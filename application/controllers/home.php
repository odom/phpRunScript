<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	function index () {
		$data['message'] = $this->session->flashdata('message');
		$data['template'] = __CLASS__.'/'.__FUNCTION__;
		$this->load->view('Template/main', $data);
	}

	function verify($check=null) {
		$data['output'] = $check[0];
		$data['phone'] = $check[1];
		$data['template'] = __CLASS__.'/'.__FUNCTION__;
		$this->load->view('Template/main', $data);
	}

	function checkVerify() {
		if ($this->input->post()) {
			$verifyNumber = $this->input->post('verifyNumber');
			$path ='upload/register/'.$this->input->post('phone');
			$output = shell_exec("./application/controllers/whatsapp/yowsup-cli  --register $verifyNumber --config $path");
			$saveTo = 'upload/users/'.$this->input->post('phone');
			$myfile = fopen($saveTo, "w") or die("Unable to open file!");
			fwrite($myfile, $output);
			fclose($myfile);
			$this->success($saveTo);
		}
	}

	function register() {
		if ($this->input->post()) {
			$phoneNumber = $this->input->post('phone');
			if ($this->checkNumber($phoneNumber) || true) {
				$this->createConfigFileByPhoneNumber($phoneNumber);
				$path = BASEPATH.'../upload/register/'.$phoneNumber;

				$output = shell_exec("./application/controllers/whatsapp/yowsup-cli --requestcode sms --config $path");
				$result = explode("\n", $output);
				$status = explode(":", $result[0])[1];
				if (trim($status) == 'fail') {
					$this->session->set_flashdata("message", array('code' => 0, 'message' => $result));
					redirect('/');
				} else if (trim($status) == 'ok') {
					$saveTo = 'upload/users/'.$phoneNumber;
					$myfile = fopen($saveTo, "w") or die("Unable to open file!");
					fwrite($myfile, $output);
					fclose($myfile);
					$this->success($saveTo);
				}
			} else {
				// Error Incorrect phone number
			}
		} else {
			redirect('/');
		}
		$this->verify(array($output, $phoneNumber));
	}

	private function success($file=false) {
		if (!$file){
			redirect('/');
		}
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		readfile($file);
		exit();
	}

	private function createConfigFileByPhoneNumber($phoneNumber) {
		$filePath = 'upload/register/'.$phoneNumber;
		$myfile = fopen($filePath, "w") or die("Unable to open file!");
		$txt = "cc=855\n";
		fwrite($myfile, $txt);
		$txt = "phone=$phoneNumber\n";
		$txt .= "id=\n";
		$txt .= "password=";
		fwrite($myfile, $txt);
		fclose($myfile);
	}

	private function checkNumber($phoneNumber) {
		return $phoneNumber;
	}
}