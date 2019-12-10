<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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

        $kategori = new stdClass();
        $kategori->id = null;
        $kategori->kategori = null;
        $data = array(
            'kategori' => $this->db->get('barang_kategori')->result_array(),
            'title' => 'Tambah kategori',
            'page' => 'add',
            'row' => $kategori
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('templates/footer');
    }
    public function indexkategori()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['row'] = $this->Kategori_m->getbarang($this->uri->segment(3));
        $data['title'] = 'Barang';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $dataa);
        $this->load->view('kategori/index_kategori', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        // ambil data user pada session

        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $kategori = new stdClass();
        $kategori->id = null;
        $kategori->kategori = null;
        $data = array(
            'title' => 'Tambah kategori',
            'page' => 'add',
            'row' => $kategori
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('kategori/tambah', $data);
        $this->load->view('templates/footer');
    }

    // prosess
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['add'])) {
            $this->Kategori_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->Kategori_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        }

        redirect('kategori');
    }

    // hapus kategori
    public function hapuskategori($id = null)
    {
        // $this->load->model('Kategori_m');
        $this->Kategori_m->hapuskategori($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data dihapus!</div>');
        redirect('kategori');
    }


    // edit kategori
    public function editkategori($id)
    {
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $query = $this->Kategori_m->get($id);

        if ($query->num_rows() > 0) {
            $kategori = $query->row();
            $data = array(
                'title' => 'Edit kategori',
                'page' => 'edit',
                'row' => $kategori
            );
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $dataa);
            $this->load->view('templates/sidebar', $dataa);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('kategori/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
            redirect('kategori');
        }
    }
}
