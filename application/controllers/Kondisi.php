<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kondisi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kondisi_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data 

        $kondisi = new stdClass();
        $kondisi->id = null;
        $kondisi->kondisi = null;
        $data = array(
            'kondisi' => $this->db->get('barang_kondisi')->result_array(),
            'title' => 'Tambah kondisi',
            'page' => 'add',
            'row' => $kondisi
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('kondisi/index', $data);
        $this->load->view('templates/footer');
    }


    public function indexkondisi()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['row'] = $this->Kondisi_m->getbarang($this->uri->segment(3));
        $data['title'] = 'Barang';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $dataa);
        $this->load->view('kondisi/index_kondisi', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        // ambil data user pada session

        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $kondisi = new stdClass();
        $kondisi->id = null;
        $kondisi->kondisi = null;
        $data = array(
            'title' => 'Tambah kondisi',
            'page' => 'add',
            'row' => $kondisi
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('kondisi/tambah', $data);
        $this->load->view('templates/footer');
    }

    // prosess
    public function process()
    {
        $post = $this->input->post(null, true);
        if (isset($_POST['add'])) {
            $this->Kondisi_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->Kondisi_m->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        }

        redirect('kondisi');
    }

    // hapus kondisi
    public function hapuskondisi($id = null)
    {
        // $this->load->model('Kondisi_m');
        $this->Kondisi_m->hapuskondisi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data dihapus!</div>');
        redirect('kondisi');
    }


    // edit kondisi
    public function editkondisi($id)
    {
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $query = $this->Kondisi_m->get($id);

        if ($query->num_rows() > 0) {
            $kondisi = $query->row();
            $data = array(
                'title' => 'Edit kondisi',
                'page' => 'edit',
                'row' => $kondisi
            );
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $dataa);
            $this->load->view('templates/sidebar', $dataa);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('kondisi/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
            redirect('kondisi');
        }
    }
}
