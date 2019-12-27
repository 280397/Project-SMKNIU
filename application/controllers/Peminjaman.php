<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Peminjaman_m');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        // ambil data user pada session
        $data['title'] = 'Daftar Pinjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data menu
        $data['pinjam'] = $this->Peminjaman_m->get();
        $data['count'] = $this->Peminjaman_m->get_count();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('peminjaman/index', $data);
        $this->load->view('templates/footer');
    }

    public function kembali()
    {
        // ambil data user pada session
        $data['title'] = 'Riwayat Peminjaman';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data menu
        $data['kembali'] = $this->Peminjaman_m->getk();
        $data['countk'] = $this->Peminjaman_m->get_countk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('peminjaman/kembali', $data);
        $this->load->view('templates/footer');
    }

    public function peminjam()
    {
        // ambil data user pada session
        $data['title'] = 'Kelola Peminjam';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data menu
        $data['row'] = $this->User_pjm_m->get();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('peminjaman/kelola_peminjam', $data);
        $this->load->view('templates/footer');
    }
}
