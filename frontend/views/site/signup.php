<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля для регистрации:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            
            <?php 
                if ($model->scenario === 'emailActivation'):
            ?>
            <i>*На указанный Email будет отправлено письмо для активации аккаунта.</i>
            <?php
                endif;
            ?>
        </div>
		<div class="col-lg-5">
			Данный сайт является частным архивом, поэтому регистрация будет активирована только в случае, если Вы каким-либо образом относитесь к фамилии Гапчич. <br />
			Любая регистрация, которая не соответствует данному условию - может быть отменена без предварительного уведомления.<br />
			Если Вы не согласны с этими условиями - не регистрируйтесь.<br />
			Регистрируясь здесь - Вы подтверждаете своё согласие с вышеуказанными условиями.
		</div>
    </div>
</div>
