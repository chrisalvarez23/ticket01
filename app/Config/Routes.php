<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard','DashboardController::index', ['filter' => 'session']);


/////////////////// ADMIN ACCESS //////////////////////////////
$routes->post('users/list','UserController::list',['filter' => 'group:admin']);
$routes->post('userroles/list','UserRoleController::list',['filter' => 'group:admin']);

$routes->resource('users',['controller' => 'UserController', 'except' => ['new','edit'], 'filter'=> 'group:admin']);
$routes->resource('userroles',['controller' => 'UserRoleController', 'except' => ['edit'], 'filter'=> 'group:admin']);


/////////////////// USER ACCESS //////////////////////////////
$routes->post('offices/list','OfficeController::list',['filter' => 'session']);
$routes->post('tickets/list','TicketController::list',['filter' => 'session']);
$routes->resource('offices',['controller' => 'OfficeController', 'except' => ['new','edit'], 'filter'=> 'session']);
$routes->resource('tickets',['controller' => 'TicketController', 'except' => ['new','edit'], 'filter'=> 'session']);
$routes->resource('dashboard',['controller' => 'DashboardController', 'except' => ['edit'], 'filter'=> 'session']);


service('auth')->routes($routes);