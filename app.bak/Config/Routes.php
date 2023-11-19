<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard','DashboardController::index');


$routes->resource('authors',['controller' => 'AuthorController', 'except' => ['new','edit'], 'filter'=> 'groupfilter:admin']);



service('auth')->routes($routes);
