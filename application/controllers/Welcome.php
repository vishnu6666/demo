<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('include/home');
		$this->load->view('include/footer');
	}

}
