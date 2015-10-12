<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Families */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="families-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'husband_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wife_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mdate')->textInput() ?>

    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
