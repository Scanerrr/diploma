<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Документи";
?>
<h1>Документи</h1>
<a href="/documents/create" class="btn btn-info">Створити нову лекцію</a>
<br>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $searchModel,
            'summary' => '<br>',
            'showOnEmpty' => false,
            'columns' => [
                [
                    'attribute' => 'name',
                    'filter' => Html::input('text', 'DocumentSearch[name]'),
                    'value' => function ($model) {
                        return substr($model->name, 0, 50);
                    },
                ],
                [
                    'label' => "Ім'я користувача",
                    'attribute' => "user.name",
                    'filter' => Html::input('text', 'DocumentSearch[user.name]'),
                    'value' => function ($model) {
                        return substr($model->user->name, 0, 50);
                    },
                ],
                [
                    'label' => 'Назва предмету',
                    'attribute' => "subjects.name",
                    'filter' => Html::input('text', 'DocumentSearch[subjects.name]'),
                    'value' => function ($model) {
                        return substr($model->subjects->name, 0, 50);
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}'
                ]
            ],
        ]) ?>
    </div>
</div>

