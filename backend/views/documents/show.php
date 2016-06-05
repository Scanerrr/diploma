<?php
use yii\helpers\Html;

?>
<div class="jumbotron">
    <div class="row">
        <div class="col-sm-3" style="margin: 20px 0;">
            <a data-toggle="modal" data-target=".w-modal-sm" class="btn btn-danger">Видалити
                поточну лекцію</a>
        </div>
        <div class="col-sm-9" style="margin: 20px 0;">
            <a id="prev" class="btn btn-default" href="/documents/getprev?id=<?= $document['id'] ?>">
                <div class="glyphicon glyphicon-chevron-left"></div>
            </a>
            <a id="next" class="btn btn-default" href="/documents/getnext?id=<?= $document['id'] ?>">
                <div class="glyphicon glyphicon-chevron-right"></div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4"><strong>Iм`я викладача: </strong><span
                style="text-decoration: underline;"><?= Html::encode($document['user']); ?></span></div>
        <div class="col-sm-4"><span><strong>Назва предмету:</strong> <?= Html::encode($document['subject']); ?></span>
        </div>
        <div class="col-sm-4"><strong>Тип документу:</strong> <?= Html::encode($document['type']); ?></div>
    </div>
    <div class="row">
        <div class="col-sm-12"><h3>Тема лекції: <span
                    style="word-wrap: break-word;text-decoration: underline;"><?= HTML::encode($document['name']) ?></span>
            </h3></div>
        <div class="col-sm-12">
            <div class="document-text"><?= $document['text'] ?></div>
        </div>
        <div class="modal fade w-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ви впевнені, що хочете видалити поточну лекцію?</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="/documents/delete?id=<?= $document['id'] ?>" class="btn btn-danger">Видалити</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Відмінити</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var button = $('<a href="#" id="scroller">Наверх</a>').addClass('btn btn-info').css({
            position: 'fixed',
            bottom: '20px',
            left: '20px',
            zIndex: '900',
            display: 'none'
        });
        $(document.body).append(button);
        var obj = $('#scroller');
        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                obj.show();
            } else {
                obj.hide();
            }
        })
    });

</script>