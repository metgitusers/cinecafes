<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->redirect_guest();
		$this->load->model('mcommon');
		
		$this->load->library('imageupload');
		$this->load->library('PushNotification');
	}
	public function index()
{
		
		$data['list'] =$this->mcommon->getDetails('notification');
		
		$data['title']='Notification List';
		$data['content']='admin/notification/list';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	public function offer()
	{
		$condition=array('status'=>1,'is_delete='=>0);
		$data['user_list'] =$this->mcommon->getDetails('user',$condition);

		
		$data['title']='Offer';
		$data['content']='admin/notification/add';
		$this->admin_load_view($data);
		//$this->load->view('admin/layouts/index', $data);
	}
	
		
	public function add_content()
	{  
		// $cafe_movie_arr=$this->input->post('cafe_movie');
		// echo "<pre>"; print_r($cafe_movie_arr);die;
	    $this->form_validation->set_rules('offer_text','Offer','trim|required');
	    
	    
	
		if ($this->form_validation->run() == FALSE) {
		//echo "val error";die;
		$this->session->set_flashdata('Movie_error_message','Something went wrong.Please try again');
		$this->add();
		} 
		
	        else{

			////send push to user
	        	$user_arr=$this->input->post('user_id');	
		 		if(!empty($user_arr))
		 		{
		 			$users=json_encode($user_arr);

		 			/********push notification  ************************/
                        //$title="Notification ".ORGANIZATION_NAME;
                        $message   = $this->input->post('offer_text');	
						//$message_data = array('title' => $title,'message' => $message);
						
						$title = $this->input->post('message_title');
						$ticker = $this->input->post('ticker');
						$msg_img = "";
						if($_FILES['file']['name']){
							$filename = $_FILES['file']['name'];
							$allowed =  array('jpg', 'jpeg', 'JPG', 'JPEG');
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							//if (in_array($ext, $allowed)) {
								$image_file = time().mt_rand(111, 999)."." . $ext;
								$imgPath = getcwd()."/public/upload_images/push_images/".$image_file;
								if(move_uploaded_file($_FILES['file']['tmp_name'], $imgPath)){
									$image_title = $image_file; //$file['result'];
									$msg_img = base_url('public/upload_images/push_images/').$image_file; //$file['result'];
								}
							//}
						}
                                
				 	foreach ($user_arr as $user_id) {
				 		$user_row=array();
				 		$user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
                        //pr($user_fcm_token_data);
                        if(!empty($user_fcm_token_data)){
						  $member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
						// print_r($member_datas);
						// print_r($user_fcm_token_data);
                            if($member_datas['notification_allow_type'] == '1'){
                                if($user_fcm_token_data['device_type'] == 1){
								  //$this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
								  $push_array = array("to" => 
														//"d_C0y2ibSU9GsMxMH3nhCj:APA91bGdwAjyMIFPZCtiWrO4UZ7OGlBsYIPjyrJaD_K1aytOKxAJGReiUdJOg8Cr5_Z3SvNi2UkDBMa_NumyGR70hFZvr2cUOcVjFcZHYOSWX2qDzwIbnbi2kCttaiVBvd0ssjA4jidt",
														$user_fcm_token_data['fcm_token'],
														"mutable_content"=> true,
														"notification" => array(
															"body" => $message,
															"title"=> $title
														),
														"data"=> array(
															"urlImageString"=> $msg_img,
															"ticker"=> $ticker
														)
													);
									//print_r($push_array);
                                  	$this->pushnotification->send_ios_notification($push_array);
                                }
                                else{
								  //$this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
								  $push_array = array("to" => 
														//"d_C0y2ibSU9GsMxMH3nhCj:APA91bGdwAjyMIFPZCtiWrO4UZ7OGlBsYIPjyrJaD_K1aytOKxAJGReiUdJOg8Cr5_Z3SvNi2UkDBMa_NumyGR70hFZvr2cUOcVjFcZHYOSWX2qDzwIbnbi2kCttaiVBvd0ssjA4jidt",
														$user_fcm_token_data['fcm_token'],
														"collapse_key"=> "type_a",
														"notification" => array(
															"body" => $message,
															"title"=> $title,
															"icon"=>$msg_img,
															"ticker"=> $ticker
														)
													);	
                                  	//$this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
                                  	$this->pushnotification->send_android_notification($push_array);
                                }
                            }

                          }
				 	}
			 	}

				//echo json_encode($push_array);
          
			$idata = array(
		 		'offer'   => $this->input->post('offer_text'),		       
				'user_id' => $users,
				"title"=> $title,
				"image"=>$msg_img,
				"ticker"=> $ticker
		        
		       // 'created_on' => date('Y-m-d H:i:s'),
            );

		 	$this->mcommon->insert('push_notification', $idata);
		 	
		 	$this->session->set_flashdata('Movie_success_message','Notification send successfully.');
		 	redirect('admin/notification/offer');
	   }
    }

  
 
}