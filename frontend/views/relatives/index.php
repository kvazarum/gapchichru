<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Relatives;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RelativesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Родственники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatives-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить человека', ['create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
    </p>

    <?php
        Pjax::begin();
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'fullName',
                'format' => 'html',
                'value' => function($model){
                    
                    $result = $model->getFullName();
                    $url = '/relatives/view?id='.$model->id;
                    $options = ['title' => $model->descr, 'target' => '_blank'];
                    $result = Html::a($result, $url, $options);
                    return $result;
                }                
            ],
            [
                'attribute'=>'bday',
                'format' => 'html',
                'label' => 'Дата рождения',
                'value' => function($model){
                    $result = '<div style="float: right;">'.Relatives::getBDate($model->id).'</div>';
                    return $result;
                }
            ],
            [
                'attribute'=>'mother_id',
                'format' => 'html',
                'value' => function($model){
                    if ($model->mother_id == 0)
                    {
                        $result = '<span class="glyphicon text-danger">Нет данных</span>';
                    }
                    else
                    {
                        $rel = Relatives::findOne($model->mother_id);
                        $result = $rel->sname.' '.$rel->fname.' '.$rel->mname;
                        if ($rel->second_sname != '')
                        {
                            $result .= ' ('.$rel->second_sname.')';
                        }
                        $url = '/relatives/view?id='.$model->mother_id;
                        $options = ['title' => $rel->descr];
                        $result = Html::a($result, $url, $options);                       
                    }
                    return $result;
                }                
            ],
            [
                'attribute'=>'father_id',
                'format' => 'html',
                'value' => function($model){
                    if ($model->father_id == 0)
                    {
                        $result = '<span class="glyphicon text-danger">Нет данных</span>';
                    }
                    else
                    {
                        $rel = Relatives::findOne($model->father_id);
                        $result = $rel->sname.' '.$rel->fname.' '.$rel->mname;
                        if ($rel->second_sname != '')
                        {
                            $result .= ' ('.$rel->second_sname.')';
                        }
                        $url = '/relatives/view?id='.$model->father_id;
                        $options = '';
                        $result = Html::a($result, $url);                        
                    }
                    return $result;
                }                
            ],                    
            // 'img',
            [
                'attribute'=>'gender',
                'format' => 'html',
                'filter'=>array(
                    "1" => "Женский",
                    "0" =>"Мужской"
                ),
                'value' => function($model){
                    if ($model->gender == 0)
                    {
                        $result = '<span class="label label-man">Мужской</span>';
                    }
                    else
                    {
                        $result = '<span class="label label-woman">Женский</span>';
                    }
                    return $result;
                }                
            ],
             'second_sname',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    Pjax::end();
    ?>

</div>
