<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
		AUTHOR NAME: Soma Nandi Dutta
		DATE: 30/7/20
	    PURPOSE: Room listing ,add , delete,status change and update
*/
class Room extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		$this->load->model('admin/mroom');
		$this->load->library('imageupload');
	}
	public function index()
	{
		$data['list']=$this->mroom->getroomList();
		$data['title']='Room List';
		$data['content']='admin/room/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function add()
	{
		//pr($this->check_valid_admin());
		$data['cafe_list'] =$this->getCafeList();
		
		$condition=array('status'=>1,'is_delete='=>0);
		$data['roomtype_list'] =$this->mcommon->getDetails('room_type',$condition);
		
		$data['title']='Room Add';
		$data['content']='admin/room/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function edit($room_id)
	{
		$data['cafe_list'] =$this->getCafeList();
		
		$condition=array('status'=>1,'is_delete='=>0);
		$data['roomtype_list'] =$this->mcommon->getDetails('room_type',$condition);
		$condition=array('room_id'=>$room_id);
		$data['row'] =$this->mcommon->getRow('room',$condition);
		//echo $this->db->last_query();die;
		$data['title']='Room Edit';
		$data['content']='admin/room/edit';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
		
	public function add_content()
	{  
		//echo "<pre>"; print_r($this->input->post());die;
	    $this->form_validation->set_rules('room_no','Room Name','trim|required');
	    $this->form_validation->set_rules('room_type_id','Room type','required');
	    $this->form_validation->set_rules('cafe_id','Cafe','required');
	    $this->form_validation->set_rules('no_of_people','no of people','trim|required');
	    //$this->form_validation->set_rules('screen_size','screen_size','trim|required');
	    //$this->form_validation->set_rules('description','Description','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
		//$this->session->set_flashdata('error_message','Something went wrong.');
		$this->add();
		} else {

            // if(!empty($_FILES['image']['name'])){
			// 	$image_path = './public/upload_images/room_images';
            //     $file=$this->imageupload->image_upload_modified($image_path,'image');
			// 	if($file['status']==1){
            //         $data['image']=$file['result'];
            //         //$image = $data['image'];
            //     }else{
            //         $this->session->set_flashdata('error_msg',$file['result']);
            //         $this->add();
			// 	}
			// } else{
			// 	//$data['image']=" ";
			// }
			$idata = array(
		 		'room_no'   => $this->input->post('room_no'),
		        'cafe_id' => $this->input->post('cafe_id'),
		        'room_type_id' => $this->input->post('room_type_id'),
		        'image' => "",
		        'no_of_people' => $this->input->post('no_of_people'),
                'screen_size' => $this->input->post('screen_size'),
                'description' => trim($this->input->post('description')),
                'status'=>1,
		       // 'created_by' =>$admin['user_id'],
		       // 'created_on' => date('Y-m-d H:i:s'),
            );

			 $room_id=$this->mcommon->insert('room', $idata);
			 //insert room images
			 if(!empty($_FILES['image']['name'])){
				$image_path = './public/upload_images/room_images';
				for($i=0; $i< count($_FILES['image']['name']); $i++){
					//if($i<=3){
						$filename = $_FILES['image']['name'][$i];
						$allowed =  array('gif', 'png', 'jpg', 'jpeg', 'JPG', 'JPEG', 'PNG', 'GIF');
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if (in_array($ext, $allowed)) {
							$image_file = time() . mt_rand(11111, 999999).'.' . $ext;
							$DIR_IMG_NORMAL = getcwd() . "/public/upload_images/room_images/" . $image_file;
							if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $DIR_IMG_NORMAL)) {
								$images = array('image'=>$image_file, 'room_id'=> $room_id);
								$this->mcommon->insert('room_images', $images);
							} 
						}
					//}
				}
			}
		 	$this->session->set_flashdata('success_message','Room added successfully.');
		 	redirect('admin/room');
	   }
    }

    public function update_content()
	{
	    //echo "<pre>"; print_r($this->input->post());die;
	    $room_id=$this->input->post('room_id');  
		  
	    $this->form_validation->set_rules('room_no','Room Name','trim|required');
	    $this->form_validation->set_rules('room_type_id','Room type','required');
	    $this->form_validation->set_rules('cafe_id','Cafe','required');
	    $this->form_validation->set_rules('no_of_people','no of people','required');
	    //$this->form_validation->set_rules('screen_size','screen_size','required');
	    //$this->form_validation->set_rules('description','Description','trim|required');
	
		if ($this->form_validation->run() == FALSE) {
		//echo "validation error";die;
		//$this->session->set_flashdata('error_message','Not updated.Something went wrong');
		//echo "valida error";die;
	    $this->edit($room_id);
		} else {
			
			//print_r($this->input->post()); die;
            // if(!empty($_FILES['image']['name'])){

			// 	$image_path = './public/upload_images/room_images';
            //     $file=$this->imageupload->image_upload_modified($image_path,'image');
			// 	if($file['status']==1){
            //         $data['image']=$file['result'];
                   
            //     }else{
            //         $this->session->set_flashdata('error_msg',$file['result']);
            //         //redirect('admin/food/edit','refersh');
            //         $this->edit($movie_id);
			// 	}
			// } else{
			// 	$data['image']=$this->input->post('old_image');
			// } 
            
          	$udata = array(
		 	    'room_no'   => $this->input->post('room_no'),
		        'cafe_id' => $this->input->post('cafe_id'),
		        'room_type_id' => $this->input->post('room_type_id'),
		        'image' => "",
		        'no_of_people' => $this->input->post('no_of_people'),
                'screen_size' => $this->input->post('screen_size'),
                'description' => trim($this->input->post('description')),
		      
		        //'updated_by' =>$admin['user_id'],
		        //'updated_on' => date('Y-m-d H:i:s'),
            );
            
            $condition=array('room_id' => $room_id);
            $this->mcommon->update('room',$condition, $udata);
			 //echo $this->db->last_query();die;
			 //insert room images
			 if(!empty($_FILES['image']['name'])){
				$image_path = './public/upload_images/room_images';
				for($i=0; $i< count($_FILES['image']['name']); $i++){
					//if($i<=3){
						$filename = $_FILES['image']['name'][$i];
						$allowed =  array('gif', 'png', 'jpg', 'jpeg', 'JPG', 'JPEG', 'PNG', 'GIF');
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if (in_array($ext, $allowed)) {
							$image_file = time() . mt_rand(11111, 999999).'.' . $ext;
							$DIR_IMG_NORMAL = getcwd() . "/public/upload_images/room_images/" . $image_file;
							if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $DIR_IMG_NORMAL)) {
								$images = array('image'=>$image_file, 'room_id'=> $room_id);
								$this->mcommon->insert('room_images', $images);
							} 
						}
					//}
				}
			}
		 		
		 	$this->session->set_flashdata('success_message','Room Updated successfully.');
		 	redirect('admin/room');
		 	
	   }
    }
   
	public function approval_status()
	{
		if ($_POST['key'] == "activeInactive"){
		$status = $_POST['status'];
	    $room_id = $_POST['recordId'];
	    $condition=array('room_id' => $room_id);
			    		$udata=array(
						'status' => $status,
	                 	);
		$result = $this->mcommon->update('room',$condition, $udata);
		//echo $this->db->last_query();die;
		if ($result){
	        echo "success";
	    }
    }
    }
    public function delete_img() 
	{
    	$room_id= $this->input->post('room_id');
		$condition=array('room_id' =>$room_id);
		$row=$this->mcommon->getRow('room',$condition);
		//$condition=array('movie_id'=>$movie_id);
		$udata['is_delete'] = 1;
		$this->mcommon->update('room',$condition,$udata);
		$path="public/upload_images/room_images/".$row['image'];
        unlink($path); 
	    //echo 1;exit;
	    echo 1;
	}
  
	
   
	
	


	

}