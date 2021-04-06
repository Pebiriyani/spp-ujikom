<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_kelas extends CI_Controller
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
        $data['kelas'] = $this->M_data->getDataKelas($config['per_page'], $data['start'], $data['keyword']);
        $data['title'] = 'data kelas';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/data_kelas', $data);
        $this->load->view('main/admin/footer', $data);
    }
    public function hapusDataKelas($id_kelas)
    {
        $where = array('id_kelas' => $id_kelas);
        $this->M_data->hapusData($where, 'kelas');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        data berhasil dihapus
      </div>');
        redirect('data_kelas');
    }
    public function tambah_kelas()
    {
        $data['nama_kelas'] = ['X', 'XI', 'XII'];
        $data['jurusan'] = ['Rekayasa perangkat lunak', 'Teknik komputer jaringan', 'Administrasi perkantoran'];

        $this->form_validation->set_rules('nama_kelas', 'nama kelas', 'required|trim');
        $this->form_validation->set_rules('kompetensi_keahlian', 'kompetensi keahlian', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            data siswa gagal ditambahkan
          </div>');
            redirect('data_kelas');
        } else {

            $data = [
                'nama_kelas' => htmlspecialchars($this->input->post('nama_kelas', TRUE)),
                'kompetensi_keahlian' => htmlspecialchars($this->input->post('kompetensi_keahlian', TRUE)),

            ];

            $this->db->insert('kelas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data siswa berhasil ditambahkan
          </div>');
            redirect('data_kelas');
        }
    }
    public function editDataKelas($id_kelas)
    {
        $data['admin'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['kelas'] = $this->M_data->getsiswabyidkelas($id_kelas);
        $data['nama_kelas'] = ['X', 'XI', 'XII'];
        $data['jurusan'] = ['Rekayasa Perangkat Lunak', 'teknik komputer jaringan', 'administrasi perkantoran'];

        $this->form_validation->set_rules('nama_kelas', 'nama kelas', 'required|trim');
        $this->form_validation->set_rules('kompetensi_keahlian', 'kompetensi keahlian', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('main/admin/header', $data);
            $this->load->view('main/admin/editkelas', $data);
            $this->load->view('main/admin/footer', $data);
        } else {

            $data = [
                'nama_kelas' => htmlspecialchars($this->input->post('nama_kelas', TRUE)),
                'kompetensi_keahlian' => htmlspecialchars($this->input->post('kompetensi_keahlian', TRUE)),

            ];

            $this->M_data->ubahdatakelas();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data kelas berhasil diubah
          </div>');
            redirect('data_kelas');
        }
    }
}