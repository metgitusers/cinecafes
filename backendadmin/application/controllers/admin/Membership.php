<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->library('imageupload');
		$this->load->model('admin/Mmembership');
		$this->load->model('admin/Mpackage');
		
	}	
	public function index() { 
		//echo $this->session->userdata('email');die;
		$data 							= array();
		$data['content'] 					= 'admin/membership/list';
		$data['membership_list']			= $this->Mpackage->get_package_list('1');
		//pr($data['membership_list']);
		$data['active_membership_list'] 	= $this->Mmembership->getMembershipDetails('1');
		$data['inactive_membership_list'] = $this->Mmembership->getMembershipDetails('0');
		//pr($data);		
		
		$this->admin_load_view($data);		
	}
public function filterSearch()
	{
		$responce_arr   		= array();		
        //pr($_POST);     
        $registration_filter	= $this->input->post("registration_filter");
        $expiry_filter      	= $this->input->post("expiry_filter");
        $membership_name		= $this->input->post("membership_name");
        $data_data    		= membershipFilterSearch($registration_filter,$expiry_filter,$membership_name);
        //pr($data_data);
        $responce_arr['html'] 	= $this->load->view('admin/membership/ajax_membership_packages_purchased_list',$data_data,true);
        echo json_encode($responce_arr);exit;
}

/************** cron need to fire *****************/

	public function membershipExpire()
	{
		$current_dt  		= date('Y-m-d');
	 	$membership_list 	= $this->Mmembership->getMembershipDetails('1');
	 	//pr($membership_list);
	 	if(!empty($membership_list)){
	 		foreach($membership_list as $list){
	 			$expiry_date = $list['expiry_date'];
	 			if(strtotime($current_dt) > strtotime($expiry_date)){
	 				$update_cond 	= array('package_membership_mapping_id' => $list['package_membership_mapping_id']);
	 				$update_data	= array('status' => '0');
	 				$this->mcommon->update('package_membership_mapping',$update_cond,$update_data);
	 				echo "successfully membership expired.";exit;
 				}
	 		}
	 	}
	}

}