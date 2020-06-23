<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Csv_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_form');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }   
    }

    function insert_csv($data) {
        $this->db->insert('tbl_form', $data);
    }

}