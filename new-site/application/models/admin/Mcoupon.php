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

    public function getcouponList($userDB = false){

        $this->db->select('coupon.*,master_cafe.cafe_name,master_cafe.cafe_place');
        $this->db->from('coupon');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = coupon.cafe_id', 'left');
        $this->db->where("coupon.is_delete", "0");
        
        if(!empty($userDB) && $userDB['role_id'] !=1)
        {
            $this->db->where("coupon.cafe_id", $userDB['cafe_id']);
        }
        
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