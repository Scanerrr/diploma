<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php if (Yii::$app->user->isGuest): ?>

        <div class="jumbotron">
            <h1>Електронна бібліотека</h1>
            <p class="lead">Сайт для ознайомлення з навчальним матерілом.</p>
            <?= \yii\helpers\Html::a('Увійти', '/site/login', ['class' => 'btn btn-raised btn-lg btn-primary']) ?>
        </div>
    <?php endif; ?>

    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="body-content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="jumbotron">
                        <h1>Документи</h1>
                        <p>Сторінка зі всіма єлектронними підручниками.</p>

                        <?= \yii\helpers\Html::a('Документи', '/documents', ['class' => 'btn btn-raised btn-lg btn-primary']) ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="jumbotron">
                        <h1>Тестування</h1>
                        <p>Сторінка з тестами по кожному предмету.</p>

                        <?= \yii\helpers\Html::a('Тестуватися', '/tests', ['class' => 'btn btn-raised btn-lg btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>
