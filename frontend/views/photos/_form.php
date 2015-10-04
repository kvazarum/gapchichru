<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Photos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // echo $form->field($model, 'file')->fileInput();
        echo $form->field($model, 'file')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                'uploadUrl' => Url::to(['/uploads']),
                'removeClass' => 'btn btn-danger',
                'initialCaption' => "Имя файла для загрузки"
            ]
        ]);
    ?>

    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'isAvatar')->checkbox() ?>
    
    <?= $form->field($model, 'relative_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
