<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require APPPATH . 'third_party/firebase/php-jwt/src/JWT.php';

use Restserver\Libraries\REST_Controller;
use Firebase\JWT\JWT;

class Auth extends REST_Controller {

	public function login_post()
	{
		$username = $this->security->xss_clean($this->post('username'));
		$password = $this->security->xss_clean($this->post('password'));

		$this->db->where('username', $username);
		$row = $this->db->get("auth_users")->row();

		if($row)
		{
			if(password_verify($password.SALT_HASH,$row->password))
            {
				$token = array(
					"iss" => "http://apirestful_codeigniter/",
					"aud" => "http://apirestful_codeigniter/api",
					"iat" => time(),
					"user" => $row
				);
		
				$jwt = JWT::encode($token, JWT_KEY);
				
				$this->response([
					'status' => TRUE,
					'message' => 'Logged Succesful',
					'token' => $jwt
                ], REST_Controller::HTTP_OK);

			}else{
				$this->response([
                    'status' => FALSE,
					'error' => 'Contraseña incorrecta',
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			$this->response([
				'status' => FALSE,
				'error' => 'Usuario no registrado',
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function logout()
	{

	}

	public function password_recovery()
	{

	}

}

/* End of file Auth.php */
