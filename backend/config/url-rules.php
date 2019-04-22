<?php
/**
 * Created by PhpStorm.
 * User: MASGEEK
 * Date: 7/25/2018
 * Time: 12:05 PM
 */

$url_rules = [
    // custom rules go first
    'vehicles/index' => 'vehicles/index',
    'vehicles/<slug:[a-zA-Z0-9-]+>/' => 'vehicles/view',
    'vehicles/view/<id:[a-zA-Z0-9-]+>/' => 'vehicles/view',
    'vehicles/update/<id:[a-zA-Z0-9-]+>/' => 'vehicles/update',
    'vehicles/delete/<id:[a-zA-Z0-9-]+>/' => 'vehicles/delete',

    //Normal ruules
    '<controller:w+>/<id:d+>' => '<controller>/view',
    '<controller:w+>/<action:w+>/<id:d+>' => '<controller>/<action>',
    '<controller:w+>/<action:w+>' => '<controller>/<action>',
];

return $url_rules;