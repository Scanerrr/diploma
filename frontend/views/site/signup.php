<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Реєстрація';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="site-signup text-center">
                <h1>Реєстрація</h1>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Ivan']) ?>

                        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Иванов Иван Иванович']) ?>

                        <?= $form->field($model, 'email')->input('email', ['placeholder' => 'example@dom.com']) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => '*******']) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6 col-lg-offset-1">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Реєстрація', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
