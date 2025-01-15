<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        // $this->check_login();  // Call the check_login method from MY_Controller

        // // Restrict access to the 'view_employees' permission (permission_id = 1)
        // $this->restrict_access(1);
    }

    public function employees() { 
        $this->load->model('Permission_model');
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'employee', 'view')) {
            show_error('You do not have permission to view this page.', 403);
        }

        if (($department_id = $this->input->post('department_id')) != '' || 
            ($designation = $this->input->post('designation')) != '' || 
            ($status = $this->input->post('status')) != '') {
   

        $department_id = $this->input->post('department_id');
        $designation = $this->input->post('designation');
        $status = $this->input->post('status');
    
        // Build the query
        $this->db->select('employees.*, departments.dep_name');
        $this->db->from('employees');
        $this->db->join('departments', 'employees.department_id = departments.id', 'left');
    
        if (!empty($department_id)) {
            $this->db->where('employees.department_id', $department_id);
        }
        if (!empty($designation)) {
            $this->db->where('employees.designation', $designation);
        }
        if (!empty($status)) {
            $this->db->where('employees.status', $status);
        }
    
        $query = $this->db->get();
        $data['employees'] = $query->result();
    
        // Load the PDF library
        $this->load->library('dompdf_gen');
    
        // Load the view file for the PDF
        $html = $this->load->view('employee_report', $data, true);
    
        // Initialize DOMPDF
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'landscape'); // Set paper size and orientation
        $this->dompdf->render();

        // $this->load->view('admin/header');
        // $this->load->view('admin/side_bar');
        // $this->load->view('employee', $data);
        // $this->load->view('admin/footer');

    }else{
        $data["all_users"] = get_query_data("SELECT * FROM users");
        $data["empall"] = get_query_data("SELECT * FROM employees");
        $data["depall"] = get_query_data("SELECT * FROM departments");
        $data["all_dep"] = get_query_data("SELECT * FROM departments");
        $data["all_role"] = get_query_data("SELECT * FROM roles");
        $data["all_employee"] = get_query_data("
        SELECT 
            employees.*, 
            employees.username AS name,
            users.username AS user_username, 
            departments.dep_name,
            roles.role AS role_name
        FROM 
            employees
        LEFT JOIN 
            users ON employees.user_id = users.id
        LEFT JOIN 
            departments ON employees.department_id = departments.id
        LEFT JOIN 
            roles ON employees.role_id = roles.id
        WHERE 
            roles.role != 'Admin' OR roles.role IS NULL
    ");
    
    
    
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('employee', $data);
        $this->load->view('admin/footer');
    }
    }
    

    public function add_employeesdata() {


        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'employee', 'add')) {
            show_error('You do not have permission to view this page.', 403);
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('department_id', 'department_id', 'required|trim');
        $this->form_validation->set_rules(
            'email', 
            'email', 
            'valid_email|required|is_unique[employees.email]',
            array('is_unique' => 'This %s already exists.')
        );
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('contact_info', 'contact_info', 'required');
        $this->form_validation->set_rules('user_id', 'user_id', 'required|trim');

        $email = $this->input->post('email');
        $designation = $this->input->post('designation');
        $contact_info = $this->input->post('contact_info');
        $username = $this->input->post('username');
        $department_id = $this->input->post('department_id');
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
        $password = md5($this->input->post('password'));

        $this->db->where('email', $email);
        $existing_email = $this->db->get('employees')->row(); 
        $emplo_name = 'Employee';
        $this->db->where('role', $emplo_name);
        $empo = $this->db->get('roles')->row(); 

        if ($existing_email) {
            $this->session->set_flashdata('existing_role_error', 'The employees already exists. Please use a different Department name.');
            redirect(base_url('Users'));
        } else {
            $data = [
                'email' => $email,
                'username' => $username,  
                'department_id' => $department_id,  
                'user_id' => $user_id,  
                'role_id' => $empo->id,  
                'status' => $status,  
                'password' => $password,  
                'designation' => $designation,  
                'contact_info' => $contact_info
            ];

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

    public function filter_emp() {
        // $this->restrict_access(3);

        $department_id = $this->input->post('department_id');
        $designation = $this->input->post('role_id'); 

        $this->db->select('employees.id, employees.username,employees.created_at, employees.designation, employees.email, employees.status, departments.dep_name, users.username');
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
            $output .= '<td>' . $employee->username . '</td>';
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
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'employee', 'update')) {
            show_error('You do not have permission to view this page.', 403);
        }

        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('department_id', 'department_id', 'required|trim');
        $this->form_validation->set_rules(
            'email', 'email', 'valid_email|required|is_unique[employees.email]',
            array('is_unique' => 'This %s already exists.')
        );
        $this->form_validation->set_rules('status', 'status', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('contact_info', 'contact_info', 'required');
        $this->form_validation->set_rules('user_id', 'user_id', 'required|trim');

        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $designation = $this->input->post('designation');
        $contact_info = $this->input->post('contact_info');
        $username = $this->input->post('username');
        $department_id = $this->input->post('department_id');
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');

        $data = [
            'email' => $email,
            'username' => $username,  
            'department_id' => $department_id,  
            'user_id' => $user_id,  
            'status' => $status,  
            'designation' => $designation,  
            'contact_info' => $contact_info
        ];

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

    public function edit_profile() { 

       
        if (!$this->session->userdata('user_id')) {
            redirect('Auth/index');
        }
        // $this->load->model('Permission_model');
        $USER_ID = $this->session->userdata('user_id');

 
        $data["profile"] = get_query_data("SELECT * FROM employees where id  = $USER_ID");
 
    
    // echo "<pre>";
    // print_r($data["all_users"]);
    // exit();
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('edit_profile',$data);
        $this->load->view('admin/footer');
    }

    public function update_employee() {
        

        
        $id = $this->input->post('id');
        $designation = $this->input->post('designation');
        $contact_info = $this->input->post('contact_info');
        $username = $this->input->post('username');
      

        $data = [
            'username' => $username,  
            'user_id' => $user_id,  
            'designation' => $designation,  
            'contact_info' => $contact_info
        ];

        $this->db->where('id', $id);
        $this->db->update('employees', $data);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('successfull', 'Profile successfully updated.');

        } else {
            $this->session->set_flashdata('invalid', 'Try Again.');

        }
        redirect(base_url('ProfileUpdate'));
    }

    // public function filter_employees()
    // {
    //     $department = $this->input->post('department');
    //     $designation = $this->input->post('designation');
    
    //     $this->load->model('Employee_model');
    //     $filtered_employees = $this->Employee_model->get_filtered_employees($department, $designation);
    
    //     // Send JSON response
    //     echo json_encode(['status' => 'success', 'data' => $filtered_employees]);
    // }
    

}
