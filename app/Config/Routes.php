<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

/*
 * ────────────────────────────────────────────────────────────────────────────
 * Landing Page Routes
 * ────────────────────────────────────────────────────────────────────────────
 */

$routes->get('/', 'Landing::index');
$routes->get('/landing', 'Landing::index');
$routes->get('/about', 'About::index');

/*
 * ────────────────────────────────────────────────────────────────────────────
 * Page Routes per Section
 * ────────────────────────────────────────────────────────────────────────────
 */
$routes->get('/programs', 'Programs::index');
$routes->get('/programs/(:segment)', 'Programs::show/$1');
$routes->get('/facilities', 'Facilities::index');
$routes->get('/facilities/(:segment)', 'Facilities::show/$1');
$routes->get('/incubatees', 'Incubatees::index');
$routes->get('/incubatees/(:segment)', 'Incubatees::show/$1');
$routes->get('/be-an-incubatee', 'Incubatees::apply');
$routes->get('/news', 'News::index');
$routes->get('/news/(:segment)', 'News::show/$1');
$routes->get('/organization', 'Organization::index');
$routes->get('/organization/(:segment)', 'Organization::show/$1');
$routes->get('/contact', 'Contact::index');
$routes->post('/contact/send', 'Contact::send');

/*
 * ────────────────────────────────────────────────────────────────────────────
 * ADMIN AUTHENTICATION ROUTES (Hidden Login)
 * ────────────────────────────────────────────────────────────────────────────
 */
$routes->get('/asog-admin', 'Auth::login');
$routes->post('/asog-admin', 'Auth::authenticate');
$routes->get('/asog-admin/logout', 'Auth::logout');

/*
 * ────────────────────────────────────────────────────────────────────────────
 * ADMIN DASHBOARD & CONTENT MANAGEMENT ROUTES (Protected by Auth Middleware)
 * ────────────────────────────────────────────────────────────────────────────
 */
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Dashboard
    $routes->get('/', 'Admin\Dashboard::index');
    
    // Posts / Blog Management
    $routes->get('posts', 'Admin\PostsAdmin::index');
    $routes->get('posts/create', 'Admin\PostsAdmin::create');
    $routes->post('posts/store', 'Admin\PostsAdmin::store');
    $routes->get('posts/(:num)/edit', 'Admin\PostsAdmin::edit/$1');
    $routes->post('posts/(:num)/update', 'Admin\PostsAdmin::update/$1');
    $routes->post('posts/(:num)/delete', 'Admin\PostsAdmin::delete/$1');
});