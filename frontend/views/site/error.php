<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Не знайдено';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="site-error">

                <h1>Не знайдено</h1>

                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>

                <?= Html::a('Назад', '/site/index') ?>

            </div>
        </div>
    </div>
</div>
