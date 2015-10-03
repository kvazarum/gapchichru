<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Search;
use frontend\models\Relatives;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Результаты поиска';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatives-index">
    <?php 
    $searchString = $_POST['search'];
    $searchString = trim($searchString);
//    $searchString = Html::encode($searchString);
//    $searchString = Html::decode($searchString);
    echo Html::tag('p', 'Поисковая строка: '.$searchString);
    echo Html::beginTag('div', ['class' => 'panel panel-info']);
        $content = Html::tag('h3', '<i class="glyphicon glyphicon-calendar"></i> Результаты поиска', ['class' => "panel-title"]);
        echo Html::tag('div', $content, ['class' => "panel-heading"]);
    echo Html::endTag('div');
    
    $result= Search::getComplitMatch($searchString, "full");
    
    if (count($result))
    {
        echo Html::beginTag('table', ['class' => 'table table-striped table-bordered detail-view']);
        foreach ($result as $record)
        {
            echo Relatives::renderRow($record->id);
        }
        echo Html::endTag('table');        
    }
    else
    {
        echo 'нет данных';
    }
    ?>

</div>
