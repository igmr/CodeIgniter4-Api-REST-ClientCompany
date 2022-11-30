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
$routes->get('/', 'Home::index', ['as', 'rootApi']);
$routes->addRedirect('/api/v1', '/');
//*	---------------------------------------------------------------------------
//!	API-REST
//*	---------------------------------------------------------------------------
//!	company	-	http://localhost:8080/company
//*	---------------------------------------------------------------------------
$routes->get('/api/v1/company'
	, [\App\Controllers\CompanyController::class, 'index']);
$routes->get('/api/v1/company/(:num)'
	, [\App\Controllers\CompanyController::class, 'show/$1']);
$routes->get('/api/v1/company/deleted'
	, [\App\Controllers\CompanyController::class, 'deleted']);
$routes->post('/api/v1/company'
	, [\App\Controllers\CompanyController::class, 'store']);
$routes->put('/api/v1/company/(:num)'
	, [\App\Controllers\CompanyController::class, 'edit/$1']);
$routes->delete('/api/v1/company/(:num)'
	, [\App\Controllers\CompanyController::class, 'remove/$1']);
//*	---------------------------------------------------------------------------
//!	client	-	http://localhost:8080/client
//*	---------------------------------------------------------------------------
$routes->get('/api/v1/client'
	, [\App\Controllers\ClientController::class, 'index']);
$routes->get('/api/v1/client/(:num)'
	, [\App\Controllers\ClientController::class, 'show/$1']);
$routes->get('/api/v1/client/deleted'
	, [\App\Controllers\ClientController::class, 'deleted']);
$routes->post('/api/v1/client'
	, [\App\Controllers\ClientController::class, 'store']);
$routes->put('/api/v1/client/(:num)'
	, [\App\Controllers\ClientController::class, 'edit/$1']);
$routes->delete('/api/v1/client/(:num)'
	, [\App\Controllers\ClientController::class, 'remove/$1']);
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
