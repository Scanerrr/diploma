<?php

namespace frontend\controllers;

use common\models\Documents;
use common\models\DocumentsSearch;
use DOMDocument;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DocumentsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'getprev', 'getnext', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $filterModel = new DocumentsSearch();
        $dp = $filterModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dp' => $dp,
            'filterModel' => $filterModel
        ]);
    }

    public function actionView()
    {
        //grab current document by page id
        $documentID = Yii::$app->request->get('id');
        $documentID = intval($documentID);

        if (!empty($documentID)) {
            $document = Documents::find()
                ->select('documents.id, documents.name, documents.text, document_types.name AS type, subjects.name AS subject, user.name AS user')
                ->innerJoin('subjects', 'subjects.id = subject_id')
                ->innerJoin('user', 'user.id = owner_id')
                ->innerJoin('document_types', 'type_id = document_types.id')
                ->where(['documents.id' => $documentID])
                ->asArray()
                ->one();

            $replacement = Yii::getAlias('@uploads');

            // get text of documents and change links in there for images and iframes
            $dom = new DOMDocument;
            $dom->loadHTML($document['text']);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $image) {
                $image->setAttribute('src', $replacement . '/uploads/' . $image->getAttribute('src'));
            }
            $iframes = $dom->getElementsByTagName('iframe');
            foreach ($iframes as $iframe) {
                $iframe->setAttribute('src', $replacement . $iframe->getAttribute('src'));
            }
            $document['text'] = $dom->saveHTML();

            if (!empty($document)) {
                return $this->render('show', [
                    'document' => $document,
                ]);
            }
        }
        return $this->redirect('/documents');
    }

    public
    function actionGetprev()
    {
        $curID = intval(Yii::$app->request->get('id'));
        $neededID = Documents::getPrev($curID);
        $this->redirect('/documents/view?id=' . $neededID);
    }

    public
    function actionGetnext()
    {
        $curID = intval(Yii::$app->request->get('id'));
        $neededID = Documents::getNext($curID);
        $this->redirect('/documents/view?id=' . $neededID);
    }
}
