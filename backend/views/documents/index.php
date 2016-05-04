<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<h1>Документи</h1>
<a href="/documents/create" class="btn btn-info">Створити нову лекцію</a>
<br>
<?= LinkPager::widget([
    'pagination' => $pages,
    'hideOnSinglePage' => false
]); ?>
<table class="table">
    <thead>
    <tr>
        <td>Назва лекції</td>
        <td>Ім'я викладача</td>
        <td>Назва предмета</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($documents as $document) { ?>
        <tr>
            <td><a href="/documents/show?id=<?= $document['id'] ?>"><?= HTML::encode($document['name']) ?></a></td>
            <td><?= HTML::encode($document['user']) ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?= LinkPager::widget([
    'pagination' => $pages,
    'hideOnSinglePage' => true
]); ?>
