<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_pjm_m', 'User_kategori_m']);
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
            'kategori' => $this->db->get('user_pjm_kategori')->result_array(),
            'title' => 'Tambah kategori',
            'page' => 'add',
            'row' => $kategori
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('peminjaman/user_kategori', $data);
        $this->load->view('templates/footer');
    }
    public function indexkategori()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['row'] = $this->Kategori_m->getpeminjam($this->uri->segment(3));
        $data['title'] = 'Peminjam';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $dataa);
        $this->load->view('peminjam/index_kategori', $data);
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
        $this->load->view('peminjaman/tambahkategori', $data);
        $this->load->view('templates/footer');
    }

    // prosess
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['add'])) {
            $this->User_kategori_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->User_kategori_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        }

        redirect('user_kategori');
    }

    // hapus kategori
    public function hapuskategori($id = null)
    {
        // $this->load->model('User_kategori_m');
        $this->User_kategori_m->hapuskategori($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data dihapus!</div>');
        redirect('user_kategori');
    }


    // edit kategori
    public function editkategori($id)
    {
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $query = $this->User_kategori_m->get($id);

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
            $this->load->view('peminjaman/tambahkategori', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
            redirect('user_kategori');
        }
    }
}
