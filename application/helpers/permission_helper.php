<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// function get_permission_id($permission_name) {
//     $CI =& get_instance(); // Get the CI super object
//     $CI->load->database();
//     $query = $CI->db->get_where('permissions', ['name' => $permission_name]);
//     if ($query->num_rows() > 0) {
//         return $query->row()->id;
//     }
//     return null; // Permission not found
// }

function has_module_action_permission($role_id, $module_name, $action)
{
    $CI = &get_instance();
    $CI->load->database();
    // echo '<pre>';
    // print_r($role_id);
    // exit();
    // Query to check if the role has the required permission
    $CI->db->select('rp.id');
    $CI->db->from('role_permissions rp');
    $CI->db->join('permissions p', 'rp.permission_id = p.id');
    $CI->db->where('rp.role_id', $role_id);
    $CI->db->where('p.module_name', $module_name);
    $CI->db->where('p.action', $action);

    $query = $CI->db->get();

    // Return true if permission exists, otherwise false
    if ($query->num_rows() > 0) {
        return true;
    }
    return false;
}

