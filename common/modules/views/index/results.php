<?php
use common\models\User;
use yii\helpers\Html;

$this->title = 'Результати тестів';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="test-default-index">
                <h1>Результати</h1>
                <?php \yii\widgets\Pjax::begin() ?>
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dp,
                    'filterModel' => $sm,
                    'summary' => '',
                    'emptyText' => 'По даному запиту нічого не знайдено',
                    'columns' => [
                        [
                            'attribute' => 'name',
                            'value' => 'test.name',
                            'label' => 'Назва тесту'
                        ],
                        [
                            'attribute' => 'username',
                            'value' => 'owner.name',
                            'label' => "Ім'я студенту"
                        ],
                        [
                            'label' => 'Оцінка',
                            'attribute' => 'mark'
                        ]
                    ]
                ]) ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>