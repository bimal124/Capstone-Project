<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = 'error/page/e404';
$route['translate_uri_dashes'] = FALSE;

$route['cms/(.+)'] = 'home/cms/$1';
$route['blog'] = 'home/blog';
$route['blog/(.+)'] = 'home/blogDetails/$1';
$route['book-appointment-now'] = 'home/book_appointment';
$route['schedule'] = 'home/schedule';
$route['booking-success'] = 'home/booking_success';

$route['reset_password'] = 'home/reset_password';
$route['checkMail'] = 'home/checkMail';

//added by sujit
$route[ADMIN_LOGIN_PATH] = 'login/admin';
$route[ADMIN_DASHBOARD_PATH] = 'dashboard/admin';
$route[ADMIN_DASHBOARD_PATH.'/profile'] = "dashboard/admin/profile";
$route[ADMIN_DASHBOARD_PATH.'/logout'] = 'login/admin/logout';
$route[ADMIN_DASHBOARD_PATH.'/forgot'] = 'login/password';
$route[ADMIN_DASHBOARD_PATH.'/reset'] = "login/admin/reset";
$route[ADMIN_DASHBOARD_PATH.'/cms/([a-zA-Z_-]+)'] = "cms/admin/index/$1";
$route[ADMIN_DASHBOARD_PATH.'/cms/([a-zA-Z_-]+)/add'] = "cms/admin/add/$1";
$route[ADMIN_DASHBOARD_PATH.'/cms/([a-zA-Z_-]+)/edit/(:num)'] = "cms/admin/edit/$1/$2";
$route[ADMIN_DASHBOARD_PATH.'/cms/([a-zA-Z_-]+)/delete/(:num)'] = "cms/admin/delete/$1/$2";
$route[ADMIN_DASHBOARD_PATH.'/([a-zA-Z_-]+)/(.+)'] = '$1/admin/$2';
$route[ADMIN_DASHBOARD_PATH.'/reload'] = "login/admin/reload";



// URI like '/en/about' -> use controller 'about'
$route['^en/(.+)$'] = "$1";
$route['^en$'] = $route['default_controller'];
