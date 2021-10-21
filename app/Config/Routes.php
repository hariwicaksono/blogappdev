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
	$routes->put('blog/imgupload/(:segment)', 'Blog::imgUpload/$1');
	$routes->put('blog/setcategory/(:segment)', 'Blog::setCategory/$1');
	$routes->get('count/blog', 'Blog::countBlog');
	
	$routes->get('search', 'Blog::searchBlog');
	$routes->get('tag', 'Blog::searchTag');
	
	$routes->get('category', 'Category::index');
	$routes->get('category/(:segment)', 'Category::show/$1');
	$routes->post('category/save', 'Category::create');
	$routes->put('category/update/(:segment)', 'Category::update/$1');
	$routes->delete('category/delete', 'Category::delete');
	$routes->get('count/category', 'Category::countCategory');
	
	$routes->get('setting', 'Setting::index');
	$routes->put('setting/update/(:segment)', 'Setting::update/$1');
	$routes->put('setting/landing/(:segment)', 'Setting::updateLanding/$1');
	
	$routes->get('user', 'User::index');
	$routes->get('user/(:segment)', 'User::show/$1');
	$routes->post('user/save', 'User::create');
	$routes->put('user/update', 'User::update');
	$routes->delete('user/delete', 'User::delete');
	$routes->put('user/changepassword/(:segment)', 'User::changePassword/$1');
	
	$routes->get('slideshow', 'Slideshow::index');
	$routes->get('slideshow/(:segment)', 'Slideshow::show/$1');
	$routes->post('slideshow/save', 'Slideshow::create');
	$routes->put('slideshow/update/(:segment)', 'Slideshow::update/$1');
	$routes->delete('slideshow/delete', 'Slideshow::delete');
	$routes->put('slideshow/upload/(:segment)', 'Slideshow::upload/$1');
	
	$routes->get('comment', 'Comment::index');
	$routes->get('comment/(:segment)', 'Comment::show/$1');
	$routes->post('comment/save', 'Comment::create');
	$routes->put('comment/update/(:segment)', 'Comment::update/$1');
	$routes->get('count/comment', 'Comment::countComment');
	
	$routes->get('menu', 'Menu::index');
	$routes->get('product', 'Product::index');
	$routes->get('count/product', 'Product::countProduct');
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