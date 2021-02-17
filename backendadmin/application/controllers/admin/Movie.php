<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 28/7/20
	    PURPOSE: Movie listing ,add , delete,status change and update
*/
class Movie extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mmovie');
		$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->mmovie->getmovieList();
		if($data['list']){
			foreach ($data['list'] as $key => $value) {
				//get image for movie
				$images = $this->mcommon->select('movie_images mi', ['mi.movie_id'=> $value['movie_id'], 'mi.is_default'=> 1], '*');
				$img = '';
				if($images){
					$img = !empty($images[0]->thumbnail)?base_url($images[0]->thumbnail):'';
				}
				$data['list'][$key]['image'] = $img;
			}
		}
		//print_r($data['list']); die;
		$data['title']='Movie List';
		$data['content']='admin/movie/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		$condition=array('status'=>1,'is_delete='=>0);
		$data['cat_list'] =$this->mcommon->getDetails('movie_category',$condition);

		$data['cafe_list'] =$this->mcommon->getDetails('master_cafe',$condition);
		$data['title']='Movie Add';
		$data['content']='admin/movie/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function edit($movie_id)
	{
		//$condition=array('status'=>1,'is_delete='=>0);
		//$data['cafe_list'] =$this->mcommon->getDetails('master_cafe',$condition);
		$condition=array('status'=>1,'is_delete='=>0);
		$data['cat_list'] =$this->mcommon->getDetails('movie_category',$condition);

		$data['cafe_list'] =$this->mcommon->getDetails('master_cafe',$condition);
		$condition_movie=array('movie_id'=>$movie_id);
		$data['row'] =$this->mcommon->getRow('movie',$condition_movie);

		$data['img_list']=$this->mcommon->getDetails("movie_images",$condition_movie);

		$movie_cafe_list=$this->mcommon->getDetails('movie_cafe_mapping',$condition_movie);
		$movie_cafe_arr=array();
		if(!empty($movie_cafe_list))
		{
			for($i=0;$i<count($movie_cafe_list);$i++)
			{
				$movie_cafe_arr[]=$movie_cafe_list[$i]['cafe_id'];
			}
		}
		$data['movie_cafe_arr']=$movie_cafe_arr;

		$data['movie_id']=$movie_id;
		//echo $this->db->last_query();die;
		$data['title']='Movie Edit';
		$data['content']='admin/movie/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
		
	public function add_content()
	{  
		// $cafe_movie_arr=$this->input->post('cafe_movie');
		// echo "<pre>"; print_r($cafe_movie_arr);die;
	    $this->form_validation->set_rules('name','Movie Name','trim|required');
	    
	    $this->form_validation->set_rules('category_id','Category','required');
	    $this->form_validation->set_rules('duration','Duration','required');
	    //$this->form_validation->set_rules('description','Description','trim|required');

	
		if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
		$this->session->set_flashdata('Movie_error_message','Something went wrong.Please try again');
		$this->add();
		} 
		/*else if($this->input->post('description')){
			//$description=trim($this->input->post('description'));
		    	//$this->form_validation->set_rules('description','Description','trim|required');
		    	$this->session->set_flashdata('description_error_message','Please enter description.only spaces are not allowed.');
		    	//$this->add();
		    	if($this->input->post()){
		    	$this->session->set_flashdata('name',$this->input->post('name'));
		    	$this->session->set_flashdata('price',$this->input->post('price'));
		    	$this->session->set_flashdata('category_id',$this->input->post('category_id'));
		    	$this->session->set_flashdata('duration',$this->input->post('duration'));
		    	$this->session->set_flashdata('minute',$this->input->post('minute'));
		        }
		    	redirect('admin/movie/add');
	        }*/
	        else{
            // if(!empty($_FILES['image']['name'])){
			// 	$image_path = './public/upload_images/movie_images';
            //     $file=$this->imageupload->image_upload_modified($image_path,'image');
			// 	if($file['status']==1){
            //         $data['image']=$file['result'];
            //         //$image = $data['image'];
            //     }else{
            //         $this->session->set_flashdata('Movie_error_message',$file['result']);
            //         $this->add();
			// 	}
			// } else{
			// 	//$data['image']=" ";
			// } 
			if(empty($this->input->post('minute'))){
				$movie_duration=$this->input->post('duration');

			}else{
				$movie_duration=$this->input->post('duration').'.'.$this->input->post('minute');
			}
          
			$idata = array(
		 		'name'   => $this->input->post('name'),
		        'category_id' => $this->input->post('category_id'),
		        //'duration' => $this->input->post('duration'),
		        //'duration' => $this->input->post('duration').'.'.$this->input->post('minute'),
		        'duration' => $movie_duration,
                //'image' => $data['image'],
                'description' => trim($this->input->post('description')),
		        'status' => 1,
		       // 'created_by' =>$admin['user_id'],
		       // 'created_on' => date('Y-m-d H:i:s'),
            );

		 	$movie_id=$this->mcommon->insert('movie', $idata);
		 	if($movie_id>0){
			/*--------------------- save moview poster-------------------*/
			$attr_val = [];
			if($image_array = $this->input->post('movie_images')){
				foreach($image_array as $key => $value){
				  //echo $value;
				  $match_string = substr($value, 0, 5);
				  if($match_string == 'data:'){
					list($type, $value) = explode(';', $value);
					list(, $value)      = explode(',', $value);
					$decoded=base64_decode($value);
					$img_name = $key.'_'.time().'.jpg';
					$img_path = getcwd().'/public/upload_images/movie_images/'.$img_name;
					if(file_put_contents($img_path, $decoded)){
						//create thumbnails
					$thumbnail = $this->doImageThumbnail($source = $img_path, $img_name = $img_name);
					$attr_val[] = array(
						'image'=> $img_name,
						'thumbnail'=> $thumbnail,
						'movie_id'=> $movie_id,
						'is_default'=> $key == 0?1:0
						);
					}
				  }
				}
				if(!empty($attr_val)){
					$this->mcommon->batch_insert('movie_images', $attr_val);
				}
			  }
		 	///////////////////////////added for cafe movie mapping////////////////////////////////
		 	$cafe_movie_arr=$this->input->post('cafe_movie');	
		 		if(!empty($cafe_movie_arr))
		 		{
				 	foreach ($cafe_movie_arr as $cafe_id) {
				 		$cafe_movie_data=array();
				 		$cafe_movie_data['movie_id']=$movie_id;
				 		$cafe_movie_data['cafe_id']=$cafe_id;
				 		$this->mcommon->insert('movie_cafe_mapping', $cafe_movie_data);
				 	}
			 	}
		 	/////////////////////////////////////////////////////////////////////////////////////////

			 	/* multiple product image upload*/
				// if(!empty($_FILES["files"]["name"][0])){
		    	// 	$imageDetailArray 		= array();
				// 	$config = array(
				// 		'upload_path'   => './public/upload_images/movie_images',
				// 		'allowed_types' => '*',
				// 		'overwrite'     => 1,  
				// 		'max_size'      => 0
				// 	);
				// 	$this->load->library('upload', $config);				
				// 	$images = array();
				// 	foreach ($_FILES["files"]["name"] as $key => $image_list) {
				// 		$_FILES['images[]']['name']		= $_FILES["files"]["name"][$key];
				// 		$_FILES['images[]']['type']		= $_FILES["files"]["type"][$key];
				// 		$_FILES['images[]']['tmp_name']	= $_FILES["files"]["tmp_name"][$key];
				// 		$_FILES['images[]']['error']	= $_FILES["files"]['error'][$key];
				// 		$_FILES['images[]']['size']		= $_FILES["files"]['size'][$key];
				// 		$this->upload->initialize($config);

				// 		if ($this->upload->do_upload('images[]')) {
				// 			$imageDetailArray 		= $this->upload->data();
				// 			$imgArry[]				= $imageDetailArray['file_name'];
							
				// 		} else {
				// 			//echo "11";exit;								
				// 			$error = $this->upload->display_errors();	
				// 			//$this->session->set_flashdata('success_message','');					
				// 			$this->session->set_flashdata('error_message', $error);
				// 			redirect('admin/movie/add');
				// 		}
				// 	}
				// 	//echo "<pre>"; print_r($imgArry);die;
				// 	if(!empty($imgArry)){
				// 		foreach($imgArry as $img){	
				// 			$movie_images	= array('movie_id'=>$movie_id,'image'  => $img);
				// 			$this->mcommon->insert('movie_images',$movie_images);
				// 			//echo $this->db->last_query();die;
				// 		}						
				// 		//$this->session->set_flashdata('error_msg','');
				// 		//$this->session->set_flashdata('success_msg','Cafe image added successfully');				
						
				// 	}
				// }

			/* multiple product image upload*/
		 	 } 
		 	$this->session->set_flashdata('Movie_success_message','Movie added successfully.');
		 	redirect('admin/movie');
		 	
	   }
    }

    public function update_content()
	{
	    $movie_id=$this->input->post('movie_id');  
		  
	    $this->form_validation->set_rules('name','Movie Name','trim|required');
	   
	    $this->form_validation->set_rules('category_id','Category','required');
	    $this->form_validation->set_rules('duration','Duration','required');
	   // $this->form_validation->set_rules('description','Description','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		$this->session->set_flashdata('Movie_error_message','Not updated.Something went wrong');
	    $this->edit($movie_id);
		} 
		/*else if($this->input->post('description')){
		    	$this->form_validation->set_rules('description','Description','trim|required');
		    	$this->session->set_flashdata('description_error_message','Please enter description. only spaces are not allowed.');
		    	$this->edit($movie_id);
		    	
	        }*/
	        else{
			
            /*--------------------- save moview poster-------------------*/
			$attr_val = [];
			if($image_array = $this->input->post('movie_images')){
				foreach($image_array as $key => $value){
				  //echo $value;
				  $match_string = substr($value, 0, 5);
				  if($match_string == 'data:'){
					list($type, $value) = explode(';', $value);
					list(, $value)      = explode(',', $value);
					$decoded=base64_decode($value);
					$img_name = $key.'_'.time().'.jpg';
					$img_path = getcwd().'/public/upload_images/movie_images/'.$img_name;
					if(file_put_contents($img_path, $decoded)){
						//create thumbnails
					$thumbnail = $this->doImageThumbnail($source = $img_path, $img_name = $img_name);
					$attr_val[] = array(
						'image'=> $img_name,
						'thumbnail'=> $thumbnail,
						'movie_id'=> $movie_id,
						'is_default'=> $key == 0?1:0
						);
					}
				  }
				}
				if(!empty($attr_val)){
					$this->mcommon->batch_insert('movie_images', $attr_val);
				}
			  }
		 	///////////////////////////added for cafe movie mapping////////////////////////////////
			if(empty($this->input->post('minute'))){
				$movie_duration=$this->input->post('duration');

			}else{
				$movie_duration=$this->input->post('duration').'.'.$this->input->post('minute');

			}
            
           
          
		 	$udata = array(
		 	    'name'   => $this->input->post('name'),
		        'category_id' => $this->input->post('category_id'),
		        //'duration' => $this->input->post('duration'),
		        //'duration' => $this->input->post('duration').'.'.$this->input->post('minute'),
		        'duration' => $movie_duration,
                //'image' => $data['image'],
                'description' => trim($this->input->post('description')),
		        //'updated_by' =>$admin['user_id'],
		        //'updated_on' => date('Y-m-d H:i:s'),
            );
            
            $condition=array('movie_id' => $movie_id);
            $this->mcommon->update('movie',$condition, $udata);

            /* multiple product image upload*/
				// if(!empty($_FILES["files"]["name"][0])){
		    	// 	$imageDetailArray 		= array();
				// 	$config = array(
				// 		'upload_path'   => './public/upload_images/movie_images',
				// 		'allowed_types' => '*',
				// 		'overwrite'     => 1,  
				// 		'max_size'      => 0
				// 	);
				// 	$this->load->library('upload', $config);				
				// 	$images = array();
				// 	foreach ($_FILES["files"]["name"] as $key => $image_list) {
				// 		$_FILES['images[]']['name']		= $_FILES["files"]["name"][$key];
				// 		$_FILES['images[]']['type']		= $_FILES["files"]["type"][$key];
				// 		$_FILES['images[]']['tmp_name']	= $_FILES["files"]["tmp_name"][$key];
				// 		$_FILES['images[]']['error']	= $_FILES["files"]['error'][$key];
				// 		$_FILES['images[]']['size']		= $_FILES["files"]['size'][$key];
				// 		$this->upload->initialize($config);
				// 		if ($this->upload->do_upload('images[]')) {
				// 			$imageDetailArray 		= $this->upload->data();
				// 			$imgArry[]				= $imageDetailArray['file_name'];
				// 		} else {							
				// 			$error = $this->upload->display_errors();
				// 			$this->session->set_flashdata('error_message', $error);
				// 			redirect('admin/movie/add');
				// 		}
				// 	}
				// 	if(!empty($imgArry)){
				// 		foreach($imgArry as $img){	
				// 			$movie_images	= array('movie_id'=>$movie_id,'image'  => $img);
				// 			$this->mcommon->insert('movie_images',$movie_images);
				// 		}
						
				// 	}
				// }

			/* multiple product image upload*/
		 	//echo $this->db->last_query();die;
		 		
		 	$this->session->set_flashdata('Movie_success_message','Movie Updated successfully.');
		 	redirect('admin/movie');
	   }
    }
   
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $movie_id = $_POST['recordId'];
	    $condition=array('movie_id' => $movie_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('movie',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete_img() 
	{
    	$movie_id= $this->input->post('movie_id');
		$condition=array('movie_id' =>$movie_id);
		$row=$this->mcommon->getRow('movie',$condition);
		$condition=array('movie_id'=>$movie_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('movie',$condition,$udata);
		$path="public/upload_images/movie_images/".$row['image'];
        unlink($path); 
	    //echo 1;exit;
	    echo 1;
	}

/** added by ishani for delete more img  */
	public function delete_more_img() 
	{
    	$movie_img_id		= $this->input->post('movie_img_id');
		$condition=array('movie_img_id' =>$movie_img_id);
		$row=$this->mcommon->getRow('movie_images',$condition);
		$this->mcommon->delete('movie_images',$condition);
		$path="public/upload_images/movie_images/".$row['image'];
        unlink($path); 
	    //echo 1;exit;
	    echo 1;
	}
  
	
   /** cafe movie delete or insert from edit page **/
   public function changecafemovie()
	{
		
		$status = $_POST['status'];
	    $movie_id = $_POST['movie_id'];
	    $cafe_id = $_POST['cafe_id'];
	    $data=array('movie_id' => $movie_id,'cafe_id'=>$cafe_id);
		if($status==1)	
		{
			$inserted_id=$this->mcommon->insert('movie_cafe_mapping',$data);
			if($inserted_id>0)
			{
				echo 1; 
				die;
			}
		} 
		else
		{
			$this->mcommon->delete('movie_cafe_mapping',$data);
			echo 1; die;
		}   		
		echo 0;
		die;
		
    }
 
}