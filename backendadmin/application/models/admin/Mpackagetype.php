<?php
class Mpackagetype extends CI_Model{
/*
    AUTHOR NAME: Soma Nandi Dutta
    DATE: 15/8/20
    PURPOSE: package type listing
*/

    function __construct(){
        parent::__construct();
    }

    public function getPackagetypeList(){

        $this->db->select('*');
        $this->db->from('package_type');
        //$this->db->where("package_type.is_delete", "0");
        $this->db->order_by("package_type.package_type_id", "desc");
        $query=$this->db->get();
       // echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getDetails($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();
        return $query->result_array(); 
    }
    public function getRow($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table); 
         //echo $this->db->last_query();die;         
        $res = array();
        if($query->num_rows()>0){ 
            $res = $query->row_array();    
        }
        return $res;            
    }  


}