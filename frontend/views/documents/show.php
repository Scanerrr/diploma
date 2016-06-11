<?php
use yii\helpers\Html;

?>
<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-12">
                    <a id="prev" class="btn btn-raised btn-xs"
                       href="/documents/getprev?id=<?= $document['id'] ?>">
                        <div class="glyphicon glyphicon-chevron-left"></div>
                    </a>
                    <a id="next" class="btn btn-raised btn-xs"
                       href="/documents/getnext?id=<?= $document['id'] ?>">
                        <div class="glyphicon glyphicon-chevron-right"></div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"><strong>Iм`я викладача: </strong><span
                        style="text-decoration: underline;"><?= Html::encode($document['user']); ?></span></div>
                <div class="col-sm-4"><strong>Назва предмету:</strong><span
                        style="text-decoration: underline;"> <?= Html::encode($document['subject']); ?></span>
                </div>
                <div class="col-sm-4"><strong>Тип документу:</strong><span
                        style="text-decoration: underline;"> <?= Html::encode($document['type']); ?></div>
                </span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-info">Тема лекції:
                        <br>
                        <span
                            style="word-wrap: break-word;text-decoration: underline;"><?= HTML::encode($document['name']) ?></span>
                    </h3></div>
                <div class="col-sm-12">
                    <div class="document-text"><?= $document['text'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var button = $('<a href="#" id="scroller">Наверх</a>').addClass('btn btn-info btn-raised').css({
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