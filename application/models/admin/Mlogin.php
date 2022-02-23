<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model {

	public function submit_login_user($data)
    {
        $num = '';
        $query = array();

        $this->db->select('*');
        $this->db->where('email',$data['email']);
        $this->db->where('password',$data['password']);
        //$this->db->where('role_id !=',2);
        $query = $this->db->get('user');
        //return $this->db->last_query();
        $num = $query->num_rows();

        $result = $query->row_array();

        //return $result;

        if($num == 1)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

}
?>