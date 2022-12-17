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
$routes->get('dashboard', 'Home::dashboard');
$routes->get('user/landpage', 'Home::landpage');

// $routes->get('tes/pdf', 'Home::pdf');

//route admin
$routes->group('', ['filter' => 'role:admin'], function ($routes) {
    //dashboard & profile
    $routes->get('admin/dashboard', 'Admin::index');
    $routes->get('admin/profile/(:any)', 'Admin::profile/$1');
    $routes->add('admin/profile/update_profile/(:any)', 'Admin::update_profile/$1');

    //view data
    $routes->get('admin/data/user', 'Admin::userlist');
    $routes->get('admin/data/match', 'Admin::matchlist');
    $routes->get('admin/data/team', 'Admin::teamlist');
    $routes->get('admin/data/stadion', 'Admin::stadionlist');

    $routes->get('admin/data/tiket', 'Admin::tiketlist');
    $routes->get('admin/data/tiket/view-tiket/(:any)', 'Admin::detail_tiket/$1');

    $routes->get('admin/data/order', 'Admin::orderlist');
    $routes->get('admin/data/order/view-order/(:any)', 'Admin::view_order/$1');
    $routes->add('admin/data/order/inserttiket', 'Admin::inserttiket');

    //download pdf
    $routes->get('assets/etiket/(:any)', 'Admin::download/$1');
    //kirim pdf ke email
    $routes->get('admin/order/kirimemail/(:any)', 'Admin::kirimemail/$1');


    $routes->get('admin/data/konfirmasi', 'Admin::konfirmasilist');
    $routes->get('admin/data/konfirmasi/view-konfirm/(:any)', 'Admin::detail_konfirmasi/$1');


    //form add data
    $routes->add('admin/data/create/add-user', 'Admin::adduser');
    $routes->add('admin/data/create/add-pertandingan', 'Admin::addmatch');
    $routes->add('admin/data/create/add-team', 'Admin::addteam');
    $routes->add('admin/data/create/add-stadion', 'Admin::addstadion');


    //save add data
    $routes->add('admin/data/create/saveteam', 'Admin::saveteam');
    $routes->add('admin/data/create/savestadion', 'Admin::savestadion');
    $routes->add('admin/data/create/savepertandingan', 'Admin::savepertandingan');



    //form edit data
    $routes->add('admin/data/user/edit/(:segment)', 'Admin::edit_user/$1');
    $routes->add('admin/data/match/edit/(:segment)', 'Admin::edit_pertandingan/$1');
    $routes->add('admin/data/team/edit/(:segment)', 'Admin::edit_team/$1');
    $routes->add('admin/data/stadion/edit/(:segment)', 'Admin::edit_stadion/$1');


    //save edit data
    $routes->add('admin/data/edit/update_user/(:segment)', 'Admin::update_user/$1');
    $routes->add('admin/data/edit/update_pertandingan/(:segment)', 'Admin::update_pertandingan/$1');
    $routes->add('admin/data/edit/update_team/(:segment)', 'Admin::update_team/$1');
    $routes->add('admin/data/edit/update_stadion/(:segment)', 'Admin::update_stadion/$1');


    //delete data
    $routes->get('admin/data/user/delete/(:segment)', 'Admin::delete_user/$1');
    $routes->get('admin/data/match/delete/(:segment)', 'Admin::delete_match/$1');
    $routes->get('admin/data/team/delete/(:segment)', 'Admin::delete_team/$1');
    $routes->get('admin/data/stadion/delete/(:segment)', 'Admin::delete_stadion/$1');
});

//routes user biasa
$routes->group('', ['filter' => 'role:client,admin'], function ($routes) {

    $routes->get('user/profile/(:any)', 'User::index/$1');
    $routes->add('user/profile/update_profile/(:any)', 'User::update_profile/$1');
    $routes->get('user/tiket', 'User::tiket');
    $routes->get('user/transaksi', 'User::transaksi');
    $routes->get('user/setting', 'User::setting');
    $routes->add('user/matchlist', 'Tiket::index');
    $routes->add('user/before-order/(:segment)', 'Tiket::before_order/$1');
    $routes->add('user/lanjut_order', 'Tiket::lanjut_order');
    $routes->add('user/order', 'Tiket::order');
    $routes->add('user/gettiket/', 'Tiket::gettiket');
    $routes->add('user/checkout/(:any)', 'Tiket::checkout/$1');
    $routes->add('user/payment/(:any)', 'Tiket::payment/$1');
    $routes->add('user/konfirmasi/(:any)/(:any)', 'Tiket::konfirmasi/$1/$2');
    $routes->add('user/insertkonfirmasi', 'Tiket::insertkonfirmasi');
    $routes->add('user/etiket/download/(:any)', 'Tiket::download/$1');
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
