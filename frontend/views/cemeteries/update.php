<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cemeteries */

$this->title = 'Изменить: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Места захоронения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="cemeteries-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="left col-sm-6" style="float: left; display: inline-block;">
    <?php
    echo $this->render('_form', [
        'model' => $model,
        ]);
    ?>
    </div>
    <?php
    $latitude = $model->latitude;
    $longitude = $model->longitude;

    echo '<div class="col-sm-6" style="float: right; display: inline-block;">';
            echo '<script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?key=AIzaSyATK26QBNg6wgXq4Kk4rwQ8r21qi5BQ_Mo&sensor=false&callback=initialize">
                </script>
                <style type="text/css">
                #map_canvas { height: 100%; }
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
                      zoom: 7,
                      mapTypeId: google.maps.MapTypeId.HYBRID
                    };

                    map = new google.maps.Map(document.getElementById("map_canvas"),
                        mapOptions);

                    var marker = new google.maps.Marker(
                    {
                        position: new google.maps.LatLng(lat,lon),
                        map: map
                    });

                    function moveMarker(location)
                    {
                        marker.setMap(null);
                        marker = new google.maps.Marker({
                                position: location,
                                map: map
                        });
                        marker.setMap(map);
                        document.getElementById("cemeteries-latitude").value = location.lat();
                        document.getElementById("cemeteries-longitude").value = location.lng();
                    }
                    google.maps.event.addListener(map, "click", function(event) {
                        moveMarker(event.latLng);
                    });
                }

            </script>';
            echo '<div id="map_canvas" style="width:430px; height: 450px;"></div>';
    echo '</div>';        
        
    ?>

</div>
