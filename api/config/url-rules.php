<?php
/**
 * Created by PhpStorm.
 * User: MASGEEK
 * Date: 7/25/2018
 * Time: 12:05 PM
 */

$url_rules = [
    [
        'class' => 'yii\rest\UrlRule',
        //'pluralize' => false,
        'controller' => [
            'v2/site',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
        ],
        'extraPatterns' => [
            'register' => 'register',
            'authorize' => 'authorize',
            'access-token' => 'access-token',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v2/country',
            'v2/employee',
            'v2/user',
            'v2/location',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>'
        ]

    ],
    'v2/register' => 'v2/site/register',
    'v2/authorize' => 'v2/site/authorize',
    'v2/access-token' => 'v2/site/access-token',
    'v2/me' => 'v2/site/me',
    'v2/logout' => 'v2/site/logout',
];


$url_rules = [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
            '{user_id}' => '<user_id:\\w+>',
            '{menu_cat_id}' => '<menu_cat_id:\\w+>',
            '{item_type_id}' => '<item_type_id:\\w+>',
        ],
        'extraPatterns' => [
            'POST create-order' => 'create-order',
            'POST {id}/update-cart' => 'update-cart',
            'GET {user_id}/items' => 'items',
            'GET ussd' => 'ussd',
            'GET,POST {item_type_id}/in-cart/{user_id}' => 'in-cart',
            'GET min-price' => 'min-price'
        ]
    ],
];

return $url_rules;