<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect('Auth/index');
        }
    }
    
	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/side_bar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');

	}

	public function roles()
	{

		$data["all_roles"] = get_query_data("
		SELECT * from roles");
		$this->load->view('admin/header');
		$this->load->view('admin/side_bar');
		$this->load->view('admin/roles',$data);
		$this->load->view('admin/footer');

	}


	public function add_roles() {
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

 public function departments()
	{

		$data["all_dep"] = get_query_data("
		SELECT * from departments");
		$this->load->view('admin/header');
		$this->load->view('admin/side_bar');
		$this->load->view('admin/departments',$data);
		$this->load->view('admin/footer');

	}
    

	public function add_departments() {
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
            $this->session->set_flashdata('swal', [
                'type' => 'success',
                'message' => 'Departments updated successfully.'
            ]);
        } else {
            $this->session->set_flashdata('swal', [
                'type' => 'warning',
                'message' => 'No changes were made.'
            ]);
        }
        redirect(base_url('Departments'));
    }
 }

 public function users()
 { 
	
	$data["depall"] = get_query_data("
	SELECT * from departments");
	$data["roleall"] = get_query_data("
	   SELECT * from roles");

	 $data["all_dep"] = get_query_data("
	 SELECT * from departments");
	 $data["all_role"] = get_query_data("
		SELECT * from roles");
		$data["all_users"] = get_query_data("
    SELECT 
        users.*, 
        roles.role, 
        departments.dep_name
    FROM 
        users
    LEFT JOIN 
        roles ON users.role_id = roles.id
    LEFT JOIN 
        departments ON users.department_id = departments.id
    ");

	// echo "<pre>";
	// print_r($data['all_data']);
	// exit();


	 $this->load->view('admin/header');
	 $this->load->view('admin/side_bar');
	 $this->load->view('admin/add_users',$data);
	 $this->load->view('admin/footer');

 }


 public function add_usersdata() {
	$this->load->library('form_validation');

	$this->form_validation->set_rules(
		'username',
		'username',
		'required|trim',
		['required' => 'The Department field is required.']
	);
	$this->form_validation->set_rules(
		'department_id',
		'department_id',
		'required|trim',
		['required' => 'The Department field is required.']
	);
	$this->form_validation->set_rules(
		'role_id',
		'role_id',
		'required|trim',
		['required' => 'The Department field is required.']
	);
	$this->form_validation->set_rules(
		'email', 'email', 'valid_email|required|is_unique[users.email]',
		array('is_unique' => 'This %s already exists.')
	);
	$this->form_validation->set_rules(
		'status',
		'status',
		'required|trim',
		['required' => 'The Department field is required.']
	);
	$this->form_validation->set_rules(
		'password',
		'password',
		'required|trim',
		['required' => 'The Department field is required.']
	);
	if ($this->form_validation->run() == FALSE) {
		$this->session->set_flashdata('invalid', validation_errors());
		redirect(base_url('Users'));
	} else {
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$department_id = $this->input->post('department_id');
		$role_id = $this->input->post('role_id');
		$status = $this->input->post('status');
		$password = md5($this->input->post('password'));

		$this->db->where('email', $email);
		$existing_email = $this->db->get('users')->row(); 


		if ($existing_email) {
			$this->session->set_flashdata('existing_role_error', 'The Department already exists. Please use a different Department name.');
			redirect(base_url('Users'));
		} else {
			$data = ['email' => $email,
			'username' => $username,  
			'department_id' => $department_id,  
			'role_id' => $role_id,  
			'status' => $status,  
			'password' => $password,  
		];

			$this->db->trans_start();
			$this->db->insert('users', $data);
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->session->set_flashdata('invalid', 'Failed to insert data.');
			} else {
				$this->session->set_flashdata('successfull', 'Data inserted successfully.');
			}

			redirect(base_url('Users'));
		}
	}
}

public function filter_users()
{
    $department_id = $this->input->post('department_id');
    $role_id = $this->input->post('role_id');

   
    $this->db->select('users.id, users.username, users.email, users.status, departments.dep_name, roles.role, users.created_at');
    $this->db->from('users');
    $this->db->join('departments', 'users.department_id = departments.id', 'left');
    $this->db->join('roles', 'users.role_id = roles.id', 'left');

    if (!empty($department_id)) {
        $this->db->where('users.department_id', $department_id);
    }
    if (!empty($role_id)) {
        $this->db->where('users.role_id', $role_id);
    }

    $query = $this->db->get();
    $users = $query->result();

  
    $output = '';
    foreach ($users as $user) {
        $output .= '<tr>';
        $output .= '<td>' . $user->id . '</td>';
        $output .= '<td>' . $user->username . '</td>';
        $output .= '<td>' . $user->email . '</td>';
        $output .= '<td><span class="badge bg-success">' . $user->status . '</span></td>';
        $output .= '<td><span class="badge bg-success">' . $user->dep_name . '</span></td>';
        $output .= '<td><span class="badge bg-secondary">' . $user->role . '</span></td>';
        $output .= '<td>' . $user->created_at . '</td>';
        $output .= '<td><button class="btn btn-danger btn-sm delete-btn" data-id="' . $user->id . '">Delete</button></td>';
        $output .= '<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateRoleModal' . $user->id . '">Update</button></td>';
        $output .= '</tr>';
    }

    echo $output;
}

public function update_user() {

    $this->form_validation->set_rules(
		'username',
		'username',
		'required|trim',
	);
	$this->form_validation->set_rules(
		'department_id',
		'department_id',
		'required|trim',
	);
	$this->form_validation->set_rules(
		'role_id',
		'role_id',
		'required|trim',
		
	);
	$this->form_validation->set_rules(
		'email', 'email', 'valid_email|required|is_unique[users.email]',
		array('is_unique' => 'This %s already exists.')
	);
	$this->form_validation->set_rules(
		'status',
		'status',
		'required|trim',
	);
	

   
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $status = $this->input->post('status');
        $email = $this->input->post('email');
        $department_id = $this->input->post('department_id');
        $role_id = $this->input->post('role_id');

		$data = [
		'username' => $username,
		'status' => $status,
		'email' => $email,
		'department_id' => $department_id,
		'role_id' => $role_id

		];

        $this->db->where('id', $id);
        $this->db->update('users', $data);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('swal', [
                'type' => 'success',
                'message' => 'User updated successfully.'
            ]);
        } else {
            $this->session->set_flashdata('swal', [
                'type' => 'warning',
                'message' => 'No changes were made.'
            ]);
        }
        redirect(base_url('Users'));
    }

	public function update_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
	
		$this->db->where('id', $id);
		$this->db->update('users', ['status' => $status]);
	
		echo json_encode(['success' => true]);
	}
	
}