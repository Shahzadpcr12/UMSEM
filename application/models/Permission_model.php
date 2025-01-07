<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Permission_model extends CI_Model
{
    public function get_permissions_grouped_by_module()
    {
        $this->db->select('id, module_name, action');
        $query = $this->db->get('permissions');
        $result = [];

        foreach ($query->result_array() as $row) {
            $result[$row['module_name']][] = [
                'id' => $row['id'],
                'action' => $row['action']
            ];
        }

        return $result;
    }

    public function get_role_permissions($role_id)
    {
        $this->db->select('permission_id');
        $this->db->where('role_id', $role_id);
        return $this->db->get('role_permissions')->result_array();
    }
    public function get_permissions_by_role($role_id) {
        $this->db->select('permission_id');
        $this->db->from('role_permissions');
        $this->db->where('role_id', $role_id);
        $query = $this->db->get();
        
        return array_column($query->result_array(), 'permission_id');
    }
    public function update_role_permissions($role_id, $permissions)
    {
        // Delete existing permissions
        $this->db->where('role_id', $role_id);
        $this->db->delete('role_permissions');

        // Insert new permissions
        $data = [];
        foreach ($permissions as $permission_id) {
            $data[] = ['role_id' => $role_id, 'permission_id' => $permission_id];
        }

        if (!empty($data)) {
            $this->db->insert_batch('role_permissions', $data);
        }
    }
}


