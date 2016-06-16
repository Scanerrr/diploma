<?php
$this->title = 'Створити тест';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="test-default-index">
                <h1>Створити тест</h1>
                <?php $form = \yii\widgets\ActiveForm::begin() ?>
                <div class="row">
                    <?= $form->field($test, 'name') ?>
                </div>
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-5">
                        <?= $form->field($test, 'tries')->input('text', ['value' => 1, 'class' => 'text-center form-control']) ?>
                    </div>
                </div>
                <?= $form->field($test, 'owner_id', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->getId()]) ?>
                <?= \yii\helpers\Html::submitButton('Створити', ['class' => 'btn btn-lg btn-primary btn-raised']) ?>
                <?php $form->end() ?>
            </div>
        </div>
    </div>