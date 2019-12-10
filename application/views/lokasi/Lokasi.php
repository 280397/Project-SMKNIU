<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Barang_m', 'Lokasi_m', 'Kondisi_m', 'Kategori_m']);
        $this->load->library('form_validation');
    }


    public function index()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // query data menu
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
        $this->load->view('templates/breadcumb', $dataa);
        $this->load->view('lokasi/index', $data);
        $this->load->view('templates/footer');
    }
    public function indexlokasi()
    {
        // ambil data user pada session
        $dataa['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->Lokasi_m->getbarang($this->uri->segment(3));
        $data['title'] = 'Kelola barang';
        // query data menu
        // $barang = new stdClass();

        // $data = array(
        //     // 'barang' => $this->db->get('barang')->result_array(),
        //     // 'title' => 'Tambah lokasi',
        //     'page' => 'add'

        // );

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

        $dataa['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $lokasi = new stdClass();
        $lokasi->id = null;
        $lokasi->lokasi = null;
        $data = array(
            'title' => 'Tambah Lokasi',
            'page' => 'add',
            'row' => $lokasi
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
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

        redirect('lokasi');
    }

    // hapus lokasi
    public function hapuslokasi($id = null)
    {
        // $this->load->model('Lokasi_m');
        $this->Lokasi_m->hapusLokasi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data dihapus!</div>');
        redirect('lokasi');
    }


    // edit lokasi
    public function editlokasi($id)
    {
        $dataa['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->Lokasi_m->get($id);

        if ($query->num_rows() > 0) {
            $lokasi = $query->row();
            $data = array(
                'title' => 'Edit Lokasi',
                'page' => 'edit',
                'row' => $lokasi
            );
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $dataa);
            $this->load->view('templates/sidebar', $dataa);
            $this->load->view('templates/breadcumb', $dataa);
            $this->load->view('lokasi/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
            redirect('lokasi');
        }
    }

    function barcode_qrcode($id)
    {
        $data['titl'] = 'Generator';
        $data['title'] = 'Barcode Generator';
        $data['title1'] = 'QR-Code Generator';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // query data menu
        $dataa['row'] = $this->Lokasi_m->get($id)->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('lokasi/barcode_qrcode', $dataa);
        $this->load->view('templates/footer');
    }

    function barcode_print($id)
    {
        $data['row'] = $this->Lokasi_m->get($id)->row();
        $html  = $this->load->view('lokasi/barcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'barcode-' . $data['row']->barcode, 'A4', 'landscape');
    }
    function qrcode_print($id)
    {
        $data['row'] = $this->Lokasi_m->get($id)->row();
        $html  = $this->load->view('lokasi/qrcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'qrcode-' . $data['row']->barcode, 'A4', 'potrait');
    }
}
