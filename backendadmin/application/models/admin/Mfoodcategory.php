<?php
class Mfoodcategory extends CI_Model{
/*
    AUTHOR NAME: Soma Nandi Dutta
    DATE: 24/7/20
    PURPOSE: food category listing
*/

    function __construct(){
        parent::__construct();
    }

    public function getfoodcategoryList(){

        $this->db->select('*');
        $this->db->from('food_category');
        $this->db->where("food_category.is_delete", "0");
        $this->db->order_by("food_category.category_id", "desc");
        $this->db->where("food_category.parent_id=", "0");
        $query=$this->db->get();
       // echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getfoodsubcategoryList($category_id){

        $this->db->select('*');
        $this->db->from('food_category');
        $this->db->where("food_category.parent_id", $category_id);
        $this->db->where("food_category.is_delete", "0");
        $this->db->where("food_category.parent_id!=", "0");
        $this->db->order_by("food_category.category_id", "desc");
        $query=$this->db->get();
       // echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function get_main_page($parent_id){

        $sql = "select * from food_category where food_category.category_id='".$parent_id."'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
       // echo $this->db->last_query();die;
        return $result;

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