<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$this->load->view('include/header');
        $this->load->view('dashboard/dashboard');
        $this->load->view('include/footer');
	}
}
