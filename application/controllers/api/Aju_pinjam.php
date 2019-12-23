<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Aju_pinjam extends REST_Controller
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
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success put data', 'data' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'error', 'data' => null);
        $get_temp = $this->db->query("SELECT * From peminjaman_temp where id_user_pjm = '$id_user_pjm' ")->result_array();
        foreach ($get_temp as $temp) {
            $data = [
                'kode'             => $temp['kode'],
                'barcode'        => $temp['barcode'],
                'id_user_pjm'     => $temp['id_user_pjm'],
                'tgl_pinjam'    => date('Y-m-d H:i:s'),
                // 'tgl_kembali'	=> '0000-00-00 00:00:00',
                'tgl_aju_kembali'    => $this->input->post('tgl_aju_kembali'),
                'id_admin'        => $this->input->post('id_admin'),
                'keperluan'        =>    $this->input->post('keperluan'),
                // 'keperluan'		=>	'ksahdjsadjjsa',
                'status'        => 'pinjam'
            ];
            $this->db->update('barang', ['status' => 'pinjam'], ['barcode' => $temp['barcode']]);
            $query = $this->db->insert('peminjaman', $data);
        }

        $this->db->delete('peminjaman_temp', ['id_user_pjm' => $id_user_pjm]);

        // $this->session->unset_userdata('kode');
        if ($query) {
            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }
}
