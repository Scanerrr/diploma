<?php

namespace backend\controllers;

use common\models\Roles;
use common\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use \yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'changerole', 'error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $usersPerPage = 5;

        $count = User::find()->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $usersPerPage]);
        $roles = Roles::find()->asArray()->all();

        $users = User::find()->select(['id', 'name', 'role', 'username'])->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();


        for ($i = 0; $i < count($users); $i++) {
            $role_id = intval($users[$i]['role']) - 1;

            $users[$i]['role_name'] = $roles[$role_id]['name'];
            $users[$i]['role_id'] = $role_id + 1;
        }

        return $this->render('index', [
            'users' => $users,
            'pages' => $pages,
            'roles' => $roles
        ]);
    }

    public function actionChangerole()
    {
        if (Yii::$app->request->isAjax) {
            $userID = Yii::$app->request->post('userID');
            $roleID = Yii::$app->request->post('roleID');
            $current_user = User::find()->where(['id' => $userID])->one();
            $current_user->role = $roleID;
            if($current_user->update(false)) {
                return "changed id: $userID";
            }
        } else {
            throw new NotFoundHttpException();
        }

    }

}
