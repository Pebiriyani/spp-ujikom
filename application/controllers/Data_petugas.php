<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_petugas extends CI_Controller
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
        $config['base_url'] = "http://localhost/spp/data_petugas/index";
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] =  $this->session->userdata('keyword');
        }

        $this->db->like('nama_petugas', $data['keyword']);
        $this->db->from('petugas');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 6;


        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['petugas'] = $this->M_data->getpetugas($config['per_page'], $data['start'], $data['keyword']);
        $data['title'] = 'data petugas';
        $this->load->view('main/admin/header', $data);
        $this->load->view('main/admin/data_petugas', $data);
        $this->load->view('main/admin/footer', $data);
    }
    public function hapusDataPetugas($id_petugas)
    {
        $where = array('id_petugas' => $id_petugas);
        $this->M_data->hapusData($where, 'petugas');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        data berhasil dihapus
      </div>');
        redirect('data_petugas');
    }
    public function tambah_petugas()
    {


        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('nama_petugas', 'nama petugas', 'required|trim');

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]');

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            data siswa gagal ditambahkan
          </div>');
            redirect('data_petugas');
        } else {

            $data = [
                'username' => htmlspecialchars($this->input->post('username', TRUE)),
                'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas', TRUE)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => 'petugas',

            ];

            $this->db->insert('petugas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data petugas berhasil ditambahkan
          </div>');
            redirect('data_petugas');
        }
    }
    public function editDataPetugas($id_petugas)
    {
        $data['admin'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['petugas'] = $this->M_data->getbyidpetugas($id_petugas);
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('nama_petugas', 'nama petugas', 'required|trim');
        $this->form_validation->set_rules('level', 'level', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'edit petugas';
            $this->load->view('main/admin/header', $data);
            $this->load->view('main/admin/editpetugas', $data);
            $this->load->view('main/admin/footer', $data);
        } else {

            $data = [
                'username' => htmlspecialchars($this->input->post('username', TRUE)),
                'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas', TRUE)),
                'level' => htmlspecialchars($this->input->post('level', TRUE)),

            ];

            $this->M_data->ubahdatapetugas();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            data petugas berhasil diubah
          </div>');
            redirect('data_petugas');
        }
    }
}