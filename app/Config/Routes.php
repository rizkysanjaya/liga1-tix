<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


//route public
$routes->get('/', 'Home::index');
$routes->get('contact', 'ContactController::index');
$routes->add('contact', 'ContactController::create');
$routes->add('contact/edit/(:segment)', 'ContactController::edit/$1');
$routes->get('contact/delete/(:segment)', 'ContactController::delete/$1');

//route admin
$routes->group('', ['filter' => 'role:admin'], function($routes){
    $routes->get('admin/dashboard', 'Admin::index');
    
    $routes->get('admin/data/user', 'Admin::userlist');
    $routes->get('admin/data/match', 'Admin::matchlist');
    $routes->get('admin/data/team', 'Admin::teamlist');
    $routes->get('admin/data/stadion', 'Admin::stadionlist');
    $routes->get('admin/data/tiket', 'Admin::tiketlist');
    $routes->get('admin/data/transaksi', 'Admin::transaksilist');
    // $routes->get('admin/users', 'UserController::index', ['filter' => 'role:admin,superadmin'])
    // $routes->get('dashboard', 'Home::dashboard');
});

//routes user biasa
$routes->group('', ['filter' => 'role:client'], function($routes){
    $routes->get('pages/profile', 'User::index');
    $routes->get('user/tiket', 'User::tiket');
    $routes->get('user/transaksi', 'User::transaksi');
    $routes->get('user/setting', 'User::setting');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
