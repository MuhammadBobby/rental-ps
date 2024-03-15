<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// inventaris
$routes->get('/inventaris', 'Inventaris::index');
$routes->get('/inventaris/create', 'Inventaris::create');
$routes->post('/inventaris/save', 'Inventaris::save');
$routes->get('/inventaris/edit/(:num)', 'Inventaris::edit/$1');
$routes->post('/inventaris/update/(:num)', 'Inventaris::update/$1');
$routes->get('/inventaris/delete/(:num)', 'Inventaris::delete/$1');

// member
$routes->get('/member', 'Member::index');
$routes->get('/member/create', 'Member::create');
$routes->post('/member/save', 'Member::save');
$routes->get('/member/edit/(:num)', 'Member::edit/$1');
$routes->post('/member/update/(:num)', 'Member::update/$1');
$routes->get('/member/delete/(:num)', 'Member::delete/$1');


// staff
$routes->get('/staff', 'Staff::index');



// transaksi
$routes->get('/booking', 'Booking::index');
