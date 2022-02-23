<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 29/7/20
	    PURPOSE: moviecategory listing ,add , delete,status change and update
*/
class Moviecategory extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mmoviecategory');
		//$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->mmoviecategory->getmoviecategoryList();
		$data['title']='Movie Category List';
		$data['content']='admin/movie_category/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
	public function add()
	{
		//$condition1=array('parent_id'=>0,'status'=>1,'is_delete='=>0);
		//$condition=array('status'=>1,'is_delete='=>0);
		//$data['cat_list'] =$this->mcommon->getDetails('movie_category',$condition);
		$data['title']='Movie Category Add';
		$data['content']='admin/movie_category/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
	public function edit($category_id)
	{
		$condition=array('category_id'=>$category_id);
		$data['row'] =$this->mcommon->getRow('movie_category',$condition);
		$data['title']='Movie Category Edit';
		$data['content']='admin/movie_category/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	
		
	public function add_content()
	{  
	    $this->form_validation->set_rules('category_id','Category','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add();
		} else {
			$condition=array('category_name'=>$this->input->post('category_id'),'is_delete!='=>"1");
            $row= $this->mmoviecategory->getRow('movie_category',$condition);
            //echo $this->db->last_query();die;   
			if(empty($row)){
				//echo "insert";die;
	         	$idata = array(
			        'category_name' => $this->input->post('category_id'),
			       // 'parent_id' => 0,
			        'status' => 1,
			       // 'created_by' =>$admin['user_id'],
			       // 'created_on' => date('Y-m-d H:i:s'),
	            );

			 	$insert_id=$this->mcommon->insert('movie_category', $idata);
			 	$this->session->set_flashdata('success_message','Movie Category added successfully.');
			 	redirect('admin/moviecategory');
		 	}else{
		 		//echo "not insert";die;

	               $this->session->set_flashdata('error_message','Movie Category already exits');
                   redirect('admin/moviecategory');
              }
		 	 redirect('admin/moviecategory');
	   }
    }
  


    public function update_content()
	{   
	    //echo "<pre>"; print_r($this->input->post());die;
	    $category_id=$this->input->post('category_id');  
		$this->form_validation->set_rules('category_name','Category','trim|required');
	   
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Not updated.Something went wrong');
		$this->edit($category_id);
		} else {
			$condition=array('category_id!='=>$this->input->post('category_id'),'category_name'=>$this->input->post('category_name'),'is_delete!='=>"1");
            $row= $this->mmoviecategory->getRow('movie_category',$condition);
            
			if(empty($row)){
					$udata = array(
			 	    'category_name' => $this->input->post('category_name'),
			        //'parent_id' => 0,
	                //'updated_by' =>$admin['user_id'],
			       // 'updated_on' => date('Y-m-d H:i:s'),
	                 );
	            
		            $condition=array('category_id' => $category_id);
		            $this->mcommon->update('movie_category',$condition, $udata);
				 	$this->session->set_flashdata('success_message','Movie Category Updated successfully.');
				 	redirect('admin/moviecategory');
		 	}else{

	               $this->session->set_flashdata('error_message','Movie Category already exits');
                   redirect('admin/moviecategory');
            }
		 	 redirect('admin/moviecategory');
		 	
	   }
    }
  

	
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $category_id = $_POST['recordId'];
	    $condition=array('category_id' => $category_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('movie_category',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete() 
	{
    	$category_id= $this->input->post('category_id');
		$condition=array('category_id' =>$category_id);
		//$row=$this->mcommon->getRow('food_category',$condition);
		$condition=array('category_id'=>$category_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('movie_category',$condition,$udata);
		echo 1;
	}
  
	
   
	
	


	

}