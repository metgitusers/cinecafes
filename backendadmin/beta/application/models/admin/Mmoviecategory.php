<?php
class Mmoviecategory extends CI_Model{
/*
    AUTHOR NAME: Soma Nandi Dutta
    DATE: 29/7/20
    PURPOSE: movie category listing
*/

    function __construct(){
        parent::__construct();
    }

    public function getmoviecategoryList(){

        $this->db->select('*');
        $this->db->from('movie_category');
        $this->db->where("movie_category.is_delete", "0");
        $this->db->order_by("movie_category.category_id", "desc");
        //$this->db->where("movie_category.parent_id=", "0");
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