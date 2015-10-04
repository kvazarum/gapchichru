<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'charset' => 'cp1251',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
