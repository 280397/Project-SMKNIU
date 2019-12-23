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

        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success post data', 'data_post_pinjam' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'error', 'data_post_pinjam' => null);
        $get_temp = $this->M_kembali->post_data($barcode, $kode, $id_user_pjm);
        $cek_antian = $this->db->query("SELECT * FROM pengembalian_temp WHERE barcode = '$barcode' AND kode ='$kode'")->row_array();

        // foreach ($get_temp as $temp) {
        $data = [
            'kode'              => $get_temp['kode'],
            'barcode'           => $get_temp['barcode'],
            'id_user_pjm'       => $get_temp['id_user_pjm']
        ];
        // $query = $this->db->insert('pengembalian_temp', $data);
        // }

        if (!$cek_antian) {
            $query = $this->db->insert('pengembalian_temp', $data);
        } else {
            echo "heng keneng";
        }

        // $this->session->unset_userdata('kode');
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
