<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmembership extends CI_Model {

	/*public function get_member_list($status ='0'){
        $result=array();
        $query = "select mu.*,CONCAT(mu.title,' ',mu.first_name,' ',ifnull(mu.middle_name,''),' ',mu.last_name) as full_name from user mu where mu.status = '".$status."'and mu.is_delete = '0' order by mu.user_id desc";
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }*/
	public function getMembershipDetails($status =null,$codition =null){
        $result=array();
        if($status != null){
            
           $query = "select mu.*,mp.*,pmm.expiry_date,pmm.package_membership_mapping_id,pmm.membership_no,pmm.package_id,pmm.added_from,pmm.buy_on,pt.package_type_name,pmm.status as package_mapping_status,mu.name as full_name from user mu left join package_membership_mapping pmm on pmm.user_id = mu.user_id inner join master_package mp on mp.package_id = pmm.package_id inner join package_type as pt on pt.package_type_id = mp.package_type_id where pmm.status = '".$status."' ".$codition." order by pmm.package_membership_mapping_id desc";     
        }
        else{
           $query = "select mu.*,mp.*,pmm.expiry_date,pmm.package_membership_mapping_id,pmm.membership_no,pmm.package_id,pmm.added_from,pmm.buy_on,pt.package_type_name,pmm.status as package_mapping_status,mu.name as full_name from user mu left join package_membership_mapping pmm on pmm.user_id = mu.user_id left join master_package mp on mp.package_id = pmm.package_id left join package_type as pt on pt.package_type_id = mp.package_type_id where mu.status ='1' order by pmm.package_membership_mapping_id desc"; 
        }
        //echo $query;exit;
        $query1 = $this->db->query($query);
        $result=$query1->result_array();
        return $result;
    }
}