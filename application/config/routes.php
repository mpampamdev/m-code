<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$urlroute = $uri_segments[2];
// $urlroute = $uri_segments[1];

if ($urlroute == ADMIN_ROUTE) {
  $route['404_override'] = 'core/pagenotfound';
}else {
  $route['404_override'] = 'dsa';
}


$route['default_controller'] = 'welcome';
$route['translate_uri_dashes'] = FALSE;

$route['mcrud'] = 'mcrud/Mcrud';

$route['maintenance'] = 'backend/core/maintenance';

$route['pagenotfound'] = 'backend/core/pagenotfound';

$route['logout'] = 'backend/login/logout';
$route[LOGIN_ROUTE] = 'backend/login';
$route[LOGIN_ROUTE.'/(:any)'] = 'backend/login/$1';


$route[ADMIN_ROUTE.'/(:any)'] = 'backend/$1';
$route[ADMIN_ROUTE.'/(:any)/(:any)'] = 'backend/$1/$2';
$route[ADMIN_ROUTE.'/(:any)/(:any)/(:any)'] = 'backend/$1/$2/$3';
$route[ADMIN_ROUTE.'/(:any)/(:any)/(:any)/(:any)'] = 'backend/$1/$2/$3/$4';
