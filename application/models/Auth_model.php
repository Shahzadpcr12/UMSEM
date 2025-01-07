<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Auth_model extends CI_Model
{
    public function admin_data($data)
    { //login form data
        $query = $this->db->get_where('employees', $data);
        if ($query) {
            return $query->row();
        }
        return false;
    }
}
