<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public $menu;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

	public function index()
	{
		$s1=$this->uri->segment(3);
        $s2=$this->uri->segment(4);
        $s3=$this->uri->segment(5);
        $s4=$this->uri->segment(6);

        if($s1 > 0){	
		$this->load->view('include/header');
		$this->load->view('category/create-category',$s1);
		$this->load->view('include/footer');
		}else{		
		$this->load->view('include/header');
		$this->load->view('category/create-category');
		$this->load->view('include/footer');	
		}
	}

	public function manage_category()
	{
		$s1=$this->uri->segment(3);
        $s2=$this->uri->segment(4);
        $s3=$this->uri->segment(5);
        $s4=$this->uri->segment(6);

		$category_list = $this->category_model->category_list($s1, $s2, $s3, $s4);  

		$tolevel=$this->category_model->getTotalLevel($s1);
		$tolevel;
	
		$i=0;
		$total=0;
		if(!empty($category_list)){	
			foreach($category_list as $k=>$v){
				$i++;
			   	$category_list[$k]['sl']=$i;
			   
			}
		}         
		if($tolevel >= 3){
			 $data = array(
				'title' 		=> 'category list',
				'category_list' => $category_list,
				'level' 		=> '1'
				
			);
		}else{	
		    $data = array(
				'title' 		=> 'category list',
				'category_list' => $category_list,
                'level' 		=> '0'				
			);
		}	

		//echo "<pre>";print_r($data);exit;
		$this->load->view('include/header');
		$this->load->view('category/category',$data);
		$this->load->view('include/footer');
	}

	public function category_submenu($s1=0, $s2=0, $s3=0, $s4=0)
	{
		if($s1 > 0){	
		$this->load->view('include/header');
		$this->load->view('category/create-category',$s1);
		$this->load->view('include/footer');
		}else{		
		$this->load->view('include/header');
		$this->load->view('category/create-category');
		$this->load->view('include/footer');	
		}
	}

	public function insert_category()
	{
		$category_id=$this->generator(15);
        $s1= $this->input->post('s1');
		$s2= $this->input->post('s2');
		$s3= $this->input->post('s3');
		$s4= $this->input->post('s4');
		$p='';

		if($s4 > 0){
		   $data=array(
			'category_id' 			=> $category_id,
			'parent_id' 			=> $s4,
			'category_name' 		=> $this->input->post('category_name'),
			'status' 				=> 1
			);
		}elseif($s3 > 0){

			$data=array(
			'category_id' 			=> $category_id,
			'parent_id' 			=> $s3,
			'category_name' 		=> $this->input->post('category_name'),
			'status' 				=> 1
			);
        }elseif($s2 > 0){

			 $data=array(
			'category_id' 			=> $category_id,
			'parent_id' 			=> $s2,
			'category_name' 		=> $this->input->post('category_name'),
			'status' 				=> 1
			);
        }elseif($s1 > 0){
			
			$data=array(
			'category_id' 			=> $category_id,
			'parent_id' 			=> $s1,
			'category_name' 		=> $this->input->post('category_name'),
			'status' 				=> 1
			); 
			$p='/'.$s1;
        }else{ 		
		    $data=array(
			'category_id' 			=> $category_id,
			'parent_id' 			=> 0,
			'category_name' 		=> $this->input->post('category_name'),
			'status' 				=> 1
			);
		}	
		
		$result=$this->category_model->category_entry($data);
		$this->session->set_userdata(array('message'=>'successfully_added'));
		if(isset($_POST['add-cat'])){
			redirect(base_url('Category/manage_category'.$p));
			exit;
		}else if(isset($_POST['add-cat-another'])){
			redirect(base_url('Category'.$p));
			exit;
		}
	}

	public function category_update_form($category_id)
	{	
		$category_detail = $this->category_model->retrieve_category_editdata($category_id);

		$this->menu=array('label'=> 'Edit Category', 'url' => 'Ccustomer');

		$data=array(
			'category_id' 			=> $category_detail[0]['category_id'],
			'category_name' 		=> $category_detail[0]['category_name'],
			'status' 				=> $category_detail[0]['status']
			);

		$this->load->view('include/header');
		$this->load->view('category/edit-category',$data);
		$this->load->view('include/footer');
	}

	public function category_update()
	{
		$category_id  = $this->input->post('category_id');
		$data=array(
			'category_name' => $this->input->post('category_name'),
			//'status' 		=> $this->input->post('status'),
			);

		$this->category_model->update_category($data,$category_id);
		$this->session->set_userdata(array('message'=>'successfully_updated'));
		redirect(base_url('Category/manage_category'));
		exit;
	}

	public function category_delete()
	{	
		$category_id =  $_POST['category_id'];
		$this->category_model->delete_category($category_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
	}


	public function generator($lenth)
	{
		$number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
	
		for($i=0; $i<$lenth; $i++)
		{
			$rand_value=rand(0,34);
			$rand_number=$number["$rand_value"];
		
			if(empty($con))
			{ 
			$con=$rand_number;
			}
			else
			{
			$con="$con"."$rand_number";}
		}
		return $con;
	}
}
