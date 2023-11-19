<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard','DashboardController::index', ['filter' => 'auth']);


/////////////////// ADMIN ACCESS //////////////////////////////
$routes->post('users/list','UserController::list',['filter' => 'groupfilter:admin']);
$routes->post('userroles/list','UserRoleController::list',['filter' => 'groupfilter:admin']);

$routes->resource('users',['controller' => 'UserController', 'except' => ['new','edit'], 'filter'=> 'groupfilter:admin']);
$routes->resource('userroles',['controller' => 'UserRoleController', 'except' => ['edit'], 'filter'=> 'groupfilter:admin']);


/////////////////// USER ACCESS //////////////////////////////
$routes->post('offices/list','OfficeController::list',['filter' => 'auth']);
$routes->post('tickets/list','TicketController::list',['filter' => 'auth']);
$routes->resource('offices',['controller' => 'OfficeController', 'except' => ['new','edit'], 'filter'=> 'auth']);
$routes->resource('tickets',['controller' => 'TicketController', 'except' => ['new','edit'], 'filter'=> 'auth']);
$routes->resource('dashboard',['controller' => 'DashboardController', 'except' => ['edit'], 'filter'=> 'auth']);


service('auth')->routes($routes);