<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {

	public function __construct()
    {
        // parent::__construct();
        // if (!$this->session->userdata('admin_id')) {
        //     redirect('Auth/index');
        // }
    }

    public function users()
    { 
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'user', 'view')) {
            show_error('You do not have permission to access this page.', 403);
        }
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
        employees.*, 
        roles.role, 
        departments.dep_name
    FROM 
        employees
    LEFT JOIN 
        roles ON employees.role_id = roles.id
    LEFT JOIN 
        departments ON employees.department_id = departments.id
    WHERE 
        roles.role != 'Admin' OR roles.role IS NULL
");

   
       // echo "<pre>";
       // print_r($data['all_data']);
       // exit();
   
   
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('add_users',$data);
        $this->load->view('admin/footer');
   
    }
   
   
    public function add_usersdata() {

        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'user', 'add')) {
            show_error('You do not have permission to access this page.', 403);
        }
       $this->load->library('form_validation');
   
       $this->form_validation->set_rules(
           'designation',
           'designation',
           'required|trim',
           
       );
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
           'contact_info',
           'contact_info',
           'required|trim',
           
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
           $contact_info = $this->input->post('contact_info');
           $designation = $this->input->post('designation');
           $username = $this->input->post('username');
           $department_id = $this->input->post('department_id');
           $role_id = $this->input->post('role_id');
           $status = $this->input->post('status');
           $password = md5($this->input->post('password'));
   
           $this->db->where('email', $email);
           $existing_email = $this->db->get('employees')->row(); 
   
   
           if ($existing_email) {
               $this->session->set_flashdata('existing_role_error', 'The Department already exists. Please use a different Department name.');
               redirect(base_url('Users'));
           } else {
               $data = ['email' => $email,
               'contact_info' => $contact_info,  
               'designation' => $designation,  
               'username' => $username,  
               'department_id' => $department_id,  
               'role_id' => $role_id,  
               'status' => $status,  
               'password' => $password,  
           ];
   
               $this->db->trans_start();
               $this->db->insert('employees', $data);
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
   
      
       $this->db->select('employees.id, employees.username, employees.email,employees.designation,employees.contact_info, employees.status, departments.dep_name, roles.role, employees.created_at');
       $this->db->from('employees');
       $this->db->join('departments', 'employees.department_id = departments.id', 'left');
       $this->db->join('roles', 'employees.role_id = roles.id', 'left');
   
       if (!empty($department_id)) {
           $this->db->where('employees.department_id', $department_id);
       }
       if (!empty($role_id)) {
           $this->db->where('employees.role_id', $role_id);
       }
   
       $query = $this->db->get();
       $users = $query->result();
   
     
       $output = '';
       foreach ($users as $user) {
           $output .= '<tr>';
           $output .= '<td>' . $user->id . '</td>';
           $output .= '<td>' . $user->username . '</td>';
           $output .= '<td>' . $user->email . '</td>';
           $output .= '<td>' . $user->contact_info . '</td>';
           $output .= '<td>' . $user->designation . '</td>';
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
    $role_id = $this->session->userdata('role_id');

    if (!has_module_action_permission($role_id, 'user', 'update')) {
        show_error('You do not have permission to access this page.', 403);
    }
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
           $designation = $this->input->post('designation');
           $contact_info = $this->input->post('contact_info');
           $email = $this->input->post('email');
           $department_id = $this->input->post('department_id');
           $role_id = $this->input->post('role_id');
   
           $data = [
           'username' => $username,
           'status' => $status,
           'contact_info' => $contact_info,
           'designation' => $designation,
           'email' => $email,
           'department_id' => $department_id,
           'role_id' => $role_id
   
           ];
   
           $this->db->where('id', $id);
           $this->db->update('employees', $data);
   
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
		$this->db->update('employees', ['status' => $status]);
	
		echo json_encode(['success' => true]);
	}

    
}