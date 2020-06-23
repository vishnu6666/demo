<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable_model extends CI_Model {
public function get_formdata_count()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_form');
        return $query->num_rows();
    }

    public function get_formdata($limit, $start, $order, $dir)
    {
        $this->db->select('*')
            ->from('tbl_form')
            ->limit($limit, $start)
            ->order_by($order,'DESC', $dir);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function formdata_search($limit, $start, $search, $order, $dir)
    {
        $this->db->select('*')
                 ->like('id', $search)
                 ->or_like('text', $search)
                 ->or_like('dropdown',$search)
                 ->limit($limit, $start)
                 ->order_by($order, $dir);
        $query = $this->db->get('tbl_form');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function formdata_search_count($search)
    {
        $this->db->like('id', $search)
                 ->or_like('text', $search)
                 ->or_like('dropdown',$search);
        $query = $this->db->get('tbl_form');

        return $query->num_rows();
    }
}