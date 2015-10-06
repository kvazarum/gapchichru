<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap ">
    <?php
    NavBar::begin([
        'brandLabel' => 'gapchich.ru',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    ActiveForm::begin(
        [
            'action' => ['search/index'],
//            'method' => 'post',
            'options' => [
                'class' => 'navbar-form navbar-right'
            ]
        ]
    );
    echo Html::beginTag('div', ['class' => 'inbox-group inbox-group-sm']);
        echo Html::input(
            'type: text',
            'search',
            '',
            [
                'placeholder' => 'Найти ...',
                'class' => 'form-control'
            ]
        );
    echo Html::endTag('div');
    ActiveForm::end();
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'О сайте', 'url' => ['/site/about']],
        ['label' => 'Сообщение', 'url' => ['/site/contact']],
        ['label' => 'История фамилии', 'url' => ['/site/history']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
        if (Yii::$app->user->can('moder'))
        {
            $menuItems[] = ['label' => 'Справочники', 
                "items" => [
                    ['label' => 'Люди', 'url' => ['/relatives']],
                    ['label' => 'Семьи', 'url' => ['/families']],
                    ['label' => 'Список мест захоронений', 'url' => ['/cemeteries']],
                    ['label' => 'Фото, документы', 'url' => ['/photos']],
                    ['label' => 'Пользователи', 'url' => ['/admin/user']],
                ]];
        }
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; gapchich.ru <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
