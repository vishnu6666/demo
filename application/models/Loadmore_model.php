<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Loadmore_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_data($offset,$limit)
    {
        $this->db->select('*');
        $this->db->from('tbl_form');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }   
    }

    public function load_data($msg_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_form');
        $this->db->where('id <', $msg_id);
        $this->db->limit(10);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }   
    }

}