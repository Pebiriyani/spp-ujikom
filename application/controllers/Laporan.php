<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
        $config['base_url'] = "http://localhost/spp/laporan/index";
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] =  $this->session->userdata('keyword');
        }

        $this->db->like('kompetensi_keahlian', $data['keyword']);
        $this->db->from('kelas');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 6;


        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['laporan'] = $this->M_data->getDatapembayaran($config['per_page'], $data['start'], $data['keyword']);

        $laporan = array();
        $bulan = array('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember');

        foreach ($data['laporan'] as $l) {
            for ($b = 0; $b < 12; $b++) {
                for ($tahun = 2021; $tahun <= date('Y'); $tahun++) {

                    $cek = $this->M_data->cekpembayaran($l['nisn'], $tahun, $bulan[$b]);

                    if ($cek) {
                        $status = 'lunas';
                    } else {
                        $status = 'belum lunas';
                    }

                    $laporan[] = array(
                        'nisn' => $l['nisn'],
                        'nama' => $l['nama'],
                        'status' => $status,
                        'tahun' => $tahun,
                        'bulan' => $bulan[$b]
                    );
                }
            }
        }
        $data['laporan'] = $laporan;

        $data['title'] = 'laporan';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/laporan', $data);
        $this->load->view('main/admin/footer', $data);
    }
}