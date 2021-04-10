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
        $config['per_page'] = 9;


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
        $idspp = $this->M_data->getsiswabynisn($nisn);
        $data['spp'] = $this->M_data->getnominal($idspp['id_spp']);

        $data['bulan'] = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei',];
        $this->load->view('main/bayar_spp', $data);
    }

    public function tambah_pembayaran($nisn)
    {
        $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->M_data->getsiswabynisn($nisn);
        $data['pembayaran'] = $this->M_data->getpembayaran($nisn);
        $data['bulan'] = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei',];
        $data['tahun'] = ['2019', '2020', '2021'];
        $idspp = $this->M_data->getsiswabynisn($nisn);
        $data['spp'] = $this->M_data->getnominal($idspp['id_spp']);
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
            $nisn = $nisn;
            $bulan = $this->input->post('bulan_dibayar');
            $tahun = $this->input->post('tahun_dibayar');
            if ($this->M_data->pembayarancek($nisn, $bulan, $tahun)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                spp sudah dibayar
            </div>');
                $this->load->view('main/bayar_spp', $data);
            } else {
                $ptgs = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
                $id = $this->uri->segment(3);
                $spp = $this->db->get_where('siswa', ['nisn' => $id])->row_array();

                $data2 = [
                    'tahun_dibayar' => htmlspecialchars($this->input->post('tahun_dibayar', TRUE)),
                    'bulan_dibayar' => htmlspecialchars($this->input->post('bulan_dibayar', TRUE)),
                    'jumlah_bayar' => htmlspecialchars($this->input->post('jumlah_bayar', TRUE)),
                    'tgl_bayar' => htmlspecialchars($this->input->post('tgl_bayar', TRUE)),
                    'id_petugas' => $ptgs['id_petugas'],
                    'id_spp' => $spp['id_spp'],
                    'nisn' => $nisn
                ];
                $this->db->insert('pembayaran', $data2);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                pembayaran berhasil
            </div>');
                $this->load->view('main/bayar_spp', $data);
            }
        }
    }
}