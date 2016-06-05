<?php use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('/js/editor/tinymce.min.js', [
    'position' => \yii\web\View::POS_HEAD
]); ?>
<script>
    tinymce.init({
        height: 500,
        selector: 'textarea',
        language: 'uk_UA',
        statusbar: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste jbimages"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages"
    })
</script>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#users" aria-controls="home" role="tab" data-toggle="tab">Создать
            вручную</a>
    </li>
    <li role="presentation"><a href="#roles" aria-controls="profile" role="tab" data-toggle="tab">Загрузка с файла</a>
    </li>
</ul>

<div class="jumbotron">
    <!-- Tab panes -->
    <div class="tab-content">
        <?= Alert::widget() ?>
        <div role="tabpanel" class="tab-pane active" id="users">
            <div class="row">
                <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

                <div class="col-sm-12">
                    <?= $form
                        ->field($model, 'name')->textInput(['maxlength' => 65]); ?>
                </div>
                <div class="col-sm-6">
                    <label>Предмет: <?= Html::activeDropDownList($model, 'subject_id', ArrayHelper::map($subjects->find()->all(), 'id', 'name'),
                            ['class' => 'form-control']) ?></label>
                </div>
                <div class="col-sm-6">
                    <label>Тип
                        документу: <?= Html::activeDropDownList($model, 'type_id', ArrayHelper::map($types->find()->all(), 'id', 'name'),
                            ['class' => 'form-control']) ?></label>
                </div>
                <div class="col-sm-12">
                    <?= $form
                        ->field($model, 'text')->textarea(); ?>
                </div>

                <?= $form
                    ->field($model, 'owner_id', ['template' => '{input}'])
                    ->hiddenInput(['value' => Yii::$app->user->id]); ?>

                <div class="col-sm-12">
                    <button type="submit" class="btn btn-default">Создать</button>
                </div>
            </div>
            <?php $form->end(); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="roles">
            <?php $form = ActiveForm::Begin(['action' => '/documents/fromfile', 'options' => ['enctype' => 'multipart/form-data']]) ?>
            <button class="btn btn-primary btn-raised"><?= $form->field($file_model, 'file')->fileInput(); ?></button>
            <div class="form-group">
                <label>Предмет: <?= Html::activeDropDownList($file_model, 'subject_id', ArrayHelper::map($subjects->find()->all(), 'id', 'name'),
                        ['class' => 'form-control']) ?></label>
            </div>
            <div class="form-group">
                <label>Тип
                    документу: <?= Html::activeDropDownList($file_model, 'type_id', ArrayHelper::map($types->find()->all(), 'id', 'name'),
                        ['class' => 'form-control']) ?></label>
            </div>
            <?= Html::submitButton("Завантажити", ['class' => 'btn btn-primary']) ?>
            <?php $form->end(); ?>
        </div>
    </div>
</div>