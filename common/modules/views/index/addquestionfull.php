<?php
use yii\helpers\Html;

$this->title = 'Додати запитання';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="test-edit">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Додати запитання</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $form = \yii\widgets\ActiveForm::begin() ?>
                        <?= $form->field($question, 'text') ?>
                        <div class="row">
                            <div class="col-sm-1"><h1>1.</h1></div>
                            <div class="col-sm-1"><?= $form->field($answer1, '[1]isCorrect')->checkbox() ?></div>
                            <div
                                class="col-sm-10"><?= $form->field($answer1, '[1]text')->input(['id' => 'ololo']) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"><h1>2.</h1></div>
                            <div class="col-sm-1"><?= $form->field($answer2, '[2]isCorrect')->checkbox() ?></div>
                            <div class="col-sm-10"><?= $form->field($answer2, '[2]text') ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"><h1>3.</h1></div>
                            <div class="col-sm-1"><?= $form->field($answer3, '[3]isCorrect')->checkbox() ?></div>
                            <div class="col-sm-10"><?= $form->field($answer3, '[3]text') ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"><h1>4.</h1></div>
                            <div class="col-sm-1"><?= $form->field($answer4, '[4]isCorrect')->checkbox() ?></div>
                            <div class="col-sm-10"><?= $form->field($answer4, '[4]text') ?></div>
                        </div>
                        <div class="col-sm-12">
                            <?= Html::submitButton('Додати запитання', ['class' => 'btn']) ?>
                        </div>
                        <?php $form->end(); ?>
                    </div
                </div>

            </div>
        </div>
    </div>
</div>