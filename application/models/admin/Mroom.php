<?php
class Mroom extends CI_Model{
/*
        AUTHOR NAME: Soma Nandi Dutta
        DATE: 30/7/20
        PURPOSE: room listing
*/
    function __construct(){
        parent::__construct();
    }

    public function getroomList($cafe_id=false){

        $this->db->select('room.*,room_type.room_type_name,master_cafe.cafe_name,master_cafe.cafe_place');
        $this->db->from('room');
        $this->db->join('room_type', 'room_type.room_type_id = room.room_type_id');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = room.cafe_id');
        $this->db->where("room.is_delete", "0");
        
        if($cafe_id)
        {
            $this->db->where("room.cafe_id", $cafe_id);
        }
        
        $this->db->order_by("room.room_id", "desc");
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getDetails($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();
        return $query->result_array(); 
    }
    
   

}