<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function user_check($email )
    {
        $this->db->select('*')
            ->from('accounts')
            ->where('email', $email );
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function login_user($email , $password)
    {
        //$pass = md5($password);
        $this->db->select('*')
            ->from('accounts')
            ->where('email', $email )
            ->where('password', $password);
           
        if ($query = $this->db->get()) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}