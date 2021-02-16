<?php
class Mcoupon extends CI_Model{
/*
        AUTHOR NAME: Soma Nandi Dutta
        DATE: 05/8/20
        PURPOSE: coupon listing
*/
    function __construct(){
        parent::__construct();
    }

    public function getcouponList(){

        $this->db->select('*');
        $this->db->from('coupon');
        $this->db->where("coupon.is_delete", "0");
        $this->db->order_by("coupon.coupon_id", "desc");
        $query=$this->db->get();
        return $query->result_array();
    }
    public function getDetails($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();
        return $query->result_array(); 
    }
    
   

}