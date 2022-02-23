<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmember extends CI_Model {

	public function get_member_list($condition =NULL,$user_type=null,$start_date=null,$end_date=null){
        // echo $user_type;
        // echo $start_date;
        // echo $end_date;die;
        $result=array();
        // if($status!=NULL)
        // {
        //     $query = "select mu.*,mu.name as full_name from user mu where mu.status = '".$status."'and mu.is_delete = '0' order by mu.user_id desc";
        // }
        // else
        // {
        //     $query = "select mu.*,mu.name as full_name from user mu where mu.is_delete = '0' order by mu.user_id desc";
        // }
        $this->db->select("user.*,user_profile.profile_img,user_profile.address,user_profile.lat,user_profile.lng,DATE_FORMAT(user_profile.dob, '%d/%m/%Y') as dob,user_profile.gender as gender,user_profile.marriage_status,user_profile.doa");
        $this->db->join('user_profile', 'user_profile.user_id = user.user_id', 'inner'); 
        
       
        if($user_type!=null)
        {
            echo $user_type;die;
            if($user_type=="App")
            {
                $this->db->where("user.added_form","App");
            }
            if($user_type=="Web")
            {
                $this->db->where("user.added_form != ","App");
            }
        }

        if(!empty($start_date)){
            if($start_date != '')
            {
                $start_date = str_replace('/', '-', $start_date);
                 $start_date=date('Y-m-d',strtotime($start_date));
                
            }
        }
        if(!empty($end_date)){
            if($end_date != '')
            {
                $end_date = str_replace('/', '-', $end_date);
                $end_date=date('Y-m-d',strtotime($end_date.' + 1 day'));
                //$end_date=date('Y-m-d',strtotime($end_date));
                  
            }
        }
         if(!empty($start_date) && !empty($end_date) ){
           //$this->db->where('reservation_date between "'.$start_dt.'" and "'.$end_dt.'"');
           $this->db->where('user.created_date between "'.$start_date.'" and "'.$end_date.'"');
        }
        
       
        $this->db->where($condition);
        //$this->db->where('package_membership_mapping.status','1');
        $this->db->order_by("user.user_id","DESC");
        $query=$this->db->get('user');
        //echo $this->db->last_query(); die();
        return $query->result_array();
        
    }
	public function getMemberDetails($condition = null,$user_type = '',$start_date='',$end_date=''){
        $this->db->select("user.*,user_profile.profile_img,user_profile.address,user_profile.lat,user_profile.lng,DATE_FORMAT(user_profile.dob, '%d/%m/%Y') as dob, user_profile.dob d_o_b, user_profile.gender as gender,user_profile.marriage_status,user_profile.doa");
        $this->db->join('user_profile', 'user_profile.user_id = user.user_id', 'inner'); 
        
       // $this->db->join('package_membership_mapping', 'package_membership_mapping.member_id = mm.member_id', 'left');
       
        $this->db->where($condition);
        if($start_date != '' && $end_date != '' ){
            $this->db->where('DATE(user.created_date) >=', date('Y-m-d', strtotime($start_date)));
            $this->db->where('DATE(user.created_date) <=', date('Y-m-d', strtotime($end_date)));
        }
        if($user_type != ''){
            $this->db->where('user.role_id', $user_type == 'App'?'App':'Admin');
        }
        //$this->db->where('package_membership_mapping.status','1');
        $this->db->order_by("user.user_id","DESC");
        $query=$this->db->get('user');
        //echo $this->db->last_query(); die();
        return $query->result_array(); 
    }
    public function get_package_type($package_id){
        $result=array();
        $this->db->select('ppm.*,pt.*'); 
        $this->db->join('package_type pt', 'ppm.package_type_id = pt.package_type_id', 'inner');
        $this->db->where('ppm.package_id',$package_id);
        $query=$this->db->get('package_price_mapping ppm');
       //echo $this->db->last_query(); die();
        return $query->result_array(); 

    }
}