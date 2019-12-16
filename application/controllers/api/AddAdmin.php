<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class AddAdmin extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_api/M_addAdmin');
    }
    
    public function index_get($id_admin)
	{
		// $id_admin = $this->get('id_admin');
		#Set response API if Success
		$response['SUCCESS'] = array('statuss' => TRUE, 'message' => 'Success get data', 'data_addadmin' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('statuss' => FALSE, 'message' => 'fail get data', 'data_addadmin' => null);

		$query = $this->M_addAdmin->get_data($id_admin);

		if ($query) {
			$response['SUCCESS']['data_addadmin'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}
}