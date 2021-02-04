<?php

class AdminModel extends CI_Model {

    public function showUsersList() {
        $this->db->select('*');
        $this->db->from('users');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $user_data = $query->result_array();
            return $user_data;
        }
    }
    
    public function editUser($user_id) {
        $user = $this->db->get_where('users',['user_id' => $user_id]);
        return $user->row_array();
    }
    
    public function updateUserData($data, $user_id) {
        $this->db->update('users', $data, array("user_id" => $user_id));
       return $this->db->affected_rows();
    }
    
    public function addUserData($data) {
        $this->db->insert('users', $data); 
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

}
