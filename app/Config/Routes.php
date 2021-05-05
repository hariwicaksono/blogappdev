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
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('api', function($routes)
{
	$routes->post('auth',                'Auth::create');
	$routes->get('setting',                 'Setting::index');
	$routes->get('setting/(:segment)',      'Setting::show/$1');
	$routes->put('setting',      'Setting::update');
	$routes->put('settinglanding',      'SettingLanding::update');
	$routes->get('blog',                 'Blog::index');
	$routes->get('blog/(:segment)',      'Blog::show/$1');
	$routes->post('blog',                'Blog::create');
	$routes->put('blog',      'Blog::update');
	$routes->delete('blog/delete/(:segment)',   'Blog::delete/$1');
	$routes->put('blogcategory',      'BlogCategory::update');
	$routes->put('blogimage',      'BlogImage::update');
	$routes->get('category',                 'Category::index');
	$routes->get('category/(:segment)',      'Category::show/$1');
	$routes->post('category',                'Category::create');
	$routes->put('category',      'Category::update');
	$routes->delete('category/delete/(:segment)',   'Category::delete/$1');
	$routes->get('comment',                 'Comment::index');
	$routes->get('comment/(:segment)',      'Comment::show/$1');
	$routes->post('comment',                'Comment::create');
	$routes->put('comment',      'Comment::update');
	$routes->get('countblog',                 'CountBlog::index');
	$routes->get('countcategory',                 'CountCategory::index');
	$routes->get('countcomment',                 'CountComment::index');
	$routes->post('imageupload',                'ImageUpload::create');
	$routes->get('search',      		'Search::index');
	$routes->get('tag',      'Tag::index');
	$routes->get('user',                 'User::index');
	$routes->get('user/(:segment)',      'User::show/$1');
	$routes->post('user',                'User::create');
	$routes->put('user',      'User::update');
	$routes->delete('user/delete/(:segment)',   'User::delete/$1');
	$routes->put('userpassword',      'UserPassword::update');
	$routes->get('product',                 'Product::index');
	$routes->get('product/(:segment)',      'Product::show/$1');
	$routes->post('product',                'Product::create');
	$routes->put('product',      'Product::update');
	$routes->delete('product/delete/(:segment)',   'Product::delete/$1');
    $routes->get('slideshow',                 'Slideshow::index');
	$routes->get('slideshow/(:segment)',      'Slideshow::show/$1');
	$routes->post('slideshow',                'Slideshow::create');
	$routes->put('slideshow',      'Slideshow::update');
	$routes->post('slideshow/delete/(:segment)',   'Slideshow::delete/$1');
	$routes->put('slideshowimage',      'SlideshowImage::update');
	$routes->get('menu',                 'Menu::index');
	$routes->get('menu/(:segment)',      'Menu::show/$1');
	$routes->post('menu',                'Menu::create');
	$routes->put('menu',      'Menu::update');
	$routes->post('menu/delete/(:segment)',   'Menu::delete/$1');
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
