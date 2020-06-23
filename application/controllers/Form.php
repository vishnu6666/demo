<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->model('form_model');
	}
	
	public function index()
	{
		$data['formdatas'] = $this->form_model->get_form_data();
		$this->load->view('include/header');
		$this->load->view('form/list',$data);
		$this->load->view('include/footer');
	}

	public function create()
    {
        $this->load->view('include/header');
        $this->load->view('form/create');
        $this->load->view('include/footer');
    }

    public function submitform()
    {
        if (!empty($this->input->post())) {

            if (isset($_FILES['singleFile']) && (!empty($_FILES['singleFile']['name']))) {
                $Filename = $_FILES['singleFile']['name'];
                $singleFile = $this->single_file_upload($Filename, 'assets/uploads/', 'singleFile');
            }else{
                $singleFile = "";
            }

            if (isset($_FILES['multiplefile']) && (!empty($_FILES['multiplefile']['name']))) {
                //$multi_Filename = $_FILES['multiplefile']['name'];
                $multiplefile = $this->mumtiple_file_upload('multiplefile', 'assets/uploads/');
            }else{
                $multiplefile = "";
            }

            $inputData = array(
                'text'          => $this->input->post('text'),
                'dropdown'      => $this->input->post('dropdown'),
                'radio'         => $this->input->post('radio'),
                'checkbox'      => $this->input->post('selectcheckboxval'),
                'singleFile'    => $singleFile,
                'multiplefile'  => $multiplefile,
                'status'        => 1,
                'cdate'         => date('Y-m-d H:i:s'),
            );

            $inserted = $this->form_model->insert_data($inputData);

            if($inserted){
                $status = "Success";
                $message = "Record inserted.";
                $data = array("Common" => array("Title" => "Form submit API", 'version' => '1.0', 'Description' => 'Form submit API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("formdata" => $inputData));
                print(json_encode($data, JSON_UNESCAPED_UNICODE));
            }else{
                $status = "Fail";
                $message = "Record not inserted.";
                $data = array("Common" => array("Title" => "Form submit API", 'version' => '1.0', 'Description' => 'Form submit API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("Value" => 'Record not inserted'));
                print(json_encode($data, JSON_UNESCAPED_UNICODE));
            }
        } else {
            $status = "Fail";
            $message = "Invalid request.";
            $data = array("Common" => array("Title" => "Form submit API", 'version' => '1.0', 'Description' => 'Form submit API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("Value" => 'Invalid request'));
            print(json_encode($data, JSON_UNESCAPED_UNICODE));
        }
    }

    public function edit_form($id)
    {
        $data['formdata'] = $this->form_model->get_edit_form_data($id);
        $this->load->view('include/header');
        $this->load->view('form/edit',$data);
        $this->load->view('include/footer');
    }

    public function updateform()
    {
        if (!empty($this->input->post())) {

            $id = $this->input->post('id');

            if (isset($_FILES['singleFile']) && (!empty($_FILES['singleFile']['name']))) {
                $Filename = $_FILES['singleFile']['name'];
                $singleFile = $this->single_file_upload($Filename, 'assets/uploads/', 'singleFile');
            }else{
                $singleFile = $this->form_model->get_single_file($id);
            }

            if (isset($_FILES['multiplefile']) && (!empty($_FILES['multiplefile']['name']))) {
                //$multi_Filename = $_FILES['multiplefile']['name'];
                $multiplefile = $this->mumtiple_file_upload('multiplefile', 'assets/uploads/');
            }else{
                $multiplefile = $this->form_model->get_multiple_file($id);
            }

            $inputData = array(
                'text'          => $this->input->post('text'),
                'dropdown'      => $this->input->post('dropdown'),
                'radio'         => $this->input->post('radio'),
                'checkbox'      => $this->input->post('selectcheckboxval'),
                'singleFile'    => $singleFile,
                'multiplefile'  => $multiplefile,
                'udate'         => date('Y-m-d H:i:s')
            );

            $updated = $this->form_model->update_data($id,$inputData);

            if($updated){
                $status = "Success";
                $message = "Record updated.";
                $data = array("Common" => array("Title" => "Form update API", 'version' => '1.0', 'Description' => 'Form update API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("formdata" => $inputData));
                print(json_encode($data, JSON_UNESCAPED_UNICODE));
            }else{
                $status = "Fail";
                $message = "Record not update.";
                $data = array("Common" => array("Title" => "Form update API", 'version' => '1.0', 'Description' => 'Form update API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("Value" => 'Record not update'));
                print(json_encode($data, JSON_UNESCAPED_UNICODE));
            }
        } else {
            $status = "Fail";
            $message = "Invalid request.";
            $data = array("Common" => array("Title" => "Form update API", 'version' => '1.0', 'Description' => 'Form update API', 'Method' => 'POST', 'Status' => $status, 'Message' => $message), "Response" => array("Value" => 'Invalid request'));
            print(json_encode($data, JSON_UNESCAPED_UNICODE));
        }
    }

    public function delete($id)
    {
        $this->form_model->delete($id);
    }
  
    function single_file_upload($Filename, $path, $controlName)
    {
        $config['upload_path']   = $path;
        $config['file_name']     = $Filename;
        $config['allowed_types'] = '*';
        $config['max_size']      = '*';
        $config['max_width']     = '*';
        $config['max_height']    = '*';
        $config['encrypt_name']  = TRUE;
        
        $this->load->helper('file');
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload($controlName)) {

            $filedata = $this->upload->data();
            return $filedata['file_name'];

        } else {
            return FALSE;
        }
    }

    public function mumtiple_file_upload($multiplefile, $path) 
    { 

        $mul_file_data = [];

        $count = count($_FILES[$multiplefile]['name']);
    
        for($i=0;$i<$count;$i++){
    
            if(!empty($_FILES[$multiplefile]['name'][$i])){
        
                $_FILES['file']['name']   = $_FILES[$multiplefile]['name'][$i];
                $_FILES['file']['type']   = $_FILES[$multiplefile]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES[$multiplefile]['tmp_name'][$i];
                $_FILES['file']['error']  = $_FILES[$multiplefile]['error'][$i];
                $_FILES['file']['size']   = $_FILES[$multiplefile]['size'][$i];

                $config['upload_path']   = $path;
                $config['file_name']     = $_FILES[$multiplefile]['name'][$i];
                $config['allowed_types'] = '*';
                $config['max_size']      = '*';
                $config['max_width']     = '*';
                $config['max_height']    = '*';
                $config['encrypt_name']  = TRUE;
      
                $this->load->helper('file');
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
        
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $mul_file_data[] = $filename;
                }
            }
        }
   
      return implode(',', $mul_file_data); 
    }
}
