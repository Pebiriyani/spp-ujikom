<?php
class M_data extends CI_model
{
    function __construct()
    {
        parent::__construct();
    }
    function select_pembayaran()
    {
        $sql = $this->db->query("select *from pembayaran");

        return $sql;
    }
    function select_siswa()
    {
        return $this->db->get('siswa')->result_array();
    }
    function select_kelas()
    {
        $sql = $this->db->query("select nama_kelas,kompetensi_keahlian from kelas where id_kelas=(select id_kelas from siswa);");

        return $sql;
    }
    public function getsiswa($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
        }
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('spp', 'siswa.id_spp = spp.id_spp');
        $query = $this->db->get('siswa', $limit, $start)->result_array();
        return $query;
    }
    public function countall()
    {
        return $this->db->get('siswa')->num_rows();
    }
    public function getsiswabynisn($nisn)
    {
        return $this->db->get_where('siswa', ['nisn' => $nisn])->row_array();
    }
    public function getsiswabyidpetugas($id_petugas)
    {
        return $this->db->get_where('petugas', ['id_petugas' => $id_petugas])->row_array();
    }
    public function getsiswabyidkelas($id_kelas)
    {
        return $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->row_array();
    }
    public function getidspp($id_spp)
    {
        return $this->db->get_where('spp', ['id_spp' => $id_spp])->row_array();
    }
    public function getpembayaran($nisn)
    {
        $query = $this->db->get_where('pembayaran', ['nisn' => $nisn])->result_array();
        return $query;
    }
    function pembayaran()
    {
        $this->db->where('nisn', $this->input->post('nisn'));
        $this->db->get('pembayaran');
    }
    public function getpetugas($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_petugas', $keyword);
        }
        return $this->db->get('petugas', $limit, $start)->result_array();
    }

    function hapusData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function getDataKelas($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('kompetensi_keahlian', $keyword);
        }
        return $this->db->get('kelas', $limit, $start)->result_array();
    }
    public function getDatapembayaran($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nisn', $keyword);
        }

        $query = $this->db->get('siswa', $limit, $start)->result_array();
        return $query;
    }
    public function getDataspp($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tahun', $keyword);
        }
        return $this->db->get('spp', $limit, $start)->result_array();
    }

    public function ubahdata()
    {
        $data = [
            'nis' => htmlspecialchars($this->input->post('nis', TRUE)),
            'nisn' => htmlspecialchars($this->input->post('nisn', TRUE)),
            'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
            'id_kelas' => htmlspecialchars($this->input->post('id_kelas', TRUE)),
            'alamat' => htmlspecialchars($this->input->post('alamat', TRUE)),
            'no_telp' => htmlspecialchars($this->input->post('no_telp', TRUE)),
            'id_spp' => htmlspecialchars($this->input->post('id_spp', TRUE)),

        ];

        $this->db->where('nisn', $this->input->post('nisn'));
        $this->db->update('siswa', $data);
    }
    public function ubahdataspp()
    {
        $data = [
            'tahun' => htmlspecialchars($this->input->post('tahun', TRUE)),
            'nominal' => htmlspecialchars($this->input->post('nominal', TRUE)),

        ];
        $this->db->where('id_spp', $this->input->post('id_spp'));
        $this->db->update('spp', $data);
    }
    public function ubahdatakelas()
    {
        $data = [
            'nama_kelas' => htmlspecialchars($this->input->post('nama_kelas', TRUE)),
            'kompetensi_keahlian' => htmlspecialchars($this->input->post('kompetensi_keahlian', TRUE)),

        ];

        $this->db->where('id_kelas', $this->input->post('id_kelas'));
        $this->db->update('kelas', $data);
    }
    public function ubahdatapetugas()
    {

        $data = [
            'username' => htmlspecialchars($this->input->post('username', TRUE)),
            'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas', TRUE)),
            'level' => htmlspecialchars($this->input->post('level', TRUE)),

        ];

        $this->db->where('id_petugas', $this->input->post('id_petugas'));
        $this->db->update('petugas', $data);
    }
    public function cekpembayaran($nisn, $tahun, $bulan)
    {
        $this->db->select('siswa.nisn', 'pembayaran.bulan_dibayar', 'pembayaran.tahun_dibayar');
        $this->db->from('siswa');
        $this->db->join('pembayaran', 'pembayaran.nisn = siswa.nisn');
        $array = array('siswa.nisn' => $nisn, 'pembayaran.bulan_dibayar' => $bulan, 'pembayaran.tahun_dibayar' => $tahun);
        $this->db->where($array);
        return $this->db->get()->num_rows();
    }
}