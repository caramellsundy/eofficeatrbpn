<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek apakah file autoload ada
if (file_exists($composer_autoload = __DIR__.'/../vendor/autoload.php')) {
    require_once $composer_autoload;
}

// Bootstrap aplikasi
$app = require_once __DIR__.'/../bootstrap/app.php';

// Tangani request
$app->handleRequest(Request::capture());