<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

	public function insert_data($formdata)
    {
        return $this->db->insert('tbl_form',$formdata);
    }

    public function get_form_data()
    {
        $this->db->select('*')
            ->from('tbl_form')
            ->order_by('id','DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }   
    }

    public function delete($id)
    {
        $this->db->where('id', $id)
                 ->delete('tbl_form');
        return true;
    }

    public function get_edit_form_data($id)
    {
        $this->db->select('*')
                 ->where('id', $id);
        $query = $this->db->get('tbl_form');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function get_single_file($id)
    {
        $this->db->select('*')
                 ->where('id', $id);
        $query = $this->db->get('tbl_form');
        if ($query->num_rows() > 0) {
            $singlefile = $query->row_array();
            return $singlefile['singleFile'];
        } else {
            return false;
        }
    }

    public function get_multiple_file($id)
    {
        $this->db->select('*')
                 ->where('id', $id);
        $query = $this->db->get('tbl_form');
        if ($query->num_rows() > 0) {
            $multiplefile = $query->row_array();
            return $multiplefile['multiplefile'];
        } else {
            return false;
        }
    }

    public function update_data($id,$inputData)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_form', $inputData);
        return true;
    }
}