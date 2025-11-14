<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('homeView', 'HomeController::index');

$routes->get('serviciosView', 'ServiciosController::index');

$routes->get('tarifasView', 'TarifasController::index');

$routes->get('demoView', 'DemoController::index');

$routes->get('contactoView', 'ContactoController::index');
$routes->get('contacto', 'ContactoController::get');
$routes->post('contacto', 'ContactoController::create');

$routes->get('usuarios', 'UsuariosController::get');
$routes->get('usuarios', 'UsuariosController::show');
$routes->post('usuarios', 'UsuariosController::create');
$routes->put('usuarios', 'UsuariosController::update');

$routes->get('loginView', 'AuthController::index');
$routes->get('registroView', 'AuthController::register');
$routes->post('auth', 'AuthController::login');


$routes->get('dashboardView', 'DashboardController::index');
$routes->get('/visits', 'DashboardController::getVisits');