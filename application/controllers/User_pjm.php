<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_pjm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_pjm_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data 


        $data = array(
            'row' => $this->db->get('user_pjm')->result_array(),
            'title' => 'Tambah user',
            'page' => 'add'
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('peminjaman/kelola_peminjam', $data);
        $this->load->view('templates/footer');
    }


    // public function indexkondisi()
    // {
    //     // ambil data user pada session
    //     $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    //     $data['row'] = $this->Kondisi_m->getbarang($this->uri->segment(3));
    //     $data['title'] = 'Barang';


    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/topbar', $dataa);
    //     $this->load->view('templates/sidebar', $dataa);
    //     $this->load->view('templates/breadcumb', $dataa);
    //     $this->load->view('kondisi/index_kondisi', $data);
    //     $this->load->view('templates/footer');
    // }

    public function add()
    {
        // ambil data user pada session

        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $user = new stdClass();
        $user->id = null;
        $user->name = null;
        $user->nis = null;
        $user->kelas = null;
        $user->username = null;
        $user->password = null;
        $data = array(
            'title' => 'Tambah user',
            'page' => 'add',
            'row' => $user
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('peminjaman/edit', $data);
        $this->load->view('templates/footer');
    }

    // prosess
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['add'])) {
            $this->User_pjm_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->User_pjm_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        }

        redirect('User_pjm');
    }

    // hapus kondisi
    public function hapususer($id = null)
    {
        // $this->load->model('Kondisi_m');
        $this->User_pjm_m->hapususer($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data dihapus!</div>');
        redirect('user');
    }


    // editn user
    public function edituser($id)
    {
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $query = $this->User_pjm_m->get($id);

        if ($query->num_rows() > 0) {
            $user = $query->row();
            $data = array(
                'title' => 'Edit user',
                'page' => 'edit',
                'row' => $user
            );
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $dataa);
            $this->load->view('templates/sidebar', $dataa);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('peminjaman/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
            redirect('user');
        }
    }
}
