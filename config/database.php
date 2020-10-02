<?php

$env = require 'env.php';

$propiedades = [
    'dev' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '',
        'db' => 'WIMAX',
        'port' => '3306',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ],
    'prod' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'user' => 'id11543080_root',
        'password' => 'asdasd',
        'db' => 'id11543080_bd_ventas',
        'port' => '3306',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ],
];


return $propiedades[$env];
?>