<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_data');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['admin'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->library('pagination');
        $config['base_url'] = "http://localhost/spp/history/index";

        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 6;


        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['history'] = $this->M_data->getDatapembayaran($config['per_page'], $data['start']);

        $data['title'] = 'history';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/history', $data);
        $this->load->view('main/admin/footer', $data);
    }
}