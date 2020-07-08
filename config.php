<?php

define('MYSQL_CONFIG', [
    'driver' => 'mysql',
    'host' =>  $_SERVER['MYSQL_HOST'],
    'port' => $_SERVER['MYSQL_PORT'],
    'database' => $_SERVER['MYSQL_DATABASE'],
    'username' => $_SERVER['MYSQL_USER'],
    'password' => $_SERVER['MYSQL_PASSWORD'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

define('DB_CONNECT_MAX_RETRIES', $_SERVER['DB_CONNECT_MAX_RETRIES'] ?? 10);
define('DB_CONNECT_RETRY_TIME', $_SERVER['DB_CONNECT_RETRY_TIME'] ?? 10);
define('ENVIRONMENT', $_SERVER['ENVIRONMENT']);
define('SCHEMA_LIST', [
    "App\Database\Schemas\Users",
    "App\Database\Schemas\UserNotifications",
]);

define('UPDATES_LIST', [
    "App\Database\Updates\Deployment1\UserNotificationsStatus",
    "App\Database\Updates\Deployment2\UsersAccountStatus",
]);

define('CONTENT_LIST', [
    "App\Database\Content\UserNotifications",
]);
