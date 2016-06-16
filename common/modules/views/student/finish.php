<?php
$this->title = 'Результат';
?>

<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Результат</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Назва тесту:
                        <strong><?= $test->name ?></strong>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Оцінка: <strong><?= $mark ?></strong></h3>
                    <h3>Вірних відповідей: <strong><?= $right . '/' . $all ?></strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= \yii\helpers\Html::a('Назад на сторінку тестів', '/test', ['class' => 'btn btn-primary btn-raised']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
