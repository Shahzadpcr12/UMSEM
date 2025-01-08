<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct()
    {
        // parent::__construct();
        // if (!$this->session->userdata('admin_id')) {
        //     redirect('Auth/index');
        // }
    }
    
	public function index()
	{

		

		// echo "<pre>";
		// print_r($data["total_users"]);
		// exit();
		// var_dump($data["total_users"]);
		// var_dump($data["total_tasks"]);
		// var_dump($data["total_departments"]);
		$this->load->view('admin/header');
		$this->load->view('admin/side_bar');
		$this->load->view('dashboard');
		$this->load->view('admin/footer');

	}

	
 



	
	
}