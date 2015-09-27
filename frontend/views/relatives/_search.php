<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RelativesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatives-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'index') ?>

    <?= $form->field($model, 'sname') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'mname') ?>

    <?php // echo $form->field($model, 'bdate') ?>

    <?php // echo $form->field($model, 'bday') ?>

    <?php // echo $form->field($model, 'bmonth') ?>

    <?php // echo $form->field($model, 'byear') ?>

    <?php // echo $form->field($model, 'mother_id') ?>

    <?php // echo $form->field($model, 'father_id') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'bplace') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'descr') ?>

    <?php // echo $form->field($model, 'second_sname') ?>

    <?php // echo $form->field($model, 'ddate') ?>

    <?php // echo $form->field($model, 'dday') ?>

    <?php // echo $form->field($model, 'dmonth') ?>

    <?php // echo $form->field($model, 'dyear') ?>

    <?php // echo $form->field($model, 'rod') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'last_change') ?>

    <?php // echo $form->field($model, 'hidden') ?>

    <?php // echo $form->field($model, 'show_pict') ?>

    <?php // echo $form->field($model, 'grave_lon') ?>

    <?php // echo $form->field($model, 'grave_lat') ?>

    <?php // echo $form->field($model, 'cemetery_id') ?>

    <?php // echo $form->field($model, 'grave_picture') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
