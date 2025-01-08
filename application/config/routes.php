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
$route['UpdateUser'] = 'user/Users/update_user';
// $route['DeleteActivity'] = 'activity_logs/Activity/activity_delete';



$route['ActivityLogs'] = 'activity_logs/Activity/activity';
// $route['Activity_log/activity_delete/(:num)'] = 'activity_logs/Activity_log/activity_delete/$1';
// $route['Activity_log/(.*)'] = 'activity_logs/Activity_log/$1';


// $route['Dashboard'] = 'admin/dashboard/index';

$route['admin-login'] = 'Auth/index';

$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;