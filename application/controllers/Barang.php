<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
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
        $data['title'] = 'Kelola barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data menu
        $data['row'] = $this->Barang_m->get();
        $data['count'] = $this->Barang_m->get_count();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('barang/index', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        // ambil data user pada session

        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $barang = new stdClass();
        $barang->id = null;
        $barang->barcode = null;
        $barang->nama_barang = null;
        $barang->merk = null;
        $barang->model = null;
        $barang->dtl_lokasi = null;
        $barang->id_kondisi = null;
        $barang->id_lokasi = null;
        $barang->sumber = null;
        $barang->tgl_masuk = null;

        $kategori = $this->Kategori_m->get();
        $lokasi = $this->Lokasi_m->get();
        $kondisi = $this->Kondisi_m->get();
        $data = array(
            'title' => 'Tambah barang',
            'page' => 'add',
            'row' => $barang,
            'kategori' => $kategori,
            'lokasi' => $lokasi,
            'kondisi' => $kondisi
        );

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $dataa);
        $this->load->view('templates/sidebar', $dataa);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('barang/tambah', $data);
        $this->load->view('templates/footer');
    }

    // prosess
    public function process()
    {
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '2048';
        $config['upload_path']   = './assets/img/barang/';
        $config['file_name']   = 'inventory-smkniu-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, true);
        if (isset($_POST['add'])) {
            if ($this->Barang_m->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai barang lain");
                redirect('barang/add');
            } else {

                if (@$_FILES['gambar']['name'] != null) {
                    if ($this->upload->do_upload('gambar')) {
                        $post['gambar'] = $this->upload->data('file_name');
                        $this->Barang_m->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                        }
                        redirect('barang');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('barang/add');
                    }
                } else {
                    $post['gambar'] = null;
                    $this->Barang_m->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('barang');
                }
            }

            // edit proses
        } else if (isset($_POST['edit'])) {
            if ($this->Barang_m->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai barang lain");
                redirect('barang/editbarang/' . $post['id']);
            } else {
                if (@$_FILES['gambar']['name'] != null) {
                    if ($this->upload->do_upload('gambar')) {

                        //replace image
                        $barang = $this->Barang_m->getId($post['id'])->row();

                        if ($barang->gambar != null) {
                            $target_file = './assets/img/barang/' . $barang->gambar;
                            unlink($target_file);
                        }
                        $post['gambar'] = $this->upload->data('file_name');
                        $this->Barang_m->edit($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                        }
                        redirect('barang');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('barang/editbarang/' . $post['id']);
                    }
                } else {
                    $post['gambar'] = null;
                    $this->Barang_m->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('barang');
                }
            }
        }
    }

    // hapus barang
    public function hapusbarang($id = null)
    {
        //replace image
        $barang = $this->Barang_m->getId($id)->row();
        if ($barang->gambar != null) {
            $target_file = './assets/img/barang/' . $barang->gambar;
            $target_file_qrcode = './assets/img/qr-code/' . $barang->barcode . '-qrcode.png';
            unlink($target_file, $target_file_qrcode);
            // unlink($target_file_qrcode);
        }

        if ($barang->barcode != null) {
            $target_file_qrcode = './assets/img/qr-code/' . $barang->barcode . '-qrcode.png';
            unlink($target_file_qrcode);
        }

        $this->Barang_m->hapusbarang($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data dihapus!</div>');
        redirect('barang');
    }


    // edit barang
    public function editbarang($id)
    {
        $dataa['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $query = $this->Barang_m->getId($id);

        if ($query->num_rows() > 0) {
            $barang = $query->row();
            $kategori = $this->Kategori_m->get();
            $lokasi = $this->Lokasi_m->get();
            $kondisi = $this->Kondisi_m->get();
            $data = array(
                'title' => 'Edit barang',
                'page' => 'edit',
                'row' => $barang,
                'kategori' => $kategori,
                'lokasi' => $lokasi,
                'kondisi' => $kondisi
            );

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $dataa);
            $this->load->view('templates/sidebar', $dataa);
            $this->load->view('templates/breadcumb', $data);
            $this->load->view('barang/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan!</div>');
            redirect('barang');
        }
    }

    function detail($id)
    {
        $param = $this->uri->segment(3);
        $lihat = $this->db->query("SELECT barang.*,barang_kondisi.kondisi as k,barang_lokasi.lokasi as l,barang_kategori.kategori as nk FROM barang LEFT JOIN barang_kategori ON barang_kategori.id=barang.nama_barang LEFT JOIN barang_kondisi ON barang_kondisi.id=barang.id_kondisi LEFT JOIN barang_lokasi ON barang_lokasi.id=barang.id_lokasi WHERE barang.id = '" . $param . "'")->row_array();

        $data = array(
            'title' => 'Kelola Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'barang' => $this->Barang_m->detail($id),
            'row' => $lihat
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('barang/detail', $data);
        $this->load->view('templates/footer');
    }

    function barcode_qrcode($id)
    {
        $data['titl'] = 'Generator';
        $data['title'] = 'Barcode Generator';
        $data['title1'] = 'QR-Code Generator';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // query data menu
        $dataa['row'] = $this->Barang_m->getId($id)->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/breadcumb', $data);
        $this->load->view('barang/barcode_qrcode', $dataa);
        $this->load->view('templates/footer');
    }

    function barcode_print($id)
    {
        $data['row'] = $this->Barang_m->getId($id)->row();
        $html  = $this->load->view('barang/barcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'barcode-' . $data['row']->barcode, 'A4', 'landscape');
    }
    function qrcode_print($id)
    {
        $data['row'] = $this->Barang_m->getId($id)->row();
        $html  = $this->load->view('barang/qrcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'qrcode-' . $data['row']->barcode, 'A4', 'potrait');
    }
    function printAll()
    {
        $data = array(
            'kategori' => $this->db->get('barang_kategori')->result_array(),
            'kondisi' => $this->db->get('barang_kondisi')->result_array(),
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'row' =>  $this->Barang_m->get(),
            'count' => $this->Barang_m->get_count()
        );

        // $data['row'] = $this->Barang_m->get();
        $html  = $this->load->view('barang/printall_n', $data, true);
        $this->fungsi->PdfGenerator($html, 'Print All', 'A4', 'potrait');
    }
}
