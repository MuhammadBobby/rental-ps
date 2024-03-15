<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// inventaris
$routes->get('/inventaris', 'Inventaris::index');


// member
$routes->get('/member', 'Member::index');


// staff
$routes->get('/staff', 'Staff::index');



// transaksi
$routes->get('/booking', 'Booking::index');
