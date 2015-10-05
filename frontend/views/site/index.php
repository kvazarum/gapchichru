<?php
use yii\helpers\Html;
use frontend\models\Relatives;
/* @var $this yii\web\View */

$this->title = 'gapchich.ru';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Гапчичи</h1>

        <p class="lead">Сайт посвящён фамилии Гапчич, людям с этой фамилией и их родственникам.</p>

    </div>

    <div class="body-content">

Если вы носите фамилию Гапчич - возникало ли у вас желание узнать откуда ведёт своё происхождение ваша фамилия? Как много людей в мире с такой же фамилией? Где они живут? Как с ними пообщаться? Или может быть вы когда-то потеряли связь со своим родственником и теперь хотели бы его найти?
Ответы на эти вопросы и пытается дать наш сайт.
<?php
    $count = Relatives::find()->where(['rod' => 'Гапчичи'])->count();
    echo Html::tag('p', 'Кол-во людей из рода "Гапчич" внесённые в базу - '.$count);
?>
        <div class="row">

        </div>

    </div>
</div>
