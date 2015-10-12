<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Relatives;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FamiliesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Семьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="families-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Families', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'husband_id',
                'label' => 'Отец',
                'format' => 'raw',
                'value' => function ($model){
                    $text = $model->husband->getFullName();
                    $url = '/relatives/view?id='.$model->husband_id;
                    return Html::a($text, $url, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'wife_id',
                'label' => 'Мать',
                'format' => 'raw',                
                'value' => function ($model){
                    $text = $model->wife->getFullName();
                    $url = '/relatives/view?id='.$model->wife_id;
                    return Html::a($text, $url, ['target' => '_blank']);
                }
            ],                    
            'mdate',
            'descr:ntext',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
