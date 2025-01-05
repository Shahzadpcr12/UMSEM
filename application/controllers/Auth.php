<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
      
    }


	
	public function index()
	{
		$this->load->view('admin/login');
		

	}

    public function login_Admin() {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required'); 
    
        if ($this->form_validation->run() == false) {
            $data = array();
            $this->load->view('admin/login', $data);
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
            );
            
            $check = $this->Auth_model->admin_data($data);
    
            if ($check != false) {
              
                $user = array(
                    'admin_id' => $check->id,
                    'email' => $check->email,
                );
                $this->session->set_userdata($user);
    
                redirect(base_url('Dashboard'));
            } else {
                $this->session->set_flashdata('invalid', 'Invalid Email or Password');
                redirect(base_url('admin-login'));
            }
        }
    }
    


    
    public function logout(){
        unset($_SESSION['user_id']);
        
        redirect(base_url('admin-login'));
    }
}
