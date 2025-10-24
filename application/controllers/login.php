<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('login');
    }

    public function auth() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $admin = $this->Admin_model->check_login($username, $password);
        if ($admin) {
            $session_data = array(
                'uid' => $admin->id,
                'username' => $admin->username,
            );
            $this->session->set_userdata($session_data);
            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid credentials');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
