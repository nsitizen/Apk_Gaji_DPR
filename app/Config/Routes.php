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
    $routes->get('anggota', 'Admin\AnggotaController::index');
    $routes->get('anggota/(:num)', 'Admin\AnggotaController::show/$1');
    $routes->get('anggota/new', 'Admin\AnggotaController::new');
    $routes->post('anggota/create', 'Admin\AnggotaController::create');
});

$routes->group('public', ['filter' => 'auth:Public'], function ($routes) {
    $routes->get('dashboard', 'Public\Dashboard::index');
    $routes->get('anggota', 'Public\AnggotaController::index');
    $routes->get('anggota/(:num)', 'Public\AnggotaController::show/$1');
});