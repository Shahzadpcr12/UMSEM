<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin-login'] = 'Auth/index';
$route['Dashboard'] = 'Admin/index';
$route['Role'] = 'Admin/roles';
$route['Departments'] = 'Admin/departments';
$route['Users'] = 'Admin/users';
$route['Employees'] = 'Employee/employees';



$route['Logout'] = 'Auth/logout';

$route['Teams'] = 'Admin/Teams/index';




$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
