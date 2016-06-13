<?php
/* @var $this yii\web\View */
use common\models\DocumentTypes;
use common\models\Subjects;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Документи';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <h1>Документи</h1>

            <div class="row">
                <div class="col-sm-12">
                    <?php \yii\widgets\Pjax::begin() ?>
                    <?= GridView::widget([
                        'dataProvider' => $dp,
                        'filterModel' => $filterModel,
                        'summary' => '',
                        'emptyText' => 'По даному запиту нічого не знайдено',
                        'columns' => [
                            [
                                'headerOptions' => [
                                    'class' => 'text-center'
                                ],
                                'label' => 'Тема документу',
                                'attribute' => 'name',
                                'value' => function ($model) {
                                    return substr($model->name, 0, 50);
                                },
                            ],
                            [
                                'headerOptions' => [
                                    'class' => 'text-center'
                                ],
                                'label' => "Ім'я викладача",
                                'attribute' => 'username',
                                'value' => function ($model) {
                                    return substr($model->user->name, 0, 50);
                                }
                            ],
                            [
                                'headerOptions' => [
                                    'class' => 'text-center'
                                ],
                                'label' => 'Назва предмету',
                                'attribute' => 'subject_name',
                                'filter' => Html::activeDropDownList($filterModel, 'subject_name', ArrayHelper::map(Subjects::find()->asArray()->all(), 'name', 'name'), ['class' => 'form-control', 'prompt' => 'Всі предмети']),
                                'value' => function ($model) {
                                    if (strlen($model->subjects->name) > 35)
                                        return substr($model->subjects->name, 0, 35);
                                    return substr($model->subjects->name, 0, 35);
                                }
                            ],
                            [
                                'headerOptions' => [
                                    'class' => 'text-center',
                                    'style' => 'width: 110px'
                                ],
                                'label' => 'Тип документу',
                                'attribute' => 'document_type',
                                'filter' => Html::activeDropDownList($filterModel, 'document_type', ArrayHelper::map(DocumentTypes::find()->asArray()->all(), 'name', 'name'), ['class' => 'form-control', 'prompt' => 'Всі типи']),
                                'value' => function ($model) {
                                    return substr($model->document_types->name, 0, 35);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view}'
                            ]
                        ],
                    ]); ?>
                    <?php \yii\widgets\Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>