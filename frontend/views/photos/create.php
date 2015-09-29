<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Photos */

$this->title = 'Добавить фото, '.$model->relative->fuName;
$this->params['breadcrumbs'][] = ['label' => 'Фото', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
