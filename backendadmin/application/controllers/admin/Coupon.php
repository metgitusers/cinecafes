<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 05/01/20
	    PURPOSE: Coupon listing ,add , delete,status change and update
*/
class Coupon extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mcoupon');
		$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->mcoupon->getcouponList($this->check_valid_admin());
		$data['title']='Coupon List';
		$data['content']='admin/coupon/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		$data['title']='Coupon Add';
		$data['content']='admin/coupon/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function edit($coupon_id)
	{
		$condition=array('coupon_id'=>$coupon_id);
		$data['row'] =$this->mcommon->getRow('coupon',$condition);
		//echo $this->db->last_query();die;
		$data['title']='Coupon Edit';
		$data['content']='admin/coupon/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
		
	public function add_content()
	{  
		//echo "<pre>"; print_r($this->input->post());die;
	    $this->form_validation->set_rules('coupon_code','Coupon Code','trim|required');
	    $this->form_validation->set_rules('start_on','Statt on','trim|required');
	    $this->form_validation->set_rules('end_on','End on','trim|required');
	    $this->form_validation->set_rules('coupon_type','Coupon type','trim|required');
	    $this->form_validation->set_rules('amount','Amount','trim|required');
	    //$this->form_validation->set_rules('min_price','Min Price','trim|required');
	    
	    if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add();
		} else {
          	$idata = array(
		 		'coupon_code'   => $this->input->post('coupon_code'),
				'cafe_id' => $this->input->post('cafe_id'),
		        'start_on' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('start_on')))),
		        'end_on' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('end_on')))),
		        'coupon_type' => $this->input->post('coupon_type'),
                'min_price' => $this->input->post('min_price'),
				'amount' => $this->input->post('amount'),
				'max_discount_amount'=> !empty($this->input->post('max_discount_amount'))?$this->input->post('max_discount_amount'):null,
                'status'=>1,
		       // 'created_by' =>$admin['user_id'],
		       // 'created_on' => date('Y-m-d H:i:s'),
            );
			//print_r($idata); die;
		 	$movie_id=$this->mcommon->insert('coupon', $idata);
		 	$this->session->set_flashdata('success_message','Coupon added successfully.');
		 	redirect('admin/coupon');
		 	
	   }
    }

    public function update_content()
	{   
	    //echo "<pre>"; print_r($this->input->post());die;
	    $coupon_id=$this->input->post('coupon_id');  
		$this->form_validation->set_rules('coupon_code','Coupon Code','trim|required');
	    $this->form_validation->set_rules('start_on','Start on','trim|required');
	    //$this->form_validation->set_rules('end_on','End on','trim|required');
	    $this->form_validation->set_rules('coupon_type','Coupon type','trim|required');
	    $this->form_validation->set_rules('amount','Amount','trim|required');
	    //$this->form_validation->set_rules('min_price','Min Price','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Not updated.Something went wrong');
		//echo "valida error";die;
	    $this->edit($coupon_id);
		} else {
			if(!empty($this->input->post('end_on'))){
				$end_on=date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('end_on'))));
			}else{
				$end_on=date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('end_on_old'))));

			}

			$udata = array(
		 	    'coupon_code'   => $this->input->post('coupon_code'),
				'cafe_id' => $this->input->post('cafe_id'),
		        //'start_on' => $this->input->post('start_on'),
				'start_on' => date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('start_on')))),
		       // 'end_on' => $this->input->post('end_on'),
		        'end_on' => $end_on,
		        'coupon_type' => $this->input->post('coupon_type'),
                'min_price' => $this->input->post('min_price'),
				'max_discount_amount'=> !empty($this->input->post('max_discount_amount'))?$this->input->post('max_discount_amount'):null,
                'amount' => $this->input->post('amount'),
		        //'updated_by' =>$admin['user_id'],
		        //'updated_on' => date('Y-m-d H:i:s'),
            );
            
            $condition=array('coupon_id' => $coupon_id);
            $this->mcommon->update('coupon',$condition, $udata);
		 	//echo $this->db->last_query();die;
		 		
		 	$this->session->set_flashdata('success_message','Coupon Updated successfully.');
		 	redirect('admin/coupon');
		 	
	   }
    }
   
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $coupon_id = $_POST['recordId'];
	    $condition=array('coupon_id' => $coupon_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('coupon',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete() 
	{
    	$coupon_id= $this->input->post('coupon_id');
		$condition=array('coupon_id'=>$coupon_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('coupon',$condition,$udata);
		echo 1;
	}
}