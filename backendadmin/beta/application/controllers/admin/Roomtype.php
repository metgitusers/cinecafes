<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 29/7/20
	    PURPOSE: moviecategory listing ,add , delete,status change and update
*/
class Roomtype extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mroomtype');
		//$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->mroomtype->getroomtypeList();
		$data['title']='Room Type List';
		$data['content']='admin/roomtype/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
	public function add()
	{
		//$condition1=array('parent_id'=>0,'status'=>1,'is_delete='=>0);
		//$condition=array('status'=>1,'is_delete='=>0);
		//$data['cat_list'] =$this->mcommon->getDetails('movie_category',$condition);
		$data['title']='Room Type Add';
		$data['content']='admin/roomtype/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
	public function edit($room_type_id)
	{
		$condition=array('room_type_id'=>$room_type_id);
		$data['row'] =$this->mcommon->getRow('room_type',$condition);
		$data['title']='Room Type Edit';
		$data['content']='admin/roomtype/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	
		
	public function add_content()
	{  
	    $this->form_validation->set_rules('room_type_id','Room Type','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add();
		} else {
			$condition=array('room_type_name'=>$this->input->post('room_type_id'),'is_delete!='=>"1");
            $row= $this->mroomtype->getRow('room_type',$condition);
            //echo $this->db->last_query();die;   
			if(empty($row)){
				//echo "insert";die;
	         	$idata = array(
			        'room_type_name' => $this->input->post('room_type_id'),
			        'status' => 1,
			       // 'created_by' =>$admin['user_id'],
			       // 'created_on' => date('Y-m-d H:i:s'),
	            );

			 	$insert_id=$this->mcommon->insert('room_type', $idata);
			 	$this->session->set_flashdata('success_message','Room type added successfully.');
			 	redirect('admin/roomtype');
		 	}else{
		 		//echo "not insert";die;

	               $this->session->set_flashdata('error_message','Room type already exits');
                   redirect('admin/roomtype');
              }
		 	 redirect('admin/roomtype');
	   }
    }
  


    public function update_content()
	{   
	    //echo "<pre>"; print_r($this->input->post());die;
	    $room_type_id=$this->input->post('room_type_id');  
		$this->form_validation->set_rules('room_type_name','Room type','trim|required');
	   
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Not updated.Something went wrong');
		$this->edit($room_type_id);
		} else {
			$condition=array('room_type_id!='=>$this->input->post('room_type_id'),'room_type_name'=>$this->input->post('room_type_name'),'is_delete!='=>"1");
            $row= $this->mroomtype->getRow('room_type',$condition);
            
			if(empty($row)){
					$udata = array(
			 	    'room_type_name' => $this->input->post('room_type_name'),
			         //'updated_by' =>$admin['user_id'],
			       // 'updated_on' => date('Y-m-d H:i:s'),
	                 );
	            
		            $condition=array('room_type_id' => $room_type_id);
		            $this->mcommon->update('room_type',$condition, $udata);
				 	$this->session->set_flashdata('success_message','Room type Updated successfully.');
				 	redirect('admin/roomtype');
		 	}else{

	               $this->session->set_flashdata('error_message','Room type already exits');
                   redirect('admin/roomtype');
            }
		 	 redirect('admin/roomtype');
		 	
	   }
    }
  

	
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $room_type_id = $_POST['recordId'];
	    $condition=array('room_type_id' => $room_type_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('room_type',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete() 
	{
    	$room_type_id= $this->input->post('room_type_id');
		//$condition=array('room_type_id' =>$room_type_id);
		//$row=$this->mcommon->getRow('food_category',$condition);
		$condition=array('room_type_id'=>$room_type_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('room_type',$condition,$udata);
		echo 1;
	}
  
	
   
	
	


	

}