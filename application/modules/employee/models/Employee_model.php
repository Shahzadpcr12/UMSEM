<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Role_model extends CI_Model
{
    public function get_filtered_employees($department, $designation)
{
    $this->db->select('*')->from('employees');
    if ($department) {
        $this->db->where('department_id', $department);
    }
    if ($designation) {
        $this->db->where('designation', $designation);
    }
    return $this->db->get()->result();
}

}