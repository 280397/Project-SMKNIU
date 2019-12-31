<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Barang_m', 'Lokasi_m', 'Kondisi_m', 'Kategori_m']);
        $this->load->library('excel');
        $this->load->helper(array('url', 'html', 'form'));
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
        $barang->status = null;

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

    // file upload functionality
    public function upload()
    {
        $data = array();
        $data['title'] = 'Import Excel Sheet | TechArise';
        $data['breadcrumbs'] = array('Home' => '#');
        // Load form validation library
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
        if ($this->form_validation->run() == false) {

            redirect('Barang');
        } else {
            // If file uploaded
            if (!empty($_FILES['fileURL']['name'])) {
                // get file extension
                $extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);

                if ($extension == 'csv') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif ($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                // array Count
                $arrayCount = count($allDataInSheet);
                $flag = 0;
                $createArray = array(
                    'Barcode',
                    'Nama',
                    'Merek',
                    'Model',
                    'Kondisi',
                    'Lokasi',
                    'Detail',
                    'Tgl',
                    'Sumber',
                    'Status'
                );
                $makeArray = array(
                    'Barcode' => 'Barcode',
                    'Nama' => 'Nama',
                    'Merek' => 'Merek',
                    'model' => 'model',
                    'Kondisi' => 'Kondisi',
                    'Lokasi' => 'Lokasi',
                    'Detail' => 'Detail',
                    'Tgl' => 'Tgl',
                    'Sumber' => 'Sumber',
                    'Status' => 'Status'
                );
                $SheetDataKey = array();
                foreach ($allDataInSheet as $dataInSheet) {
                    foreach ($dataInSheet as $key => $value) {
                        if (in_array(trim($value), $createArray)) {
                            $value = preg_replace('/\s+/', '', $value);
                            $SheetDataKey[trim($value)] = $key;
                        }
                    }
                }
                $dataDiff = array_diff_key($makeArray, $SheetDataKey);
                if (empty($dataDiff)) {
                    $flag = 1;
                }
                // match excel sheet column
                if ($flag == 1) {
                    for ($i = 2; $i <= $arrayCount; $i++) {
                        $addresses = array();
                        $barcode = $SheetDataKey['Barcode'];
                        $nama = $SheetDataKey['Nama'];
                        $merek = $SheetDataKey['Merek'];
                        $model = $SheetDataKey['Model'];
                        $kondisi = $SheetDataKey['Kondisi'];
                        $lokasi = $SheetDataKey['Lokasi'];
                        $detail = $SheetDataKey['Detail'];
                        $tgl = $SheetDataKey['Tgl'];
                        $sumber = $SheetDataKey['Sumber'];
                        $status = $SheetDataKey['Status'];

                        $barcode = filter_var(trim($allDataInSheet[$i][$barcode]), FILTER_SANITIZE_STRING);
                        $nama = filter_var(trim($allDataInSheet[$i][$nama]), FILTER_SANITIZE_STRING);
                        $merek = filter_var(trim($allDataInSheet[$i][$merek]), FILTER_SANITIZE_EMAIL);
                        $model = filter_var(trim($allDataInSheet[$i][$model]), FILTER_SANITIZE_STRING);
                        $kondisi = filter_var(trim($allDataInSheet[$i][$kondisi]), FILTER_SANITIZE_STRING);
                        $lokasi = filter_var(trim($allDataInSheet[$i][$lokasi]), FILTER_SANITIZE_STRING);
                        $detail = filter_var(trim($allDataInSheet[$i][$detail]), FILTER_SANITIZE_STRING);
                        $tgl = filter_var(trim($allDataInSheet[$i][$tgl]), FILTER_SANITIZE_STRING);
                        $sumber = filter_var(trim($allDataInSheet[$i][$sumber]), FILTER_SANITIZE_STRING);
                        $status = filter_var(trim($allDataInSheet[$i][$status]), FILTER_SANITIZE_STRING);
                        $fetchData[] = array(
                            'barcode'       => $barcode,
                            'nama_barang'   => $nama,
                            'merk'          => $merek,
                            'model'         => $model,
                            'kondisi'       => $kondisi,
                            'lokasi'        => $lokasi,
                            'detail'        => $detail,
                            'tgl_masuk'     => PHPExcel_Style_NumberFormat::toFormattedString($tgl, 'YYYY-MM-DD'),
                            'sumber'        => $sumber,
                            'status'        => $status,
                            'created' => date('Y-m-d H:i:s')
                        );
                    }
                    $data['dataInfo'] = $fetchData;
                    $this->site->setBatchImport($fetchData);
                    $this->site->importData();
                } else {
                    echo "Please import correct file, did not match excel sheet column";
                }
                // $this->load->view('Barang', $data);
                redirect('Barang');
            }
        }
    }

    // checkFileValidation
    public function checkFileValidation($string)
    {
        $file_mimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if (isset($_FILES['fileURL']['name'])) {
            $arr_file = explode('.', $_FILES['fileURL']['name']);
            $extension = end($arr_file);
            if (($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)) {
                return true;
            } else {
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }



    public function saveimport()
    {
        if (!isset($_FILES["file"]["name"])) {

            //upload gagal
            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> ' . $this->upload->display_errors() . '</div>');
            //redirect halaman
            redirect('Barang');
        } else {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            // $fileName = 'data-' . time() . '.xlsx';
            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                // $cellIterator = $worksheet->getActiveCell();
                // $cellIterator->setIterateOnlyExistingCells(FALSE);
                for ($row = 2; $row <= $highestRow; $row++) {
                    $barcode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $merk = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $model = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $kondisi = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $lokasi = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $detail = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $tgl = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $sumber = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $status = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $data[] = array(
                        'barcode'       => $barcode,
                        'nama_barang'   => $name,
                        'merk'          => $merk,
                        'model'         => $model,
                        'kondisi'       => $kondisi,
                        'lokasi'        => $lokasi,
                        'detail'        => $detail,
                        'tgl_masuk'     => PHPExcel_Style_NumberFormat::toFormattedString($tgl, 'YYYY-MM-DD'),
                        'sumber'        => $sumber,
                        'status'        => $status
                    );
                }
            }
            $this->Barang_m->insertimport($data);
            $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            redirect('Barang');
        }
    }
}
