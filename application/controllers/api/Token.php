<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Token extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        
		$this->load->model('m_api/M_auth');
    }
   
    public function index_post($id)
    {
        #Set response API if Success
        $response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success post data', 'data_token' => null);

        #Set response API if Not Found
        $response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'error', 'data_token' => null);
        $token = $this->post('token');
        
        // $get_id = $this->db->query("SELECT * From user_pjm where id = '$id' ")->result_array();
        
           $query = $this->db->update('user_pjm', ['token' => $token], ['id' => $id]);
           

        if ($query) {
            $this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
        } else {
            $this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
        }
    }
    	public function index_get()
	{
	    $id = $this->get('id');
		#Set response API if Success
		$response['SUCCESS'] = array('status' => TRUE, 'message' => 'Success get data', 'data_token' => null);

		#Set response API if Not Found
		$response['NOT_FOUND'] = array('status' => FALSE, 'message' => 'No user were found', 'data_token' => null);


		
        $query = $this->M_auth->get_data($id);
        

		if ($query) {
			$response['SUCCESS']['data_token'] = $query;
			$this->response($response['SUCCESS'], REST_Controller::HTTP_OK);
		} else {
			$this->response($response['NOT_FOUND'], REST_Controller::HTTP_OK);
		}
	}
}
