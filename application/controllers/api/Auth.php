<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_api/M_auth');
	}

	public function index_post()
	{
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success loggin', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'No user were found', 'data' => null);


		$user = $this->post('username');
		$pass = $this->input->post('password');
		
		$query = $this->M_auth->check_login('user_pjm', $user, $pass);
		//$query =  $this->M_auth->insert_token($user,$token);

		if ($query) {
			$response['SUCCESS']['data'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}
	 
	public function index_get()
	{
	    $id = $this->get('id');
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success loggin', 'data' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'No user were found', 'data' => null);


		
        $query = $this->M_auth->get_data($id);
        

		if ($query) {
			$response['SUCCESS']['data'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/api/Auth.php */
