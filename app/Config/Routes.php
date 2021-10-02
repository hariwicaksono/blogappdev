<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => $routes->getDefaultNamespace() . 'Api'], function ($routes) {
	$routes->get('blog', 'Blog::index');
	$routes->get('blog/(:segment)', 'Blog::show/$1');
	$routes->post('blog/save', 'Blog::create');
	$routes->put('blog/update/(:segment)', 'Blog::update/$1');
	$routes->delete('blog/delete', 'Blog::delete');
	$routes->get('category', 'Category::index');
	$routes->get('category/(:segment)', 'Category::show/$1');
	$routes->post('category/save', 'Category::create');
	$routes->put('category/update/(:segment)', 'Category::update/$1');
	$routes->delete('category/delete', 'Category::delete');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}