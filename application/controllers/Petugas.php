<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
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
        $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->library('pagination');
        $config['base_url'] = "http://localhost/spp/petugas/index";
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] =  $this->session->userdata('keyword');
        }

        $this->db->like('nama', $data['keyword']);
        $this->db->from('siswa');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 6;


        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['siswa'] = $this->M_data->getsiswa($config['per_page'], $data['start'], $data['keyword']);
        $this->load->view('main/petugas', $data);
    }
    public function bayar_spp($nisn)
    {
        $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->M_data->getsiswabynisn($nisn);
        $data['pembayaran'] = $this->M_data->getpembayaran($nisn);

        $data['bulan'] = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei',];
        $this->load->view('main/bayar_spp', $data);
    }

    public function tambah_pembayaran($nisn)
    {
        $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('riyani')])->row_array();

        $data['siswa'] = $this->M_data->getsiswabynisn($nisn);
        $data['pembayaran'] = $this->M_data->getpembayaran($nisn);
        $data['bulan'] = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei',];
        $this->form_validation->set_rules('tahun_dibayar', 'tahun', 'required|trim');
        $this->form_validation->set_rules('bulan_dibayar', 'bulan', 'required|trim');
        $this->form_validation->set_rules('jumlah_bayar', 'jumlah bayar', 'required|trim');
        $this->form_validation->set_rules('tgl_bayar', 'tgl bayar');


        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           pembayaran gagal
          </div>');
            $this->load->view('main/bayar_spp', $data);
        } else {
            $data2['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
            $data2['siswa'] = $this->M_data->getsiswabynisn($nisn);
            $data2['pembayaran'] = $this->M_data->getpembayaran($nisn);
            $data2['bulan'] = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei',];
            $ptgs = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
            $data = [
                'tahun_dibayar' => htmlspecialchars($this->input->post('tahun_dibayar', TRUE)),
                'bulan_dibayar' => htmlspecialchars($this->input->post('bulan_dibayar', TRUE)),
                'jumlah_bayar' => htmlspecialchars($this->input->post('jumlah_bayar', TRUE)),
                'tgl_bayar' => htmlspecialchars($this->input->post('tgl_bayar', TRUE)),
                'id_petugas' => $ptgs['id_petugas'],
                'id_spp' => 1,
                'nisn' => $nisn
            ];
            $this->db->insert('pembayaran', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            pembayaran berhasil
          </div>');
            $this->load->view('main/bayar_spp', $data2);
        }
    }
}