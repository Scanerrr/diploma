<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предмети';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати предмет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?php if($dataProvider->getCount() > 0) { ?>
    <table class="table">
        <thead>
        <tr>
            <td width="80%">Назва предмету</td>
            <td colspan="2" class="text-center">Управління</td>
        </tr>
        </thead>
        <tbody>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'showOnEmpty' => false,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return '<tr>
                <td>' . Html::encode($model->name) . '</td>
                <td>' . Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) . '</td>
                <td>' . Html::a('Видалити', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => [
                    'confirm' => 'Ви впевнені, що хочете видалити даний предмет?',
                    'method' => 'post',
                ]]) . '</td>
            </tr>';
            },
        ]) ?>
        </tbody>
    </table>
<?php } else echo '<h5>Нічого не знайдено.</h5>' ?>
    <?php Pjax::end(); ?></div>
