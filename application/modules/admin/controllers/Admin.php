<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('Auth/index');
        }
    }
    
	public function index()
	{

		$this->load->view('admin/header');
		$this->load->view('admin/side_bar');
		$this->load->view('dashboard');
		$this->load->view('admin/footer');

	}

	
 



	
	
}