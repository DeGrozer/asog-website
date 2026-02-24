<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Landing Page Routes
 * --------------------------------------------------------------------
 */
$routes->get('/', 'Landing\Landing::index');
$routes->get('/landing', 'Landing\Landing::index');