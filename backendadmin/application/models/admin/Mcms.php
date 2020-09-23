<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcms extends CI_Model {

	public function getCmsList(){
        $result=array();
        $query = "select cms.* from cms where cms.status = '1' and is_delete ='0' order by cms.page_id desc";
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }
}