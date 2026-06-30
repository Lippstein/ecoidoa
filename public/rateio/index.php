<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// DOOOOOOOOOOO RATEIOOOOOOOOOOOO

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = $_SERVER['HTTP_HOST'] ?? '';
$parts = explode('.', $host);

$_SESSION['subdominio'] = (count($parts) > 2) ? $parts[0] : 'idoa';

// var_dump($_SESSION['subdominio']);
// exit;


// Maintenance mode?
if (file_exists($maintenance = __DIR__.'/../ecoidoa/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoload
require __DIR__.'/../ecoidoa/vendor/autoload.php';
    
// Bootstrap the application
/** @var Application $app */
$app = require_once __DIR__.'/../ecoidoa/bootstrap/app.php';

// Create kernel, handle the request, send the response and terminate the kernel.
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Request::capture();

$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);



// use Illuminate\Foundation\Application;
// use Illuminate\Http\Request;

// define('LARAVEL_START', microtime(true));

// // Determine if the application is in maintenance mode...
// if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
//     require $maintenance;
// }

// // Register the Composer autoloader...
// require __DIR__.'/../vendor/autoload.php';

// // Bootstrap Laravel and handle the request...
// /** @var Application $app */
// $app = require_once __DIR__.'/../bootstrap/app.php';

// $app->handleRequest(Request::capture());
