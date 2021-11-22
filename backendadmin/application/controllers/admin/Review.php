<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 21/8/20
	    PURPOSE: Review listing
*/
class Review extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mreview');
		

	}
	public function index()
	{
		$data['list']=$this->mreview->getReviewList($this->check_valid_admin());
		$data['title']='Review List';
		$data['content']='admin/review/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}

	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $rating_id = $_POST['recordId'];
	    $condition=array('rating_id' => $rating_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('rating_review',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
   
	
	


	

}