<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Appbookingdiscount extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mappbookingdiscount');
		$this->load->library('imageupload');
	}
	
	public function index() { 
		$this->_load_list_view();		
	}
	
	private function _load_list_view() {
		$data['content'] 	= 'admin/appbookingdiscount/list';
		$data['title']		= 'appbookingdiscount';
		$condition 			= array();
    	$lists 				= $this->mcommon->getDetails('appbookingdiscount',$condition);
		//echo $this->db->last_query();exit;
		//print_r($lists);exit;
    	$data['lists']		= $lists;
		$this->admin_load_view($data);
	}

	public function all_details(){
		$id = $this->input->post('id');		
		$result = $this->mappbookingdiscount->get_details($id);		
		echo json_encode($result);
	}
		
	public function edit($id){
		$data['row']=$this->mappbookingdiscount->get_details($id);	
		if(empty($data['row'])){
			$this->_load_list_view();
		}else{			
			$this->_load_details_view($id);
		}
	}
		
	private function _load_details_view($id){
		$condition = array();
		$data['row']=$this->mappbookingdiscount->get_details($id);	
		$data['content'] = 'admin/appbookingdiscount/edit';
		$data['title']= 'App Booking Discount Percentage(%)';
		$this->admin_load_view($data);
	}

	public function update_content(){

		if($this->input->post()){
			$id = $this->input->post('id');			
			$percentage = $this->input->post('percentage');								
			$condition=array('id'=>$id);

			$this->mappbookingdiscount->update($condition, $udata=array('percentage'=>$percentage));
			$this->session->set_flashdata('success_msg','Record updated successfully');								
		}	
		redirect('admin/appbookingdiscount');							
	}
		
	public function active()
	{
		$condition['id']=$this->input->post('id');
		$udata['status'] = 1;
		$this->mappbookingdiscount->active($condition,$udata);
		$response=array('status'=>1,'message'=>'Success');		
		echo json_encode($response);
	}
	
	public function inactive()
	{
		$condition['id']=$this->input->post('id');
		$udata['status'] = 0;
		$this->mappbookingdiscount->active($condition,$udata);
		echo $this->db->last_query();exit;
		
		$response=array('status'=>1,'message'=>'Success');		
		echo json_encode($response);
	}

}