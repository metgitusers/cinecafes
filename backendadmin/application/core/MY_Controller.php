<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		global $notification_data;
		$this->load->database();
		$this->load->model('mcommon');
		$this->load->model('admin/Mlist');
		
		//$this->load->model('admin/muser');
		$this->refresh_user();
		$this->role_id  			= $this->session->userdata('role_id');
		$this->user_id  			= $this->session->userdata('user_data');
		if(!empty($this->user_id)){
			$cond_profile			= array('user_id' => $this->user_id);
			$user_profile_data		= $this->mcommon->getRow('user_profile',$cond_profile);
			//pr($user_profile_data);
			if(!empty($user_profile_data)){
				$this->profile_img	= $user_profile_data['profile_photo'];
			}
			else{
				$this->profile_img	= '';
			}
		}
			 $this->data1['users'] = $this->Mlist->get_user_list();
		
		$this->notification_data 	= $this->notification();
		//pr($this->notification_data);
	}
	protected function is_logged_in() {
		return $this->session->userdata('admin') ? 1 : 0;
	}
	protected function redirect_guest_bak() {
		if (!$this->session->userdata('admin') || $this->session->userdata('project')=='' || $this->session->userdata('project')!='dealsntings'){
			//echo "<pre>"; print_r($this->session->userdata('project')); die;
			//redirect('admin/index', 'refresh');
			redirect('admin/logout');
		}

	}
	protected function redirect_guest() {
		if (!$this->session->userdata('admin')) {
			redirect('admin/', 'refresh');
		}
	}
	
	protected function admin_login_load_view($data) {
	 //$this->load->view('admin/header_admin',$data); 
	 $this->load->view($data['content'],$data);
	 //$this->load->view('admin/footer_admin'); 
    }
	
	protected function admin_load_view($data) {
	 $this->load->view('admin/header_admin',$data); 
	 $this->load->view($data['content'],$this->data1);
	 $this->load->view('admin/footer_admin'); 
    }
   
	protected function views(){
		$this->data['users'] = $this->Mlist->get_user_list();
		$this->load->view('admin/listing_admin', $this->data);
	}
	
	protected function is_logged_in_user() {
		return $this->session->userdata('front_end_user') ? 1 : 0;
	}
	protected function redirect_guest_user() {
		if (!$this->session->userdata('front_end_user')) {
			redirect('index', 'refresh');
		}
	}

	protected function refresh_user() {
		if ($this->session->userdata('front_end_user')) {
			$loggedin_user_id=$this->session->userdata('front_end_user')['user_id'];
			$loggedin_user_details=$this->muser->get_details($loggedin_user_id);
			$this->session->set_userdata('front_end_user',$loggedin_user_details);
			return 1;
		}
	}

	protected function redirect_merchant() {
		if (!$this->session->userdata('merchant')) {
			redirect('admin/index/merchant_login', 'refresh');
		}
	}

	protected function redirect_redeem() {
		if (!$this->session->userdata('redeem')) {
			redirect('admin/index/redeem_login', 'refresh');
		}
	}
	protected function getUserPermissionList($menu_id,$role_id) {

		$user_permn_data		= array();
		$user_permission_condn	= array('menu_id' =>$menu_id,'role_id' => $role_id);
		$user_permission_data	= $this->mcommon->getRow('user_permission',$user_permission_condn);
		if(!empty($user_permission_data)){
			$user_permn_data 	= $user_permission_data;
		}
		
		return $user_permn_data;
	}
	public function notification()
	{
		$result 			 = array();
		$notification	 	 = array();		
		$notification_cnt 	 = 0;
		$condition			 = array('status' =>'1','notification_title' => 'Reservation Pending');
		$notification_data	 = $this->mcommon->getNotificationList($condition);
		//pr($notification_data);
		if(!empty($notification_data)){
			$notification_cnt = count($notification_data);			
			$notification['details']	= $notification_data;
			$notification['count']		= $notification_cnt;
		}

		return $notification;
	}

	// check is request JSON by CS
	public function isJSON($string)
	{
		$valid = is_string($string) && is_array(json_decode($string, true)) ? true : false;
		if (!$valid) {
			$response['status']['error_code'] = 1;
            $response['status']['message']    = 'BAD REQUEST';
            $response['code']      = '401';

			echo json_encode($response); 
			exit;
		}
	}
	public function extract_json($key)
	{
		return json_decode($key, true);
	}
	public function outputJson($response)
	{
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}

	/**------------------------ adding function for food */
	protected function getItemAvailabilityDetails($request_day, $request_time, $food_item_id)
	{
		//check if the item have any alternate time scheduled
		$this->db->select('x.price, x.is_seen, x.time');
		$this->db->join('food_item_available_days y', 'y.food_item_available_day_id = x.food_item_available_day_id', 'left');
		$this->db->where('y.food_item_id', $food_item_id);
		$this->db->where('y.day', $request_day);
		//$this->db->where('x.time <=', $request_time);//CONVERT( TIME, '10:00:22 PM' );
		//$this->db->where('CONVERT(varchar, x.time, 108)', "<=", $request_time);//CONVERT( TIME, '10:00:22 PM' );
		$result = $this->db->get('food_item_available_day_times x')->row();
		// echo 'sql'.$this->db->last_query();
		// print_r($result);
		// echo $request_time;
		// echo strtotime($result->time).' <= '.strtotime($request_time).'<br>';
		if(empty($result) || strtotime($result->time) >= strtotime($request_time)){
			$this->db->select('x.price, x.is_seen');
			$this->db->where('x.food_item_id', $food_item_id);
			$this->db->where('x.day', $request_day);
			$result = $this->db->get('food_item_available_days x')->row();
		}
		return $result;
	}
		/**
		 * @request order_id
		 * @@response array()
	*/
	public function getOrderDetails($food_order_id = '')
	{
		$result = array();
		if($food_order_id != ''){
			$where = array(
				'foi.food_order_id'=> $food_order_id,
				'foi.item_addon_id'=> null
			);
			$result['content']='admin/food/orders/details';
			//$result['details']='admin/food/orders/index';
			$join[] = ['table' => 'food_items fi', 'on' => 'fi.food_item_id = foi.item_id', 'type' => 'left'];
			$details= $this->mcommon->select('food_order_items foi', $where, 'foi.*, fi.*, foi.price ordered_price', 'foi.food_order_item_id', 'ASC', $join);
			$order_details_array = [];
			if(!empty($details)){
				$join2 = [];
				$join2[] = ['table' => 'food_item_addons fi', 'on' => 'fi.food_item_addon_id = food_order_items.item_addon_id', 'type' => 'left'];
				foreach ($details as $key => $value) {
					$value->addons = $this->mcommon->select('food_order_items', ['food_order_items.food_order_id'=>$food_order_id, 'food_order_items.item_id'=>$value->item_id, 'food_order_items.item_addon_id !='=> null], 'food_order_items.*, fi.*', '', '', $join2);
					$order_details_array[] = $value;
				}
			}
			$result['details'] = $order_details_array;
			// echo '<pre>';
			// print_r($result['details']); die;
			$where = array(
				'fo.food_order_id'=> $food_order_id
			);
			$join = [];
			$join[] = ['table' => 'master_member mm', 'on' => 'mm.member_id = fo.user_id', 'type' => 'left'];
			$join[] = ['table' => 'food_ordered_address oa', 'on' => 'oa.order_id = fo.food_order_id', 'type' => 'left'];
			$result['order_user'] = $this->mcommon->select('food_orders fo', $where, 'fo.*, mm.first_name, mm.last_name, oa.*', 'fo.food_order_id', 'DESC', $join);
			$result['order_address'] = $this->mcommon->select('food_ordered_address foa', ['foa.order_id'=> $food_order_id], 'foa.*');
			$result['order_coupon'] = $this->mcommon->select('food_apply_coupon fac', ['fac.food_order_id'=> $food_order_id], 'fac.*');
			$result['food_order_id']= $food_order_id;
		}
		return $result;
	}

	//wallet deduction while purchasing
	public function deductWalllet($user_id,$amount)
	{
		
			if(empty($user_id)||empty($amount))
			{
			$response['status']['error_code'] = 1;
			$response['status']['message']    = 'Invalid user id or amount';
			
				$this->displayOutput($response);
			}

			$condition  = array('user_id'=>$user_id);
			$user_row   = $this->mcommon->getRow('user',$condition);
			if (empty($user_row)) {
				$response['status']['error_code'] = 1;
				$response['status']['message']    = 'Invalid user id.';
			
				$this->displayOutput($response);
			}

			if($user_row['wallet']<$amount)
			{
				$response['status']['error_code'] = 1;
				$response['status']['message']    = 'Insuffivient amount in wallet. Present balance is '.$user_row['wallet'];
			
				$this->displayOutput($response);
			}
			//update to wallet user table//////////////////////////
			$present_amount=$user_row['wallet'];
			$updated_amount=$present_amount-$amount;
			$user_data=array();
			$user_data['wallet']=$updated_amount;
			$this->mcommon->update('user',$condition,$user_data);

			///////////////////////////////////////////////////////////////
						////Notification////////////////////////////////////////////
						//get user info
						$condition_user['user_id']=$user_id;
						$user_row=$this->mapi->getRow("user",$condition_user); 
						
							$notification_title="Point deducted from wallet";
							$notification_des= $amount." point deducted from your wallet";
							$this->add_notification($user_id,$notification_title,$notification_des);
						/** Notification ends here.............................**/

						/********************************** Send reservation details in sms *************************************************/

							$message  = $notification_des." at ".ORGANIZATION_NAME.". \n";
							$message .= "Present wallet balance is : ".$updated_amount;
							
							smsSend($user_row['mobile'],$message);

							/********push notification fr membership ************************/
							$title=$notification_title;
							//$message   = $notification_des;
							$message_data = array('title' => $title,'message' => $notification_des);
							$user_fcm_token_data  = $this->mcommon->getRow('device_token',array('user_id' => $user_id));
							//pr($user_fcm_token_data);
							if(!empty($user_fcm_token_data)){
							$member_datas  = $this->mcommon->getRow('user',array('user_id' => $user_id));
								if($member_datas['notification_allow_type'] == '1'){
									if($user_fcm_token_data['device_type'] == 1){
									$this->pushnotification->send_ios_notification($user_fcm_token_data['fcm_token'], $message_data);
									}
									else{
									$this->pushnotification->send_android_notification($user_fcm_token_data['fcm_token'], $message_data);
									}
								}

							}

							/*********Mail fn ...************************************************/
							$details            =  $message;  
							$name=$user_row['name'];
							$email=$user_row['email'];
							$mail['name']       = $name;
							$mail['to']         = $email;    
							//$params['to']     = 'sreelabiswas.kundu@met-technologies.com';
							
							$mail['subject']    = ORGANIZATION_NAME." wallet point deducted";                             
							$mail_temp          = file_get_contents('./global/mail/wallet_template.html');
							$mail_temp          = str_replace("{web_url}", base_url(), $mail_temp);
							$mail_temp          = str_replace("{logo}", LOGOURL, $mail_temp);
							$mail_temp          = str_replace("{shop_name}", ORGANIZATION_NAME, $mail_temp);  
							$mail_temp          = str_replace("{name}", $mail['name'], $mail_temp);
									
							$mail_temp          = str_replace("{current_year}", date('Y'), $mail_temp);                         
							$mail_temp                 =   str_replace("{details}", $details, $mail_temp);
							
							

							$mail['message']    = $mail_temp;
							$mail['from_email']    = FROM_EMAIL;
							$mail['from_name']    = ORGANIZATION_NAME;
							sendmail($mail); 

							
							
							/****************mail ends*******************************************/ 
							/////////////////////////////////////////////////////////////////////////////
			return 1;
	}

	public function add_notification($user_id,$notification_title,$notification_des,$reservation_id=null)
	{
	  if($reservation_id==null)
	  {
		$reservation_id=0;
	  }
	  $notification_arr = array(      'user_id' => $user_id,
									  'notification_title'        => $notification_title,
									  'notification_description'  => $notification_des,
									  'reservation_id'  => $reservation_id,
									  'status'                    => '1',
									  'created_on'                => date('Y-m-d H:i:s')
									  );
	  $insert_data      = $this->mcommon->insert('notification', $notification_arr);
	}

	/*
		Image thumbnails by chayan
		by chayan
	*/
	public function doImageThumbnail($source ='',$image_name = '',  $quality = 70, $width = 120, $height = 120)
	{
		$this->load->library('image_lib');
		$config['image_library']  	= 'gd2';
		$config['source_image']   	= $source;       
		$config['create_thumb']   	= FALSE;
		$config['maintain_ratio'] 	= TRUE;
		$config['quality'] 			= $quality;
		$config['width']          	= $width;
		$config['height']         	= $height;
		$config['new_image']      	= getcwd().'/public/upload_images/thumbnail/'. $image_name;               
		$this->image_lib->initialize($config);
		if ($result = $this->image_lib->resize()) {
			return '/public/upload_images/thumbnail/'.$image_name;
		}
	}
}
