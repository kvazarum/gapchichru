<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Relatives;
use frontend\models\Families;
use frontend\models\Photos;
use frontend\models\Cemeteries;

/* @var $this yii\web\View */
/* @var $model app\models\Relatives */

$this->title = Relatives::getFullName($model->id);
$this->params['breadcrumbs'][] = ['label' => 'Родственники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

const COL_SPAN = 4;
?>
<div class="relatives-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle='tab'>Основные данные</a></li>
        <li><a href="#parents" data-toggle='tab'>Родители</a></li>
        <li><a href="#families" data-toggle='tab'>Семейная информация</a></li>
        <li><a href="#photos" data-toggle='tab'>Документы и фото</a></li>
        <li><a href="#ancestors" data-toggle='tab'>Предки</a></li>
        <li><a href="#descendants" data-toggle='tab'>Потомки</a></li>
        <?php
            if ($model->cemetery_id != null)
            {
                echo '<li><a href="#cemetery" data-toggle="tab">Место захоронения</a></li>';
            }
        ?>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane active" id="main">
    <?php
        echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'img',
                'label' => 'Изображение',
                'value' => strlen($model->img) > 0 ? '/pics/'.$model->img : '/pics/pics/no_data.png',
                'format' => ['image',['width'=>'200','height'=>'200']],
                ['attribute'=>'hidden','visible'=> !Yii::$app->user->isGuest],
            ],            
            'id',
            'rod',            
            'sname',
            'fname',
            'mname',
            'second_sname',            
            'bday',
            'bmonth',
            'byear',
            'bplace',
            [
                'attribute'=>'sex',
                'format' => 'raw',
                'value' => $model->sex ? '<span class="label label-danger">Женский</span>' : '<span class="label label-primary">Мужской</span>',
            ],
            'descr:html',
        ],
    ]) ?>
        </div>
        <div class="tab-pane" id="parents">
            <p>
    <?php
//  -----------parents----------------------        
        echo Html::beginTag('table', ['class' => 'table table-striped table-bordered detail-view']);
            echo Html::beginTag('tr', ['class' => 'info']);
                echo Html::tag('th', 'Отец', ['colspan' => COL_SPAN]);
            echo Html::endTag('tr');
            
                echo Relatives::renderRow($model->father_id);
            
            echo Html::beginTag('tr', ['class' => 'info']);
                echo Html::tag('th', 'Мать', ['colspan' => COL_SPAN]);
                echo Relatives::renderRow($model->mother_id);
            echo Html::endTag('tr');                       
        echo Html::endTag('table');
    ?>     
            </p>
        </div>
        <div class="tab-pane" id="families">
            <p>
            <?php
//  -----------families----------------------                                
                $families = Families::getFamilies($model->id);
                for ($i = 0; $i < count($families); $i++)
                {
                    if ($model->id == $families[$i]->wife_id)
                    {
                        $spouse = $families[$i]->husband_id;
                    }
                    else
                    {
                        $spouse = $families[$i]->wife_id;
                    }
                    $spouseName = Relatives::getFullName($spouse);
                    echo Html::beginTag('table', ['class' => 'table table-striped table-bordered detail-view']);
                        echo Html::beginTag('tr', ['class' => 'info']);
                        $father = $families[$i]->husband_id;
                        $mother = $families[$i]->wife_id;

                        $url = '/relatives/create?father_id='.$father.'&mother_id='.$mother;
                        $options = NULL;
                        $text = Html::tag('a', '<small>Добавить ребёнка</small>', ['class' => 'btn btn-success pull-right', 'href' => $url]);
                        echo Html::tag('th', '<h3>Семья</h3>'.$text, ['colspan' => COL_SPAN]);
                        echo Html::endTag('tr');
                        echo Html::beginTag('tr');
                            echo Html::tag('th', 'Супруг', ['colspan' => COL_SPAN]);
                        echo Html::endTag('tr');
                        Relatives::renderRow($spouse);
                        $fam = Families::findOne($families[$i]->id);
                        $children = $fam->getChildren();
                        if ($children)
                        {
                            echo Html::beginTag('tr');
                                echo Html::tag('th', 'Дети', ['colspan' => COL_SPAN]);
                            echo Html::endTag('tr');
                            foreach ($children as $child)
                            {
                                Relatives::renderRow($child->id);
                            }
                        }
                    echo Html::endTag('table');
                }
                ?>
            </p>
        </div>
