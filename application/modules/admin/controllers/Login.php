<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    
    public function index()
    {
        $data['title'] = 'Login';
        // Fungsi Login
        $valid = $this->form_validation;
        $username_admin = $this->input->post('username_admin');
        $password_admin = $this->input->post('password_admin');
        $valid->set_rules('username_admin', 'Username', 'required');
        $valid->set_rules('password_admin', 'Password', 'required');
        if ($valid->run()) {
            $this->login_admin->login($username_admin, $password_admin, base_url('../dashboard'),base_url('../'));
        }
        // End fungsi login
        $this->load->view('template/header_view',$data);
        $this->load->view('login_v');
    }
    public function logout()
    {
        $this->login_admin->logout();
    }
    public function logoutMember()
    {
        $this->login_admin->logoutMember();
    }
}
