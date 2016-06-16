<?php
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Тестування</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3>Назва тесту:
                        <strong><?= $test->name ?></strong>
                    </h3>
                    <div class="progress progress-striped active">
                        <div class="progress-bar" style="width: <?= $curr * 100 / $all; ?>%"></div>
                    </div>
                </div>
            </div>
            <!--QUESTIONS-->
            <?php if (count($test->questions) > $curr) { ?>
            <div class="row">
                <?php $form = \yii\widgets\ActiveForm::begin(['action' => "/test/student/pass?id=$test->id&cur_question=" . ($curr + 1)]) ?>
                <div class="col-sm-12">
                    <h4><?= $test->questions[$curr]->text; ?></h4>
                    <table class="table">
                        <thead>
                        <tr></tr>
                        <tr></tr>
                        </thead>
                        <tbody>
                        <?php foreach ($test->questions[$curr]->answers as $answer) { ?>
                            <input type="hidden" name="question" value="<?= $test->questions[$curr]->id ?>">
                            <tr>
                                <td width="10px"><input type="checkbox" name="Answers[<?= $answer->id ?>]"></td>
                                <td><?= $answer->text ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?= Html::submitButton('Наступне питання', ['class' => 'btn btn-raised btn-primary']); ?>
                <?php $form->end() ?>
                <?php } else { ?>
                    <?= Html::a('Закінчити тест', '/test/student/finish?id=' . $test->id, ['class' => 'btn btn-raised btn-primary']) ?>
                <?php } ?>

            </div>
        </div>
    </div>
</div>