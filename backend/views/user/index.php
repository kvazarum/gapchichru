<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'class' => 'col-xs-1',
                ],
            ],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->username, '/admin/user/view?id='.$model->id, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'relative_id',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->relative_id != null)
                    {
                        $url = '/relatives/view?id='.$model->relative_id;
                        $result = Html::a($model->getRelativeName(), $url, ['target' => '_blank']);
                    }
                    else
                    {
                        $result = null;
                    }
                    return $result;
                }
            ],
             'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->status === 10)
                    {
                        $class = 'label-success label';
                        $value = 'ACTIVE';
                    }
                    else
                    {
                        $class = 'label-danger label';
                        $value ='NOT_ACTIVE';
                    }
                    return Html::tag('span', $value, ['class' => $class]);
                }
            ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
