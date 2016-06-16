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
                <?= Html::a('Створити тест', 'index/create', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Переглянути результати тестів', 'index/results', ['class' => 'btn btn-primary']) ?>
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
                                return Html::a($model->name, 'index/edit?id=' . $model->id);
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
                            'label' => 'Спроби',
                            'value' => 'tries'
                        ],
                        [
                            'format' => 'raw',
                            'value' => function ($obj) {
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>', '/test/index/delete?id=' . $obj->id);
                            }
                        ],

                    ]
                ]) ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>