<?php

namespace frontend\controllers;

use common\models\DocumentsSearch;
use Yii;
use yii\web\Controller;

class DocumentsController extends Controller
{
    public function actionIndex()
    {
        $filterModel = new DocumentsSearch();
        $dp = $filterModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dp' => $dp,
            'filterModel' => $filterModel
        ]);
    }

}
