<?php

namespace backend\controllers;

use common\models\Documents;
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

        $documents = Documents::find()->select(['id', 'name'])->offset($paginator->offset)
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


        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionShow()
    {
        //grab current document by page id
        $documentID = Yii::$app->request->get('id');
        $documentID = intval($documentID);

        $document = Documents::find()->where(['id' => $documentID])->one();

        //get owner
        $ownerID = $document['owner_id'];
        $owner = Documents::getOwnerNameByID($ownerID);

        if (!empty($document)) {
            return $this->render('show', [
                'document' => $document,
                'owner' => $owner,
            ]);
        } else {
            return $this->redirect('/documents');
        }
    }

    public function actionRemove() {
        $documentID = Yii::$app->request->get('id');
        $documentID = intval($documentID);

        $document = Documents::find()->where(['id' => $documentID])->one();
        if(!empty($document)) {
            $document->delete();
            return $this->redirect('/documents');
        } else {
            echo "lol";
        }
    }

}
