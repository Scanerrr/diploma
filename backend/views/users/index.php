<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>


<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#users" aria-controls="home" role="tab" data-toggle="tab">Користувачі</a>
    </li>
    <li role="presentation"><a href="#roles" aria-controls="profile" role="tab" data-toggle="tab">Ролі</a></li>
</ul>

<div class="jumbotron">
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="users">
            <?= LinkPager::widget([
                'pagination' => $pages,
                'hideOnSinglePage' => false
            ]); ?>

            <table class="table">
                <thead>
                <tr>
                    <td width="10%">ID</td>
                    <td width="25%">Логін</td>
                    <td width="45%">Ім'я</td>
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
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="roles">
            <table class="table">
                <thead>
                <tr>
                    <td>Назва ролі</td>
                    <td>Опис ролі</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($roles as $role) { ?>
                    <tr>
                        <td><?= $role['name'] ?></td>
                        <td><?= $role['description'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



