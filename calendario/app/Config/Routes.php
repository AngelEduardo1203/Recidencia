<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ruta raíz: carga el controlador Home y su método index
// $routes->get('/', 'Home::index');
$routes->get('/', 'LoginController::index', ['filter' => 'guest']);
$routes->post('auth', 'LoginController::auth', ['filter' => 'guest']);
$routes->get('logout', 'LoginController::logout', ['filter' => 'guest']);


$routes->group('calendario', ['filter' => 'role:admin'], function($routes) {
    $routes->get('/', 'Calendario::index');
    $routes->get('formulario', 'Calendario::formulario');
    $routes->post('formulario/guardar', 'Calendario::guardar');
    $routes->get('evento/(:num)', 'Calendario::detalle/$1');
    $routes->get('editar/(:num)', 'Calendario::editar/$1');
    $routes->post('actualizar/(:num)', 'Calendario::actualizar/$1');
    $routes->get('eliminar/(:num)', 'Calendario::eliminar/$1');
    $routes->get('uploads/eventos/(:segment)', 'Calendario::ver/$1');
});

$routes->group('usuario', ['filter' => 'role:admin,investigador,editor'], function($routes) {
    $routes->get('/', 'Calendario::indexUsuario');
    $routes->get('evento/(:num)', 'Calendario::detalleUsuario/$1');
    $routes->get('certificado/generar/(:num)', 'Certificado::generar/$1');
    $routes->get('evento/suscribirse/(:num)', 'Certificado::suscribirse/$1');

});






