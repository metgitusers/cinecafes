<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 28/7/20
	    PURPOSE: cafe listing ,add , delete,status change and update
*/
class Cafe extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mcafe');
		$this->load->library('imageupload');

		ini_set("allow_url_fopen", 1);
		ini_set("allow_url_include", 1);
	}
	public function index()
	{
		$data['list']=$this->mcafe->getCafeList();
		if(!empty($data['list'])){
			foreach($data['list'] as $img_list){
				
				$image_list[$img_list['cafe_id']] = $this->mcafe->getImages($img_list['cafe_id']);
        	}
			
			$data['cafe_img_list']['image_list']	= $image_list;	
			//echo "<pre>";print_r($data['product_img_list']['image_list']);die;
		}
		$data['title']='Cafe List';
		$data['content']='admin/cafe/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		$data['title']='Cafe Add';
		$data['content']='admin/cafe/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function edit($cafe_id)
	{
		$condition=array('cafe_id'=>$cafe_id);
		$data['row'] =$this->mcommon->getRow('master_cafe',$condition);
		$data['img_list']=$this->mcafe->getallImages($cafe_id);
		//echo $this->db->last_query();die;
		$data['title']='Cafe Edit';
		$data['content']='admin/cafe/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
		
	public function add_content()
	{  
		//echo "<pre>"; print_r($this->input->post());die;
	    //$this->form_validation->set_rules('cafe_name','Cafe Name','trim|required');
	    //$this->form_validation->set_rules('price','Price','trim|required');
	    $this->form_validation->set_rules('phone','phone','required');
	    $this->form_validation->set_rules('cafe_place','location','trim|required');
	    $this->form_validation->set_rules('autocomplete','address','trim|required');
	   // $this->form_validation->set_rules('opening_hours','opening hours','required');
	    $this->form_validation->set_rules('start_time','Start time','trim|required');
	    $this->form_validation->set_rules('end_time','End time','trim|required');
	   
	   // $this->form_validation->set_rules('cafe_description','Description','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add();
		} else {
			/////////////////////////////////////////////////////////
		
			///////////////////////////////////////////////////////
			$address = $this->input->post('autocomplete'); // Address
			// echo $address;die;
			//$apiKey = 'api-key'; // Google maps now requires an API key.
			$apiKey = 'AIzaSyBygzKjcQExaecyS1lz35vPwzLRhhqRBfk'; // Google maps now requires an API key.
			// Get JSON results from this request
			$geo = "";
			// $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
			// $geo = json_decode($geo, true); // Convert the JSON to an array
			//var_dump($geo);
			$latitude = "";
			$longitude = "";
			if (isset($geo['status']) && ($geo['status'] == 'OK')) {
				$latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
				$longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
				//echo $latitude.'    '. $longitude; die;
			}

			///defult price settings
			$condition_default_price['id']=1;
			$defult_price_row=$this->mcommon->getRow("price_settings",$condition_default_price);
			$defult_price=$defult_price_row['cafe_price'];
            
            $admin=$this->session->userdata('admin');
			$idata = array(
		 		'cafe_name'   => $this->input->post('cafe_name'),
		 		'cafe_place'   => $this->input->post('cafe_place'),
		 		'cafe_location'   => $address,
		 		'cafe_lat'   => $latitude,
		 		'cafe_lng'   => $longitude,
		        'price' => $defult_price,
		        'phone' => $this->input->post('phone'),
		       // 'opening_hours' => $this->input->post('opening_hours'),
		        'opening_hours' => $this->input->post('start_time').'-'.$this->input->post('end_time'),
		        'start_time' => $this->input->post('start_time'),
		        'end_time' => $this->input->post('end_time'),
		        
                //'image' => $data['image'],
                'cafe_description' => trim($this->input->post('cafe_description')),
		        'status' => 1,
		        'created_by' =>$admin['user_id'],
		        'created_on' => date('Y-m-d H:i:s')
            );

		 	$cafe_id=$this->mcommon->insert('master_cafe', $idata);
		 	/* multiple product image upload*/
			if(!empty($_FILES["files"]["name"][0])){
		    		$imageDetailArray 		= array();
					//echo  "okk";exit;
					$config = array(
						'upload_path'   => './public/upload_images/cafe_images',
						'allowed_types' => '*',
						'overwrite'     => 1,  
						'max_size'      => 0
					);
					$this->load->library('upload', $config);				
					$images = array();
					foreach ($_FILES["files"]["name"] as $key => $image_list) {
						$_FILES['images[]']['name']		= $_FILES["files"]["name"][$key];
						$_FILES['images[]']['type']		= $_FILES["files"]["type"][$key];
						$_FILES['images[]']['tmp_name']	= $_FILES["files"]["tmp_name"][$key];
						$_FILES['images[]']['error']	= $_FILES["files"]['error'][$key];
						$_FILES['images[]']['size']		= $_FILES["files"]['size'][$key];
						$this->upload->initialize($config);

						if ($this->upload->do_upload('images[]')) {
							$imageDetailArray 		= $this->upload->data();
							$imgArry[]				= $imageDetailArray['file_name'];
							
						} else {
							//echo "11";exit;								
							$error = $this->upload->display_errors();	
							$this->session->set_flashdata('success_message','');					
							$this->session->set_flashdata('error_message', $error);
							redirect('admin/cafe/add');
						}
					}
					//echo "<pre>"; print_r($imgArry);die;
					if(!empty($imgArry)){
						foreach($imgArry as $img){	
							$cafe_images	= array('cafe_id'=>$cafe_id,'image'  => $img);
							$this->mcommon->insert('cafe_images',$cafe_images);
							//echo $this->db->last_query();die;
						}						
						$this->session->set_flashdata('error_msg','');
						$this->session->set_flashdata('success_msg','Cafe image added successfully');				
						
					}
				}

			/* multiple product image upload*/
		 	$this->session->set_flashdata('success_message','Cafe added successfully.');
		 	redirect('admin/cafe');
		 	
	   }
    }
    public function update_content()
	{  
		$cafe_id=$this->input->post('cafe_id');
		//echo "<pre>"; print_r($this->input->post());die;
	    $this->form_validation->set_rules('cafe_name','Cafe Name','trim|required');
	    //$this->form_validation->set_rules('price','Price','trim|required');
	    $this->form_validation->set_rules('phone','phone','required');
	   $this->form_validation->set_rules('cafe_place','location','trim|required');
	    $this->form_validation->set_rules('autocomplete','address','trim|required');
	    //$this->form_validation->set_rules('opening_hours','opening hours','required');
	    $this->form_validation->set_rules('start_time','Start time','trim|required');
	    $this->form_validation->set_rules('end_time','End time','trim|required');
	   
	   // $this->form_validation->set_rules('cafe_description','Description','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
		$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add();
		} else {

			/////////////////////////////////////////////
			 $address = $this->input->post('autocomplete'); // Address
			// echo $address;die;
			//$apiKey = 'api-key'; // Google maps now requires an API key.
			$apiKey = 'AIzaSyBygzKjcQExaecyS1lz35vPwzLRhhqRBfk'; // Google maps now requires an API key.
			// Get JSON results from this request
			$latitude = "";
			$longitude = "";
			// $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
			// $geo = json_decode($geo, true); // Convert the JSON to an array
			//var_dump($geo);

			if (isset($geo['status']) && ($geo['status'] == 'OK')) {
				$latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
				$longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
				//echo $latitude.'    '. $longitude; die;
			}
			///////////////////////////////////////////
            
            $admin=$this->session->userdata('admin');
			$udata = array(
		 		'cafe_name'   => $this->input->post('cafe_name'),
		 		'cafe_place'   => $this->input->post('cafe_place'),
		 		'cafe_location'   => $address,
		 		'cafe_lat'   => $latitude,
		 		'cafe_lng'   => $longitude,
		        //'price' => $this->input->post('price'),
		        'phone' => $this->input->post('phone'),
		       // 'opening_hours' => $this->input->post('opening_hours'),
		        'opening_hours' => $this->input->post('start_time').'-'.$this->input->post('end_time'),
		        'start_time' => $this->input->post('start_time'),
		       
		        'end_time' => $this->input->post('end_time'),
		        
                'cafe_description' => trim($this->input->post('cafe_description')),
		        //'status' => 1,
		        'updated_by' =>$admin['user_id'],
		        'update_on' => date('Y-m-d H:i:s'),
            );
            $condition=array('cafe_id'=>$cafe_id);
		 	$this->mcommon->update('master_cafe',$condition, $udata);
		 	//echo $this->db->last_query();die;
		 	/* multiple product image upload*/
			if(!empty($_FILES["files"]["name"][0])){
		    		$imageDetailArray 		= array();
					//echo  "okk";exit;
					$config = array(
						'upload_path'   => './public/upload_images/cafe_images',
						'allowed_types' => '*',
						'overwrite'     => 1,  
						'max_size'      => 0
					);
					$this->load->library('upload', $config);				
					$images = array();
					foreach ($_FILES["files"]["name"] as $key => $image_list) {
						$_FILES['images[]']['name']		= $_FILES["files"]["name"][$key];
						$_FILES['images[]']['type']		= $_FILES["files"]["type"][$key];
						$_FILES['images[]']['tmp_name']	= $_FILES["files"]["tmp_name"][$key];
						$_FILES['images[]']['error']	= $_FILES["files"]['error'][$key];
						$_FILES['images[]']['size']		= $_FILES["files"]['size'][$key];
						$this->upload->initialize($config);

						if ($this->upload->do_upload('images[]')) {
							$imageDetailArray 		= $this->upload->data();
							$imgArry[]				= $imageDetailArray['file_name'];
							
						} else {
							//echo "11";exit;								
							$error = $this->upload->display_errors();	
							$this->session->set_flashdata('success_message','');					
							$this->session->set_flashdata('error_message', $error);
							redirect('admin/cafe/edit'.$cafe_id);
						}
					}
					//echo "<pre>"; print_r($imgArry);die;
					if(!empty($imgArry)){
						foreach($imgArry as $img){	
							$cafe_images	= array('cafe_id'=>$cafe_id,'image'  => $img);
							$this->mcommon->insert('cafe_images',$cafe_images);
							//echo $this->db->last_query();die;
						}						
						$this->session->set_flashdata('error_msg','');
						$this->session->set_flashdata('success_msg','Cafe image Updated successfully');				
						
					}
				}

			/* multiple product image upload*/
		 	$this->session->set_flashdata('success_message','Cafe Updated successfully.');
		 	redirect('admin/cafe');
		 	
	   }
    }
  
	public function approval_status()
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
    
	public function delete_img() 
	{
    	$cafe_img_id		= $this->input->post('cafe_img_id');
		$condition=array('cafe_img_id' =>$cafe_img_id);
		$row=$this->mcommon->getRow('cafe_images',$condition);
		$this->mcommon->delete('cafe_images',$condition);
		$path="public/upload_images/cafe_images/".$row['image'];
        unlink($path); 
	    //echo 1;exit;
	    echo 1;
	}
	
	public function delete() 
	{
    	$cafe_id= $this->input->post('cafe_id');
		$condition=array('cafe_id'=>$cafe_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('master_cafe',$condition,$udata);
		//echo $this->db->last_query();die;
		echo 1;
	}
}