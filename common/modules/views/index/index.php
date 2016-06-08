<?php
use yii\helpers\Html;
?>

<div class="test-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>

    <?= Html::a('Створити тест', 'index/create') ?>
    <?php \yii\widgets\Pjax::begin() ?>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dp,
        'filterModel' => $filterModel,
        'summary' => '',
        //'onEmptyText' => 'asdasd',
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->name, 'edit?id=' . $model->id);
                }
            ],
            [
                'attribute' => 'username',
                'label' => "Ім'я користувача",
                'value' => 'owner.name'
            ]
        ]
    ]) ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
