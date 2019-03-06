<?php
class Services extends CI_Controller{
	public function __construct(){
		parent::__construct();
		require_once APPPATH . 'libraries/nusoap/nusoap.php';
		
		$this->nusoap_server = new soap_server();
		$this->nusoap_server->configureWSDL('My Services', 'urn:mywebservice');
		
		$this->nusoap_server->register('getMyName',
				array('firstname' => 'xsd:string', 'lastname' => 'xsd:string'),
				array('return' => 'xsd:string'),
				'urn:mywebservice',
				'urn:mywebservice#getMyName',
				'rpc',
				'encoded',
				'Get My Name'
				);
	}
	
	public function index(){
		function getMyName($firstname, $lastname){
			$res = array('firstname' => $firstname, 'lastname' => $lastname);
			$xml = new SimpleXMLElement('<root/>');
array_walk_recursive($res, array ($xml, 'addChild'));
return $xml->asXML();exit;
			return json_encode($res);
		}
		$this->nusoap_server->service(file_get_contents("php://input"));
		
	}
}