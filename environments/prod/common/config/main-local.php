<?php
$password = 'taxi';
$username = 'taxi';
$database = 'taxi';

$dbconfig = [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host=localhost;port=3306;dbname=$database", // MySQL, MariaDB
    'tablePrefix' => 'tb_',
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    // Duration of schema cache.
    'schemaCacheDuration' => 3600,
    // Name of the cache component used to store schema information
    'schemaCache' => 'db_cache',
    'on afterOpen' => function ($event) {
        // $event->sender refers to the DB connection
        //$event->sender->createCommand("SET time_zone = '+03:00'")->execute();
    }
];

return [
    'components' => [
        'db' => $dbconfig,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
