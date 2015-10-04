<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PhotosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Изображения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
        Pjax::begin();
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'headerOptions' => [
                    'class' => 'col-lg-1',
                ],
            ],
            [
                'attribute'=>'name',
                'label' => 'Изображение',
                'value' => function($model){
                    $result = '/pics/'.$model->name;
                    return $result;
                },
                'format' => ['image',['height'=>'40']],
            ],
            [
                'attribute'=>'relative_id',
                'format' => 'raw',
                'value' => function ($model){
                    $name = $model->relative->fullName;
                    return Html::tag('a', $name, ['href' => '/relatives/view?id='.$model->relative_id]);
                    }
                ],
            [
                'attribute'=>'descr',
                'format' => 'html',
                'value' => function ($model){
                    if ($model->descr == null)
                    {
                        $result = '';
                    }
                    else
                    {
                        $result = $model->descr;
                    }
                    
                    return $result;
                    }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    Pjax::end();        
    ?>

</div>
