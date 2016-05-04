<?php

namespace backend\controllers;

use common\models\Documents;
use common\models\Subjects;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class DocumentsController extends Controller
{
    public function actionIndex()
    {
        $count = Documents::find()->count();
        $documentPerPage = 5;
        $paginator = new Pagination(['totalCount' => $count, 'pageSize' => $documentPerPage]);

        $documents = Documents::find()
            ->select(['documents.id', 'documents.name', 'user.name AS user', 'subjects.name AS subject'])
            ->innerJoin('user', 'user.id = owner_id')
            ->innerJoin('subjects', 'subjects.id = subject_id')
            ->offset($paginator->offset)
            ->limit($paginator->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'documents' => $documents,
            'pages' => $paginator
        ]);
    }

    public function actionCreate()
    {
        $model = new Documents();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $this->redirect('../');
        }

        $data = Subjects::find()->asArray()->all();

        $subjects = [];
        foreach ($data as $d) {
            $subjects[$d['id']] = $d['name'];
        }

        return $this->render('create', [
            'model' => $model,
            'subjects' => $subjects
        ]);
    }


    public function actionGetprev()
    {
        $curID = intval(Yii::$app->request->get('id'));
        $neededID = Documents::getPrev($curID);
        $this->redirect('/documents/show?id=' . $neededID);
    }

    public function actionGetnext()
    {
        $curID = intval(Yii::$app->request->get('id'));
        $neededID = Documents::getNext($curID);
        $this->redirect('/documents/show?id=' . $neededID);
    }

    public function actionShow()
    {
        //grab current document by page id
        $documentID = Yii::$app->request->get('id');
        $documentID = intval($documentID);

        $document = Documents::find()
            ->select('documents.id, documents.name, documents.text, subjects.name AS subject, user.name AS user')
            ->innerJoin('subjects', 'subjects.id = subject_id')
            ->innerJoin('user', 'user.id = owner_id')
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

    public function actionRemove()
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
