<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login/process', 'AuthController::process');
$routes->get('/logout', 'AuthController::logout');

$routes->group('admin', ['filter' => 'auth:Admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
});

$routes->group('public', ['filter' => 'auth:Public'], function ($routes) {
    $routes->get('dashboard', 'Public\Dashboard::index');
});