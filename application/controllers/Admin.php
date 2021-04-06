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

        $this->form_validation->set_rules('nis', 'Nis', 'required|trim');
        $this->form_validation->set_rules('nisn', 'Nisn', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No telp', 'required|trim');
        $this->form_validation->set_rules('id_spp', 'id spp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            data siswa gagal ditambahkan
          </div>');
            redirect('admin');
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

            $this->db->insert('siswa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data siswa berhasil ditambahkan
          </div>');
            redirect('admin');
        }
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
    public function laporan()
    {
        redirect('laporan');
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
}