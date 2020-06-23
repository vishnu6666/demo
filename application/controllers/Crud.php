<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
    }

    public function index()
    {
        $data['formdatas'] = $this->crud_model->get_form_data();
        $this->load->view('include/header');
        $this->load->view('crud/crud',$data);
        $this->load->view('include/footer');
    }

    public function create()
    {
        $data=[];
        if(is_array($this->input->post()) && count($this->input->post())>0){

            if (isset($_FILES['singleFile']) && (!empty($_FILES['singleFile']['name']))) {
                $Filename = $_FILES['singleFile']['name'];
                $singleFile = $this->single_file_upload($Filename, 'assets/uploads/', 'singleFile');
            }else{
                $singleFile = "";
            }

            if (isset($_FILES['multiplefile']) && (!empty($_FILES['multiplefile']['name']))) {
                $multiplefile = $this->mumtiple_file_upload('multiplefile', 'assets/uploads/');
            }else{
                $multiplefile = "";
            }

            $config = array(
                array(
                    'field' => 'text',
                    'label' => 'Text',
                    'rules' => 'required|trim',
                ),
                array(
                    'field' => 'dropdown',
                    'label' => 'Dropdown',
                    'rules' => 'required|trim',
                ),
                array(
                    'field' => 'radio',
                    'label' => 'Gender',
                    'rules' => 'required|trim',
                ),
                array(
                    'field' => 'checkbox[]',
                    'label' => 'Hobby',
                    'rules' => 'required',
                ),
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                $data['formdata'] = $this->input->post();
            } else {
                $inputData = array(
                    'text'          => $this->input->post('text'),
                    'dropdown'      => $this->input->post('dropdown'),
                    'radio'         => $this->input->post('radio'),
                    'checkbox'      => implode(',', $this->input->post('checkbox')),
                    'singleFile'    => $singleFile,
                    'multiplefile'  => $multiplefile,
                    'status'        => 1,
                    'cdate'         => date('Y-m-d H:i:s'),
                );

                $inserted = $this->crud_model->insert_data($inputData);
                if($inserted){
                    $this->session->set_flashdata('success_msg', 'Data Added Successfully');
                    redirect(base_url('crud'));
                }
            }
        }
        $this->load->view('include/header');
        $this->load->view('crud/create',$data);
        $this->load->view('include/footer');
    }

    public function edit($id)
    {
        if(is_array($this->input->post()) && count($this->input->post())>0){
            
            if (isset($_FILES['singleFile']) && (!empty($_FILES['singleFile']['name']))) {
                $Filename = $_FILES['singleFile']['name'];
                $singleFile = $this->single_file_upload($Filename, 'assets/uploads/', 'singleFile');
            }else{
                $singleFile = $this->crud_model->get_single_file($id);
            }

            if(count($_FILES['multiplefile']['name']) > 1){
                $multiplefile = $this->mumtiple_file_upload('multiplefile', 'assets/uploads/');
            }else{
                $multiplefile = $this->crud_model->get_multiple_file($id);
            }

            $config = array(
                array(
                    'field' => 'text',
                    'label' => 'Text',
                    'rules' => 'required|trim',
                ),
                array(
                    'field' => 'dropdown',
                    'label' => 'Dropdown',
                    'rules' => 'required|trim',
                ),
                array(
                    'field' => 'radio',
                    'label' => 'Gender',
                    'rules' => 'required|trim',
                ),
                array(
                    'field' => 'checkbox[]',
                    'label' => 'Hobby',
                    'rules' => 'required',
                ),
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == false) {
                $data['formdata'] = $this->input->post();
            } else {
                $inputData = array(
                    'text'          => $this->input->post('text'),
                    'dropdown'      => $this->input->post('dropdown'),
                    'radio'         => $this->input->post('radio'),
                    'checkbox'      => implode(',', $this->input->post('checkbox')),
                    'singleFile'    => $singleFile,
                    'multiplefile'  => $multiplefile,
                    'status'        => 1,
                    'udate'         => date('Y-m-d H:i:s'),
                );

                $updated = $this->crud_model->update_data($id,$inputData);
                if($updated){
                    $this->session->set_flashdata('success_msg', 'Data Updated Successfully');
                    redirect(base_url('crud'));
                }
            }
        }
        $data['formdata'] = $this->crud_model->get_edit_form_data($id);
        $this->load->view('include/header');
        $this->load->view('crud/edit',$data);
        $this->load->view('include/footer');
    }

    public function updateStatus()
    {
        $id = $this->input->post("id");
        $result = 0;
        $data = array(
            'status' => $this->input->post("status"),
            'udate' => date("Y-m-d H:i:s"),
        );
        $updateResult = $this->crud_model->updateStatus($id, $data);
        if ($updateResult === TRUE) {
            $result = 1;
        } else {
            $result = 0;
        }
        echo $result;
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->crud_model->delete($id);
        redirect('features');
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
                } else {
                    //$error = array('error' => $this->upload->display_errors()); 
                }
            }
        }
   
      return implode(',', $mul_file_data); 
    }

}