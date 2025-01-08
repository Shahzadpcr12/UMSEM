<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    // protected function get_permission_id($permission_name) {
    //     $query = $this->db->get_where('permissions', ['name' => $permission_name]);
    //     if ($query->num_rows() > 0) {
    //         return $query->row()->id;
    //     }
    //     return null; // Permission not found
    // }
    // protected function restrict_access($permission_id)
    // {
    //     $user_permissions = $this->session->userdata('permissions'); // Assuming permissions are stored in session
        
    //     if (empty($user_permissions) || !in_array($permission_id, $user_permissions)) {
    //         // Redirect to a 'permission denied' page or show an error
    //         show_error('You do not have permission to access this page.', 403);
    //     }
    // }

    
    
    // protected function restrict_access_by_name($permission_name)
    // {
    //     $this->load->model('Permission_model');
    //     $permission_id = $this->Permission_model->get_permission_id($permission_name);
    
       
    //     if (!$permission_id || !in_array($permission_id, $this->session->userdata('permissions'))) {
    //         show_error('You do not have permission to access this page.', 403);
    //     }
    // }
    
    
}
