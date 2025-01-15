<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('Auth/index');
        }
    }

    public function departments()
	{
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'department', 'view')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('dep_error', $data);
            return;
        }
		$data["all_dep"] = get_query_data("
		SELECT * from departments");
		$this->load->view('admin/header');
		$this->load->view('admin/side_bar');
		$this->load->view('departments',$data);
		$this->load->view('admin/footer');

	}
    

	public function add_departments() {

        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'department', 'add')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('dep_error', $data);
            return;
        }
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules(
			'dep_name',
			'dep_name',
			'required|trim',
			['required' => 'The Department field is required.']
		);
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('invalid', validation_errors());
			redirect(base_url('Departments'));
		} else {
			$dep_names = $this->input->post('dep_name');
	
			$this->db->where('dep_name', $dep_names);
            $existing_dep_name = $this->db->get('departments')->row(); 

	
			if ($existing_dep_name) {
				$this->session->set_flashdata('existing_role_error', 'The Department already exists. Please use a different Department name.');
				redirect(base_url('Departments'));
			} else {
				$data = ['dep_name' => $dep_names];
	
				$this->db->trans_start();
				$this->db->insert('departments', $data);
				$this->db->trans_complete();
	
				if ($this->db->trans_status() === FALSE) {
					$this->session->set_flashdata('invalid', 'Failed to insert data.');
				} else {
					$this->session->set_flashdata('successfull', 'Data inserted successfully.');
				}
	
				redirect(base_url('Departments'));
			}
		}
	}
	
public function delete_department($id) {

    $role_id = $this->session->userdata('role_id');

    if (!has_module_action_permission($role_id, 'department', 'delete')) {
        $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('dep_error', $data);
            return;
    }
    $this->db->where('id', $id);
    if ($this->db->delete('departments')) {
        $this->session->set_flashdata('swal', [
            'type' => 'success',
            'message' => 'Department deleted successfully.'
        ]);
    } else {
        $this->session->set_flashdata('swal', [
            'type' => 'error',
            'message' => 'Failed to delete Department.'
        ]);
    }
    redirect(base_url('Departments'));
}

public function update_department() {
    $role_id = $this->session->userdata('role_id');

    if (!has_module_action_permission($role_id, 'department', 'update')) {
        $data['message'] = 'You do not have permission to view this page.';
        $data['status_code'] = 403; 
        $this->load->view('dep_error', $data);
        return;
    }
    $this->form_validation->set_rules('dep_name', 'dep_name', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('swal', [
            'type' => 'error',
            'message' => validation_errors()
        ]);
        redirect(base_url('Departments'));
    } else {
        $id = $this->input->post('id');
        $dep_name = $this->input->post('dep_name');

        $this->db->where('id', $id);
        $this->db->update('departments', ['dep_name' => $dep_name]);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Successfully Update.');

            
        } else {
            $this->session->set_flashdata('invalid', 'Something went wrong.');

        }
        redirect(base_url('Departments'));
    }
 }
}