<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->view('welcome_message');
		require_once APPPATH . 'libraries\nusoap\nusoap.php';
		$client = new nusoap_client('http://localhost/ci-rest/index.php/services?wsdl');
		$error = $client->getError();
		if($error){
			echo $error;
		}
		$res = $client->call('getMyName', array('firstname' => "Jaydeep", 'lastname' => "Maniyar"));

		if($client->fault){
			echo $client->fault;
		}else{
			print_r($res);exit;
			$data = json_encode($res);
			var_dump($data);
		}
	}
}
