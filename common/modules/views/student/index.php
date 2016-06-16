<?php
use common\models\User;
use yii\helpers\Html;

$this->title = 'Тести';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="test-default-index">
                <h1>Тести</h1>
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
                            'value' => function ($model) {
                                return Html::a($model->name, '/test/student/pass?id=' . $model->id);
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
                            'headerOptions' => [
                                'class' => 'text-center',
                                'width' => '30px'
                            ],
                            'label' => 'Спроби',
                            'value' => function ($obj) {
                                return count($obj->results) . '/' . $obj->tries;
                            }
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center',
                                'width' => '35px'
                            ],
                            'label' => 'К-сть питань',
                            'value' => function ($obj) {
                                return count($obj->questions);
                            }
                        ]
                    ]
                ]) ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>