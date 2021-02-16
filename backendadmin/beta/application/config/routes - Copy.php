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
$route['admin'] = 'admin/AdminPortal_Controller/login';
$route['index'] = 'admin/AdminPortal_Controller/index';
$route['view'] = 'admin/AdminPortal_Controller/view';
$route['add-page'] = 'admin/AdminPortal_Controller/add_page';
$route['list'] = 'admin/AdminPortal_Controller/listing';

//food
$route['food-listing'] = 'admin/Food';
$route['food-add'] = 'admin/Food/add';
$route['food-edit'] = 'admin/Food/edit';
//food category
$route['food-category-listing'] = 'admin/Foodcategory';
$route['food-category-add'] = 'admin/Foodcategory/add';
$route['food-category-edit'] = 'admin/Foodcategory/edit';

$route['default_controller'] = 'index';
$route['recoverPasswordUser/recoverAccount']= 'recoverPasswordUser/recoverAccount';
$route['recoverPasswordUser/(:any)']        = 'recoverPasswordUser/forgotpassword/$1';
$route['404_override'] 						= 'custom404';