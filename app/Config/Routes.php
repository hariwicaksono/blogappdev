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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Equivalent to the following:
$routes->post('api/auth',                'Auth::create');
$routes->get('api/setting',                 'Setting::index');
$routes->get('api/setting/(:segment)',      'Setting::show/$1');
$routes->post('api/setting',                'Setting::create');
$routes->put('api/setting/(:segment)',      'Setting::update/$1');
$routes->delete('api/setting/delete/(:segment)',   'Setting::delete/$1');
$routes->get('api/blog',                 'Blog::index');
$routes->get('api/blog/(:segment)',      'Blog::show/$1');
$routes->post('api/blog',                'Blog::create');
$routes->put('api/blog/(:segment)',      'Blog::update/$1');
$routes->delete('api/blog/delete/(:segment)',   'Blog::delete/$1');
$routes->put('api/blogcategory/(:segment)',      'BlogCategory::update/$1');
$routes->put('api/blogimage/(:segment)',      'BlogImage::update/$1');
$routes->get('api/category',                 'Category::index');
$routes->get('api/category/(:segment)',      'Category::show/$1');
$routes->post('api/category',                'Category::create');
$routes->put('api/category/(:segment)',      'Category::update/$1');
$routes->delete('api/category/delete/(:segment)',   'Category::delete/$1');
$routes->get('api/comment',                 'Comment::index');
$routes->get('api/comment/(:segment)',      'Comment::show/$1');
$routes->post('api/comment',                'Comment::create');
$routes->put('api/comment/(:segment)',      'Comment::update/$1');
$routes->delete('api/comment/delete/(:segment)',   'Comment::delete/$1');
$routes->get('api/countblog',                 'CountBlog::index');
$routes->get('api/countcategory',                 'CountCategory::index');
$routes->get('api/countcomment',                 'CountComment::index');
$routes->post('api/imageupload',                'ImageUpload::create');
$routes->get('api/search',      		'Search::index');
$routes->get('api/slideshow',                 'Slideshow::index');
$routes->get('api/slideshow/(:segment)',      'Slideshow::show/$1');
$routes->post('api/slideshow',                'Slideshow::create');
$routes->put('api/slideshow/(:segment)',      'Slideshow::update/$1');
$routes->delete('api/slideshow/delete/(:segment)',   'Slideshow::delete/$1');
$routes->put('api/slideshowimage/(:segment)',      'SlideshowImage::update/$1');
$routes->get('api/tag',      'Tag::index');
$routes->get('api/user',                 'User::index');
$routes->get('api/user/(:segment)',      'User::show/$1');
$routes->post('api/user',                'User::create');
$routes->put('api/user/(:segment)',      'User::update/$1');
$routes->delete('api/user/delete/(:segment)',   'User::delete/$1');
$routes->put('api/userpassword/(:segment)',      'UserPassword::update/$1');

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
