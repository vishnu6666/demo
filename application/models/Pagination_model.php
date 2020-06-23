<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagination_model extends CI_Model {

	public function num_rows()
	  {
	   	$query=$this->db->select()
	            ->from('tbl_form')
	            ->get();
	           return $query->num_rows();
	  }

	public function dataList($limit,$offset)
	  {
	   $query=$this->db->select('')
	            ->from('tbl_form')
	            ->limit($limit,$offset)
	            ->get();
	           return $query->result();
	  }
}
