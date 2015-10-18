<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use frontend\models\Relatives;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Relatives */
/* @var $form yii\widgets\ActiveForm */

$month = [
    null => 'Выберите месяц ...',
    '1' => 'Январь',
    '2' => 'Февраль',
    '3' => 'Март',
    '4' => 'Апрель',
    '5' => 'Май',
    '6' => 'Июнь',
    '7' => 'Июль',
    '8' => 'Август',
    '9' => 'Сентябрь',
    '10' => 'Октябрь',
    '11' => 'Ноябрь',
    '12' => 'Декабрь',
];

$gender = [
    0 => 'Мужской',
    1 => 'Женский',
];
?>

<div class="relatives-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'rod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bday')->textInput() ?>

    <?= $form->field($model, 'bmonth')->dropDownList($month, ['class' => 'form-control'])    ?>

    <?= $form->field($model, 'byear')->textInput(['maxlength' => true]) ?>

    <?php
        
        $relatives = Relatives::findAll(['gender' => 0]);
        $array = [];
        foreach ($relatives as $rel) {
            $name = $rel->getFullName();
            $array[] = ['id' => $rel->id, 'name' => $name];
        }
        $list = ArrayHelper::map($array, 'id' , 'name');
        
//        echo $form->field($model, 'father_id')->textInput(['maxlength' => true]);
        echo $form->field($model, 'father_id')->widget(Select2::classname(), [
            'data' => $list,
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите отца ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    <?php
//        echo $form->field($model, 'mother_id')->textInput(['maxlength' => true]);
        $relatives = Relatives::findAll(['gender' => 1]);
        $array = [];
        foreach ($relatives as $rel) {
            $name = $rel->getFullName();
            $array[] = ['id' => $rel->id, 'name' => $name];
        }
        $list = ArrayHelper::map($array, 'id' , 'name');    
        echo $form->field($model, 'mother_id')->widget(Select2::classname(), [
            'data' => $list,
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите мать ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);    
    ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bplace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList($gender) ?>

    <?= $form->field($model, 'descr')->textarea() ?>

    <?= $form->field($model, 'second_sname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dmonth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dyear')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible')->textInput()->widget(CheckboxX::classname(), [
        'autoLabel'=>true,
        'pluginOptions'=>['threeState'=>false]
        ])->label(false); 
    ?>

    <?= $form->field($model, 'hidden')->textarea() ?>

    <?= $form->field($model, 'show_pict')->textInput()->widget(CheckboxX::classname(), [
        'autoLabel'=>true,
        'pluginOptions'=>['threeState'=>false]
        ])->label(false); 
    ?>

    <?= $form->field($model, 'grave_lon')->textInput() ?>

    <?= $form->field($model, 'grave_lat')->textInput() ?>

    <?= $form->field($model, 'cemetery_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grave_picture')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
