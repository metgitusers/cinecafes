<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->admin=$this->session->userdata('admin');
		$this->load->library('imageupload');
		// if($this->session->userdata('role_id') == '')
		// {
		// 	redirect('admin');
		// 	die();
		// }
	}

	// Default load function for header and footer inculded
	private function _load_view($data) {
		//$this->load->view('admin/layouts/index',$data);
		$this->admin_load_view($data);
	}	

	public function index() { 
		$result = array();
		$result['content']='admin/food/coupon/index';
		$this->_load_view($result);

	}

	public function add()
	{	
		$result = array();			
		$result['content']='admin/food/coupon/add';
		$this->_load_view($result);
	}

	public function store()
	{
		$data 	= array();
		$result =  array();
		$img 	= '';
		
		$result['content']='admin/food/coupon/add';
		$this->form_validation->set_rules('coupon_code', 'Code', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		$this->form_validation->set_rules('min_purchase_amount', 'Minimim Purchase Amount', 'trim|required');
		$this->form_validation->set_rules('discount_amount', 'Minimim Purchase Amount', 'trim|required');
		$this->form_validation->set_rules('max_uses', 'Minimim Purchase Amount', 'trim|required');
		if($this->form_validation->run()==FALSE){
			$this->_load_view($result);
		}else{
			//echo 'test1'; die;
			$where = array('LOWER(coupon_code)'=> $this->input->post('coupon_code'), 'status !='=> 3);
			if(!empty($this->input->post('food_coupon_id'))){
				$where['food_coupon_id !='] = $this->input->post('food_coupon_id');
			}
			$isPresent = $this->mcommon->getRow('food_coupons', $where);
			if(!empty($isPresent)){
				$this->session->set_flashdata('error_msg','');
				$this->session->set_flashdata('success_msg','Coupon Code allready exists');
				$this->_load_view($result);
			}
			else{
				
				$data = array(
					'coupon_code' 	=> $this->input->post('coupon_code'),
					'start_date'	=> date('Y-m-d', strtotime($this->input->post('start_date'))),
					'end_date'		=> date('Y-m-d', strtotime($this->input->post('end_date'))),
					'min_purchase_amount'		=> $this->input->post('min_purchase_amount'),
					'discount_amount'			=> $this->input->post('discount_amount'),
					'max_uses'			=> $this->input->post('max_uses'),
					'coupon_type'		=> !empty($this->input->post('coupon_type'))?$this->input->post('coupon_type'):1,
				);

				if(empty($this->input->post('food_coupon_id'))){
					$result = $this->mcommon->insert('food_coupons',$data);
					$msg = "Add new coupon";
				}else{
					$data['status']= $this->input->post('status');
					$result = $this->mcommon->update('food_coupons',['food_coupon_id'=> $this->input->post('food_coupon_id')], $data);
					$msg = "update coupon";
					$result =$this->input->post('food_coupon_id');
				}
				if($result)
				{
					$log_data = array('action' 	=> $msg,
								'statement' 	=> $msg." named - '".$this->input->post('coupon_code')."'" ,
								'action_by'	=> $this->admin['user_id'],
								'IP'			=> getClientIP(),
								'id'          	=> $result,
								'type'        	=> "Food coupon code",
								'status'		=> '1'
								);
					$this->mcommon->insert('log',$log_data);
					$this->session->set_flashdata('error_msg','');
					$this->session->set_flashdata('success_msg','Action successfully completed');
					
					redirect('admin/food/coupon');
				}
				else{
					$this->session->set_flashdata('success_msg','');
					$this->session->set_flashdata('error_msg','Opps!Sorry try again.');				
					redirect('admin/admin/coupon/add');
				}
			}
		}
	}

	public function edit($food_coupon_id)
	{
		ini_set('display_errors', 1);
		$result = array();		
		$result['details'] = $this->mcommon->getRow('food_coupons',array('food_coupon_id'=>$food_coupon_id));
		$result['content']='admin/food/coupon/add';
		$this->_load_view($result);
	}


}