<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 24/7/20
	    PURPOSE: food listing ,add , delete,status change and update
*/
class Food extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mfood');
		$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->mfood->getfoodList();
		$data['title']='Food List';
		$data['content']='admin/food_list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		$condition1=array('parent_id'=>0,'status'=>1,'is_delete='=>0);
		$data['cat_list'] =$this->mcommon->getDetails('food_category',$condition1);
		//echo $this->db->last_query();die;
		$data['title']='Food Add';
		$data['content']='admin/food_add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function edit($food_id)
	{
		$condition=array('status'=>1,'is_delete='=>0);
		$data['food_variant_list'] =$this->mcommon->getDetails('master_variant',$condition);
		//$data['cafe_list'] =$this->mcommon->getDetails('master_cafe',$condition);
		$condition1=array('parent_id'=>0,'status'=>1,'is_delete='=>0);
		$data['cat_list'] =$this->mcommon->getDetails('food_category',$condition1);
		$condition2=array('food_id'=>$food_id);
		//$condition=array('status'=>1,'is_delete='=>0,'parent_id!='=>0);
		//$data['sub_list'] =$this->mcommon->getDetails('food_category',$condition);
		$data['row'] =$this->mcommon->getRow('food',$condition2);
		//echo $this->db->last_query();die;
		$data['title']='Food Edit';
		$data['content']='admin/food_edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
		
	public function add_content()
	{  
		//echo "<pre>"; print_r($this->input->post());die;
	    $this->form_validation->set_rules('name','Food Name','trim|required');
	    $this->form_validation->set_rules('name','Food Name','trim|required');
	    $this->form_validation->set_rules('veg_nonveg','Veg or Nonveg','trim|required');
	   // $this->form_validation->set_rules('cafe_id','Cafe','required');
	    $this->form_validation->set_rules('category_id','Category','required');
	    //$this->form_validation->set_rules('subcategory_id','Subcategory','required');
	   // $this->form_validation->set_rules('description','Description','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		echo "val error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add();
		} else {
            
            if(!empty($_FILES['image']['name'])){

				$image_path = './public/upload_images/food_images';
                $file=$this->imageupload->image_upload_modified($image_path,'image');
				if($file['status']==1){
                    $data['image']=$file['result'];
                    //$image = $data['image'];
                }else{
                    $this->session->set_flashdata('error_msg',$file['result']);
                    $this->add();
				}
			} else{
				//$data['image']=" ";
			} 
          
			$idata = array(
		 		'name'   => $this->input->post('name'),
		        'price' => $this->input->post('price'),
		        'veg_nonveg' => $this->input->post('veg_nonveg'),
		        //'cafe_id' => $this->input->post('cafe_id'),
		        'category_id' => $this->input->post('category_id'),
		        //'subcategory_id' => $this->input->post('subcategory_id'),
                'image' => $data['image'],
                'description' => trim($this->input->post('description')),
		        'status' => 1,
		       // 'created_by' =>$admin['user_id'],
		        'created_on' => date('Y-m-d H:i:s'),
            );

		 	$food_id=$this->mcommon->insert('food', $idata);
		 	$this->session->set_flashdata('success_message','Food added successfully.');
		 	redirect('admin/food');
		 	
	   }
    }

     public function update_content()
	{   
	    //echo "<pre>"; print_r($this->input->post());die;
	    $food_id=$this->input->post('food_id');  
		  
	    $this->form_validation->set_rules('name','Food Name','trim|required');
	    $this->form_validation->set_rules('price','Price','trim|required');
	    $this->form_validation->set_rules('veg_nonveg','Veg or Nonveg','trim|required');
	   // $this->form_validation->set_rules('cafe_id','Cafe','required');
	    $this->form_validation->set_rules('category_id','Category','required');
	    //$this->form_validation->set_rules('subcategory_id','Subcategory','required');
	    //$this->form_validation->set_rules('description','Description','trim|required');
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		$this->session->set_flashdata('error_message','Not updated.Something went wrong');
		//echo "valida error";die;
	    $this->edit($food_id);
		} else {
			
            if(!empty($_FILES['image']['name'])){

				$image_path = './public/upload_images/food_images';
                $file=$this->imageupload->image_upload_modified($image_path,'image');
				if($file['status']==1){
                    $data['image']=$file['result'];
                   
                }else{
                    $this->session->set_flashdata('error_msg',$file['result']);
                    //redirect('admin/food/edit','refersh');
                    $this->edit($food_id);
				}
			} else{
				$data['image']=$this->input->post('old_image');
			} 
            
           
          
		 	$udata = array(
		 	    'name'   => $this->input->post('name'),
		        'price' => $this->input->post('price'),
		        'veg_nonveg' => $this->input->post('veg_nonveg'),
		        //'cafe_id' => $this->input->post('cafe_id'),
		        'category_id' => $this->input->post('category_id'),
		        //'subcategory_id' => $this->input->post('subcategory_id'),
                'image' => $data['image'],
                'description' => trim($this->input->post('description')),
		      
		        //'updated_by' =>$admin['user_id'],
		        'updated_on' => date('Y-m-d H:i:s'),
            );
            
            $condition=array('food_id' => $food_id);
            $this->mcommon->update('food',$condition, $udata);
		 	$this->session->set_flashdata('success_message','Food Updated successfully.');
		 	redirect('admin/food');
		 	
	   }
    }
    /*public function subcat_list()
	{
		$condition=array('parent_id'=>$this->input->post('category_id'),'status'=>1,'is_delete'=>0);
		$subcat_list=$this->mfood->getDetails('food_category',$condition); 
		$result=array('status'=>1,'data'=>$subcat_list);
		echo json_encode($result);
	}*/
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $food_id = $_POST['recordId'];
	    $condition=array('food_id' => $food_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('food',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete_img() 
	{
    	$food_id= $this->input->post('food_id');
		$condition=array('food_id' =>$food_id);
		$row=$this->mcommon->getRow('food',$condition);
		$condition=array('food_id'=>$food_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('food',$condition,$udata);
		$path="public/upload_images/food_images/".$row['images'];
        unlink($path); 
	    //echo 1;exit;
	    echo 1;
	}
	////////////food variant//////////////////////////////
  
	public function variant($food_id)
	{
		$data['list']=$this->mfood->getfoodVariantList($food_id);
		$data['title']='Food Variant List';
		$data['content']='admin/food/variant_list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add_variant($food_id)
	{
		$condition=array('status'=>1,'is_delete='=>0);
		$data['food_variant_list'] =$this->mcommon->getDetails('master_variant',$condition);
		$data['food_id']=$food_id;
		$condition1=array('food_id'=>$food_id);
		$row=$this->mcommon->getRow('food',$condition1);
		//print_r($row['name']);die;
		$data['food_name']=$row['name'];
		$data['title']='Food Variant Add';
		$data['content']='admin/food/variant_add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	public function edit_variant($food_id,$food_variant_id)
	{
		$condition=array('status'=>1,'is_delete='=>0);
		$data['food_variant_list'] =$this->mcommon->getDetails('master_variant',$condition);
		$data['food_id']=$food_id;
		$condition1=array('food_variant_id'=>$food_variant_id);
		$data['row']=$this->mcommon->getRow('food_variant',$condition1);
		$condition2=array('food_id'=>$food_id);
		$row=$this->mcommon->getRow('food',$condition2);
	    $data['food_name']=$row['name'];
		$data['title']='Food Variant Edit';
		$data['content']='admin/food/variant_edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	public function add_variant_content()
	{  
		$food_id=$this->input->post('food_id');
		//echo "<pre>"; print_r($this->input->post());die;
	    $this->form_validation->set_rules('food_variant_name','Food Variant Name','trim|required');
	    $this->form_validation->set_rules('food_variant_price','Food Variant Price','trim|required');
	  
	   if ($this->form_validation->run() == FALSE) {
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add_variant($this->input->post('food_id'));
		} else {
			$condition1=array('food_id' => $food_id);
			$food_variante_count =$this->mfood->food_variant_count('food_variant',$condition1);
			//echo $food_variante_count ;die;
			if($food_variante_count==0){
				//if($food_variante_count==0 && $this->input->post('is_default')==1){
                  $is_default=1;
			}else if($food_variante_count>0 && $this->input->post('is_default')!=1){
				  $is_default=0;

			}else if($this->input->post('is_default')==1){
				$is_default=$this->input->post('is_default');
				$udata = array(
			 		 'is_default' => 0,
			 		);
			 		$condition=array('food_id' => $food_id);
		 		    $this->mcommon->update('food_variant',$condition, $udata);

			}else if($this->input->post('is_default')==0){
				$is_default=$this->input->post('is_default');
			}
			 
                $idata = array(
		 		'food_id' => $this->input->post('food_id'),
		 		'food_variant_name' => $this->input->post('food_variant_name'),
		        'food_variant_price' => $this->input->post('food_variant_price'),
		        'status' => 1,
		        'is_default' => $is_default,
		        //'created_by' =>$admin['user_id'],
		        //'created_on' => date('Y-m-d H:i:s'),
                );
		 		$food_variant_id=$this->mcommon->insert('food_variant', $idata);
		 		if($food_variant_id){
		 			$udata = array(
			 		 'price' => $this->input->post('food_variant_price'),
			 		);
			 		$condition=array('food_id' => $food_id);
		 		    $this->mcommon->update('food',$condition, $udata);
			    }
		 	$this->session->set_flashdata('success_message','Food varient added successfully.');
		 	redirect('admin/food/variant/'.$this->input->post('food_id'));
		 	
	   }
    }
    public function update_variant_content()
	{  
		$food_variant_id=$this->input->post('food_variant_id');
		$food_id=$this->input->post('food_id');
		
	    $this->form_validation->set_rules('food_variant_name','Food Variant Name','trim|required');
	    $this->form_validation->set_rules('food_variant_price','Food Variant Price','trim|required');
	  
	   if ($this->form_validation->run() == FALSE) {
		
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->edit_variant($food_id,$food_variant_id);
		} else {
				if($this->input->post('is_default')==1){
					$is_default=$this->input->post('is_default');
					$udata = array(
				 		 'is_default' => 0,
				 		);
				 		$condition=array('food_id' => $food_id);
			 		    $this->mcommon->update('food_variant',$condition, $udata);

				}else if($this->input->post('is_default')==0){
					$is_default=$this->input->post('is_default');
				}
			 
                $udata = array(
		 		//'food_id' => $this->input->post('food_id'),
		 		'food_variant_name' => $this->input->post('food_variant_name'),
		        'food_variant_price' => $this->input->post('food_variant_price'),
		        'is_default' => $is_default,
		       // 'status' => 1,
		        //'created_by' =>$admin['user_id'],
		        //'created_on' => date('Y-m-d H:i:s'),
                );
                 $condition=array('food_variant_id' => $food_variant_id);
		 		 $this->mcommon->update('food_variant',$condition, $udata);
		 		 $food_data = array(
			 		 'price' => $this->input->post('food_variant_price'),
			 	);
			 	$condition1=array('food_id' => $food_id);
		 		$this->mcommon->update('food',$condition1, $food_data);
				$this->session->set_flashdata('success_message','Food varient Updated successfully.');
			 	redirect('admin/food/variant/'.$this->input->post('food_id'));
		 	
	   }
    }
    public function variant_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $food_variant_id = $_POST['recordId'];
	    $condition=array('food_variant_id' => $food_variant_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('food_variant',$condition, $udata);
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete_variant() 
	{
    	$food_variant_id= $this->input->post('food_variant_id');
		$condition=array('food_variant_id'=>$food_variant_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('food_variant',$condition,$udata);
		echo 1;
	}
	////////////food addon//////////////////////////////
  
	public function addon($food_id)
	{
		$data['list']=$this->mfood->getfoodAddonList($food_id);
		$data['title']='Food Addon List';
		$data['content']='admin/food/addon_list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add_addon($food_id)
	{
		$condition=array('status'=>1,'is_delete='=>0);
		$data['food_variant_list'] =$this->mcommon->getDetails('master_variant',$condition);
		$data['food_id']=$food_id;
		$condition1=array('food_id'=>$food_id);
		$row=$this->mcommon->getRow('food',$condition1);
		$data['food_name']=$row['name'];
		$data['title']='Food Addon Add';
		$data['content']='admin/food/addon_add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	public function edit_addon($food_id,$addon_id)
	{
		$data['food_id']=$food_id;
		$condition1=array('addon_id'=>$addon_id);
		$data['row']=$this->mcommon->getRow('food_addon',$condition1);
		$condition2=array('food_id'=>$food_id);
		$row=$this->mcommon->getRow('food',$condition2);
		$data['food_name']=$row['name'];
		$data['title']='Food Addon Edit';
		$data['content']='admin/food/addon_edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);

	}
	public function add_addon_content()
	{  
		$addon_id=$this->input->post('addon_id');
		$this->form_validation->set_rules('addon_text','Addon Name','trim|required');
	    $this->form_validation->set_rules('addon_price','Addon Price','trim|required');
	  
	   if ($this->form_validation->run() == FALSE) {
		
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add_variant($this->input->post('food_id'));
		} else {
			 
                $idata = array(
		 		'food_id' => $this->input->post('food_id'),
		 		'addon_text' => $this->input->post('addon_text'),
		        'addon_price' => $this->input->post('addon_price'),
		        'status' => 1,
		        //'created_by' =>$admin['user_id'],
		        //'created_on' => date('Y-m-d H:i:s'),
                );
		 		$addon_id=$this->mcommon->insert('food_addon', $idata);
		 		
		 	$this->session->set_flashdata('success_message','Food Addon added successfully.');
		    redirect('admin/food/addon/'.$this->input->post('food_id'));
		 	
	   }
    }
    public function update_addon_content()
	{  
		$addon_id=$this->input->post('addon_id');
		$food_id=$this->input->post('food_id');
		
	    $this->form_validation->set_rules('addon_text','Addon Name','trim|required');
	    $this->form_validation->set_rules('addon_price','Addon Price','trim|required');
	  
	    if ($this->form_validation->run() == FALSE) {
		
			$this->session->set_flashdata('error_message','Something went wrong.');
			$this->edit_addon($food_id,$addon_id);
		} else {
			 
                $udata = array(
		 		//'food_id' => $this->input->post('food_id'),
		 		'addon_text' => $this->input->post('addon_text'),
		        'addon_price' => $this->input->post('addon_price'),
		        'status' => 1,
		        //'created_by' =>$admin['user_id'],
		        //'created_on' => date('Y-m-d H:i:s'),
                );
                 $condition=array('addon_id' => $addon_id);
		 		 $this->mcommon->update('food_addon',$condition, $udata);
				 		
				 $this->session->set_flashdata('success_message','Food addon Updated successfully.');
				 redirect('admin/food/addon/'.$this->input->post('food_id'));
		 	
	   }
    }
    public function addon_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $addon_id = $_POST['recordId'];
	    $condition=array('addon_id' => $addon_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('food_addon',$condition, $udata);
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete_addon() 
	{
    	$addon_id= $this->input->post('addon_id');
		$condition=array('addon_id'=>$addon_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('food_addon',$condition,$udata);
		echo 1;
	}
   
   
	
	


	

}