<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Landing Page Routes
 * --------------------------------------------------------------------
 */

$routes->get('/', 'Landing::index');
$routes->get('/landing', 'Landing::index');
$routes->get('/about', 'About::index');

/*
 * --------------------------------------------------------------------
 * Page Routes per Section
 * --------------------------------------------------------------------
 */
$routes->get('/programs', 'Programs::index');
$routes->get('/facilities', 'Facilities::index');
$routes->get('/incubatees', 'Incubatees::index');
$routes->get('/news', 'News::index');
$routes->get('/organization', 'Organization::index');
$routes->get('/contact', 'Contact::index');