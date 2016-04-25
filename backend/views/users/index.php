<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<h1>Пользователи</h1>

<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>

<table class="table">
    <thead>
    <tr>
        <td width="10%">ID</td>
        <td width="25%">Логин</td>
        <td width="45%">Имя</td>
        <td width="20%">Роль</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= Html::encode($user['username']); ?></td>
            <td><?= Html::encode($user['name']); ?></td>
            <td><select class="form-control user-select" name="roles" id="<?= $user['id'] ?>">
                    <option value="<?= $user['role_id'] ?>"><?= $user['role_name'] ?></option>
                    <?php foreach ($roles as $role) { ?>
                        <?php if ($role['id'] != $user['role_id']) { ?>
                            <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                        <?php } ?>
                    <?php } ?>
                </select></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
