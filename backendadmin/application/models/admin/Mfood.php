<?php
class Mfood extends CI_Model{
/*
        AUTHOR NAME: Soma Nandi Dutta
        DATE: 24/7/20
        PURPOSE: food listing
*/
    function __construct(){
        parent::__construct();
    }

    public function getfoodList(){

        $this->db->select('food.*,food_category.category_name');
        $this->db->from('food');
       // $this->db->join('food_variant', 'food_variant.food_id = food.food_id');
        //$this->db->join('master_cafe', 'master_cafe.cafe_id = food.cafe_id');
        $this->db->join('food_category', 'food_category.category_id = food.category_id');
       // $this->db->where('food.status',1);
        $this->db->where("food.is_delete", "0");
        $this->db->order_by("food.food_id", "desc");
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getfoodVariantList($food_id){

        $this->db->select('food_variant.*,food.name');
        $this->db->from('food_variant');
        $this->db->join('food', 'food.food_id = food_variant.food_id');
        $this->db->where("food_variant.is_delete", "0");
        $this->db->where("food_variant.food_id", $food_id);
        $this->db->order_by("food_variant.food_variant_id", "desc");
        $query=$this->db->get();
       // echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getfoodAddonList($food_id){

        $this->db->select('food_addon.*,food.name');
        $this->db->from('food_addon');
        $this->db->join('food', 'food.food_id = food_addon.food_id');
        $this->db->where("food_addon.is_delete", "0");
        $this->db->where("food_addon.food_id", $food_id);
        $this->db->order_by("food_addon.addon_id", "desc");
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
    public function getFoodDetails($food_id){
        $this->db->select('food.*,food_variant.food_variant_name,food_variant.food_variant_price');
        $this->db->from('food');
        $this->db->join('food_variant', 'food_variant.food_id = food.food_id');
        $this->db->where("food.food_id", $food_id);
        //$this->db->where($condition);
        $query=$this->db->get();
       // echo $this->db->last_query();die;
        return $query->row_array(); 
    }
    //count row
    public function food_variant_count($table,$condition)
    {
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();die;
        return $query->num_rows();
    }
    
   

}