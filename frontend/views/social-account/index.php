<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SocialAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Социальные сети';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'network_id',
                'format' => 'raw',
                'value' => function($model){
                    $name = $model->network->title;
                    return Html::a($name, $model->url, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'relative_id',
                'format' => 'raw',
                'value' => function($model){
                    $name = $model->relative->fullName;
                    return Html::a($name, '/relatives/view?id='.$model->relative_id, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date('d-m-Y H:i:s', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model){
                    return date('d-m-Y H:i:s', $model->updated_at);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
