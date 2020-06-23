<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagination extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->model('pagination_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		$config=[
		        'base_url' 		=> base_url('Pagination/index'),
		        'per_page' 		=> 3,
		        'total_rows' 	=> $this->pagination_model->num_rows(),
		        'full_tag_open'	=> "<ul class='pagination'>",
		        'first_link' 	=> false,
	        	'last_link' 	=> false,
		        'full_tag_close'=> "</ul>",
		        'next_tag_open' => "<li>",
		        'next_tag_close'=> "</li>",
		        'prev_tag_open' => "<li>",
		        'prev_tag_close'=> "</li>",
		        'num_tag_open' 	=> "<li>",
		        'num_tag_close' => "<li>",
		        'cur_tag_open' 	=> "<li class='active'><a>",
		        'cur_tag_close' => "</a></li>"
			];

	  	$this->pagination->initialize($config);

	  	$data['dataList']=$this->pagination_model->dataList($config['per_page'],$this->uri->segment(3));
		$this->load->view('include/header');
		$this->load->view('pagination/pagination',$data);
		$this->load->view('include/footer');
	}
}
