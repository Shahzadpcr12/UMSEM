<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

    // public function __construct() {
    //     parent::__construct();
    //     $this->check_login();  

       
    //     $this->restrict_access(1);
    // }
	

	public function roles()
	{
        $role_id = $this->session->userdata('role_id');

if (!has_module_action_permission($role_id, 'role', 'view')) {
    // $this->load->view('admin/header');
    // $this->load->view('admin/side_bar');
    // $this->load->view('admin/error');
    // $this->load->view('admin/footer');
    show_error('You do not have permission to access this page.', 403);

}



		$data["all_roles"] = get_query_data("
		SELECT * from roles");
		$this->load->view('admin/header');
		$this->load->view('admin/side_bar');
		$this->load->view('roles',$data);
		$this->load->view('admin/footer');

	}


	public function add_roles() {

        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'role', 'add')) {
            show_error('You do not have permission to access this page.', 403);
        }
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules(
			'role',
			'Role',
			'required|trim',
			['required' => 'The Role field is required.']
		);
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('invalid', validation_errors());
			redirect(base_url('Role'));
		} else {
			$role = $this->input->post('role');
	
			$this->db->where('role', $role);
			$existing_role = $this->db->get('roles')->row();
	
			if ($existing_role) {
				$this->session->set_flashdata('existing_role_error', 'The role already exists. Please use a different role name.');
				redirect(base_url('Role'));
			} else {
				$data = ['role' => $role];
	
				$this->db->trans_start();
				$this->db->insert('roles', $data);
				$this->db->trans_complete();
	
				if ($this->db->trans_status() === FALSE) {
					$this->session->set_flashdata('invalid', 'Failed to insert data.');
				} else {
					$this->session->set_flashdata('successfull', 'Data inserted successfully.');
				}
	
				redirect(base_url('Role'));
			}
		}
	}
	
public function delete_role($id) {

    $role_id = $this->session->userdata('role_id');

    if (!has_module_action_permission($role_id, 'role', 'delete')) {
        show_error('You do not have permission to access this page.', 403);
    }
    $this->db->where('id', $id);
    if ($this->db->delete('roles')) {
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
    redirect(base_url('Role'));
}

public function update_role() {

    $role_id = $this->session->userdata('role_id');

    if (!has_module_action_permission($role_id, 'role', 'update')) {
        show_error('You do not have permission to access this page.', 403);
    }
    $this->form_validation->set_rules('role', 'Role', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('swal', [
            'type' => 'error',
            'message' => validation_errors()
        ]);
        redirect(base_url('Role'));
    } else {
        $id = $this->input->post('id');
        $role = $this->input->post('role');

        $this->db->where('id', $id);
        $this->db->update('roles', ['role' => $role]);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('swal', [
                'type' => 'success',
                'message' => 'Role updated successfully.'
            ]);
        } else {
            $this->session->set_flashdata('swal', [
                'type' => 'warning',
                'message' => 'No changes were made.'
            ]);
        }
        redirect(base_url('Role'));
    }
 }
 public function manage_permissions($role_id)
 {
     $this->load->model('Permission_model');
     $this->load->model('Roles_model');
 
     $role = $this->Roles_model->get_role($role_id);
     $permissions = $this->Permission_model->get_permissions_grouped_by_module();
     $role_permissions = $this->Permission_model->get_role_permissions($role_id);
 
     $data = [
         'role_id' => $role_id,
         'role_name' => $role->role,
         'permissions' => $permissions,
         'role_permissions' => array_column($role_permissions, 'permission_id')
     ];
 
 
     $this->load->view('admin/header');
     $this->load->view('admin/side_bar');
     $this->load->view('manage_permissions',$data);
     $this->load->view('admin/footer');
 }
 public function update_permissions()
 {
     $role_id = $this->input->post('role_id');
     $selected_permissions = $this->input->post('permissions') ?: [];
 
     $this->load->model('Permission_model');
 
     $this->Permission_model->update_role_permissions($role_id, $selected_permissions);
 
     $this->session->set_flashdata('success', 'Permissions updated successfully.');
     redirect('Role');
 }
 
}