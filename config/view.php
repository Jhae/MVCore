<?php

$env = require 'env.php';

$prefijo = [
    'dev' => '/MVCore',
    'prod' => '/base/core',
];

return $prefijo[$env];
?>