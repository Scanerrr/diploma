<?php

namespace backend\controllers;

use common\models\Documents;
use common\models\DocumentsSearch;
use common\models\DocumentTypes;
use common\models\Subjects;
use common\models\UploadFile;
use Yii;
use yii\web\UploadedFile;

class DocumentsController extends DefaultController
{
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
                $id = $model->upload();
                if (!empty($id)) {
                    return $this->redirect('/documents/view?id=' . $id);
                }
            }

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

        $data = Subjects::find()->asArray()->all();

        $subjects = [];
        foreach ($data as $d) {
            $subjects[$d['id']] = $d['name'];
        }

        $data = DocumentTypes::find()->asArray()->all();

        $types = [];
        foreach ($data as $d) {
            $types[$d['id']] = $d['name'];
        }

        return $this->render('create', [
            'model' => $model,
            'subjects' => $subjects,
            'types' => $types,
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
