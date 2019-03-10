<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' => 'Results Tool',
    'version' => '0.0.1',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // see settings on http://demos.krajee.com/grid#module
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
            // see settings on http://demos.krajee.com/datecontrol#module
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'api' => [
            'class' => 'common\components\Api',
        ],
        'authManager' => [
            //'class' => 'yii\rbac\PhpManager',
            'class' => 'yii\rbac\DbManager',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => YII_DEBUG ? '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI' : '6LeCmhATAAAAAJz8aA6herY6UJIpt4yVPXCXj0zw',
            'secret' => YII_DEBUG ? '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe' : '6LeCmhATAAAAAGzVoPdjPRL1Rs_ZfNpfDUcXa43u',
        ],
    ],
];
