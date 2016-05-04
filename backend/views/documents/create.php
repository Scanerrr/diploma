<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#users" aria-controls="home" role="tab" data-toggle="tab">Создать
            вручную</a>
    </li>
    <li role="presentation"><a href="#roles" aria-controls="profile" role="tab" data-toggle="tab">Загрузка с файла</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="users">
        <?php $form = \yii\bootstrap\ActiveForm::begin([]); ?>
        <?= $form
            ->field($model, 'name')->textInput(); ?>
        <?= $form
            ->field($model, 'text')->textarea(); ?>
        <?= $form
            ->field($model, 'owner_id', ['template' => '{input}'])
            ->hiddenInput(['value' => Yii::$app->user->id]); ?>
        <?= $form
            ->field($model, 'subject_id', ['template' => '{label}{input}{error}'])
            ->dropDownList($subjects); ?>
        <button type="submit" class="btn btn-default">Создать</button>
        <?php $form->end(); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="roles">
        <form action="../fromfile" method="post">
            <div class="form-group">
                <label for="exampleInputFile">Загрузить файл</label>
                <input type="file" name="file">
                <p class="help-block"></p>
            </div>
            <button type="submit" class="btn btn-default">Загрузить</button>
        </form>
    </div>
</div>