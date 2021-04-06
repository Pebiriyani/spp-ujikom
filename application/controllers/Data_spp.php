<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_spp extends CI_Controller
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
        $config['base_url'] = "http://localhost/spp/data_spp/index";
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] =  $this->session->userdata('keyword');
        }

        $this->db->like('tahun', $data['keyword']);
        $this->db->from('spp');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 6;


        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['spp'] = $this->M_data->getDataspp($config['per_page'], $data['start'], $data['keyword']);

        $data['title'] = 'data spp';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/data_spp', $data);
        $this->load->view('main/admin/footer', $data);
    }
    public function hapusDataspp($id_spp)
    {
        $where = array('id_spp' => $id_spp);
        $this->M_data->hapusData($where, 'spp');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        data berhasil dihapus
      </div>');
        redirect('data_spp');
    }
    public function tambah_spp()
    {

        $this->form_validation->set_rules('tahun', 'tahun', 'required|trim');
        $this->form_validation->set_rules('nominal', 'nominal', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            data siswa gagal ditambahkan
          </div>');
            redirect('data_spp');
        } else {

            $data = [
                'tahun' => htmlspecialchars($this->input->post('tahun', TRUE)),
                'nominal' => htmlspecialchars($this->input->post('nominal', TRUE)),

            ];

            $this->db->insert('spp', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data siswa berhasil ditambahkan
          </div>');
            redirect('data_spp');
        }
    }
    public function editDataspp($id_spp)
    {
        $data['admin'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['spp'] = $this->M_data->getidspp($id_spp);


        $this->form_validation->set_rules('tahun', 'tahun', 'required|trim');
        $this->form_validation->set_rules('nominal', 'nominal', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('main/admin/header', $data);
            $this->load->view('main/admin/editspp', $data);
            $this->load->view('main/admin/footer', $data);
        } else {

            $data = [
                'tahun' => htmlspecialchars($this->input->post('tahun', TRUE)),
                'nominal' => htmlspecialchars($this->input->post('nominal', TRUE)),

            ];

            $this->M_data->ubahdataspp();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data spp berhasil diubah
          </div>');
            redirect('data_spp');
        }
    }
}