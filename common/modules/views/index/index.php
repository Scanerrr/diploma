<?php
use common\models\User;
use yii\helpers\Html;

$user_role = Yii::$app->session->get('role');
$this->title = 'Тести';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="test-default-index">
                <h1>Тести</h1>

                <!--SHOW button only for teacher-->
                <?php if ($user_role != User::ROLE_STUDENT) { ?>
                    <?= Html::a('Створити тест', 'index/create', ['class' => 'btn btn-primary']) ?>
                <?php } ?>
                <?php \yii\widgets\Pjax::begin() ?>
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dp,
                    'filterModel' => $filterModel,
                    'summary' => '',
                    'columns' => [
                        [
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function ($model) use ($user_role) {
                                if ($user_role != User::ROLE_STUDENT)
                                    return Html::a($model->name, 'index/edit?id=' . $model->id);
                                return Html::a($model->name, 'student/quiz?id=' . $model->id);
                            }
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'attribute' => 'username',
                            'label' => "Ім'я викладача",
                            'value' => 'owner.name'
                        ],
                        [
                            'format' => 'raw',
                            'value' => function ($obj) use ($user_role) {
                                if ($user_role != User::ROLE_STUDENT)
                                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', '/test/index/delete?id=' . $obj->id);
                                return '';
                            }
                        ]
                    ]
                ]) ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>