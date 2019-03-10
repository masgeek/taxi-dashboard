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
            'v1/my-cart' => 'v1/cart',
            'v2/my-cart' => 'v2/cart',
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
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/order',
            'v2/order',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
            '{user_id}' => '<user_id:\\w+>',
            '{rider_id}' => '<rider_id:\\w+>',
        ],
        'extraPatterns' => [
            'POST {user_id}/my-orders' => 'my-orders',
            'POST {user_id}/active-orders' => 'active-orders',
            'POST {rider_id}/rider-orders' => 'rider-orders',
        ]
    ],
    /////////////////////////////////////
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/timeline',
            'v2/timeline',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
            //'{user_id}' => '<user_id:\\w+>',
            '{order_id}' => '<order_id:\\w+>',
        ],
        'extraPatterns' => [
            'GET {order_id}/active-orders' => 'active-orders',
        ]
    ],
    //////////////////////////////////////
    ///  /////////////////////////////////////
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/address' => 'v1/address',
            'v2/address' => 'v2/address',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
            '{user_id}' => '<user_id:\\w+>',
            '{order_id}' => '<order_id:\\w+>',
        ],
        'extraPatterns' => [
            'GET {user_id}/my-address' => 'my-address',
        ]
    ],
    //////////////////////////////////////
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/location',
            'v2/location',
        ],
    ],
    //////////////////////////////////////
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/rider',
            'v2/rider',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
            //'{user_id}' => '<user_id:\\w+>',
            '{user_id}' => '<user_id:\\w+>',
        ],
        'extraPatterns' => [
            'GET {id}/my-orders' => 'my-orders',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/cust-addr' => 'v1/customeraddress',
            'v2/cust-addr' => 'v2/customeraddress',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
            '{user_id}' => '<user_id:\\w+>',
        ],
        'extraPatterns' => [
            'GET {user_id}/my-address' => 'my-address',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/payment',
            'v2/payment',
            'v1/user',
            'v2/user',
            'v1/menucategory',
            'v2/menucategory',
            'v1/menuitem',
            'v2/menuitem',
        ],
        //'GET,HEAD <id:\d+>/booth' => 'booth/all-booths',
        'tokens' => [
            '{id}' => '<id:\\w+>',
            '{user_id}' => '<user_id:\\w+>',
            '{menu_cat_id}' => '<menu_cat_id:\\w+>',
        ],
        'extraPatterns' => [
            'POST' => 'mail',
            'GET,POST all' => 'all',
            'GET,POST,PUT,DELETE push' => 'push',
            'GET {user_id}/token' => 'token',
            'POST login' => 'login',
            'POST recover' => 'recover',
            'POST register' => 'register',
            'POST add' => 'add',
            'POST reserve' => 'reserve',
            'POST confirm' => 'confirm',
            'POST cancel' => 'cancel',
            'POST assign-staff' => 'assign-staff',
            'POST {id}/add-service' => 'add-service',
            'POST add-service' => 'remove-service',
            'POST pay' => 'pay',
            'GET account-type' => 'account-type',
            'GET {menu_cat_id}/cat-item' => 'cat-item',
            'GET single-cat' => 'single-cat',

            'POST generate' => 'generate',
        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/delivery' => 'v1/delivery',
            'v2/delivery' => 'v1/delivery',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
        ],
        'extraPatterns' => [
        ]
    ]
];

return $url_rules;