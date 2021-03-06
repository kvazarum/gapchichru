<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Families */

$this->title = 'Create Families';
$this->params['breadcrumbs'][] = ['label' => 'Families', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="families-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
