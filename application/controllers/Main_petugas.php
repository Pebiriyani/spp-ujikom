<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_data');
        $this->load->helper('url');
    }
    public function index()
    {

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'login page';
            $this->load->view('main/login_petugas', $data);
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $petugas = $this->db->get_where('petugas', ['username' => $username])->row_array();
        if ($petugas) {
            if (password_verify($password, $petugas['password'])) {
                $data = [
                    'username' => $petugas['username'],
                    'level' => $petugas['level']
                ];

                $this->session->set_userdata($data);
                if ($petugas['level'] == 'admin') {
                    redirect('admin');
                } else {
                    redirect('petugas');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">wrong password!</div>');
                redirect('main_petugas');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> username is not registered!</div>');
            redirect('main_petugas');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('password');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> you have been logout!</div>');
        redirect('main_petugas');
    }
}