<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlist extends CI_Model {

    public function get_user_list(){
        $result=array();
        $query = "select * from master_cafe";
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }
}
?>