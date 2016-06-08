<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumbotron">
    <div class="site-request-password-reset">
        <h1>Зброс пароля</h1>

        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Відправити', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>