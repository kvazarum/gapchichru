<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SocialAccount */

$this->title = $model->relative->fullName.': '.$model->network->title;
$this->params['breadcrumbs'][] = ['label' => 'Социальные сети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-account-view">

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
                'attribute' => 'network_id',
                'value' => $model->network->title,
            ],
            [
                'attribute' => 'relative_id',
                'value' => $model->relative->fullName,
            ],            
            'url:url',
            [
                'attribute' => 'created_at',
                'value' => date('d-m-Y H:i:s',$model->created_at),
            ],
            [
                'attribute' => 'updated_at',
                'value' => date('d-m-Y H:i:s',$model->updated_at),
            ],            
        ],
    ]) ?>

</div>
