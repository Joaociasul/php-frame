<?php

use App\Providers\RegisterAll;

define('BASE_PATH', dirname(__FILE__, 2));

require BASE_PATH . '/vendor/autoload.php';

$allProviders = new RegisterAll();
try {
    $allProviders->boot();
} catch (ReflectionException $e) {
    var_dump($e);
    exit;
    http_response_code(500);
    echo "Error";
}