<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Csv_model');
    }

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('csv/csv');
		$this->load->view('include/footer');
	}

	function exportcsv()
    {
		$csvData = $this->Csv_model->get_data();
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"export_csv" . ".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array("No", "Text", "Dropdown", "Gendar", "Hobby"));
        foreach ($csvData as $key => $csvinfo) {
            $count = $key+1;
            $csvarray = array($count, $csvinfo["text"], $csvinfo["radio"], $csvinfo["checkbox"]);
            fputcsv($handle, $csvarray);
        }
        fclose($handle);
        exit;
    }

    function importcsv() 
    {
        $data['error'] = '';    
 
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('Csvimport');
        $this->load->helper('file');
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
 
            $this->load->view('include/header');
            $this->load->view('csv/csv',$data);
            $this->load->view('include/footer');
        } else {
            $file_data = $this->upload->data();
            $file_path =  'assets/uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);

                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'text'      => $row['Text'],
                        'radio'     => $row['Dropdown'],
                        'checkbox'  => $row['Hobby'],
                    );
                    $this->Csv_model->insert_csv($insert_data);
                }
                //$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect(base_url().'Csv');
            } else 
                $data['error'] = "Error occured";
                $this->load->view('include/header');
                $this->load->view('csv/csv',$data);
                $this->load->view('include/footer');
        }
 
    } 

}
