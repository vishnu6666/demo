<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in') == true) {
            redirect('dashboard');
        }
        if(is_array($this->input->post()) && count($this->input->post())>0){
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user_check = $this->auth_model->user_check($email);
           
            if ($user_check) {
                $user_data = $this->auth_model->login_user($email, $password);
                if ($user_data) {
    
                    if($user_data['type'] == 1 ){
                         $session_data_admin = array(
                                            "user_id"       =>  $user_data['id'],
                                            "uuid"          =>  $user_data['uuid'],
                                            "first_name"    =>  $user_data['first_name'],
                                            "last_name"     =>  $user_data['last_name'],
                                            "email"         =>  $user_data['email'],
                                            "type"          =>  $user_data['type'],
                                            "logged_in"     =>  true,
                                        );
                        $this->session->set_userdata($session_data_admin);
                        redirect(base_url() . 'dashboard');
                    }

                } else {
                    $this->session->set_flashdata('error_msg', 'Invalid Password, please try again.');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Email address not exists in system');
                redirect('auth/login');
            }
        }
        $this->load->view('include/header');
        $this->load->view('auth/login');
        $this->load->view('include/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
        exit;
    }
}