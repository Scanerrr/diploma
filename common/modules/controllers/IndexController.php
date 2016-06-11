<?php

namespace common\modules\controllers;

use common\models\Tests;
use common\models\TestsSearch;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `test` module
 */
class IndexController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'edit', 'quiz'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $test = Tests::find()->all();
        $filterModel = new TestsSearch();
        $dp = $filterModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'test' => $test,
            'dp' => $dp,
            'filterModel' => $filterModel
        ]);
    }

    public function actionCreate()
    {
        $test = new Tests();
        if ($test->load(Yii::$app->request->post()) && $test->validate()) {
            $test->save();
            return $this->redirect('edit?id=' . Yii::$app->db->getLastInsertID());
        }

        $user_role = Yii::$app->session->get('role');
        // if user is teacher then allows to create tests
        // for frontend and backend
        if ($user_role == User::ROLE_TEACHER || $user_role === User::ROLE_ADMIN) {
            return $this->render('create', [
                'test' => $test,
            ]);
        } else {
            return $this->goBack();
        }
    }

    public function actionEdit()
    {

        $id = Yii::$app->request->get('id');
        $id = intval($id);
        $test = Tests::find()->where(['id' => $id])->one();

        $user_role = Yii::$app->session->get('role');
        // if user is teacher then allows to create tests
        // for frontend and backend
        if ($user_role == User::ROLE_TEACHER || $user_role === User::ROLE_ADMIN) {
            return $this->render('edit', [
                'test' => $test,

            ]);
        } else {
            return $this->goBack();
        }
    }

    public function actionQuiz()
    {

        $id = Yii::$app->request->get('id');
        $id = intval($id);
        $test = Tests::find()->where(['id' => $id])->one();

        return $this->render('quiz', [
            'test' => $test,

        ]);

    }
}
