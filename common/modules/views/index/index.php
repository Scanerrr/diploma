<?php
use common\models\User;
use yii\helpers\Html;

$user_role = Yii::$app->session->get('role');

?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="test-default-index">
                <h1>Тести</h1>

                <!--SHOW button only for teacher-->
                <?php if ($user_role == User::ROLE_TEACHER || $user_role === User::ROLE_ADMIN): ?>
                    <?= Html::a('Створити тест', 'index/create', ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
                <?php \yii\widgets\Pjax::begin() ?>
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dp,
                    'filterModel' => $filterModel,
                    'summary' => '',
                    //'onEmptyText' => 'asdasd',
                    'columns' => [
                        [
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function ($model) use ($user_role) {
                                if ($user_role === User::ROLE_TEACHER || $user_role === User::ROLE_ADMIN)
                                    return Html::a($model->name, 'index/edit?id=' . $model->id);
                                else
                                    return Html::a($model->name, 'index/quiz?id=' . $model->id);
                            }
                        ],
                        [
                            'headerOptions' => [
                                'class' => 'text-center'
                            ],
                            'attribute' => 'username',
                            'label' => "Ім'я викладача",
                            'value' => 'owner.name'
                        ]
                    ]
                ]) ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>