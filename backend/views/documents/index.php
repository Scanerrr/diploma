<?php
/* @var $this yii\web\View */
use common\models\DocumentTypes;
use common\models\Subjects;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = "Документи";
?>

<div class="jumbotron">
    <h1>Документи</h1>
    <a href="/documents/create" class="btn btn-primary">Створити нову лекцію</a>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <?= GridView::widget([
                'dataProvider' => $provider,
                'filterModel' => $searchModel,
                'summary' => '<br>',
                'emptyText' => 'По даному запиту нічого не знайдено',
                'columns' => [
                    [
                        'label' => 'Назва документу',
                        'attribute' => 'name',
                        'value' => function ($model) {
                            if (strlen($model->name) > 36) {
                                return substr($model->name, 0, 36) . '...';
                            }
                            return substr($model->name, 0, 36);
                        },
                    ],
                    [
                        'label' => "Ім'я користувача",
                        'attribute' => "username",
                        'value' => function ($model) {
                            return substr($model->user->name, 0, 46);
                        },
                    ],
                    [
                        'label' => 'Назва предмету',
                        'attribute' => "subject_name",
                        'filter' => Html::activeDropDownList($searchModel, 'subject_name', ArrayHelper::map(Subjects::find()->asArray()->all(), 'name', 'name'), ['class' => 'form-control', 'prompt' => 'Всі предмети']),
                        'value' => function ($model) {
                            return substr($model->subjects->name, 0, 36);
                        },
                    ],
                    [
                        'label' => 'Тип документу',
                        'attribute' => 'document_type',
                        'filter' => Html::activeDropDownList($searchModel, 'document_type', ArrayHelper::map(DocumentTypes::find()->asArray()->all(), 'name', 'name'), ['class' => 'form-control', 'prompt' => 'Всі типи']),
                        'value' => function ($model) {
                            return substr($model->document_types->name, 0, 36);
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {delete}'
                    ]
                ],
            ]) ?>
        </div>
    </div>
</div>
