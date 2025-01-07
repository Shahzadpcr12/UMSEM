<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Role'] = 'role/Role/roles';
$route['Departments'] = 'department/Department/departments';
$route['Users'] = 'user/Users/users';
$route['Employees'] = 'employee/Employee/employees';
$route['Tasks'] = 'task/Task/task';
$route['Permissions'] = 'permission/Permission/permissions';


$route['Task/bulk_update'] = 'task/Task/bulk_update';
$route['Task/bulk_delete'] = 'task/Task/bulk_delete';

$route['Logout'] = 'auth/Auth/logout';




$route['Dashboard'] = 'admin/Admin/index';

// $route['Dashboard'] = 'admin/dashboard/index';

$route['admin-login'] = 'Auth/index';

$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;