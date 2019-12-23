<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Aju_kembali extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('m_api/M_pinjam');
    }
    public function index_get()
    {
        $id_admin = $this->get('id_admin');
        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data_admin' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data_admin' => null);
        $this->load->model('m_api/M_addAdmin');
        $query = $this->M_addAdmin->get_data($id_admin);

        if ($query) {
            $response['SUCCESS']['data_admin'] = $query;
            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }
    public function index_post($id_user_pjm)
    {

        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success post data', 'data' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'error', 'data' => null);
        $get_temp = $this->db->query("SELECT * From pengembalian_temp where id_user_pjm = '$id_user_pjm' ")->result_array();
        foreach ($get_temp as $temp) {
            $data = [
                // 'barcode'               => $this->input->post('barcode'),
                'tgl_kembali'           => date('Y-m-d H:i:s'),
                'id_admin_kembali'      => $this->input->post('id_admin'),
                'status'                => 'kembali'
            ];
            $this->db->update('barang', ['status' => 'ready'], ['barcode' => $temp['barcode']]);
            $query = $this->db->update('peminjaman', $data, [
                'barcode'   => $temp['barcode'],
                'kode'      => $temp['kode']
            ]);
        }

        $this->db->delete('pengembalian_temp', ['id_user_pjm' => $id_user_pjm]);

        if ($query) {
            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }
}
