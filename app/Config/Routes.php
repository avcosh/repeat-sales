<?php
use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Site::index' , ['as' => 'site.index']);
$routes->post('/', 'Site::index' , ['as' => 'site.index']);

$routes->get('tracking', 'Tracking::index' , ['as' => 'tracking.index']);

$routes->get('tracking/create', 'Tracking::create' , ['as' => 'tracking.create']);
$routes->post('tracking/store', 'Tracking::store', ['as' => 'tracking.store']);

$routes->get('tracking/ajax', 'Tracking::ajax' , ['as' => 'tracking.ajax']);
$routes->get('tracking/ajax2', 'Tracking::ajax2' , ['as' => 'tracking.ajax2']);
$routes->get('tracking/ajax3', 'Tracking::ajax3' , ['as' => 'tracking.ajax3']);

$routes->get('tracking/edit/(:num)', 'Tracking::edit/$1', ['as' => 'tracking.edit']);
$routes->post('tracking/update/(:num)', 'Tracking::update/$1', ['as' => 'tracking.update']);
$routes->get('tracking/delete/(:num)', 'Tracking::delete/$1' , ['as' => 'tracking.delete']);

$routes->get('report', 'Report::index' , ['as' => 'report.index']);

$routes->get('launch', 'Site::launch');

$routes->get('install', 'Site::install' );
$routes->post('install', 'Site::install');





