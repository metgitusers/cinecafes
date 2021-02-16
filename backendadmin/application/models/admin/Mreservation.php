<?php
class Mreservation extends CI_Model{
/*
    AUTHOR NAME: Soma Nandi Dutta
    DATE: 08/8/20
    PURPOSE: reservation listing
*/

    function __construct(){
        parent::__construct();
    }

    public function getreservationList($start_date=null,$end_date=null,$cafe_id=null){
 
        /*if(!empty($start_date)){
            if($start_date != '')
            {
                 $start_dt=date('Y-m-d',strtotime($start_date));
                 echo $start_dt;die;
            }
        }
        if(!empty($end_date)){
            if($end_date != '')
            {
                 //$end_dt=date('Y-m-d',strtotime($end_date));
                $end_dt=date('Y-m-d',strtotime($end_date));
                  echo $end_dt;die;
            }
        }*/

        $this->db->select('reservation.*,room.room_no,CONCAT(master_cafe.cafe_name, "-",master_cafe.cafe_place) AS cafe_name,transaction_history.payment_mode');
        $this->db->from('reservation');
        $this->db->join('room', 'room.room_id = reservation.room_id');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = reservation.cafe_id');
       
        //$this->db->join('user', 'user.user_id = reservation.user_id');
        $this->db->join('transaction_history', 'transaction_history.reservation_id = reservation.reservation_id','left');
       
        if(!empty($start_date) && !empty($end_date) ){
           //$this->db->where('reservation_date between "'.$start_dt.'" and "'.$end_dt.'"');
           $this->db->where('reservation_date between "'.$start_date.'" and "'.$end_date.'"');
        }
        if($cafe_id > 0)
        {
            $this->db->where('reservation.cafe_id',$cafe_id);
        }
        $this->db->order_by("reservation.reservation_id", "desc");
        $query=$this->db->get();
        // if(!empty($start_date) && !empty($end_date) ){
        // echo $this->db->last_query();die;
        // }
        return $query->result_array();
    }
    public function getDetails($table,$condition){
        $this->db->where($condition);
        $query=$this->db->get($table);
        //echo $this->db->last_query();
        return $query->result_array(); 
    }
    public function getreservationById($reservation_id){

        $this->db->select('reservation.*,room.room_no,room.no_of_people as room_no_of_people,room.description as room_description,room.image as room_image,CONCAT(master_cafe.cafe_name, "-",master_cafe.cafe_place) AS cafe_name,master_cafe.cafe_description,master_cafe.cafe_location,master_cafe.opening_hours as cafe_opening_hours,master_cafe.phone as cafe_phone,transaction_history.payment_mode');
        $this->db->from('reservation');
        $this->db->join('room', 'room.room_id = reservation.room_id');
        $this->db->join('master_cafe', 'master_cafe.cafe_id = reservation.cafe_id');
        //$this->db->join('user', 'user.user_id = reservation.user_id');
        $this->db->join('transaction_history', 'transaction_history.reservation_id = reservation.reservation_id','left');
        $this->db->where('reservation.reservation_id',$reservation_id);
        $this->db->order_by("reservation.reservation_id", "desc");
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->row_array();
    }
    public function getCafeImgById($cafe_id){
        $sql = "select * from cafe_images where cafe_images.cafe_id='".$cafe_id."' limit 1";
        $query = $this->db->query($sql);
        return $query->row_array();
        //echo $this->db->last_query();die;
        //return $result; 
    } 
    public function getMovieById($movie_id){
        //$sql = "select * from movie where movie_id='".$movie_id."'";
        $this->db->select('movie.*,movie_category.category_name');
        $this->db->from('movie');
        $this->db->join('movie_category', 'movie_category.category_id = movie.category_id');
        $this->db->where("movie.status", "1");
        $this->db->where("movie.is_delete", "0");
        $this->db->where('movie.movie_id',$movie_id);
        $query=$this->db->get();
        $result = $query->row_array();
        //echo $this->db->last_query();die;
        return $result; 
    } 
    public function getCouponById($coupon_code){
       
        $this->db->select('coupon.*');
        $this->db->from('coupon');
        $this->db->where("coupon.status", "1");
        $this->db->where("coupon.is_delete", "0");
        $this->db->where('coupon.coupon_code',$coupon_code);
        $query=$this->db->get();
        $result = $query->row_array();
        //echo $this->db->last_query();die;
        return $result; 
    } 
    // public function getFoodById($reservation_id){        
    //     $this->db->select('reservation_food_mapping.*,food.*,food_variant.*,food_category.category_name');
    //     $this->db->from('reservation_food_mapping');
    //     $this->db->join('food', 'food.food_id = reservation_food_mapping.food_id');
    //     $this->db->join('food_category', 'food_category.category_id = food.category_id');
    //     $this->db->join('food_variant', 'food_variant.food_variant_id = reservation_food_mapping.food_variant_id');
    //     $this->db->where('reservation_food_mapping.reservation_id',$reservation_id);
    //     $query=$this->db->get();
    //     $result = $query->row_array();
    //     //echo $this->db->last_query();die;
    //     return $result; 
    // } 
    //get ordered food while reservation
    public function getFoodById($reservation_id){        
        $this->db->select('rf.*,foi.*');
        $this->db->from('reservation_orders rf');
        $this->db->join('food_order_items foi', 'rf.order_id = foi.food_order_id');
        //$this->db->join('food_category', 'food_category.category_id = food.category_id');
        $this->db->where('rf.reservation_id',$reservation_id);
        $query=$this->db->get();
        $result = $query->row_array();
        return $result; 
    } 
    public function getAddonById($reservation_id){
       
        $this->db->select('reservation_addon_mapping.reservation_id,reservation_addon_mapping.addon_id,reservation_addon_mapping.   food_id,food_addon.*');
        $this->db->from('reservation_addon_mapping');
        $this->db->join('food_addon', 'food_addon.addon_id = reservation_addon_mapping.addon_id');
        $this->db->where("food_addon.status", "1");
        $this->db->where("food_addon.is_delete", "0");
        $this->db->where('reservation_addon_mapping.reservation_id',$reservation_id);
        $query=$this->db->get();
        $result = $query->result_array();
       // echo $this->db->last_query();die;
        return $result; 
    } 

}