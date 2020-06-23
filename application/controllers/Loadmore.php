<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Loadmore extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Loadmore_model');
    }

    public function index() 
    {
        $limit = 10;
        $offset = 0;
        $data['loadData'] = $this->Loadmore_model->get_data($offset, $limit);
        $this->load->view('include/header');
        $this->load->view('loadmore/loadmore',$data);
        $this->load->view('include/footer');
    }

    public function load_messages() 
    {
        if (isset($_POST['msg_id']) && !empty($_POST['msg_id'])) {
            $data['loadData'] = $this->Loadmore_model->load_data($_POST['msg_id']);
            $page = $this->load->view("loadmore/loadmore_ajax_view", $data, true);

            echo json_encode(array("result" => "Success", "page" => $page, "msg" => ""));
        } else {
            echo json_encode(array("result" => "Fail", "page" => "", "msg" => "Server problem. Try after sometime."));
        }
    }

    public function onclick() 
    {
        $limit = 10;
        $offset = 0;
        $data['loadData'] = $this->Loadmore_model->get_data($offset, $limit);
        $this->load->view('include/header');
        $this->load->view('loadmore/loadmore-onclick',$data);
        $this->load->view('include/footer');
    }



}
