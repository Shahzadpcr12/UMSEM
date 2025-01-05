<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect('Auth/index');
        }
    }

    public function task()
    { 
       
    //    $data["all_users"] = get_query_data("
    //    SELECT * from users");
    //    $data["empall"] = get_query_data("
    //       SELECT * from employees");
    // $data["depall"] = get_query_data("
	// SELECT * from departments");
    //     $data["all_dep"] = get_query_data("
    //     SELECT * from departments");
    //     $data["all_role"] = get_query_data("
    //        SELECT * from roles");
    //        $data["all_employee"] = get_query_data("
    //    SELECT 
    //        employees.*, 
    //        users.username, 
    //        departments.dep_name
    //    FROM 
    //        employees
    //    LEFT JOIN 
    //        users ON employees.user_id = users.id
    //    LEFT JOIN 
    //        departments ON employees.department_id = departments.id
    //    ");
   
    //    echo "<pre>";
    //    print_r($data['all_employee']);
    //    exit();
   
   
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('admin/add_task');
        $this->load->view('admin/footer');
   
    }
}