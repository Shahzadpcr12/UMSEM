<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('Auth/index');
        }
    }

    public function activity()
    { 
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'activitylogs', 'view')) {

            show_error('You do not have permission to access this page.', 403);
        }
        $data["all_activitylogs"] = get_query_data("
        SELECT 
    tal.*, 
    e.username, 
    t.title 
FROM 
    task_activity_log tal
LEFT JOIN 
    employees e ON tal.user_id = e.id
LEFT JOIN 
    tasks t ON tal.task_id = t.id;

    ");
    // echo "<pre>";
    // print_r($data['all_activitylogs']);
    // exit();
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('activity_log',$data);
        $this->load->view('admin/footer');
   
    }
    
    
   
    
    

    
    
}
