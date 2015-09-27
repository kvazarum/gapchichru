<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Relatives */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Relatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatives-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
