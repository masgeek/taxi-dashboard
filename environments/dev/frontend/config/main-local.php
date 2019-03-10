<?php


$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sK8lASIoVVSFDKKRQ1LbN-jwlKjddGD2',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    //$config['modules']['gii'] = 'yii\gii\Module';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => ['class' => 'mdm\gii\generators\crud\Generator'],
            'mvc' => ['class' => 'mdm\gii\generators\mvc\Generator'],
            'migration' => ['class' => 'mdm\gii\generators\migration\Generator'],
        ]
    ];
}

return $config;
