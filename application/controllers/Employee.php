<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect('Auth/index');
        }
    }

    public function employees()
    { 
       
       $data["all_users"] = get_query_data("
       SELECT * from users");
       $data["empall"] = get_query_data("
          SELECT * from employees");
    $data["depall"] = get_query_data("
	SELECT * from departments");
        $data["all_dep"] = get_query_data("
        SELECT * from departments");
        $data["all_role"] = get_query_data("
           SELECT * from roles");
           $data["all_employee"] = get_query_data("
       SELECT 
           employees.*, 
           users.username, 
           departments.dep_name
       FROM 
           employees
       LEFT JOIN 
           users ON employees.user_id = users.id
       LEFT JOIN 
           departments ON employees.department_id = departments.id
       ");
   
    //    echo "<pre>";
    //    print_r($data['all_employee']);
    //    exit();
   
   
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('admin/employee',$data);
        $this->load->view('admin/footer');
   
    }

    public function add_employeesdata() {
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules(
            'name',
            'name',
            'required|trim',
          
        );
        $this->form_validation->set_rules(
            'department_id',
            'department_id',
            'required|trim',
           
        );
        // $this->form_validation->set_rules(
        //     'role_id',
        //     'role_id',
        //     'required|trim',
        //     ['required' => 'The Department field is required.']
        // );
        $this->form_validation->set_rules(
            'email', 'email', 'valid_email|required|is_unique[employees.email]',
            array('is_unique' => 'This %s already exists.')
        );
        $this->form_validation->set_rules(
            'status',
            'status',
            'required|trim',
            
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required|trim',
            
        );
         $this->form_validation->set_rules(
            'designation',
            'designation',
            'required',
            
        );
         $this->form_validation->set_rules(
            'contact_info',
            'contact_info',
            'required',
            
        );
        $this->form_validation->set_rules(
            'user_id',
            'user_id',
            'required|trim',
            
        );
      
            $email = $this->input->post('email');
            $designation = $this->input->post('designation');
            $contact_info = $this->input->post('contact_info');
            $name = $this->input->post('name');
            $department_id = $this->input->post('department_id');
            $user_id = $this->input->post('user_id');
            $status = $this->input->post('status');
            $password = md5($this->input->post('password'));
    
            $this->db->where('email', $email);
            $existing_email = $this->db->get('employees')->row(); 
    
    
            if ($existing_email) {
                $this->session->set_flashdata('existing_role_error', 'The employees already exists. Please use a different Department name.');
                redirect(base_url('Users'));
            } else {
                $data = ['email' => $email,
                'name' => $name,  
                'department_id' => $department_id,  
                'user_id' => $user_id,  
                'status' => $status,  
                'password' => $password,  
                'designation' => $designation,  
                'contact_info' => $contact_info,  
            ];
    // echo "<pre>";
    // print_r($data);
    // exit();
                $this->db->trans_start();
                $this->db->insert('employees', $data);
                $this->db->trans_complete();
    
                if ($this->db->trans_status() === FALSE) {
                    $this->session->set_flashdata('invalid', 'Failed to insert data.');
                } else {
                    $this->session->set_flashdata('successfull', 'Data inserted successfully.');
                }
    
                redirect(base_url('Employees'));
            }
    }
    public function filter_emp()
    {
        $department_id = $this->input->post('department_id');
        $designation = $this->input->post('role_id'); 
    
        $this->db->select('employees.id, employees.name,employees.created_at, employees.designation, employees.email, employees.status, departments.dep_name, users.username');
    $this->db->from('employees');
    $this->db->join('departments', 'employees.department_id = departments.id', 'left');
    $this->db->join('users', 'employees.user_id = users.id', 'left'); 
    
        
        if (!empty($department_id)) {
            $this->db->where('employees.department_id', $department_id);
        }
        if (!empty($designation)) {
            $this->db->where('employees.designation', $designation);
        }
    
        $query = $this->db->get();
        $employees = $query->result();
    
        
        $output = '';
        foreach ($employees as $employee) {
            $output .= '<tr>';
            $output .= '<td>' . $employee->id . '</td>';
            $output .= '<td>' . $employee->name . '</td>';
            $output .= '<td>' . $employee->email . '</td>';
            $output .= '<td>' . $employee->status . '</td>';
            $output .= '<td><span class="badge bg-success">' . $employee->dep_name . '</span></td>';
            $output .= '<td>' . $employee->designation . '</td>';
            $output .= '<td>' . $employee->username  . '</td>';
            $output .= '<td>' . $employee->created_at  . '</td>';

            $output .= '<td><button class="btn btn-danger btn-sm delete-btn" data-id="' . $employee->id . '">Delete</button></td>';
            $output .= '<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateRoleModal' . $employee->id . '">Update</button></td>';
            $output .= '</tr>';
        }
    
        echo $output;
    }

    public function update_employees() {

        $this->form_validation->set_rules(
            'name',
            'name',
            'required|trim',
          
        );
        $this->form_validation->set_rules(
            'department_id',
            'department_id',
            'required|trim',
           
        );
        // $this->form_validation->set_rules(
        //     'role_id',
        //     'role_id',
        //     'required|trim',
        //     ['required' => 'The Department field is required.']
        // );
        $this->form_validation->set_rules(
            'email', 'email', 'valid_email|required|is_unique[employees.email]',
            array('is_unique' => 'This %s already exists.')
        );
        $this->form_validation->set_rules(
            'status',
            'status',
            'required|trim',
            
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required|trim',
            
        );
         $this->form_validation->set_rules(
            'designation',
            'designation',
            'required',
            
        );
         $this->form_validation->set_rules(
            'contact_info',
            'contact_info',
            'required',
            
        );
        $this->form_validation->set_rules(
            'user_id',
            'user_id',
            'required|trim',
            
        );
        
    
       
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $designation = $this->input->post('designation');
        $contact_info = $this->input->post('contact_info');
        $name = $this->input->post('name');
        $department_id = $this->input->post('department_id');
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
    
            $data = ['email' => $email,
                'name' => $name,  
                'department_id' => $department_id,  
                'user_id' => $user_id,  
                'status' => $status,  
                'designation' => $designation,  
                'contact_info' => $contact_info,  
            ];
    //  echo "<pre>";
    // print_r($data);
    // exit();
            $this->db->where('id', $id);
            $this->db->update('employees', $data);
    
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('swal', [
                    'type' => 'success',
                    'message' => 'Employee updated successfully.'
                ]);
            } else {
                $this->session->set_flashdata('swal', [
                    'type' => 'warning',
                    'message' => 'No changes were made.'
                ]);
            }
            redirect(base_url('Employees'));
        }
}