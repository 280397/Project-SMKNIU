<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // ambil data user pada session
        $data['title'] = 'Kelola Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Barang_model', 'barang');

        // query data menu
        $data['barang'] = $this->barang->getBarangId();
        $data['nama_barang'] = $this->db->get('barang')->result_array();
        $data['kondisi'] = $this->db->get('barang_kondisi')->result_array();
        $data['lokasi'] = $this->db->get('barang_lokasi')->result_array();


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('barang/index', $data);
            $this->load->view('templates/footer');
        }
    }

    // tambah barang
    public function tambahbarang()
    {
        // ambil data user pada session
        $data['title'] = 'Tambah Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Barang_model', 'barang');

        // query data menu
        $data['barang'] = $this->barang->getBarangId();
        $data['nama_barang'] = $this->db->get('barang')->result_array();
        $data['kondisi'] = $this->db->get('barang_kondisi')->result_array();
        $data['lokasi'] = $this->db->get('barang_lokasi')->result_array();

        // rules
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Barang', 'required');
        $this->form_validation->set_rules('merk', 'Merek');
        $this->form_validation->set_rules('model', 'Model', 'required');
        $this->form_validation->set_rules('id_kondisi', 'Kondisi', 'required');
        $this->form_validation->set_rules('id_lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('dtl_lokasi', 'Detail Lokasi', 'required');
        // $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('sumber', 'Sumber', 'required');
        $this->form_validation->set_rules('gambar', 'Gambar');
        // $this->form_validation->set_rules('barcode', 'Barcode');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('barang/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'merk' => $this->input->post('merk'),
                'model' => $this->input->post('model'),
                'id_kondisi' => $this->input->post('id_kondisi'),
                'id_lokasi' => $this->input->post('id_lokasi'),
                'dtl_lokasi' => $this->input->post('dtl_lokasi'),

                'sumber' => $this->input->post('sumber'),
                'gambar' => 'default.jpg',

            ];

            $this->db->insert('barang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang ditambahkan!</div>');
            redirect('barang');
        }
    }


    // hapus barang
    public function hapusbarang($id)
    {
        // $this->load->model('Barang_model');
        $this->Barang_model->hapusBarang($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('barang');
    }


    // edit barang
    public function editbarang($id)
    {
        $data['title'] = 'Edit Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->Barang_model->getBarang($id);
        $dataa['kondisi'] = $this->db->get('barang_kondisi')->result_array();
        $dataa['lokasi'] = $this->db->get('barang_lokasi')->result_array();

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Barang', 'required');
        $this->form_validation->set_rules('merk', 'Merek');
        $this->form_validation->set_rules('model', 'Model', 'required');
        $this->form_validation->set_rules('id_kondisi', 'Kondisi', 'required');
        $this->form_validation->set_rules('id_lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('dtl_lokasi', 'Detail Lokasi', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('sumber', 'Sumber', 'required');
        $this->form_validation->set_rules('gambar', 'Gambar');
        $this->form_validation->set_rules('barcode', 'Barcode');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('barang/edit', $dataa);
            $this->load->view('templates/footer');
        } else {
            $this->Barang_model->ubahBarang();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang berhasil diedit!</div>');
            redirect('barang');
        }
    }
    // detail barang
    public function detailbarang($id)
    {
        $data['title'] = 'Edit Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->Barang_model->getBarang($id);
        // $dataa['kondisi'] = $this->db->get('barang_kondisi')->result_array();
        // $dataa['lokasi'] = $this->db->get('barang_lokasi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('barang/edit', $data);
        $this->load->view('templates/footer');
    }
}
