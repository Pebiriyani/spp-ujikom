<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pembayaran extends CI_Controller
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
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 6;


        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['kelas'] = $this->M_data->getDataKelas($config['per_page'], $data['start']);

        $data['bulan'] = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei'];
        $data['title'] = 'pembayaran';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/data_pembayaran', $data);
        $this->load->view('main/admin/footer', $data);
    }

    public function tambah_pembayaran()
    {
        $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['bulan'] = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei'];



        $this->form_validation->set_rules('tahun_dibayar', 'tahun dibayar', 'required|trim');
        $this->form_validation->set_rules('bulan_dibayar', 'bulan dibayar', 'required|trim');
        $this->form_validation->set_rules('jumlah_bayar', 'jumlah bayar', 'required|trim');
        $this->form_validation->set_rules('nisn', 'nisn', 'required|trim');
        $this->form_validation->set_rules('tgl_bayar', 'tgl_bayar', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
           pembayaran gagal
          </div>');
            redirect('data_pembayaran');
        } else {
            $nisn = $this->input->post('nisn');
            $bulan = $this->input->post('bulan_dibayar');
            $tahun = $this->input->post('tahun_dibayar');
            if ($this->M_data->pembayarancek($nisn, $bulan, $tahun)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            spp sudah dibayar
          </div>');
                redirect('data_pembayaran');
            } else {
                $ptgs = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();


                $data = [
                    'tahun_dibayar' => htmlspecialchars($this->input->post('tahun_dibayar', TRUE)),
                    'bulan_dibayar' => htmlspecialchars($this->input->post('bulan_dibayar', TRUE)),
                    'jumlah_bayar' => htmlspecialchars($this->input->post('jumlah_bayar', TRUE)),
                    'nisn' => htmlspecialchars($this->input->post('nisn', TRUE)),
                    'tgl_bayar' => htmlspecialchars($this->input->post('tgl_bayar', TRUE)),
                    'id_petugas' => $ptgs['id_petugas'],
                    'id_spp' => 1
                ];
                $this->db->insert('pembayaran', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            pembayaran berhasil
          </div>');
                redirect('data_pembayaran');
            }
        }
    }
}