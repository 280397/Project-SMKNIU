<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Barang_m', 'Lokasi_m', 'Kondisi_m', 'Kategori_m']);
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data 

        $lokasi = new stdClass();
        $lokasi->id = null;
        $lokasi->lokasi = null;
        $data = array(
            'lokasi' => $this->db->get('barang_lokasi')->result_array(),
            'title' => 'Tambah lokasi',
            'page' => 'add',
            'row' => $lokasi
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('lokasi/index', $data);
        $this->load->view('templates/footer');
    }
    public function indexlokasi()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['row'] = $this->Lokasi_m->getbarang($this->uri->segment(3));
        $data['title'] = 'Barang';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $dataa);
        $this->load->view('lokasi/lokasi_index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        // ambil data user pada session

        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $lokasi = new stdClass();
        $lokasi->id = null;
        $lokasi->lokasi = null;
        $data = array(
            'title' => 'Tambah lokasi',
            'page' => 'add',
            'row' => $lokasi
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('lokasi/tambah', $data);
        $this->load->view('templates/footer');
    }

    // prosess
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['add'])) {
            $this->Lokasi_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->Lokasi_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        }

        redirect('Lokasi');
    }

    // hapus lokasi
    public function hapuslokasi($id = null)
    {
        // $this->load->model('lokasi_m');
        $this->Lokasi_m->hapuslokasi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data dihapus!</div>');
        redirect('Lokasi');
    }


    // edit lokasi
    public function editlokasi($id)
    {
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $query = $this->Lokasi_m->get($id);

        if ($query->num_rows() > 0) {
            $lokasi = $query->row();
            $data = array(
                'title' => 'Edit lokasi',
                'page' => 'edit',
                'row' => $lokasi
            );
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $dataa);
            $this->load->view('templates/sidebar', $dataa);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('lokasi/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
            redirect('Lokasi');
        }
    }
}
