<br>
<a data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-danger">Удалить текущую лекцию</a>
<h2><?= $document['name'] ?></h2>

<p><?= $document['text'] ?></p>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Вы действительно хотите удалить текущую лекцию?</h4>
            </div>
            <div class="modal-footer">
                <a href="/documents/remove?id=<?= $document['id'] ?>" class="btn btn-danger">Удалить</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>