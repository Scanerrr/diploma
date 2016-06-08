<?php
/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = 'Документи';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <h1>Документи</h1>

            <div class="row">
                <div class="col-sm-12">
                    <?= GridView::widget([
                        'dataProvider' => $dp,
                        'filterModel'  => $filterModel,
                        'summary' => '',
                        'emptyText' => 'По даному запиту нічого не знайдено',
                        'columns' => [
                            [
                                'attribute' => 'name',
                                'value' => function ($model) {
                                    return substr($model->name, 0, 35);
                                },
                            ],
                            [
                                'attribute' => 'username',
                                'value' => function ($model) {
                                    return substr($model->user->name, 0, 35);
                                }
                            ],
                            [
                                'attribute' => 'subject_name',
                                'value' => function ($model) {
                                    if (strlen($model->subjects->name) > 35)
                                        return substr($model->subjects->name, 0, 35);
                                    return substr($model->subjects->name, 0, 35);
                                }
                            ],
                            [
                                'attribute' => 'document_type',
                                'value' => function ($model) {
                                    return substr($model->document_types->name, 0, 35);
                                }
                            ]
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>