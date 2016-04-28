<?php
use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <a data-toggle="modal" style="margin: 20px 0;" data-target=".bs-example-modal-sm" class="btn btn-danger">Видалити
                поточну лекцію</a>
        </div>
        <div class="col-sm-9">
            <div>
                <ul class="pagination" id="pagination">
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 bold"><strong>Iм`я викладача: </strong><span
                style="text-decoration: underline;"><?= Html::encode($owner['name']); ?></span></div>
        <div class="col-sm-6"><strong>Назва предмету:</strong></div>
    </div>
    <div class="row">
        <h3>Тема лекції: <span style="text-decoration: underline;"><?= HTML::encode($document['name']) ?></span></h3>

        <p><?= HTML::encode($document['text']) ?></p>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ви впевнені, що хочете видалити поточну лекцію?</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="/documents/remove?id=<?= $document['id'] ?>" class="btn btn-danger">Видалити</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Відмінити</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>