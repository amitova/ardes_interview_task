<?php

class UsersModel extends CI_Model{

    public function insertRegistration($data){
       $this->db->insert('users', $data); 
       return $this->db->affected_rows();
    }
    
    public function login($email, $pass){
        $user = $this->db->get_where('users',['email' => $email, 'pass' => $pass]);
        return $user->row_array();
    
    }
    
    function editUserProfile($email){
        $user = $this->db->get_where('users',['email' => $email]);
        return $user->row_array();
    }
    
    function updateUserProfile($data, $user_id) {
       $this->db->update('users', $data, array("user_id" => $user_id));
       return $this->db->affected_rows();
    }
}

