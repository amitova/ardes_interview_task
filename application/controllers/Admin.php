<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * .
 * */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library('form_validation');
    }
    
    public function showUsersList() {
        $data['users_data'] = $this->AdminModel->showUsersList();
        $data['view'] = "AdminView/UsersListView";
        $this->load->view('elements/template',$data);
    }
    public function addUser() {
        if($this->input->post()){
            $this->form_validation->set_rules('email', 'Email Address',  'required|trim|valid_email|is_unique[users.email]', array('is_unique' => 'The  %s alredy exist!'));
            $this->form_validation->set_rules('fnsme', 'First name', 'trim');
            $this->form_validation->set_rules('lnsme', 'Last name', 'trim');
            $this->form_validation->set_rules('selectStatus', 'Status', 'required');
            $this->form_validation->set_rules('selectRole', 'Role', 'required');
            $this->form_validation->set_rules('inputPassword', 'Password','required|min_length[6]');
            $this->form_validation->set_rules('inputConfirmPassword', 'Confirm Password', 'required|matches[inputPassword]');
            
            if($this->form_validation->run() == TRUE){
                $query_data = array(
                    'email' => $this->input->post('email', TRUE),
                    'fname' => $this->input->post('inputFName', TRUE),
                    'lname' => $this->input->post('inputLName', TRUE),
                    'status' => $this->input->post('selectStatus', TRUE),
                    'role' => $this->input->post('selectRole', TRUE),
                    'reg_date' => date("Y-m-d H:i:s"),
                    'pass' => md5($this->input->post('inputPassword', TRUE))
                );
                $user_id = $this->AdminModel->addUserData($query_data);   
            }else{
                $data['errors'] = validation_errors();
            }
        }
        
        if(isset($user_id)){
            redirect('dashboard/editUser/'.$user_id);  
        }else{
            $data['method'] = "addUser";
            $data['view'] = "AdminView/EditUserView";
            $this->load->view('elements/template',$data);
        }
        
    }
    public function editUser($user_id="") {
        $method = $this->uri->segment(2);
        
        if($this->input->post()){
            $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
            $this->form_validation->set_rules('fnsme', 'First name', 'trim');
            $this->form_validation->set_rules('lnsme', 'Last name', 'trim');
            $this->form_validation->set_rules('selectStatus', 'Status', 'required');
            $this->form_validation->set_rules('selectRole', 'Role', 'required');

            
            if($this->form_validation->run()== TRUE){
                $query_data = array(
                    'email' => $this->input->post('email', TRUE),
                    'fname' => $this->input->post('inputFName', TRUE),
                    'lname' => $this->input->post('inputLName', TRUE),
                    'status' => $this->input->post('selectStatus', TRUE),
                    'role' => $this->input->post('selectRole', TRUE),
                    'last_edit_date' => date("Y-m-d H:i:s"),
                );
                
                $editQuery = $this->AdminModel->updateUserData($query_data, $user_id);
            }else{
                $data['errors'] = validation_errors();
            }
        }
        
        $data = $this->AdminModel->editUser($user_id);
        $data['method'] = $method;
        $data['view'] = "AdminView/EditUserView";
        $this->load->view('elements/template',$data);

    }

}
