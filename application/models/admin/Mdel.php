<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdel extends CI_Model {

    public function del_user($id){
        $this->db->query("delete from master_cafe where cafe_id='".$id."'");
		$num = $this->db->affected_rows();
		if($num == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	public function list_user($id){
        $result=array();
        $query = "select * from master_cafe where cafe_id='".$id."'";
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        $this->load->view('admin/add_page_admin');
    }
}
?>