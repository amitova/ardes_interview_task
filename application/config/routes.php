<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['checkUser'] = 'users/checkUser';
$route['dashboard/2'] = 'users/profile';
$route['dashboard/1'] = 'admin/showUsersList';
$route['dashboard/editUsers'] = 'admin/showUsersList';
$route['dashboard/addUser'] = 'admin/addUser';
$route['dashboard/editUser/(:any)'] = 'admin/editUser/$1';
$route['dashboard/profile'] = 'users/profile';
$route['dashboard/editProfile'] = 'users/editProfile';
$route['dashboard/data'] = 'currency/showCurrenciesData';
$route['dashboard/charts'] = 'currency/drawChart';
$route['dashboard/data/export'] = 'currency/exportCurrenciesData';
$route['logout'] = 'users/logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
