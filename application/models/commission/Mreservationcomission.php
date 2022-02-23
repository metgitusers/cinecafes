<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreservationcomission extends CI_Model {

	/*public function get_member_list($status ='0'){
        $result=array();
        $query = "select mu.*,CONCAT(mu.title,' ',mu.first_name,' ',ifnull(mu.middle_name,''),' ',mu.last_name) as full_name from master_member mu where mu.status = '".$status."'and mu.is_delete = '0' order by mu.member_id desc";
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }*/
	public function get_reservation_list($condition = ''){
        ini_set('display_errors', 1);
        $result=array();
            $query = "select reservation.*, cafe.cafe_name, cafe.cafe_place, room.room_no, room_type.room_type_name, reservation.status as resv_status,
                    reservation.name as full_name from reservation
                    left join master_cafe cafe on reservation.cafe_id = cafe.cafe_id 
                    left join room on room.room_id = reservation.room_id
                    left join room_type on room_type.room_type_id = room.room_type_id
                    where ".$condition."
                    AND  reservation.status in(1)
                    order by reservation.reservation_date desc";  
     //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }
    public function get_reservation_list2($condition = NULL){
        $result=array();
        if(!empty($condition)){
            $query = "select reservation.*,ml.zone_name,reservation.status as resv_status,CONCAT(reservation.first_name,' ',reservation.last_name) as full_name from reservation left join master_zone ml on reservation.zone_id = ml.zone_id where ".$condition." order by reservation.reservation_id desc";  
        }
        else{
            $query = "select reservation.*,ml.zone_name,reservation.status as resv_status,CONCAT(reservation.first_name,' ',reservation.last_name) as full_name from reservation left join master_zone ml on reservation.zone_id = ml.zone_id order by reservation.reservation_id desc";  
        }
     echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }    
    public function getTimeDetails($condition){
        $this->db->select("*");
        $this->db->where($condition);
        $query=$this->db->get('time_slot');
        return $query->result_array(); 
    }
    public function reservationCommissionFilterSearch($condition = '', $zone_id = ''){    
        $result         = array();
        $final_result   = array();
        $query = "SELECT rev.cafe_id,count(rev.reservation_id) as no_of_reservation, cafe.cafe_name, cafe.cafe_place  FROM reservation as rev left join master_cafe as cafe on cafe.cafe_id = rev.cafe_id where ".$condition." and rev.status in(1) and cafe.is_delete = 0 group by rev.cafe_id order by cafe.cafe_name Asc";
        //echo $query;exit;
        $query1     = $this->db->query($query);
        $result     = $query1->result_array();
             
        return $result;
    }
    //reservation date group
    public function reservationCommissionListFilterSearch($condition = ''){    
        $result         = array();
        $final_result   = array();
        $query = "SELECT rev.cafe_id, rev.reservation_date, cafe.cafe_name, cafe.cafe_place  FROM reservation as rev left join master_cafe as cafe on cafe.cafe_id = rev.cafe_id where ".$condition." and rev.status in(1) and cafe.is_delete = 0 order by cafe.cafe_name Asc";
        //echo $query;exit;
        $query1     = $this->db->query($query);
        $result     = $query1->result_array();
        //echo $this->db->last_query();
        return $result;
    }
}