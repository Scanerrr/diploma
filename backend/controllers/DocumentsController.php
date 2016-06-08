<?php

namespace backend\controllers;

use common\models\Documents;
use common\models\DocumentsSearch;
use common\models\DocumentTypes;
use common\models\Subjects;
use common\models\UploadFile;
use Yii;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class DocumentsController extends DefaultController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'fromfile', 'create', 'getprev', 'getnext', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $searchModel = new DocumentsSearch();
        $provider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'provider' => $provider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionFromfile()
    {
        $model = new UploadFile();

        if (Yii::$app->request->isPost) {
            //get the file
            $model->file = UploadedFile::getInstance($model, 'file');

            if (!empty($model->file)) {
                $filename = $model->upload();
                if (!empty($filename)) {
                    $model->load(Yii::$app->request->post());
                    $document = new Documents();
                    $document->name = $model->getTheme($filename);
                    $document->text = '<iframe style="width:100%;height:100vh" src="/' . $filename . '"></iframe>';
                    $document->owner_id = Yii::$app->user->id;
                    $document->type_id = $model->type_id;
                    $document->subject_id = $model->subject_id;
                    $document->save();
                    Yii::trace($document->errors);
                }
            }
            Yii::trace($model->errors);

            Yii::$app->session->setFlash('error', 'Не вдалося завантажити файл');
        }
        return $this->redirect('/documents/create');
    }

    public function actionCreate()
    {
        $model = new Documents();
        $file_model = new UploadFile();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $this->redirect('../');
        }

        return $this->render('create', [
            'model' => $model,
            'subjects' => new Subjects(),
            'types' => new DocumentTypes(),
            'file_model' => $file_model
        ]);
    }


    public function actionGetprev()
    {
        $curID = intval(Yii::$app->request->get('id'));
        $neededID = Documents::getPrev($curID);
        $this->redirect('/documents/view?id=' . $neededID);
    }

    public function actionGetnext()
    {
        $curID = intval(Yii::$app->request->get('id'));
        $neededID = Documents::getNext($curID);
        $this->redirect('/documents/view?id=' . $neededID);
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


        if (!empty($document)) {
            return $this->render('show', [
                'document' => $document,
            ]);
        } else {
            return $this->redirect('/documents');
        }
    }

    public function actionDelete()
    {
        $documentID = Yii::$app->request->get('id');
        $documentID = intval($documentID);

        $document = Documents::find()->where(['id' => $documentID])->one();
        if (!empty($document)) {
            $document->delete();
            return $this->redirect('/documents');
        } else {
            echo "lol";
        }
    }

}
