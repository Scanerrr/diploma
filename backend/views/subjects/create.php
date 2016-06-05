<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subjects */

$this->title = 'Додати новий предмет';
?>
<div class="jumbotron">
    <div class="subjects-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
