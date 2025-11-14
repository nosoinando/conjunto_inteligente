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
$routes->resource('usuarios', ['controller' => 'UsuariosController']);
