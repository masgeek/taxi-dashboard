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
        'controller' => [
            'v1/users',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
        ],
        'extraPatterns' => [
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/makes',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
            '{make}' => '<make:\\w+>',
        ],
        'extraPatterns' => [
            'GET find-by-make/<make>' => 'find-by-make',
            'PUT <make>' => 'update',

        ]
    ],
];

return $url_rules;