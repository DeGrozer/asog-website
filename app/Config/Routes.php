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
$routes->get('/facilities', 'Facilities::index');
$routes->get('/incubatees', 'Incubatees::index');
$routes->get('/news', 'News::index');
$routes->get('/news/(:segment)', 'News::show/$1');
$routes->get('/organization', 'Organization::index');
$routes->get('/contact', 'Contact::index');

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
    $routes->post('posts', 'Admin\PostsAdmin::store');
    $routes->get('posts/(:num)/edit', 'Admin\PostsAdmin::edit/$1');
    $routes->put('posts/(:num)', 'Admin\PostsAdmin::update/$1');
    $routes->delete('posts/(:num)', 'Admin\PostsAdmin::delete/$1');
    
    // Programs Management
    $routes->get('programs', 'Admin\ProgramsAdmin::index');
    $routes->get('programs/create', 'Admin\ProgramsAdmin::create');
    $routes->post('programs', 'Admin\ProgramsAdmin::store');
    $routes->get('programs/(:num)/edit', 'Admin\ProgramsAdmin::edit/$1');
    $routes->put('programs/(:num)', 'Admin\ProgramsAdmin::update/$1');
    $routes->delete('programs/(:num)', 'Admin\ProgramsAdmin::delete/$1');
    
    // News Management
    $routes->get('news', 'Admin\NewsAdmin::index');
    $routes->get('news/create', 'Admin\NewsAdmin::create');
    $routes->post('news', 'Admin\NewsAdmin::store');
    $routes->get('news/(:num)/edit', 'Admin\NewsAdmin::edit/$1');
    $routes->put('news/(:num)', 'Admin\NewsAdmin::update/$1');
    $routes->delete('news/(:num)', 'Admin\NewsAdmin::delete/$1');
    
    // Facilities Management
    $routes->get('facilities', 'Admin\FacilitiesAdmin::index');
    $routes->get('facilities/create', 'Admin\FacilitiesAdmin::create');
    $routes->post('facilities', 'Admin\FacilitiesAdmin::store');
    $routes->get('facilities/(:num)/edit', 'Admin\FacilitiesAdmin::edit/$1');
    $routes->put('facilities/(:num)', 'Admin\FacilitiesAdmin::update/$1');
    $routes->delete('facilities/(:num)', 'Admin\FacilitiesAdmin::delete/$1');
    
    // Incubatees Management
    $routes->get('incubatees', 'Admin\IncubateesAdmin::index');
    $routes->get('incubatees/create', 'Admin\IncubateesAdmin::create');
    $routes->post('incubatees', 'Admin\IncubateesAdmin::store');
    $routes->get('incubatees/(:num)/edit', 'Admin\IncubateesAdmin::edit/$1');
    $routes->put('incubatees/(:num)', 'Admin\IncubateesAdmin::update/$1');
    $routes->delete('incubatees/(:num)', 'Admin\IncubateesAdmin::delete/$1');
    
    // Organization/Team Management
    $routes->get('team', 'Admin\TeamAdmin::index');
    $routes->get('team/create', 'Admin\TeamAdmin::create');
    $routes->post('team', 'Admin\TeamAdmin::store');
    $routes->get('team/(:num)/edit', 'Admin\TeamAdmin::edit/$1');
    $routes->put('team/(:num)', 'Admin\TeamAdmin::update/$1');
    $routes->delete('team/(:num)', 'Admin\TeamAdmin::delete/$1');
});