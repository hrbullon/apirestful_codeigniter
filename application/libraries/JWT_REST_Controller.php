<?php

namespace JWTRestserver\Libraries;

require APPPATH . 'libraries/REST_Controller.php';

defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
use Firebase\JWT\JWT; 

class JWT_REST_Controller extends REST_Controller {

	public function __construct()
	{
		parent::__construct();

		//Check JWT JSON Web Token
        $headers = $this->input->get_request_header('Authorization', TRUE); //get token from request header
		
		if($headers)
		{
			//Remove Bearer String 
			$headers = str_replace('Bearer ','', $headers);

			try {
				
				$decoded = JWT::decode($headers, JWT_KEY, array('HS256'));
				
			}   catch (Exception $e) {

				$this->response = new stdClass();
				$this->response->format = $this->_detect_output_format();

				$this->response([
					'status' => FALSE,
					'error' => 'Token inválido',
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			$this->response([
				'status' => FALSE,
				'error' => 'Token es requerido',
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}

/* End of file JWT_REST_Controller.php */
