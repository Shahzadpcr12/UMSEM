<?php 
// defined('BASEPATH') OR exit('No direct script access allowed'); 


// class Roles_model extends CI_Model {
//     public function get_permissions($role_id) {
//         $this->db->select('permission_id');
//         $this->db->from('role_permissions');
//         $this->db->where('role_id', $role_id);
//         $query = $this->db->get();
//         return array_column($query->result_array(), 'permission_id');
//     }
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    // Method to fetch role by ID
    public function get_role($role_id) {
        $this->db->where('id', $role_id);
        $query = $this->db->get('roles'); // Assuming your roles table is named 'roles'

        if ($query->num_rows() > 0) {
            return $query->row(); // Return a single row object
        }
        return null; // Return null if no role is found
    }
}

