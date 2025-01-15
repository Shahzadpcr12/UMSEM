<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('Auth/index');
        }
    }

    public function permissions()
    { 
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'permission', 'view')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('error', $data);
            return;
        }
        
        
        $data["all_permission"] = get_query_data("
       SELECT * from permissions");
   
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('add_permission',$data);
        $this->load->view('admin/footer');
   
    }

    public function add_permission()
{

    $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'permission', 'add')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('error', $data);
            return;
        }
    $module_name = $this->input->post('module_name');
    $actions = $this->input->post('action'); 

    if (!empty($module_name) && !empty($actions)) {
        foreach ($actions as $action) {
            $data = [
                'module_name' => $module_name,
                'action' => $action
            ];

           
            $this->db->insert('permissions', $data);
        }

        $this->session->set_flashdata('success', 'Permissions added successfully.');
    } else {
        $this->session->set_flashdata('error', 'Please fill out all fields.');
    }

    redirect('Permissions');
}
public function delete_permission($id) {

    $role_id = $this->session->userdata('role_id');

    if (!has_module_action_permission($role_id, 'permission', 'delete')) {
        show_error('You do not have permission to access this page.', 403);
    }
    $this->db->where('id', $id);
    if ($this->db->delete('permissions')) {
        $this->session->set_flashdata('swal', [
            'type' => 'success',
            'message' => 'Role deleted successfully.'
        ]);
    } else {
        $this->session->set_flashdata('swal', [
            'type' => 'error',
            'message' => 'Failed to delete role.'
        ]);
    }
    redirect(base_url('Permissions'));
}
}