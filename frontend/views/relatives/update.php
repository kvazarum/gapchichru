<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Relatives */

$this->title = 'Изменить данные: ' . ' ' . $model->fuName;
$this->params['breadcrumbs'][] = ['label' => 'Общий список', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fuName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="relatives-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
