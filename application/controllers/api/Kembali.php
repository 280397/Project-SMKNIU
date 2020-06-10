<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Kembali extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_api/M_kembali');
    }

    public function index_get()
    {
        $barcode = $this->get('barcode');
        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data_kembali' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data_kembali' => null);

        $query = $this->M_kembali->get_data($barcode);
        // $queryy = $this->M_kembali->get_dataa($barcode);

        // $sekarang   = date('Y-m-d');
        // $tanggal   = $query['tgl_pinjam'];
        // $date1      = new DateTime($sekarang);
        // $date2      = new DateTime($tanggal);
        // $interval   = $date1->diff($date2);
        // $usia       = $interval->d;
        // $hasil = 0;
        // foreach ($queryy as $data) {
        //     // echo $data['nama_barang'] .
        //     $kali = $data['denda'] * $usia;
        //     $jumlah = $hasil += $kali;
        // }
        // echo $jumlah;

        // echo $usia;
        if ($query) {
            $response['SUCCESS']['data_kembali'] = $query;
            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }

    public function index_post()
    {
        $barcode = $this->post('barcode');
        $kode = $this->post('kode');
        $id_user_pjm = $this->post('id_user_pjm');
        $denda = $this->post('denda');

        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success post data', 'data_post_pinjam' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'error', 'data_post_pinjam' => null);
        $get_temp = $this->M_kembali->post_data($barcode, $kode, $id_user_pjm, $denda);
        $cek_antian = $this->db->query("SELECT * FROM pengembalian_temp WHERE barcode = '$barcode' AND kode ='$kode'")->row_array();
        $cek_denda = $this->db->query("SELECT * FROM peminjaman WHERE barcode = '$barcode' AND tgl_kembali = '0000-00-00 00:00:00'")->row_array();

        $sekarang   = date('Y-m-d');
        $tanggal    = $cek_denda['tgl_aju_kembali'];
        // $date1      = new DateTime($sekarang);
        // $date2      = new DateTime($tanggal);
        // $interval   = $date1->diff($date2);

        // $hari      = $interval->d;
            
        $tanggal_kembali = date("Y-m-d",strtotime($cek_denda['tgl_aju_kembali']));
        $sekarang = date("Y-m-d",strtotime($sekarang));
        $hasil = abs(strtotime($sekarang) - strtotime($tanggal_kembali));
        $tahun = floor($hasil / (365*60*60*24));
        $bulan = floor(($hasil - $tahun * 365*60*60*24) / (30*60*60*24));
        $hari = floor(($hasil - $tahun * 365*60*60*24 - $bulan*30*60*60*24)/ (60*60*24));
            
        // var_dump($hari); die;
        if ($hari > 0) {
            foreach ($get_temp as $temp) {

                $data = [
                    'kode'              => $get_temp['kode'],
                    'barcode'           => $get_temp['barcode'],
                    'id_user_pjm'       => $get_temp['id_user_pjm'],
                    'denda'             => '2000' * $hari
                ];
            }
           
        } else {
            foreach ($get_temp as $temp) {

                $data = [
                    'kode'              => $get_temp['kode'],
                    'barcode'           => $get_temp['barcode'],
                    'id_user_pjm'       => $get_temp['id_user_pjm'],
                    'denda'             => '0'
                ];
            }
            
        }
        if (!$cek_antian) {
                $query = $this->db->insert('pengembalian_temp', $data);
            } else {
                echo "Gagal";
            }
        if ($query) {
            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }

    public function ambil_get()
    {
        $id = $this->get('id_user_pjm');
        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data_aju_kembali' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data_aju_kembali' => null);

        $query = $this->M_kembali->ambil_data($id);

        if ($query) {
            $response['SUCCESS']['data_aju_kembali'] = $query;

            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }
    public function ambild_get()
    {
        $id = $this->get('id_user_pjm');
        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data_denda' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data_denda' => null);

        $query = $this->M_kembali->ambil_denda($id);

        if ($query) {
            $response['SUCCESS']['data_denda'] = $query;

            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }

    public function index_delete($id)
    {

        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success delete data', 'data_kembali' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data_kembali' => null);

        $query = $this->M_kembali->hapus($id);

        if ($query) {
            $response['SUCCESS']['data_kembali'] = $query;
            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }
}
