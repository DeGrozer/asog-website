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
$routes->get('/about/logo', 'About::logo');

/*
 * ────────────────────────────────────────────────────────────────────────────
 * Page Routes per Section
 * ────────────────────────────────────────────────────────────────────────────
 */
$routes->get('/programs', 'Programs::index');
$routes->get('/services', 'Programs::services');
$routes->get('/facilities', 'Facilities::index');
$routes->get('/incubatees', 'Incubatees::index');
$routes->get('/incubatees/cohort-(:num)', 'Incubatees::cohort/$1');
$routes->get('/incubatees/apply', 'Incubatees::apply');
$routes->get('/incubatees/apply/form', 'Incubatees::applyForm');
$routes->post('/incubatees/apply/form', 'Incubatees::applyFormStore');
$routes->get('/incubatees/apply/form/check-email', 'Incubatees::checkEmail');
$routes->get('/incubatees/apply/form/thank-you', 'Incubatees::applyFormThankYou');
$routes->get('/news', 'News::index');
$routes->get('/news/(:segment)', 'News::show/$1');
$routes->get('/organization', 'Organization::index');
$routes->get('/contact', 'Contact::index');
$routes->post('/contact/send', 'Contact::send');

/*
 * ────────────────────────────────────────────────────────────────────────────
 * Uploaded File Serving (writable/uploads → /uploads/...)
 * Only handles application files stored in writable/uploads/applications/.
 * Post images live in public/uploads/posts/ and are served directly.
 * ────────────────────────────────────────────────────────────────────────────
 */
$routes->get('uploads/applications/(.+)', 'Uploads::serve/$1');

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
    $routes->post('posts/upload-image', 'Admin\PostsAdmin::uploadImage');
    $routes->get('posts/(:num)/edit', 'Admin\PostsAdmin::edit/$1');
    $routes->put('posts/(:num)', 'Admin\PostsAdmin::update/$1');
    $routes->delete('posts/(:num)', 'Admin\PostsAdmin::delete/$1');

    // Incubatee Applications
    $routes->get('applications', 'Admin\ApplicationsAdmin::index');
    $routes->get('applications/(:num)', 'Admin\ApplicationsAdmin::show/$1');
    $routes->put('applications/(:num)/status', 'Admin\ApplicationsAdmin::updateStatus/$1');

    // Contact Messages
    $routes->get('messages', 'Admin\MessagesAdmin::index');
    $routes->get('messages/(:num)', 'Admin\MessagesAdmin::show/$1');
    $routes->put('messages/(:num)/read', 'Admin\MessagesAdmin::toggleRead/$1');
    $routes->delete('messages/(:num)', 'Admin\MessagesAdmin::delete/$1');

    // Incubatees Management
    $routes->get('incubatees', 'Admin\IncubateesAdmin::index');
    $routes->get('incubatees/create', 'Admin\IncubateesAdmin::create');
    $routes->post('incubatees', 'Admin\IncubateesAdmin::store');
    $routes->get('incubatees/(:num)/edit', 'Admin\IncubateesAdmin::edit/$1');
    $routes->post('incubatees/(:num)/update', 'Admin\IncubateesAdmin::update/$1');
    $routes->post('incubatees/(:num)/delete', 'Admin\IncubateesAdmin::delete/$1');

    // Cohort Management (AJAX)
    $routes->post('cohorts/add', 'Admin\IncubateesAdmin::addCohort');
    $routes->post('cohorts/(:num)/delete', 'Admin\IncubateesAdmin::deleteCohort/$1');
});