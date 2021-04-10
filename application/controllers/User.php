<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_data');
        $this->load->helper('url');
        $this->load->helper('form');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('siswa', ['nama' => $this->session->userdata('nama')])->row_array();
        $data['siswa'] = $this->M_data->select_pembayaran()->result();
        $this->load->view('main/user', $data);
    }
}