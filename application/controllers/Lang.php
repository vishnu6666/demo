<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
    }

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('lang/index');
		$this->load->view('include/footer');
	}

}
