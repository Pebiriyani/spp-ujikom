<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $config['base_url'] = "http://localhost/spp/admin/index";
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
        $data['title'] = 'data siswa';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/index', $data);
        $this->load->view('main/admin/footer', $data);
    }

    public function tambah_siswa()
    {

        $config['upload_path']          = './assets/images/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            data siswa gagal ditambahkan
          </div>');
            redirect('admin');
        } else {
            $gambar = $this->upload->data();
            $gambar = $gambar['file_name'];

            $nis = $this->input->post('nis', TRUE);
            $nisn = $this->input->post('nisn', TRUE);
            $nama = $this->input->post('nama', TRUE);
            $id_kelas = $this->input->post('id_kelas', TRUE);
            $alamat = $this->input->post('alamat', TRUE);
            $no_telp = $this->input->post('no_telp', TRUE);
            $id_spp = $this->input->post('id_spp', TRUE);

            $data = array(
                'nisn' => $nisn,
                'nis' => $nis,
                'nama' => $nama,
                'id_kelas' => $id_kelas,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'id_spp' => $id_spp,
                'gambar' => $gambar
            );
            $this->db->insert('siswa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                data siswa berhasil ditambahkan
             </div>');
            redirect('admin');
        }


        // $this->form_validation->set_rules('nis', 'Nis', 'required|trim');
        // $this->form_validation->set_rules('nisn', 'Nisn', 'required|trim');
        // $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        // $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
        // $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        // $this->form_validation->set_rules('no_telp', 'No telp', 'required|trim');
        // $this->form_validation->set_rules('id_spp', 'id spp', 'required|trim');

        // if ($this->form_validation->run() == false) {
        // } else {

        //     $data = [];

        //     $this->db->insert('siswa', $data);
        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        //     data siswa berhasil ditambahkan
        //   </div>');
        //     redirect('admin');
        // }
    }
    public function hapusDataSiswa($nisn)
    {
        $where = $this->M_data->getsiswabynisn($nisn);
        $this->M_data->hapusData($where, 'siswa');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data berhasil dihapus
          </div>');
        redirect('admin');
    }
    public function data_petugas()
    {
        redirect('data_petugas');
    }
    public function data_kelas()
    {
        redirect('data_kelas');
    }
    public function data_pembayaran()
    {
        redirect('data_pembayaran');
    }
    public function data_spp()
    {
        redirect('data_spp');
    }
    public function history()
    {
        redirect('history');
    }
    public function laporan($nisn)
    {
        $data['admin'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $nisn = $this->uri->segment(3);
        $laporan = array();
        $bulan = array('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember');



        for ($tahun = 2019; $tahun <= date('Y'); $tahun++) {
            for ($b = 0; $b < 12; $b++) {


                $cek = $this->M_data->cekpembayaran($nisn, $tahun, $bulan[$b]);

                if ($cek) {
                    $status = 'lunas';
                } else {
                    $status = 'belum lunas';
                }

                $laporan[] = array(
                    'status' => $status,
                    'tahun' => $tahun,
                    'bulan' => $bulan[$b]
                );
            }
        }


        $data['laporan'] = $laporan;
        $data['title'] = 'data laporan';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/laporan_pembayaran', $data);
        $this->load->view('main/admin/footer', $data);
    }
    public function editDataSiswa($nisn)
    {
        $data['admin'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->M_data->getsiswabynisn($nisn);
        $this->form_validation->set_rules('nis', 'Nis', 'required|trim');
        $this->form_validation->set_rules('nisn', 'Nisn', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No telp', 'required|trim');
        $this->form_validation->set_rules('id_spp', 'id spp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'edit siswa';
            $this->load->view('main/admin/header', $data);
            $this->load->view('main/admin/ubahdatasiswa', $data);
            $this->load->view('main/admin/footer', $data);
        } else {

            $data = [
                'nis' => htmlspecialchars($this->input->post('nis', TRUE)),
                'nisn' => htmlspecialchars($this->input->post('nisn', TRUE)),
                'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
                'id_kelas' => htmlspecialchars($this->input->post('id_kelas', TRUE)),
                'alamat' => htmlspecialchars($this->input->post('alamat', TRUE)),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', TRUE)),
                'id_spp' => htmlspecialchars($this->input->post('id_spp', TRUE)),

            ];

            $this->M_data->ubahdata();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data siswa berhasil diubah
          </div>');
            redirect('admin');
        }
    }
    public function pembayaran($nisn)
    {
        $data['admin'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
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
            $data['title'] = 'pembayaran';
            $this->load->view('main/admin/header', $data);
            $this->load->view('main/admin/data_pembayaran', $data);
            $this->load->view('main/admin/footer', $data);
        } else {
            $nisn = $nisn;
            $bulan = $this->input->post('bulan_dibayar');
            $tahun = $this->input->post('tahun_dibayar');
            if ($this->M_data->pembayarancek($nisn, $bulan, $tahun)) {
                $this->session->set_flashdata('mesage', '<div class="alert alert-danger" role="alert">
                spp sudah dibayar
            </div>');
                $data['title'] = 'pembayaran';
                $this->load->view('main/admin/header', $data);
                $this->load->view('main/admin/data_pembayaran', $data);
                $this->load->view('main/admin/footer', $data);
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
                $this->session->set_flashdata('mesage', '<div class="alert alert-success" role="alert">
                pembayaran berhasil
            </div>');
                $data['title'] = 'pembayaran';
                $this->load->view('main/admin/header', $data);
                $this->load->view('main/admin/data_pembayaran', $data);
                $this->load->view('main/admin/footer', $data);
            }
        }
    }
}