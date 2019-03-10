<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 15-Aug-18
 * Time: 9:53 AM
 */

/*$url_rules = [
    '<alias:\w+>' => 'site/<alias>',
    //candidate actions
    'candidate/register' => 'candidate/default/signup',
    'candidate/login' => 'candidate/default/login',
    'candidate/logout' => 'candidate/default/logout',

    //principal actions
    'principal/register' => 'principal/default/signup',
    'principal/login' => 'principal/default/login',
    'principal/logout' => 'principal/default/logout',

    //sub county actions
    'sub-county/register' => 'sub-county/default/signup',
    'sub-county/login' => 'sub-county/default/login',
    'sub-county/logout' => 'sub-county/default/logout',

    //county actions
    'county/register' => 'county/default/signup',
    'county/login' => 'county/default/login',
    'county/logout' => 'county/default/logout'
];*/

$url_rules = [
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    //custom rules
    '/' => 'site/index',
    'my-staff' => 'staff/index',
    'my-payments' => 'payment/index',
    'pending-payments' => 'payment/pending-payments',
    'confirm-payment' => 'payment/confirm-payment',
    'finalized-payments' => 'payment/finalized-payments',
    'my-bookings' => 'reservation/index',
    'add-service' => 'salonservices/create',
    'assign-service' => 'booked/assign-service',
    'confirm-service' => 'booked/confirm-service',
    'confirm-reservation' => 'reservation/confirm-reservation',
    'process-reservation' => 'reservation/process-reservation',
    'confirm' => 'reservation/confirm',
    'services' => 'service/index',

    'active-users' => 'user/active-users',
    'pending-users' => 'user/pending-users',
    'suspended-users' => 'user/suspended-users',
    'deactivated-users' => 'user/deactivated-users',
    'user-status' => 'user/user-status',
];


return $url_rules;