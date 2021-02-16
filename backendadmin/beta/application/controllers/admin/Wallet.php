<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 20/8/20
	    PURPOSE: wallet listing
*/
class Wallet extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mwallet');
		$this->load->model('admin/mtransactionhistory');

	}
	public function index()
	{
		$data['list']=$this->mwallet->getWalletList();
		$data['title']='Wallet List';
		$data['content']='admin/wallet/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}

	public function detail($user_id)
	{
		$start_date="";
		$end_date="";
		$payment_mode="wallet";
		$data['list']=$this->mwallet->getWalletTransactionhistoryList($user_id);
		
		$data['title']='Wallet Transaction';
		$data['content']='admin/wallet/detail';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}

	/*public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $cafe_id = $_POST['recordId'];
	    $condition=array('cafe_id' => $cafe_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('master_cafe',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
    
	
	public function delete() 
	{
    	$cafe_id= $this->input->post('cafe_id');
		$condition=array('cafe_id'=>$cafe_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('master_cafe',$condition,$udata);
		//echo $this->db->last_query();die;
		echo 1;
	}*/
  
	
   
	
	


	

}