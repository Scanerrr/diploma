<?php

namespace frontend\controllers;

use common\models\Documents;
use common\models\DocumentsSearch;
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
                        'actions' => ['index','getprev', 'getnext', 'view'],
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

        $document = Documents::find()
            ->select('documents.id, documents.name, documents.text, document_types.name AS type, subjects.name AS subject, user.name AS user')
            ->innerJoin('subjects', 'subjects.id = subject_id')
            ->innerJoin('user', 'user.id = owner_id')
            ->innerJoin('document_types', 'type_id = document_types.id')
            ->where(['documents.id' => $documentID])
            ->asArray()
            ->one();


        Yii::trace($document['text'], 'text');
        if (!empty($document)) {
            return $this->render('show', [
                'document' => $document,
            ]);
        } else {
            return $this->redirect('/documents');
        }
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
