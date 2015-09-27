<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Cemeteries */

$this->title = 'Create Cemeteries';
$this->params['breadcrumbs'][] = ['label' => 'Cemeteries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cemeteries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
