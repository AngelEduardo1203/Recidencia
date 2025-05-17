<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Ruta raíz: carga el controlador Home y su método index
$routes->get('/', 'Home::index');
// Muestra el calendario administrativo (vista general de eventos)
$routes->get('calendario', 'Calendario::index');
// Muestra el calendario para usuarios (posiblemente con menos permisos o diferente visualización)
$routes->get('calendarioUsuario', 'Calendario::indexUsuario');
// Muestra el formulario para crear un nuevo evento
$routes->get('formulario', 'Calendario::formulario');
// Guarda los datos enviados desde el formulario (método POST)
$routes->post('formulario/guardar', 'Calendario::guardar');
// Muestra los detalles de un evento por ID (para administrador)
$routes->get('evento/(:num)', 'Calendario::detalle/$1');
// Muestra los detalles de un evento por ID (para usuario)
$routes->get('eventoUsuario/(:num)', 'Calendario::detalleUsuario/$1');
// Muestra el formulario de edición para un evento por ID
$routes->get('editar/(:num)', 'Calendario::editar/$1');
// Procesa la actualización de un evento existente por ID
$routes->post('actualizar/(:num)', 'Calendario::actualizar/$1');
// Elimina un evento por ID
$routes->get('eliminar/(:num)', 'Calendario::eliminar/$1');
// Muestra un documento subido en el navegador (como PDF, etc.)
$routes->get('uploads/eventos/(:segment)', 'Calendario::ver/$1');
// muetra el certificado de asistencia
$routes->get('certificado/generar/(:num)', 'Certificado::generar/$1');






