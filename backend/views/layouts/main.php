<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use common\widgets\NavBarCustom;

$user_role = Yii::$app->session->get('role');
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
        'brandLabel' => 'Электронная книга',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ]
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems = [
            ['label' => 'Домашня сторінка', 'url' => ['/']],
        ];
        $menuItems[] = ['label' => 'Виход', 'url' => ['/site/logout']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBarCustom::end();
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php if (!Yii::$app->user->isGuest) { ?>
            <div class="col-sm-2">
                <?php

                $menuItems = [];
                //if user is admin
                if($user_role === User::ROLE_ADMIN) {
                    $menuItems = [
                        ['label' => 'Користувачі', 'url' => '/users/'],
                        ['label' => 'Предмети', 'url' => '/subjects/']
                    ];
                }
                $menuItems[] = ['label' => 'Документи', 'url' => '/documents/'];
                echo Nav::widget([
                    'options' => ['class' => ''],
                    'items' => $menuItems,
                ]);
                ?>
            </div>
            <div class="col-sm-10">
                <?php } else echo '<div class="col-sm-12">'; ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-center">&copy; B&amp;V Inc. <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<?php $this->registerJsFile('/js/users.js'); ?>
</body>
</html>
<?php $this->endPage() ?>
