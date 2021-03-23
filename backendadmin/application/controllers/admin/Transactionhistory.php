<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 20/8/20
	    PURPOSE: Transactionhistory listing and details
*/
class Transactionhistory extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mtransactionhistory');
		
	}
	public function index()
	{
		$start_date="";
		$end_date="";
		$user_id="";
		if(!empty($_POST['start_date'])){
       		$start_date= date('Y-m-d', strtotime($this->input->post('start_date')));
        }
        if(!empty($_POST['end_date'])){
       		$end_date= date('Y-m-d', strtotime($this->input->post('end_date')));
        }
        if(!empty($_POST['user_id'])){
       		$user_id= $this->input->post('user_id');
        }
        $data['start_date']=$start_date;
        $data['end_date']=$end_date;
        $data['user_id']=$user_id; 
       
		$data['list']=$this->mtransactionhistory->getTransactionhistoryList($start_date,$end_date,$user_id);
		$data['user_list'] =$this->mtransactionhistory->getDistinctUser();
		//echo '<pre>';
		//print_r($data['list']); die;
		//print_r( $data['list']['package_id']);die;
		    /*if(!empty($data['list'])){
				foreach($data['list'] as $pkg_list){
					
					$package_list[$pkg_list['package_id']] = $this->mtransactionhistory->getpackage($pkg_list['package_id']);
	        	}
				
				$data['pkg_all_list']['package_list']	= $package_list;	
				//echo "<pre>";print_r($data['pkg_all_list']['package_list']);die;
			}*/
	    $data['title']='Transactionhistory List';
		$data['content']='admin/transaction_history/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
	
	


	

}