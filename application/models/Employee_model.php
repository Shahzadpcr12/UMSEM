<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Employee_model extends CI_Model
{
    public function fetch_data()
    {
        $this->db->select('employees.id, employees.name, employees.email, employees.status, departments.dep_name as department, employees.designation');
        $this->db->from('employees');
        $this->db->join('departments', 'employees.department_id = departments.id', 'left');

        // Apply search and pagination if required
        $query = $this->db->get();
        $result = $query->result_array();

        return [
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $this->db->count_all('employees'),
            "recordsFiltered" => $query->num_rows(),
            "data" => $result
        ];
    }
}

