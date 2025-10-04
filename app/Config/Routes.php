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
    $routes->get('anggota/edit/(:num)', 'Admin\AnggotaController::edit/$1');
    $routes->post('anggota/update/(:num)', 'Admin\AnggotaController::update/$1');
    $routes->get('anggota/delete/(:num)', 'Admin\AnggotaController::delete/$1');

    $routes->get('komponengaji', 'Admin\KomponenGajiController::index');
    $routes->get('komponengaji/(:num)', 'Admin\KomponenGajiController::show/$1');
    $routes->get('komponengaji/new', 'Admin\KomponenGajiController::new');
    $routes->post('komponengaji/create', 'Admin\KomponenGajiController::create');
    $routes->get('komponengaji/edit/(:num)', 'Admin\KomponenGajiController::edit/$1');
    $routes->post('komponengaji/update/(:num)', 'Admin\KomponenGajiController::update/$1');
});

$routes->group('public', ['filter' => 'auth:Public'], function ($routes) {
    $routes->get('dashboard', 'Public\Dashboard::index');
    $routes->get('anggota', 'Public\AnggotaController::index');
    $routes->get('anggota/(:num)', 'Public\AnggotaController::show/$1');
});