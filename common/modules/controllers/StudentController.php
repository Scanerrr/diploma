<?php

namespace common\modules\controllers;

use common\models\Answers;
use common\models\Questions;
use common\models\Results;
use common\models\Tests;
use common\models\TestsSearch;
use common\models\UserAction;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class StudentController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'pass', 'finish'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $tests = Tests::find()->all();
        $filterModel = new TestsSearch();
        $dp = $filterModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'test' => $tests,
            'dp' => $dp,
            'filterModel' => $filterModel
        ]);
    }

    public function actionPass($id = null, $cur_question = null)
    {

        if (!isset($cur_question)) $cur_question = 0;
        $user_id = Yii::$app->user->id;

        //set result of an answer
        $answers = Yii::$app->request->post()['Answers'];
        $question_id = Yii::$app->request->post()['question'];

        if (!empty($question_id)) {
            if (!(UserAction::find()->where(['question_id' => $question_id, 'user_id' => $user_id])->exists())) {
                $action = new UserAction();
                if (!empty($answers)) {
                    $action->user_id = $user_id;
                    $action->question_id = $question_id;
                    $action->answers = json_encode($answers);
                    $action->save();
                } else {
                    $action->user_id = $user_id;
                    $action->question_id = $question_id;
                    $action->answers = json_encode([]);
                    $action->save();
                }
            }

        }


        if (!empty($id = intval($id)) && isset($cur_question)) {

            $test = Tests::findOne(['id' => $id]);

            if (count($test->results) >= $test->tries || count($test->questions) === 0) {
                return $this->redirect('/test/student');
            }

            return $this->render('pass', [
                'test' => $test,
                'curr' => intval($cur_question),
                'all' => count($test->questions)
            ]);
        }
        return $this->redirect('/test/student');
    }

    public function actionFinish($id = null)
    {
        if (!empty($id = intval($id))) {
            $actions = UserAction::find()->select(['answers', 'question_id'])->where(['user_id' => Yii::$app->user->id])->asArray()->all();
            $right_answers = 0;
            foreach ($actions as $action) {
                $isCorrect = false;
                $answers = json_decode($action['answers'], true);
                $right_answers_count = Answers::find()->where(['question_id' => $action['question_id'], 'isCorrect' => 1])->count();
                if ($right_answers_count != count($answers)) {
                    continue;
                }
                foreach ($answers as $answer_id => $on) {
                    $db_answer = Answers::findOne(['id' => $answer_id]);
                    if ($db_answer->isCorrect == 1) {
                        $isCorrect = true;
                    } else {
                        $isCorrect = false;
                        break;
                    }
                }
                if ($isCorrect) {
                    $right_answers++;
                }
            }
            //count mark
            $all_question_in_test = Questions::find()->where(['test_id' => $id])->count();
            $mark = $right_answers * 12 / $all_question_in_test;

            $result = new Results();
            $result->owner_id = Yii::$app->user->id;
            $result->test_id = $id;
            $result->mark = floor($mark);
            $result->save();
            UserAction::deleteAll(['user_id' => Yii::$app->user->id]);

            return $this->render('finish', [
                'all' => $all_question_in_test,
                'right' => $right_answers,
                'mark' => $mark,
                'test' => Tests::findOne(['id' => $id])
            ]);
        }

        return $this->goHome();
    }
}