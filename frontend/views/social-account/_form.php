<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\SocialNetworks;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\SocialAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="social-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $networks = SocialNetworks::find()->all();
        $items = ArrayHelper::map($networks, 'id', 'title');
        echo $form->field($model, 'network_id')->dropDownList($items);
    ?>

    <?= $form->field($model, 'relative_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
