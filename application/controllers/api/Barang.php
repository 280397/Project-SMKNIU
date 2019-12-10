<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Barang extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_api/M_auth');
	}


	public function index_get()
	{

		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data' => null);

		$query = $this->M_auth->get_alldata();

		if ($query) {
			$response['SUCCESS']['data'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}

	public function get_list()
	{

		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'fail get data', 'data' => null);

		$query = $this->M_auth->get_alldata();

		if ($query) {
			$response['SUCCESS']['data'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}
}
