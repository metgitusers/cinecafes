<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		//$this->load->model('admin/mdashboard');
		$this->load->model('admin/mreservation');
		$this->load->model('admin/Mmembership');
	}
	public function index() { 
		$data=array();
		$this->_load_dashboard_view($data);
	}
	private function _load_dashboard_view($dashboard) {
		$data['content'] = 'admin/dashboard';
		$start_date=date('Y-m-d');
		$end_date=date('Y-m-d');
		$cafe_id="";
		if(!empty($_POST['start_date'])){
       		$start_date= $this->input->post('start_date');
        }
        if(!empty($_POST['start_date'])){
       		$end_date= $this->input->post('end_date');
        }
        if(!empty($_POST['cafe_id'])){
       		$cafe_id= $this->input->post('cafe_id');
        }
        $data['start_date']= $start_date;
        $data['end_date']= $end_date;
        $data['cafe_id']= $cafe_id;
        $condition=array('status'=>1,'is_delete='=>0);
		$data['list']=$this->mreservation->getreservationList($start_date,$end_date,$cafe_id);
		$data['cafe_list'] =$this->mcommon->getDetails('master_cafe',$condition);
		$table="user";
		$condition_all_users['role_id']=0;
		$all_users=$this->mcommon->getNumRows($table,$condition_all_users);

		$member_active_list					= $this->Mmembership->getMembershipDetails('1');
		$member_active_cnt					= 0;
		if(!empty($member_active_list)){
			$member_active_cnt					= count($member_active_list);
		}
		$club_members=$member_active_cnt;
		
		//app registered users
		$condition_app_users['role_id']=0;
		$condition_app_users['added_form']="App";
		$app_users=$this->mcommon->getNumRows($table,$condition_app_users);
		
		$data['club_members']= $club_members;
		$data['all_users']=$all_users; 
		$data['app_users']=$app_users; 
		$data['title']= 'Dashboard';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
}