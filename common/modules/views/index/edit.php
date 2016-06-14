<?php
use yii\helpers\Html;

$this->title = 'Перегляд тесту';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="test-edit">
                <div class="row">
                    <div class="col-sm-12">
                        <h1><?= $test->name ?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?= Html::a('Додати закрите запитання', '/test/index/addquestionbool?id=' . $test->id, ['class' => 'btn btn-primary']); ?>
                        <?= Html::a('Додати відкрите запитання', '/test/index/addquestionfull?id=' . $test->id, ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr></tr>
                            <tr></tr>
                            <tr></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($test->questions as $question) { ?>
                                <tr>
                                    <td colspan="2"><strong><?= $question->text ?></strong></td>
                                    <td width="10px"><?= Html::a('<span class="glyphicon glyphicon-remove"></span>','/test/index/deletequestion?id=' . $question->id . '&test_id=' . $test->id); ?></td>
                                </tr>
                                <?php foreach ($question->answers as $answer) { ?>
                                    <tr class="<?= $answer->isCorrect == 1 ? 'success' : 'danger' ?>">
                                        <td width="10px">
                                            <?= $answer->isCorrect == 1 ? '+' : '-' ?>
                                        </td>
                                        <td colspan="2">
                                            <?= $answer->text ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
