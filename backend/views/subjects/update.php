<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subjects */

$this->title = 'Змінити предмет: ' . $model->name;
?>
<div class="jumbotron">
    <div class="subjects-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