<!-----------------------------carousel----------------------------------------->
        <div class="tab-pane" id="photos">
            <div class="col-lg-offset-3 col-lg-6 carousel slide" data-ride="carousel" id="image-slider">
                <ol class="carousel-indicators">
                    <?php
                        $photos = Photos::findAll(['relative_id' => $model->id]);
                        $count = 0;
                        foreach ($photos as $photo)
                        {
                            if ($count == 0)
                            {
                                $class = 'class="active"';
                            }
                            else
                            {
                                $class = "";
                            }
                            echo '<li data-target="#image-slider" data-slide-to="'.$count.'" '.$class.'></li>';
                            $count++;
                        }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                        $flag = TRUE;
                        foreach ($photos as $photo)
                        {
                            if ($flag)
                            {
                                $class = "item active";
                            }
                            else 
                            {
                                $class = "item";
                            }
                            echo '<div class="'.$class.'">';
                                echo '<img src="/pics/'.$photo->name.'" />';
                            echo '</div>';
                            $flag = FALSE;
                        }
                    ?>                            
                </div>
                <?php
                if (count($photos) > 0)
                {
                ?>
                <a href="#image-slider" class="left carousel-control" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a href="#image-slider" class="right carousel-control" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>                
                <?php
                }
                ?>
            </div>
        </div>
<!----------------------------- cemetery ----------------------------------------->
        <div class="tab-pane" id="cemetery">
            <?php
            
            echo '<div class="main-box" style="height: 550px;">';
            if ($model->cemetery_id != null)
            {
                $cemetery = Cemeteries::findOne($model->cemetery_id);
                echo Html::a($cemetery->title, '/cemeteries/view?id='.$cemetery->id, ['title' => $cemetery->description]);
                if ($model->hasGraveCoordinates())
                {
                    echo '<script type="text/javascript"
                        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyATK26QBNg6wgXq4Kk4rwQ8r21qi5BQ_Mo&sensor=false&callback=initialize">
                        </script>
                        <style type="text/css">
                        #map_canvas { height: 100%; }  
                    </style>';
                    echo '<script type="text/javascript">
                        function initialize() 
                        {
                            var lat = '.$model->grave_lat.';
                            var lon = '.$model->grave_lon.';
                            var name = "'.$model->getFuName().'";
                            var image = "/pics/icons/headstone.png";

                            var myLatlng = new google.maps.LatLng(lat,lon);
                            var mapOptions = {
                              center: myLatlng,
                              zoom: 15,
                              mapTypeId: google.maps.MapTypeId.HYBRID
                            };

                            var map = new google.maps.Map(document.getElementById("map_canvas"),
                                mapOptions);

                            var marker = new google.maps.Marker(
                            {
                                position: new google.maps.LatLng(lat,lon),
                                map: map,
                                icon: image,
                                title: name
                            });
//                            google.maps.event.addListener(marker, "click", function() {
//                                infowindow.open(map, this);
//                            });                            
                        }
                    </script>';
                    echo '<div class="left" id="map_canvas" style="width:500px; height: 500px; float: left;"></div><p />';              
                }               
            }
            
            if ($model->grave_picture != null)
            {
                echo '<div>';
                echo '<div align="center" ><img id="wheelzoom" style="height: 500px;" src="/pics/' . $model->grave_picture. '" ></div>';

                echo "<script>
                        $('#wheelzoom').wheelzoom();
                    </script>'";
                
                echo '</div>';
            }            
            ?>
            </div>
        </div>
<!----------------------------- потомки ----------------------------------------->    
        <div class="tab-pane" id="descendants">
        <?php
            if ($model->hasChildren())
            {
                if ($model->sex)
                {
                    $field = 'mother_id';
                }
                else
                {
                    $field = 'father_id';
                }
                
                $children = Relatives::findAll([$field => $model->id]);
                renderRelativesTable($children);
            }
            else
            {
                echo Html::tag('div', 'Нет данных');
            }
        ?>
        </div>        
<!----------------------------- предки ----------------------------------------->    
        <div class="tab-pane" id="ancestors">
            
        </div>

<?php
    function renderRelativesTable($children)
    {
        $nextLevelChildren = [];
        echo Html::beginTag('table', ['class' => 'table table-striped table-bordered detail-view']);
            echo Html::beginTag('tr', ['class' => 'info']);
                echo Html::tag('th', 'Уровень', ['colspan' => COL_SPAN]);
            echo Html::endTag('tr');
            foreach ($children as $child)
            {
                echo Relatives::renderRow($child->id);
                if ($child->sex)
                {
                    $field = 'mother_id';
                }
                else
                {
                    $field = 'father_id';
                }
                $nextChildren = Relatives::findAll([$field => $child->id]);
                if (count($nextChildren) > 0)
                {
                    foreach ($nextChildren as $nextChild)
                    {
                        $nextLevelChildren[] = $nextChild;
                    }
                }                
            }
        echo Html::endTag('table');
        
        if (count ($nextLevelChildren) > 0)
        {
            renderRelativesTable($nextLevelChildren);
        }
//        return $nextLevelChildren;
    }
?>
</div>
</div>
