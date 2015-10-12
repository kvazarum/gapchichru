<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Families */

$this->title = $model->husband->fullName.' & '.$model->wife->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Семьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="families-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'husband_id',
                'format' => 'raw',
                'value' => Html::a($model->husband->fullName, '/relatives/view?id='.$model->husband_id),
            ],
            [
                'attribute' => 'wife_id',
                'format' => 'raw',
                'value' => Html::a($model->wife->fullName, '/relatives/view?id='.$model->wife_id),
            ],            
            'mdate',
            'descr:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
