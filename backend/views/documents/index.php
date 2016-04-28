<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Документы</h1>

<a href="/documents/create" class="btn btn-info">Создать новую лекцию</a>
<br>
<?= LinkPager::widget([
    'pagination' => $pages,
    'hideOnSinglePage' => false
]); ?>
<table class="table">
    <thead>
    <tr>
        <td width="10%">#</td>
        <td>Название лекции</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($documents as $document) { ?>
        <tr>
            <td><?= $document['id'] ?></td>
            <td><a href="/documents/show?id=<?= $document['id'] ?>"><?= HTML::encode($document['name']) ?></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?= LinkPager::widget([
    'pagination' => $pages,
    'hideOnSinglePage' => true
]); ?>
