<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	function index () {
		$data['action'] = 'index';
		$data['template'] = __CLASS__.'/'.__FUNCTION__;
		$this->load->view('Template/main', $data);
	}

}
