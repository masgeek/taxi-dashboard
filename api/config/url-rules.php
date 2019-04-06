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
            'v1/user',
        ],
        'tokens' => [
            '{id}' => '<id:\\w+>',
        ],
        'extraPatterns' => [
            'POST sign-up' => 'create',
        ]
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => [
            'v1/make',
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