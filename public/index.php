<?php

use App\Router;
use App\Controllers\HomeController;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router;

$router
    ->get('/', [HomeController::class, 'index'])
    ->get('/home', [HomeController::class, 'index'])
    ->get('/home/show', [HomeController::class, 'show']);

# Untuk melihat route yang terdaftar di aplikasi
// echo '<pre>';
// var_dump($router->routes());
// echo '</pre>';
// exit;

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
