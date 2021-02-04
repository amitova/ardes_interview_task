<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
    * .
**/
class Users extends CI_Controller {
    
        public function __construct(){
                parent::__construct();
                $this->load->model('UsersModel');
        }

	/*
	 * Index Page - show login/register form.
	 */
	public function index()
	{
            $this->load->helper('url');
            $this->load->view('UsersViews/LoginView');
	}
        /*
	 * checkUser - check from which form (login/register)  is sent the request
         * and call necessary method .
	 */
        public function checkUser() {
            $checkForm = $this->input->post('key');
            if($checkForm == 1){
                $this->login();
            }else{
                $this->registration();
            }
        }
        
        public function login() {
            
            $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
            $this->form_validation->set_rules('inputPassword', 'Password','required');
            $encrypted_pass = md5($this->input->post('inputPassword'));
            $email = $this->input->post('email', TRUE);
            
            if($this->form_validation->run()){
                $userData = $this->UsersModel->login($email,$encrypted_pass);
                //var_dump($userData);    
                if(!empty($userData)){
                    $this->session->set_userdata('email', $userData['email']);
                    $this->session->set_userdata('logged_in', TRUE);
                    $this->session->set_userdata('role', $userData['role']);
                    if($userData['role']==1 && $userData['status']==1){
                        echo 1;
                    }elseif($userData['role']==2 && $userData['status']==1){
                        echo 2;
                    }else{
                        echo "Access denied";
                    }
                    
                }else{
                    echo "Incorrect credentials!";
                }
            }else{
                echo validation_errors();
            }
        }
        
        public function registration(){
            
            $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]', array('is_unique' => 'The  %s alredy exist!'));
            $this->form_validation->set_rules('inputPassword', 'Password','required|min_length[6]');
            $this->form_validation->set_rules('inputConfirmPassword', 'Confirm Password', 'required|matches[inputPassword]');
            
            if($this->form_validation->run()){
            
                $encrypted_pass = md5($this->input->post('inputPassword', TRUE));
                $data = array(
                    'email' => $this->input->post('email', TRUE),
                    'pass' => $encrypted_pass,
                    'status' => 1,
                    'role' => 2,
                    'reg_date' => date("Y-m-d H:i:s"),
                );
                
                $runQuery = $this->UsersModel->insertRegistration($data);
                if($runQuery == 1){
                    echo "r";
                }
                
            }else{
                echo validation_errors();
            }
            
        }
        
        public function profile($msg=""){
            $email = $this->session->email;
            $data = $this->UsersModel->editUserProfile($email);
			$data['success'] = $msg;
            $data['view'] = "UsersViews/ProfileView";
            $this->load->view('elements/template',$data);
        }
        
        public function editProfile(){
            
            $this->form_validation->set_rules('fnsme', 'First name', 'trim');
            $this->form_validation->set_rules('lnsme', 'Last name', 'trim');

            if($this->form_validation->run()){
                $user_id = $this->input->post('user_id', TRUE);
                $data = array(
                    'fname' => $this->input->post('inputFName', TRUE),
                    'lname' => $this->input->post('inputLName', TRUE),
                    'last_edit_date' => date("Y-m-d H:i:s"),
                );
                $runQuery = $this->UsersModel->updateUserProfile($data, $user_id); 
				if($runQuery){
					$msg = "Success!";
				}
            }
            $this->profile($msg);
        }
        
        public function logout(){
            $this->session->sess_destroy();
            redirect('/');
        }
        
        
}
