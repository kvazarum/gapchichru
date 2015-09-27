<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CemeteriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Места захоронения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cemeteries-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить место захоронения', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        Pjax::begin();
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'class'=>'col-lg-1'
                ],                
            ],
            [
                'attribute' => 'title',
                'headerOptions' => [
                    'class'=>'col-lg-3'
                ],                
            ],
            'description:ntext',
            'latitude',
            'longitude',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        ]);
        Pjax::end();
    ?>

</div>
