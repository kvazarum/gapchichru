<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Relatives;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cemeteries */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Места захоронений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cemeteries-view">

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
    <div class="row">
        <div style="float: left" class="col-xs-6">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Данные</h3>
            </div>
            <div class="panel-body">
        <?php
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title:ntext',
                    'description:ntext',
                    'latitude',
                    'longitude',
                    [
                        'attribute' => 'created_at',
                        'value' => date('d-m-Y H:i:s', $model->created_at),
                    ],                    
                    [
                        'attribute' => 'updated_at',
                        'value' => date('d-m-Y H:i:s', $model->updated_at),
                    ],

                ],
            ]);
        ?>
            </div>
        </div>
        <?php
        $relatives = Relatives::findAll(['cemetery_id' => $model->id]);
        if (count($relatives))
        {
        ?>
            <div class="panel panel-default panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Список захороненых</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered detail-view">
                        <?php
                        foreach ($relatives as $relative)
                        {
                            echo Relatives::renderRow($relative->id);
                        }
                        ?>
                    </table>
                </div>
                <div class="panel-footer">
                    <?php echo 'Итого в списке: '.count($relatives); ?>
                </div>
            </div>

        <?php
        }
        ?>
        </div>
        <div style="float: right;" class="col-xs-6">
        <?php
    $latitude = $model->latitude;
    $longitude = $model->longitude;

    echo '<div style="display: inline-block; margin-left: 20px;">';
    echo '<script type="text/javascript" async defer
                src="http://maps.googleapis.com/maps/api/js?key=AIzaSyATK26QBNg6wgXq4Kk4rwQ8r21qi5BQ_Mo&sensor=false&callback=initialize">
            </script>';
    echo '<style type="text/css">
                #map_canvas {
                    width: 50%;
                }
            </style>';
    echo '<script type="text/javascript">
                var map;
                function initialize()
                {
                    var lat = '.$latitude.';
                    var lon = '.$longitude.';

                    var myLatlng = new google.maps.LatLng(lat,lon);
                    var mapOptions = {
                      center: myLatlng,
                      zoom: 11,
                      mapTypeId: google.maps.MapTypeId.HYBRID
                    };

                    map = new google.maps.Map(document.getElementById("map_canvas"),
                        mapOptions);

                    var marker = new google.maps.Marker(
                    {
                        position: new google.maps.LatLng(lat,lon),
                        map: map
                    });
                }

            </script>';
    echo '<div id="map_canvas" style="width:430px; height: 450px;"></div>';

    ?>
        </div>
    </div>

</div>
