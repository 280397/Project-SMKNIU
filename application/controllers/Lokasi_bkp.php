<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lokasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // ambil data user pada session
        $data['title'] = 'Kelola Lokasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // query data menu
        $data['lokasi'] = $this->db->get('barang_lokasi')->result_array();

        // rules
        // $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('lokasi/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'lokasi' => $this->input->post('lokasi')
            ];
            $this->db->insert('barang_lokasi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Lokasi ditambahkan!</div>');
            redirect('lokasi');
        }
    }

    // hapus lokasi
    public function hapuslokasi($id = null)
    {
        $this->load->model('Lokasi_model');
        $this->Lokasi_model->hapusLokasi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Lokasi dihapus!</div>');
        redirect('lokasi');
    }


    // edit lokasi
    public function editlokasi($id)
    {
        $data['title'] = 'Edit Lokasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lokasi'] = $this->Lokasi_model->getLokasi($id);
        $data['lokasi'] = $this->db->get_where('barang_lokasi', ['id' => $id])->row_array();

        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('lokasi/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // $data = ['lokasi' => $lokasi];
            $this->Lokasi_model->ubahLokasi();
            // $this->Lokasi_model->ubahLokasi();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Lokasi berhasil diedit!</div>');
            redirect('lokasi');
        }
    }
}
