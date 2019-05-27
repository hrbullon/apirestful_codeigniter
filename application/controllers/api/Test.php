<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require APPPATH . 'third_party/firebase/php-jwt/src/JWT.php';

use Firebase\JWT\JWT;

class Test extends REST_Controller {
 
    public function articles_get()
    {
			$this->response([
				'status' => TRUE,
				'message' => 'respond with information about a user'
			], REST_Controller::HTTP_OK);
    }
 
    public function articles_put()
    {
			$this->response([
				'status' => TRUE,
				'message' => 'create a new user and respond with a status/errors'
			], REST_Controller::HTTP_OK);
	}
 
    public function articles_post()
    {
			$this->response([
				'status' => TRUE,
				'message' => 'update an existing user and respond with a status/errors'
			], REST_Controller::HTTP_OK);
    }
 
    public function articles_delete()
    {
			$this->response([
				'status' => TRUE,
				'message' => 'delete a user and respond with a status/errors'
			], REST_Controller::HTTP_OK);
		}
		
		public function load_library_get()
		{
				
			$key = "example_key";
			$token = array(
					"iss" => "http://example.org",
					"aud" => "http://example.com",
					"iat" => 1356999524,
					"nbf" => 1357000000,
					"user" => "Haderson Bullon"
			);

			/**
			 * IMPORTANT:
			 * You must specify supported algorithms for your application. See
			 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
			 * for a list of spec-compliant algorithms.
			 */
			$jwt = JWT::encode($token, $key);
			$decoded = JWT::decode($jwt, $key, array('HS256'));
			echo var_dump($decoded);			
		}
}
