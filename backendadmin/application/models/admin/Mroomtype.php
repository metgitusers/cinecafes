<?php
class Mroomtype extends CI_Model{
/*
    AUTHOR NAME: Soma Nandi Dutta
    DATE: 29/7/20
    PURPOSE: roomtype listing
*/

    function __construct(){
        parent::__construct();
    }

    public function getroomtypeList(){

        $this->db->select('*');
        $this->db->from('room_type');
        $this->db->where("room_type.is_delete", "0");
        $this->db->order_by("room_type.room_type_id", "desc");
        //$this->db->where("room_type.parent_id=", "0");
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