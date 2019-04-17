<?php
/**
 * Created by PhpStorm.
 * User: MASGEEK
 * Date: 7/25/2018
 * Time: 12:05 PM
 */

$url_rules = [
    //'<controller:\w+>/<id:\d+>' => '<controller>/view',
    //'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    //'<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
    //'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',

    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    'manage-client-users/<slug>' => 'manage-client-users/slug',
    //'/reports/report/general-reports' => 'general-reports'
];

return $url_rules;