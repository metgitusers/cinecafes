<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 24/7/20
	    PURPOSE: foodcategory listing ,add , delete,status change and update
*/
class Foodcategory extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mfoodcategory');
		$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->mfoodcategory->getfoodcategoryList();
		$data['title']='Food Category List';
		$data['content']='admin/foodcategory_list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function subcatgory_list($category_id)
	{
		$data['list']=$this->mfoodcategory->getfoodsubcategoryList($category_id);
		if(!empty($data['list'])){
    		foreach($data['list'] as $sub_list){
    			 $parent_id=$sub_list['parent_id'];
    		    $result1[] = $this->mfoodcategory->get_main_page($parent_id);
		        
        
    		}
    		$data['main_category']=$result1;
    	}
    	
		$data['title']='Food Subcategory List';
		$data['content']='admin/foodsubcat_list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		$condition1=array('parent_id'=>0,'status'=>1,'is_delete='=>0);
		$data['cat_list'] =$this->mcommon->getDetails('food_category',$condition1);
		$data['title']='Food Category Add';
		$data['content']='admin/foodcat_add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add_subcat($category_id)
	{
		$condition1=array('parent_id'=>0,'status'=>1,'is_delete='=>0);
		$data['cat_list'] =$this->mcommon->getDetails('food_category',$condition1);
		$data['category_id']=$category_id;
		$data['title']='Food Subcategory Add';
		$data['content']='admin/foodsubcat_add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	public function edit($category_id)
	{
		$condition=array('category_id'=>$category_id,'parent_id='=>0);
		$data['row'] =$this->mcommon->getRow('food_category',$condition);
		$data['title']='Food Category Edit';
		$data['content']='admin/foodcat_edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	public function subcat_edit($category_id)
	{
		$condition1=array('parent_id'=>0,'status'=>1,'is_delete='=>0);
		$data['cat_list'] =$this->mcommon->getDetails('food_category',$condition1);
		$data['category_id']=$category_id;
		$condition=array('category_id'=>$category_id,'parent_id!='=>0);
		$data['row'] =$this->mcommon->getRow('food_category',$condition);
	    $data['title']='Food Subcategory Edit';
		$data['content']='admin/foodsubcat_edit';
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
			$condition=array('category_name'=>$this->input->post('category_id'),'is_delete!='=>"1",'parent_id'=>"0");
            $row= $this->mfoodcategory->getRow('food_category',$condition);
            //echo $this->db->last_query();die;   
			if(empty($row)){
				//echo "insert";die;
	         	$idata = array(
			        'category_name' => $this->input->post('category_id'),
			        'parent_id' => 0,
			        'status' => 1,
			       // 'created_by' =>$admin['user_id'],
			        'created_on' => date('Y-m-d H:i:s'),
	            );

			 	$insert_id=$this->mcommon->insert('food_category', $idata);
			 	$this->session->set_flashdata('success_message','Food Category added successfully.');
			 	redirect('admin/foodcategory');
		 	}else{
		 		//echo "not insert";die;

	               $this->session->set_flashdata('error_message','Food Category already exits');
                   redirect('admin/foodcategory');
              }
		 	 redirect('admin/foodcategory');
	   }
    }
    public function addsub_content()
	{  
	    $this->form_validation->set_rules('category_id','Category','required');
	    $this->form_validation->set_rules('subcategory_id','Subcategory','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add_subcat();
		} else {
			//$condition=array('category_name'=>$this->input->post('category_id'),'is_delete!='=>"1");
            //$row= $this->mfoodcategory->getRow('food_category',$condition);
            //echo $this->db->last_query();die;   
			//if(empty($row)){
				//echo "insert";die;
	         	$idata = array(
			        'category_name' => $this->input->post('subcategory_id'),
			        'parent_id' => $this->input->post('category_id'),
			        'status' => 1,
			       // 'created_by' =>$admin['user_id'],
			        'created_on' => date('Y-m-d H:i:s'),
	            );

			 	$insert_id=$this->mcommon->insert('food_category', $idata);
			 	$this->session->set_flashdata('success_message','Food Subcategory added successfully.');
			 	redirect('admin/foodcategory/subcatgory_list/'.$this->input->post('category_id'));
			 	//$this->add_subcat();
		 	//}else{
		 		//echo "not insert";die;

	              // $this->session->set_flashdata('error_message','Food Category already exits');
                  // redirect('admin/foodcategory');
            //  }
		 	// redirect('admin/foodcategory');
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
            $row= $this->mfoodcategory->getRow('food_category',$condition);
            
			if(empty($row)){
					$udata = array(
			 	    'category_name' => $this->input->post('category_name'),
			        'parent_id' => 0,
	                //'updated_by' =>$admin['user_id'],
			        'updated_on' => date('Y-m-d H:i:s'),
	                 );
	            
		            $condition=array('category_id' => $category_id);
		            $this->mcommon->update('food_category',$condition, $udata);
				 	$this->session->set_flashdata('success_message','Food Category Updated successfully.');
				 	redirect('admin/foodcategory');
		 	}else{

	               $this->session->set_flashdata('error_message','Food Category already exits');
                   redirect('admin/foodcategory');
            }
		 	 redirect('admin/foodcategory');
		 	
	   }
    }
    public function updatesub_content()
	{  
		$category_id=$this->input->post('category_id');
	    $this->form_validation->set_rules('category_id','Category','required');
	    $this->form_validation->set_rules('subcategory_id','Subcategory','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->edit_subcat($this->input->post('parent_id'));
		} else {
			//$condition=array('category_name'=>$this->input->post('category_id'),'is_delete!='=>"1");
            //$row= $this->mfoodcategory->getRow('food_category',$condition);
            //echo $this->db->last_query();die;   
			//if(empty($row)){
				//echo "update";die;
	         	$udata = array(
			        'category_name' => $this->input->post('subcategory_id'),
			        'parent_id' => $this->input->post('parent_id'),
			        'status' => 1,
			       // 'updated_by' =>$admin['user_id'],
			        'updated_on' => date('Y-m-d H:i:s'),
	            );
                $condition=array('category_id' => $category_id);  
			 	$this->mcommon->update('food_category',$condition, $udata);
			 	$this->session->set_flashdata('success_message','Food Subcategory updated successfully.');
			 	redirect('admin/foodcategory/subcatgory_list/'.$this->input->post('parent_id'));
			 	//$this->add_subcat();
		 	//}else{
		 		//echo "not update";die;

	              // $this->session->set_flashdata('error_message','Food Category already exits');
                  // redirect('admin/foodcategory');
            //  }
		 	// redirect('admin/foodcategory');
	   }
    }

	
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive1"){
		$status = $_POST['status'];
	    $category_id = $_POST['recordId'];
	    $condition=array('category_id' => $category_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('food_category',$condition, $udata);
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
		$row=$this->mcommon->getRow('food_category',$condition);
		$condition=array('category_id'=>$category_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('food_category',$condition,$udata);
		echo 1;
	}
  
	
   
	
	


	

}