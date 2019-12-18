<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Pinjam extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_api/M_pinjam');
	}

	public function index_get()
	{
		$barcode = $this->get('barcode');
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data' => null);

		$query = $this->M_pinjam->get_data($barcode);

		if ($query) {
			$response['SUCCESS']['data'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}

	public function index_post()
	{
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success post data', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'error', 'data' => null);

		$id_user_pjm = $this->post('id_user_pjm');
		// $kodesesi = 'INV-' . date('YmdHis');

		$session = $this->M_pinjam->ambilSession($id_user_pjm);
		$cek_sesi = $this->M_pinjam->cekSession($id_user_pjm);

		if ($cek_sesi->sesi > 0) {
			$kodesesi = $session->kode;
		} else {
			$kodesesi = 'INV-' . date('YmdHis');
		}


		$data = [
			'kode' 		 	=> $kodesesi,
			'id_user_pjm' 	=> $id_user_pjm,
			'barcode' 		=> $this->post('barcode')

		];


		$query = $this->db->insert('peminjaman_temp', $data);

		// if (!$cek) {

		// 	$this->db->insert('peminjaman', $data);
		// } else {
		// 	$this->db->insert('peminjaman', $data);
		// }

		// echo $cek_sesi;
		// echo $kodesesi;
		//  $this->M_pinjam->ambilSession($data['id_user_pjm'])->kode;
		//  $queryA = $this->db->insert($query,$queryy);

		if ($query) {

			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}

	public function pinjam_delete($kode)
	{

		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success put data', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'error', 'data' => null);
		$session = $this->db->query("SELECT kode From peminjaman where kode = '$kode' limit 1")->row_array();

		$kode = $session['kode'];
		$tgl_pinjam = date('Y-m-d H:i:s');
		$tgl_kembali = $this->put('tgl_kembali');
		$id_user = 21;
		// $id_user = $this->put('id_user');
		$keperluan = $this->put('keperluan');
		$status = 'pinjam';


		$query = $this->M_pinjam->put($kode, $tgl_pinjam, $tgl_kembali, $id_user, $keperluan, $status);

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
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data_add' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data_add' => null);

		$query = $this->M_pinjam->ambil_data($id);

		if ($query) {
			$response['SUCCESS']['data_add'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}
	public function index_delete($id)
	{

		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success delete data', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data' => null);

		$query = $this->M_pinjam->hapus($id);

		if ($query) {
			$response['SUCCESS']['data'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}

	public function list_get()
	{
		$id = $this->get('id_user_pjm');
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data_list' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data_list' => null);

		$query = $this->M_pinjam->list_data($id);

		if ($query) {
			$response['SUCCESS']['data_list'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}
}

/* End of file Pinjam.php */
/* Location: ./application/controllers/api/Auth.php */
