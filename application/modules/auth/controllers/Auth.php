<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Auth_model');
      
    }
    

	
	public function index() {
        $this->load->view('login');
    }
    

   
    public function login_admin() {
        $username = $this->input->post('email');
        $password = $this->input->post('password');
    
        $this->db->where('email', $username);
        $this->db->where('password', md5($password));
        $employee = $this->db->get('employees')->row();
    
        if ($employee) {
            $this->db->select('permission_id');
            $this->db->from('role_permissions');
            $this->db->where('role_id', $employee->role_id);
            $permissions = $this->db->get()->result_array();
    
            $permission_ids = array_column($permissions, 'permission_id'); 
    
           
            $this->session->set_userdata([
                'user_id' => $employee->id,
                'role_id' => $employee->role_id, 
                'permissions' => $permission_ids, 
            ]);
            // echo '<pre>';
            // print_r($this->session->userdata());
            // exit();
            
            redirect('Dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid login credentials.');
            redirect(base_url('admin-login'));
        }
    }
    
    
    
    

    // public function login_admin() {
    //     $username = $this->input->post('email');
    //     $password = $this->input->post('password');
    

    //     $this->db->where('email', $username);
    //     $this->db->where('password', md5($password));
    //     $employee = $this->db->get('employees')->row();
    
    //     if ($employee) {
    //         $this->session->set_userdata([
    //             'user_id' => $employee->id,
    //             'role_id' => $employee->role_id,
    //             'email' => $employee->username,
    //         ]);
    
    //         echo "yes";
    //         exit();
    //     } else {
    //         $this->session->set_flashdata('error', 'Invalid login credentials.');

    //         echo "no";
    //         exit();
    //         redirect(base_url('admin-login'));
    //     }
    // }
    
    
    public function logout(){
        unset($_SESSION['user_id']);
        
        redirect(base_url('admin-login'));
    }
}
