<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\NavBarCustom;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBarCustom::begin([
        'brandLabel' => 'Електронна книга',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ]
    ]);
    $menuItems = [
        ['label' => 'Домашня сторінка', 'url' => ['/site/index']],
        ['label' => 'О сервісі', 'url' => ['/site/about']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Реєстрація', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Увійти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>' . Html::a('Вийти', '/site/logout') .'</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBarCustom::end();
    ?>

    <div class="container-fluid">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="text-center">&copy; B&amp;V Inc. <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
