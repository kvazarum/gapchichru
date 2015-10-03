<?php

/**
 * @var $this yii\web\View
 * @var $user frontend\models\User
 */
use yii\helpers\Html;

echo 'Привет '.Html::encode($user->username).'.';
echo Html::a('Для активации аккаунта перейдите по этой ссылке.',
        Yii::$app->urlManager->createAbsoluteUrl(
            [
                '/site/activate-account',
                'key' => $user->activate_key
            ]
        )
    );

