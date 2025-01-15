<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MX_Controller {

	public function __construct()
    {
        // parent::__construct();
        // if (!$this->session->userdata('admin_id')) {
        //     redirect('Auth/index');
        // }
    }

    public function task()
    { 
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'task', 'view')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('error_task', $data);
            return;
        }
        $data["all_users"] = get_query_data("
        SELECT tasks.*, employees.username, employees.id AS employee_id
        FROM tasks
        LEFT JOIN employees ON tasks.to_assigned = employees.id
    ");
    
    
  
    $data["all_dep"] = get_query_data("
	SELECT * from departments");
        $data["all_employees"] = get_query_data("
        SELECT * from employees");
        
    $data["all_tasks"] = get_query_data(" 
    SELECT 
        tasks.*, 
        employees.username, 
        departments.dep_name 
    FROM 
        tasks 
    LEFT JOIN employees ON tasks.to_assigned = employees.id 
    LEFT JOIN departments ON employees.department_id = departments.id
");


        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('add_task',$data);
        $this->load->view('admin/footer');
   
    }
    public function get_employees_by_department()
    {
        $department_id = $this->input->post('department_id');
        
        $employees = $this->db->select('id, username')
                              ->from('employees')
                              ->where('department_id', $department_id)
                              ->get()
                              ->result();
    
        echo json_encode($employees); 
    }
    
    public function get_departments()
    {
      
        $departments = $this->db->select('id, dep_name')
                                ->from('departments')
                                ->get()
                                ->result();
    
        echo json_encode($departments); 
    }

    // public function add_task() {
    //     $this->load->library('form_validation');
    
    //     // Form Validation Rules
    //     $this->form_validation->set_rules('title', 'Title', 'required|trim');
    //     $this->form_validation->set_rules('department_id', 'Department', 'required|trim');
    //     $this->form_validation->set_rules('status', 'Status', 'required|trim');
    //     $this->form_validation->set_rules('description', 'Description', 'required|trim');
    //     $this->form_validation->set_rules('designation', 'Designation', 'required');
    //     $this->form_validation->set_rules('priority', 'Priority', 'required');
    
    //     if ($this->form_validation->run() === FALSE) {
    //         // If validation fails, reload the form
    //         $this->session->set_flashdata('error', validation_errors());
    //         redirect(base_url('Tasks'));
    //     } else {
    //         // Retrieve form data
    //         $title = $this->input->post('title');
    //         $description = $this->input->post('description');
    //         $department_id = $this->input->post('department_id');
    //         $to_assigned = $this->input->post('to_assigned'); // Corrected
    //         $priority = $this->input->post('priority');
    //         $status = $this->input->post('status');
    
    //         // Check if task with same title exists
    //         $this->db->where('title', $title);
    //         $existing_task = $this->db->get('tasks')->row();
    
    //         if ($existing_task) {
    //             $this->session->set_flashdata('existing_role_error', 'A task with this title already exists.');
    //             redirect(base_url('Tasks'));
    //         } else {
    //             // Prepare data for insertion
    //             $data = [
    //                 'title' => $title,
    //                 'description' => $description,
    //                 'department_id' => $department_id,
    //                 'to_assigned' => $to_assigned, // Correctly mapped
    //                 'status' => $status,
    //                 'priority' => $priority,
    //             ];
    
    //             // Insert data into DB
    //             $this->db->trans_start();
    //             $this->db->insert('tasks', $data);
    //             $this->db->trans_complete();
    
    //             // Check transaction status
    //             if ($this->db->trans_status() === FALSE) {
    //                 $this->session->set_flashdata('invalid', 'Failed to insert data.');
    //             } else {
    //                 $this->session->set_flashdata('successfull', 'Task added successfully.');
    //             }
    
    //             redirect(base_url('Tasks'));
    //         }
    //     }
    // }
    
    public function add_task() {

        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'task', 'add')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('error_task', $data);
            return;
        }
        $user_id = $this->session->userdata('user_id');

        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $department_id = $this->input->post('department_id');
        $to_assigned = $this->input->post('to_assigned');
        $priority = $this->input->post('priority');
        $status = $this->input->post('status');
    
        $data = [
            'title' => $title,
            'description' => $description,
            'department_id' => $department_id,
            'to_assigned' => $to_assigned,
            'status' => $status,
            'priority' => $priority,
            'createby' => $user_id,
        ];
    
        $this->db->trans_start();
        $this->db->insert('tasks', $data);


$last_inserted_id = $this->db->insert_id();

$logdata =  [
    'task_id' => $last_inserted_id,
    'status' => 'add',
    'user_id' => $user_id,
   
];
$this->db->insert('task_activity_log', $logdata);
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('invalid', 'Failed to insert data.');
            redirect(base_url('Tasks'));
        }
    
        $this->db->select('email');
        $this->db->where('id', $to_assigned);
        $user = $this->db->get('employees')->row();
    // 	echo "<pre>";
	// print_r($user);
	// exit();
        if ($user) {
            $subject = "New Task Assigned: $title";
            $message = "
                <p>Dear {$user->username},</p>
                <p>A new task has been assigned to you:</p>
                <ul>
                    <li><strong>Title:</strong> $title</li>
                    <li><strong>Description:</strong> $description</li>
                    <li><strong>Priority:</strong> $priority</li>
                    <li><strong>Status:</strong> $status</li>
                </ul>
                <p>Please log in to the system to view and manage the task.</p>
                <p>Thank you.</p>
            ";
    
            $this->email->from('your-email@example.com', 'Task Management System');
            $this->email->to($user->email);
            $this->email->subject($subject);
            $this->email->message($message);
    
            if ($this->email->send()) {
                $this->session->set_flashdata('successfull', 'Task added and email notification sent successfully.');
            } else {
                $this->session->set_flashdata('email_error', 'Task added, but email notification failed.');
            }
        } else {
            $this->session->set_flashdata('user_error', 'Task added, but assigned user email not found.');
        }
    
        redirect(base_url('Tasks'));
    }
    
    public function edit_task($id) {
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'task', 'update')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('error_task', $data);
            return;
        }
        
        $data["all_dep"] = get_query_data("
        SELECT * from departments");
            $data["all_employees"] = get_query_data("
            SELECT * from employees");
            $data["all_users"] = get_query_data("
            SELECT tasks.*, employees.username, employees.id AS employee_id
            FROM tasks
            LEFT JOIN employees ON tasks.to_assigned = employees.id
        ");
        $tasks = get_query_data("
            SELECT tasks.*, employees.username, employees.id AS employee_id
            FROM tasks
            LEFT JOIN employees ON tasks.to_assigned = employees.id
            WHERE tasks.id = $id
        ");
    
       
        if (empty($tasks)) {
            show_404(); 
            return;
        }
    
        $data['task'] = $tasks[0]; 
    
     
    
        $this->load->view('admin/header');
        $this->load->view('admin/side_bar');
        $this->load->view('edit_task', $data); 
        $this->load->view('admin/footer');
    }
    
    

    public function update_task() {
        $role_id = $this->session->userdata('role_id');

        if (!has_module_action_permission($role_id, 'task', 'update')) {
            $data['message'] = 'You do not have permission to view this page.';
            $data['status_code'] = 403; 
            $this->load->view('error_task', $data);
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
    
       
        $title = $this->input->post('title');
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $department_id = $this->input->post('department_id');
        $to_assigned = $this->input->post('to_assigned');
        $priority = $this->input->post('priority');
        $status = $this->input->post('status');
    
            $data = [
                'title' => $title,
                'description' => $description,
                'department_id' => $department_id,
                'to_assigned' => $to_assigned,
                'status' => $status,
                'priority' => $priority, 
            ];

            $this->db->where('id', $id);
            $this->db->update('tasks', $data);
    

            $logdata =  [
    'task_id' => $id,
    'status' => 'edit',
    'user_id' => $user_id,
   
    ];
    $this->db->insert('task_activity_log', $logdata);
    if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('success', 'Successfully Update.');

        
    } else {
        $this->session->set_flashdata('invalid', 'Something went wrong.');

    }
            redirect(base_url('Tasks'));
        }
        public function bulk_update()
        {
            $task_ids = $this->input->post('task_ids');
            $status = $this->input->post('status');
            
            if ($task_ids && $status) {
                $this->db->where_in('id', $task_ids);
                $this->db->update('tasks', ['status' => $status]);
        
                $this->session->set_flashdata('success', 'Tasks updated successfully!');
            }
        
            redirect('Tasks');
        }
        public function bulk_delete()
        {

            $role_id = $this->session->userdata('role_id');

            if (!has_module_action_permission($role_id, 'task', 'delete')) {
                show_error('You do not have permission to view this page.', 403);
            }
            if ($this->input->method() === 'post') {
                $task_ids = $this->input->post('task_ids');
        
                if ($task_ids) {
                    $this->db->where_in('id', $task_ids);
                    $this->db->delete('tasks');
        
           
                    $this->session->set_flashdata('message', 'Tasks deleted successfully!');
                }
        
                redirect('Tasks');
            } else {
                redirect('Tasks');
            }
        }
        
        public function bulk_action()
        {
            if ($this->input->method() === 'post') {
                $task_ids = $this->input->post('task_ids');
                
                if ($this->input->post('bulk_delete')) {
                    $this->db->where_in('id', $task_ids);
                    $this->db->delete('tasks');
                    
                    $this->session->set_flashdata('message', 'Tasks deleted successfully!');
                } 
                elseif ($this->input->post('status')) {
                    $new_status = $this->input->post('status');
                    
                    $this->db->where_in('id', $task_ids);
                    $this->db->update('tasks', ['status' => $new_status]);
                    
                    $this->session->set_flashdata('message', 'Tasks updated successfully!');
                }
        
                redirect('Tasks');
            } else {
                redirect('Tasks');
            }
        }
        
}
 