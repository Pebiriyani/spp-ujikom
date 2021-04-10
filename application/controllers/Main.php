<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_data');
    }
    public function index()
    {

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('nisn', 'nisn', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('main/loginsiswa');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $nama = $this->input->post('nama');
        $nisn = $this->input->post('nisn');
        $user = $this->db->get_where('siswa', ['nama' => $nama])->row_array();
        if ($user) {
            if ($user['nisn'] == $nisn) {
                $data = [
                    'nama' => $user['nama'],
                    'nisn' => $user['nisn']
                ];
                $this->session->set_userdata($data);
                redirect('user', $data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">wrong nis!</div>');
                redirect('main');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> name is not registered!</div>');
            redirect('main');
        }
    }

    public function petugas()
    {
        $this->load->view('main/login_petugas');
    }


    public function logout()
    {
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('nisn');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> you have been logout!</div>');
        redirect('main');
    }
}