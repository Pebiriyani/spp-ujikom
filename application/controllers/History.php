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
        $config['base_url'] = "http://localhost/spp/data_kelas/index";


        $this->db->like('kompetensi_keahlian');
        $this->db->from('kelas');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;


        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['history'] = $this->M_data->get_pembayaran($config['per_page'], $data['start']);
        $data['title'] = 'History';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/history', $data);
        $this->load->view('main/admin/footer', $data);
    }
}