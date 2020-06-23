
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->model('datatable_model');
	}

	public function basic()
	{
		$this->load->view('datatable/basic');
	}

    public function index()
    {
        $this->load->view('include/header');
        $this->load->view('datatable/server-side-datatable');
        $this->load->view('include/footer');
    }

    public function get_form_data()
    {
        $columns = array(
            0 => 'id',
            1 => 'text',
            2 => 'dropdown',
            3 => 'radio',
            4 => 'status',
            5 => 'cdate',
            6 => 'udate',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        $total_formdata = $this->datatable_model->get_formdata_count();

        $total_filter = $total_formdata;

        if (empty($this->input->post('search')['value'])) {
            $formdatas = $this->datatable_model->get_formdata( $limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $formdatas = $this->datatable_model->formdata_search( $limit, $start, $search, $order, $dir);

            $total_filter = $this->datatable_model->formdata_search_count( $search);
        }

        $data = array();

        if (!empty($formdatas)) {
            foreach ($formdatas as $formdata) {
                $nestedData['text']     = $formdata->text;
                $nestedData['dropdown'] = $formdata->dropdown;
                $nestedData['radio']    = $formdata->radio;
                $nestedData['status']   = $formdata->status ? '<div class="text-center table-actions"><a class="table-actions" href=""><i class="btn-success btn">InActive</i></a></div>':'<div class="text-center table-actions"><a class="table-actions" href=""><i class="btn-info btn">Active</i></a></div>'; 
                
                $nestedData['cdate']    = $formdata->cdate;
                $nestedData['udate']    = $formdata->udate;
                
                $nestedData['actions']  = '<div class="text-center table-actions"><a class="table-actions" href="' . base_url() . 'form/edit_form/' . $formdata->id . '"><button class="btn btn-primary">Edit</button></a>
                <button onclick="deletedata(' . "'" . $formdata->id . "'" . ')" class="btn btn-danger">Delete</button></div>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"              => intval($this->input->post('draw')),
            "recordsTotal"      => intval($total_formdata),
            "recordsFiltered"   => intval($total_filter),
            "data"              => $data,
        );
        echo json_encode($json_data);
    }
}
