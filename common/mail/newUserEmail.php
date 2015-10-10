<?php

/**
 * @var $this yii\web\View
 * @var $user frontend\models\User
 */
use yii\helpers\Html;

echo 'Регистрация нового пользователя на сайте gapchich.ru';
echo '<br />Имя пользователя: '.$user->username;
echo '<br />Email: '.$user->email;
echo '<br />Время регистрации: '.date('d-m-Y H:i:s', time());

?>
