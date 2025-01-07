<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Role_model extends CI_Model
{
    public function get_role($role_id)
    {
        $this->db->where('id', $role_id);
        return $this->db->get('roles')->row();
    }
}

