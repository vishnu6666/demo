<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function category_list($s1, $s2, $s3, $s4)
	{
		if($s1 > 0){
			$this->db->select('*');
			$this->db->from('product_category');
			$this->db->where('status',1);
			$this->db->where('parent_id', $s1);
			$this->db->order_by('id','desc');
			$this->db->limit('500');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();	
			} 
        }else{
			$this->db->select('*');
			$this->db->from('product_category');
			$this->db->where('status',1);
			$this->db->where('parent_id', 0);
			$this->db->order_by('id','desc');
			$this->db->limit('500');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();	
			}
		}
		return false;
	}

	public function getTotalLevel($id){
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
				$rt= $query->result_array();			 
			 return $rt[0]['level'];
		}
		return false;
		
	}

	public function category_entry($data)
	{
		
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('status',1);
		$this->db->where('category_name',$data['category_name']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return FALSE;
		}else{
			$this->db->insert('product_category',$data);
			$insert_id = $this->db->insert_id();
			$this->db->select('level');
			$this->db->from('product_category');
			$this->db->where('id',$data['parent_id']);
			$query1 = $this->db->get();
			if ($query1->num_rows() > 0) {
				$rt=$query1->result_array();	
				$level= $rt[0]['level']+1;				
				  $data1=array(
						'level'	=> $level					
			      );
			    $this->db->where('id',$insert_id);
		        $this->db->update('product_category',$data1);
			}
			return TRUE;
		}
	}

	public function retrieve_category_editdata($category_id)
	{
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where('category_id',$category_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function update_category($data,$category_id)
	{
		$this->db->where('category_id',$category_id);
		$this->db->update('product_category',$data);
		return true;
	}

	public function delete_category($category_id)
	{
		$this->db->where('category_id',$category_id);
		$this->db->delete('product_category'); 	
		return true;
	}

	// public function examhall_list($s1, $s2, $s3, $s4)
	// {
	// 	if($s4 > 0){
	// 		$this->db->select('*');
	// 		$this->db->from('exam_hall_menu');
	// 		$this->db->where('status',1);
	// 		$this->db->where('parent_id', $s4);
	// 		$this->db->order_by('id','desc');
	// 		$this->db->limit('500');
	// 		$query = $this->db->get();
	// 		if ($query->num_rows() > 0) {
	// 			return $query->result_array();	
	// 		}
 //        }elseif($s3 > 0){
	// 		$this->db->select('*');
	// 		$this->db->from('exam_hall_menu');
	// 		$this->db->where('status',1);
	// 		$this->db->where('parent_id', $s3);
	// 		$this->db->order_by('id','desc');
	// 		$this->db->limit('500');
	// 		$query = $this->db->get();
	// 		if ($query->num_rows() > 0) {
	// 			return $query->result_array();	
	// 		} 
 //        }elseif($s2 > 0){
	// 		$this->db->select('*');
	// 		$this->db->from('exam_hall_menu');
	// 		$this->db->where('status',1);
	// 		$this->db->where('parent_id', $s2);
	// 		$this->db->order_by('id','desc');
	// 		$this->db->limit('500');
	// 		$query = $this->db->get();
	// 		if ($query->num_rows() > 0) {
	// 			return $query->result_array();	
	// 		}
 //        }elseif($s1 > 0){
	// 		$this->db->select('*');
	// 		$this->db->from('exam_hall_menu');
	// 		$this->db->where('status',1);
	// 		$this->db->where('parent_id', $s1);
	// 		$this->db->order_by('id','desc');
	// 		$this->db->limit('500');
	// 		$query = $this->db->get();
	// 		if ($query->num_rows() > 0) {
	// 			return $query->result_array();	
	// 		} 
 //        }else{
	// 		$this->db->select('*');
	// 		$this->db->from('exam_hall_menu');
	// 		$this->db->where('status',1);
	// 		$this->db->where('parent_id', 0);
	// 		$this->db->order_by('id','desc');
	// 		$this->db->limit('500');
	// 		$query = $this->db->get();
	// 		if ($query->num_rows() > 0) {
	// 			return $query->result_array();	
	// 		}
	// 	}
	// 	return false;
	// }

}