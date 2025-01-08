<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_permission_model extends CI_Model {
    public function has_permission($role_id, $permission_id) {
        $this->db->where('role_id', $role_id);
        $this->db->where('permission_id', $permission_id);
        $query = $this->db->get('role_permissions');
        return $query->num_rows() > 0; // Returns true if permission exists
    }
}
