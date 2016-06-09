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
                        <p>Сторінка зі всіма єлектронними підручниками. </p>

                        <?= \yii\helpers\Html::a('Документи', '/documents', ['class' => 'btn btn-raised btn-lg btn-primary']) ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="jumbotron">
                        <h1>Тестування</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                            ut
                            aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum
                            dolore eu
                            fugiat nulla pariatur.</p>

                        <?= \yii\helpers\Html::a('Тестуватися', '/test', ['class' => 'btn btn-raised btn-lg btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>
