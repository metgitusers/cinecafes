<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->library('imageupload');
		$this->load->model('admin/mmember');
		$this->load->model('admin/mpackage');
		$this->redirect_guest();
	}
	public function generateRandomString($length = 6) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}	
	public function index($user_type=null) { 
		//echo $this->session->userdata('email');die;
		$data 						= array();
		$data['content'] 				= 'admin/member/list';
		$data['member_active_list'] 	= $this->mmember->get_member_list('1');
		$data['member_inactive_list'] = $this->mmember->get_member_list('0');
		//$condition['is_delete']=0;
		//$condition['status']=1;
		$condition['role_id']=0;
		$condition['is_delete']=0;

		///** added by ishani on 09.18.2020  ** //
		$start_date="";
		$end_date="";
		if($_POST)
		{
			if(!empty($_POST['start_date'])){
	       		$start_date= $this->input->post('start_date');
	        }
	        if(!empty($_POST['end_date'])){
	       		$end_date= $this->input->post('end_date');
	        }
	        if(!empty($_POST['user_type'])){
				$user_type= $this->input->post('user_type');
				if(strtolower($user_type) != 'admin')
				$condition['added_form'] =  strtolower($user_type)=='app'?'App':'Admin';  
	        }
	        //die;
		 }
		 if(!empty($user_type)){
			$user_type= $user_type;
			if(strtolower($user_type) != 'admin')
			$condition['added_form'] =  strtolower($user_type)=='app'?'App':'Admin';  
		}
	     $data['start_date']=$start_date;
	     $data['end_date']=$end_date;
	     $data['user_type']=$user_type;
		$data['member_all_list'] 	= $this->mmember->getMemberDetails($condition,$user_type,$start_date,$end_date);
		//echo $this->db->last_query(); die;
		//pr($data);		
		
		$this->admin_load_view($data);		
	}
	/*
		AUTHOR NAME: Sreela Biswas Kundu
		Date: 28/8/19
		purpose: Edit member  
	*/
	public function edit($user_id){
		$data 			= array();
		$condition['user.user_id']			=$user_id;
		$data['package']	= $this->mpackage->get_package_list();
		$member_data=$this->mmember->getMemberDetails($condition);
		$data['member']	= $member_data[0];
		$data['user_id']=$user_id;
		
		$member_package=$this->mcommon->getRow('package_membership_mapping', array('user_id' =>$user_id,'status' =>'1'));
		if(!empty($member_package))
		{
			$data['member_package']	= $member_package;
		}
		else
		{
			$data['member_package']	= array();
		}
		
		//$data['member']	= $this->mcommon->getRow('master_member',$condition);
		//pr($data['member_package']);
		$data['content'] 	= 'admin/member/add';
		if(empty($data['member'])){
			redirect('admin/member');
		}else{
			$this->admin_load_view($data);
		}
	}
	public function UpdateMember($user_id){
		//pr($_POST);
		$old_membership_id      = '';
		$old_start_date='';
		$membership_data	 	= $this->mcommon->getRow("package_membership_mapping",array('user_id' => $user_id,'status' =>'1'));
		//print_r($membership_data);
		if(!empty($membership_data)){
			$old_membership_id  = $membership_data['membership_id'];
			$old_start_date = $membership_data['buy_on'];
		}
		//pr($_POST);
		$data			= array();
		$package_price 	= '0.00';
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		//$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_rules('dob', 'Date of Birth');
		
		
		if($this->form_validation->run()==FALSE){
			$condition['user.user_id']			=$user_id;
		$data['package']	= $this->mpackage->get_package_list();
		$member_data=$this->mmember->getMemberDetails($condition);
		$data['member']	= $member_data[0];
		$data['user_id']=$user_id;
		
		$member_package=$this->mcommon->getRow('package_membership_mapping', array('user_id' =>$user_id,'status' =>'1'));
		if(!empty($member_package))
		{
			$data['member_package']	= $member_package;
		}
		else
		{
			$data['member_package']	= array();
		}
			//echo validation_errors();
			//echo 1; die;
			$data['content'] 	= 'admin/member/add';
			$this->admin_load_view($data);
		}
		else{
			//email.........................................
			if (!empty($this->input->post( 'email' ))) {
	             
	             $existing_row_count = $this->mcommon->getNumRows("user",array('email' => $this->input->post( 'email' ),'user_id!='=>$user_id));
	            if ($existing_row_count>0) {
	            	//echo 1; die;
	            	$this->session->set_flashdata('error_msg','Email already exist for another user');
					redirect('admin/member/edit/'.$user_id);
	            }
	          }

	          //Phone.........................................
			if (!empty($this->input->post( 'mobile' ))) {
	             
	             $existing_row_count = $this->mcommon->getNumRows("user",array('mobile' => $this->input->post( 'mobile' ),'user_id!='=>$user_id));
	            if ($existing_row_count>0) {
	            	//echo 2; die;
	              $this->session->set_flashdata('error_msg',"Mobile no already exist for another user");
					redirect('admin/member/edit/'.$user_id);
	            }
	          }
			if(!empty($_FILES['profile_img']['name'])){
					
					//$image_path = 'public/upload_images/profile_photo';
					$image_path = './public/upload_images/profile_photo';
					$file 		= $this->imageupload->image_upload2($image_path,'profile_img');
					//pr($file);
					if($file['status']==0){
						$this->session->set_flashdata('error_msg',$file['result']);
						redirect('admin/member/edit/'.$user_id);
					}	
					else{
			        	$profile_img 	= $file['result'];
		        	}
	    	}
	    	else{
	    		$profile_img 	= $this->input->post( 'old_profile_img' );    		
	    	}
	    	
            

	    	if($this->input->post( 'status') ==''){
	    		$status ='0';
	    	}
	    	else{
	    		$status ='1';
	    	}
	    	if($this->input->post( 'marriage_status' ) =='married' && !empty($this->input->post( 'doa' ))){
	    		$doa	= date('Y-m-d',strtotime(str_replace('/','-',$this->input->post("doa"))));
	    	}
	    	else{
	    		$doa	= '';
	    	}

	    	if(!empty($this->input->post( 'dob' ))){
	    		$dob	= date('Y-m-d',strtotime(str_replace('/','-',$this->input->post("dob"))));
	    	}
	    	else{
	    		$dob	= '';
	    	}
	    	//echo "hzj".$doa;exit;
	    	//$password			= $this->input->post( 'password' );
	    			$data = array(		
								
					'name' 						=> $this->input->post( 'name' ),	
		
					//'country_code'						=>'91',	
					'mobile' 							=> $this->input->post( 'mobile' ),
					//'password'							=> sha1($password),
					//'original_password'					=> $password,
					'email' 							=> $this->input->post( 'email' ),	
			
					'status' 							=> $status,	
					'updated_by'       =>        $this->session->userdata('user_data'),
          			'updated_date'            => date('Y-m-d H:i:s'),  	
					);
					//check is available
					if($this->input->post( 'last_name' )){
						$data['last_name']	= $this->input->post( 'last_name' );
					}
	    			//pr($data);
					$condition	= array('user_id'=>$user_id);
		        	$this->mcommon->update('user',$condition,$data);

		        	$data_profile=array();

		            $data_profile = array(	
					'gender' 							=> $this->input->post( 'gender' ),
					'marriage_status' 					=> $this->input->post( 'marriage_status' ),
					'address' 					=> $this->input->post( 'address' ),
					'dob' 								=> $dob,				
					'doa' 								=> $doa,
					'profile_img'						=> $profile_img,
					
					'updated_by' 						=> $this->session->userdata('user_data'),			
					'updated_date' 						=> date('Y-m-d H:i:s'),				
					);
		           //update user profile 
		            $this->mcommon->update('user_profile',$condition,$data_profile);	        	
		        	if(!empty($this->input->post( 'edit_membership_registration' ))){
		        			$buy_on = DATE('Y-m-d',strtotime(str_replace('/','-',$this->input->post( 'edit_membership_registration' ))));
		        		}
		        		else{
		        			$buy_on ='';
		        		}
		        		if(!empty($this->input->post( 'edit_expiry_dt' ))){
		        			$expiry_dt = DATE('Y-m-d',strtotime(str_replace('/','-',$this->input->post( 'edit_expiry_dt' ))));
		        		}
		        		else{
		        			$expiry_dt ='';
		        		}
						$package_type_name  = "";
						$package_name  		= "";
						$package_price  	= "";
						$package_type_id  = "";
	        		if($this->input->post( 'membership_id' )!=''&& $this->input->post( 'package_id' ) !=''){
	        			//echo 1; die;
	        			$pkg_condition		= array('user_id'=>$user_id,'status' =>'1');
		        		$package_data		= $this->mcommon->getRow('package_membership_mapping',$pkg_condition);
		        		//pr($package_data);
		        		if(!empty($package_data)){
		        			$update_data	= array('status'=> '0');
		        			$this->mcommon->update('package_membership_mapping',$pkg_condition,$update_data);
		        		}
		        		$condition 			= array('pm.package_id'=>$this->input->post('package_id'));		
						$package_type_data	= $this->mpackage->get_package_row($condition);		        		
		        		
		        		//pr($package_type_data);
		        		if(!empty($package_type_data)){
		        			if($package_type_data['package_type_name'] =='Yearly'){
		        				$expiry_date 	= date('Y-m-d', strtotime(' +1 year'));
		        			}
		        			else{
		        				$expiry_date = date('Y-m-d', strtotime(' +1 month'));
		        			}
		        			$package_type_name  = $package_type_data['package_type_name'];
		        			$package_name  		= $package_type_data['package_name'];
		        			$package_price  	= $package_type_data['package_price'];
		        			$package_type_id  = $package_type_data['package_type_id'];
	        			}
		        			        		
	        			$pck_array_data 	= array('package_id'		=> $this->input->post( 'package_id' ),
	    										'membership_no'		=> $this->input->post( 'membership_id' ),
	    										'package_type_id'	=> $package_type_id,
	    										'package_price'	=> $package_price,
		        								'user_id' 		=> $user_id,
		        								'added_from' 		=> 'admin',
		        								'buy_on'			=> $buy_on,
		        								'expiry_date'		=> $expiry_dt,
		        								'status'			=> '1'
		        							);
		    			$this->mcommon->insert('package_membership_mapping',$pck_array_data);
		    			
		    			$pck_trans_array_data 	= array('transaction_id' 	=> $this->generateRandomString(),
		    										'package_id'		=> $this->input->post( 'package_id' ),
			        								'user_id' 		=> $user_id,
			        								'added_form' 		=> 'admin',
			        								'amount'			=> $package_price,
			        								'transaction_type'	=> 'Membership',
			        								'payment_status'	=> '1',
			        								'payment_mode'      => 'Cash/Backend Transaction'
			        								);
		    			$this->mcommon->insert('transaction_history',$pck_trans_array_data);
	        		}
	        		else //if edit date
	        		{
	        			
	        			if($buy_on!='' && $old_start_date!='')
	        			{
	        				
	        				if($buy_on != $old_start_date)
	        					{
	        						
	        						//update subscription date
	        						$package_update_data 	= array('buy_on'			=> $buy_on,
		        								'expiry_date'		=> $expiry_dt
										);
	        						$pkg_condition_update['package_membership_mapping_id']=$membership_data['package_membership_mapping_id'];;
	        						$this->mcommon->update('package_membership_mapping',$pkg_condition_update,$package_update_data);
	        						//echo $this->db->last_query();die;
	        					}
	        			}
	        			
	        		}	

	        		
					/****************** Send password to the member ****************************/
	        		if($this->input->post('membership_id') != $old_membership_id){

	        			$log_data 	= array('action' 		=> 'Edit',
											'statement' 	=> "Edit membership id of the member named -'".$this->input->post( 'first_name' )."'",
											'action_by'		=> $this->session->userdata('user_data'),
											'IP'			=> getClientIP(),
											'id'          	=> $user_id,
				  	  						'type'        	=>"Member",
											'status'		=> '1'
										);
						//$this->mcommon->insert('log',$log_data);

	        			$logo					= 	base_url('public/images/logo.png');
						$params['name']			=	$this->input->post( 'name' ).' '.$this->input->post( 'last_name' );
						$params['to']			=	$this->input->post( 'email' );
						//$params['to']			=	'sreelabiswas.kundu@met-technologies.com';
						$details 				=   "Membership Id: ".$this->input->post( 'membership_id' )."<br>"."Membership name: ".$package_name."<br>"."Membership type: ".$package_type_name."<br>"."Membership Price:(₹) ".$package_price."<br>"."Expire On: ".DATE('d/m/Y',strtotime($expiry_dt));											
						$params['subject']		=   'Club Fenicia - Membership Confirmation Mail';															
						$mail_temp 				= 	file_get_contents('./global/mail/new_membership_template.html');
						$mail_temp				=	str_replace("{web_url}", base_url(), $mail_temp);
						$mail_temp				=	str_replace("{logo}", $logo, $mail_temp);
						$mail_temp				=	str_replace("{shop_name}", 'Club Fenicia', $mail_temp);	
						$mail_temp				=	str_replace("{name}", $params['name'], $mail_temp);
						$mail_temp				=	str_replace("{membership_name}", $package_name, $mail_temp);
						$mail_temp				=	str_replace("{details}", $details, $mail_temp);
						$mail_temp				=	str_replace("{current_year}", date('Y'), $mail_temp);						
						$params['message']		=	$mail_temp;
						//$msg 					= 	registration_mail($params);

                            
						$message  = "Congratulations! You are now an active Member of Club Fenicia. Membership Details - "."\n";
		              	$message  .=   " ID: ".$this->input->post( 'membership_id' )."\n Name: ".$package_name."\n Type: ".$package_type_name."\n Expire On: ".DATE('d/m/Y',strtotime($expiry_dt));
						
		              	//$this->smsSend($this->input->post('mobile'),$message);
		              	//echo $this->input->post('mobile');exit;
	        		}
		        	else{
		        		$log_data 	= array('action' 		=> 'Edit',
											'statement' 	=> "Edited details of the member - '".$this->input->post( 'first_name' )."'",
											'action_by'		=> $this->session->userdata('user_data'),
											'IP'			=> getClientIP(),
											'id'          	=> $user_id,
				  	  						'type'        	=>"Member",
											'status'		=> '1'
										);
						//$this->mcommon->insert('log',$log_data);
		        	}	        		

			$this->session->set_flashdata('success_msg','User details updated successfully');
			redirect('admin/member');
			//redirect('admin/member/edit/'.$user_id);
		}
	}
	/*
		AUTHOR NAME: Sreela Biswas Kundu
		Date: 28/8/19
		purpose: ADD NEW member  
	*/
	public function add(){
		$data 				= array();
		$data['package']	= $this->mpackage->get_package_list();
		$data['user_id']='';
		$data['content'] 				= 'admin/member/add';
		$this->admin_load_view($data);
	}
	public function addMember(){
		//pr($_POST);
		$img 	='';
		$data 	=  array();
		$data =  array();
		$email 	=  $this->input->post( 'email' );
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		
		if(!empty($email)){
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[user.email]',array('is_unique'=>'This %s already exists.'));
		}
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[user.mobile]',array('is_unique'=>'This %s already exists.'));
		$this->form_validation->set_rules('gender', 'gender');
		$this->form_validation->set_rules('dob', 'date of Birth');
		$this->form_validation->set_rules('doa', 'date of anniversary');
		$this->form_validation->set_rules('address', 'Adrress');
		$this->form_validation->set_rules('marriage_status', 'Marrital status');

		if($this->input->post( 'package_id' ) !=''){
		$this->form_validation->set_rules('package_id', 'package_id');
		$this->form_validation->set_rules('membership_registration', 'Membership Registration Date', 'trim|required');
		$this->form_validation->set_rules('expiry_dt', 'Membership Expiry Date', 'trim|required');
		}
		
		if($this->form_validation->run()==FALSE){
			//echo validation_errors();
			//echo 1; die;
			$data['package']	= $this->mpackage->get_package_list();
			$data['content'] 	= 'admin/member/add';
			$data['user_id']='';
			$this->admin_load_view($data);
		
		}
		else{
			if(!empty($_FILES['profile_img']['name'])){
				$image_path = 'public/upload_images/profile_photo';
				$file 		= $this->imageupload->image_upload2($image_path,'profile_img');
				//pr($file);
				if($file['status']==0){
					$this->session->set_flashdata('error_msg',$file['result']);
					redirect('admin/member/add');
				}	
				else{
					$img = $file['result'];
	        	}
	    	}
	    	if($this->input->post( 'status') ==''){
	    		$status ='0';
	    	}
	    	else{
	    		$status ='1';
	    	}
	    	$password			= mt_rand();
	    	if($this->input->post( 'doa' ) !=''){
	    		$doa	= date('Y-m-d',strtotime(str_replace('/','-',$this->input->post("doa"))));
	    	}
	    	else{
	    		$doa	= '';
	    	}

	    	if(!empty($this->input->post( 'dob' ))){
	    		$dob	= date('Y-m-d',strtotime(str_replace('/','-',$this->input->post("dob"))));
	    	}
	    	else{
	    		$dob	= '';
	    	}
        	$data = array(		
						
			'name' 						=> $this->input->post( 'name' ),		
		
			//'country_code'						=>'91',	
			'mobile' 							=> $this->input->post( 'mobile' ),
			'password'							=> sha1($password),
			'original_password'					=> $password,
			'email' 							=> $this->input->post( 'email' ),	
			
			'status' 							=> $status,
			
			'added_form'						=> 'admin',
			//'login_status'						=> '1',
			'created_by' 						=> $this->session->userdata('user_data'),			
			'created_date' 						=> date('Y-m-d H:i:s'),				
			);
			//check is available
			if($this->input->post( 'last_name' )){
				$data['last_name']	= $this->input->post( 'last_name' );
			}
        	$user_id = $this->mcommon->insert('user',$data);

        	if($user_id)
        	{
        		//insert to profile

        		$data_profile = array(	
        	'user_id' 							=> $user_id,	
			'gender' 							=> $this->input->post( 'gender' ),
			'marriage_status' 					=> $this->input->post( 'marriage_status' ),
			'address' 					=> $this->input->post( 'address' ),
			'dob' 								=> $dob,				
			'doa' 								=> $doa,
			'profile_img'						=> $img,
			
			'created_by' 						=> $this->session->userdata('user_data'),			
			'created_date' 						=> date('Y-m-d H:i:s'),				
			);
			$user_profile_id = $this->mcommon->insert('user_profile',$data_profile);
        		$log_data 	= array('action' 		=> 'Add',
									'statement' 	=> "Added a new member named - '".$this->input->post( 'first_name' )."'",
									'action_by'		=> $this->session->userdata('user_data'),
									'IP'			=> getClientIP(),
									'id'          	=> $user_id,
					  	  			'type'        	=>"Member",
									'status'		=> '1'
								);
				//$this->mcommon->insert('log',$log_data);
				$package_type_name  = "";
				$package_name  		= "";
				$package_price  	= "";
				$package_type_id  = "";
        		if($this->input->post( 'package_id' ) !=''){

	        				
					$condition 			= array('pm.package_id'=>$this->input->post('package_id'));		
					$package_type_data	= $this->mpackage->get_package_row($condition);		        		
	        		
	        		//print_r($package_type_data);
	        		if(!empty($package_type_data)){
	        			if($package_type_data['package_type_name'] =='Yearly'){
	        				$expiry_date 	= date('Y-m-d', strtotime(' +1 year'));
	        			}
	        			else{
	        				$expiry_date = date('Y-m-d', strtotime(' +1 month'));
	        			}
	        			$package_type_name  = $package_type_data['package_type_name'];
	        			$package_name  		= $package_type_data['package_name'];
	        			$package_price  	= $package_type_data['package_price'];
	        			$package_type_id  = $package_type_data['package_type_id'];
	        		}	
	        		if(!empty($this->input->post( 'membership_registration' ))){
	        			$buy_on = DATE('Y-m-d',strtotime(str_replace('/','-',$this->input->post( 'membership_registration' ))));
	        		}
	        		else{
	        			$buy_on ='';
	        		}
	        		if(!empty($this->input->post( 'expiry_dt' ))){
	        			$expiry_dt = DATE('Y-m-d',strtotime(str_replace('/','-',$this->input->post( 'expiry_dt' ))));
	        		}
	        		else{
	        			$expiry_dt ='';
	        		}	        		
	    			$pck_array_data 	= array('package_id'		=> $this->input->post( 'package_id' ),
	    										'membership_no'		=> $this->input->post( 'membership_id' ),
	    										'package_type_id'	=> $package_type_id,
	    										'package_price'	=> $package_price,
		        								'user_id' 		=> $user_id,
		        								'added_from' 		=> 'admin',
		        								'buy_on'			=> $buy_on,
		        								'expiry_date'		=> $expiry_dt,
		        								'status'			=> '1'
		        							);
	    			$this->mcommon->insert('package_membership_mapping',$pck_array_data);
	    			
	    			$pck_trans_array_data 	= array('transaction_id' 	=> $this->generateRandomString(),
	    										'package_id'		=> $this->input->post( 'package_id' ),
		        								'user_id' 		=> $user_id,
		        								'added_form' 		=> 'admin',
		        								'amount'			=> $package_price,
		        								'transaction_type'	=> 'Membership',
		        								'payment_status'	=> '1',
		        								'payment_mode'      => 'Cash/Backend Transaction'
		        								);
	    			$this->mcommon->insert('transaction_history',$pck_trans_array_data);

    			} 
        		/****************** Send membership ID to the member ****************************/
        		$logo					= 	base_url('public/images/logo.png');
				$params['name']			=	$this->input->post( 'name').' '.$this->input->post( 'last_name' );
				$params['to']			=	$this->input->post( 'email' );	
				$params['password']		=	$password;	
				//$params['to']			=	'sreelabiswas.kundu@met-technologies.com';
				$details 				=   "Username: ".$this->input->post( 'email' )."<br>";
				if(!empty($this->input->post( 'membership_id' ))){
					$details 			.=   "Membership Id: ".$this->input->post( 'membership_id' )."<br>"."Membership name: ".$package_name."<br>"."Membership type: ".$package_type_name."<br>"."Membership Price:(₹) ".$package_price."<br> Expire On: ".DATE('d/m/Y',strtotime($expiry_dt));
				}				
				$params['subject']		=   'Club Fenicia - Registration Successful Mail';															
				$mail_temp 				= 	file_get_contents('./global/mail/registration_template.html');
				$mail_temp				=	str_replace("{web_url}", base_url(), $mail_temp);
				$mail_temp				=	str_replace("{logo}", $logo, $mail_temp);
				$mail_temp				=	str_replace("{shop_name}", 'Club Fenicia', $mail_temp);	
				$mail_temp				=	str_replace("{name}", $params['name'], $mail_temp);
				$mail_temp				=	str_replace("{details}", $details, $mail_temp);
				$mail_temp				=	str_replace("{current_year}", date('Y'), $mail_temp);						
				$params['message']		=	$mail_temp;
				//$msg 					= 	registration_mail($params);


				$message  = "Congratulation! You become a active club menber of Finicia. Your details are - ";
              	$message .=  "username: ".$this->input->post( 'email' );
              	if(!empty($this->input->post( 'membership_id' ))){
					$message .=   "\n ID: ".$this->input->post( 'membership_id' )."\n Name: ".$package_name."\n Type: ".$package_type_name."\n Price: ".$package_price."\n Expire On: ".DATE('d/m/Y',strtotime($expiry_dt));
				}
              	//$this->smsSend($this->input->post( 'mobile' ),$message);
        		$this->session->set_flashdata('success_msg','New User added successfully');
        		redirect('admin/member');
        	}
		}
    	
	}
	public function ajaxGetPackageType(){
		$response				= array();
		//$return_response		= '';
		$package_id				= $this->input->post('package_id');
		$response				= $this->mmember->get_package_type($package_id);
		//pr($response);die;
		echo json_encode($response);exit;
	}
	public function uniqueMembershipId(){
		//pr($_POST);		
		$membership_id	= $this->input->post('membership_id');
		//$user_id		= $this->input->post('user_id');
		$response_data	= $this->mcommon->getRow('package_membership_mapping', array('membership_id' =>$membership_id));
		if(!empty($response_data)){
			echo 1;exit;
		}
		else{
			echo 0;exit;
		}
	}
	public function editUniqueMembershipId(){
		//pr($_POST);		
		$membership_id	= $this->input->post('membership_id');
		$user_id		= $this->input->post('user_id');
		$response_data	= $this->mcommon->getRow('package_membership_mapping', array('membership_id' =>$membership_id,'user_id !=' =>$user_id));
		if(!empty($response_data)){
			echo 1;exit;
		}
		else{
			echo 0;exit;
		}
	}
	public function getExpiryDate(){
		$memb_reg_dt=array();
		if(!empty($this->input->post('membership_reg_dt') && $this->input->post('package_type'))){
		$membership_reg_dt = $this->input->post('membership_reg_dt');
		$package_type 	   = $this->input->post('package_type');
		$package_number 	   = $this->input->post('package_number');
		//$number 	       = $this->input->post('number');
		//$number 	       = "10";
		//echo $package_number;  die;
		//echo $number; die;
		if($package_type =='Yearly'){
			$day    = date("d", strtotime(str_replace('/','-',$membership_reg_dt)));
			$month  = date("m", strtotime(str_replace('/','-',$membership_reg_dt)));
			$year   = date("Y", strtotime(str_replace('/','-',$membership_reg_dt)));
			if($day=='01'){
			  	if($month =='01'){
			     	$memb_reg_dt 	= '31-12-'.$year;
			  	}
			  	else{
				    $new_month 		= $month-1;
				    $new_year  		= $year+1;
				    $new_days  		= cal_days_in_month(CAL_GREGORIAN, $month-1, $year+1);
				    $new_dt    		= $new_year.'-'.$new_month.'-'.$new_days;
				    $memb_reg_dt 	= date("d/m/Y", strtotime($new_dt));
			  	}
			}
			else{
		     	$new_day  		= $day-1;
		     	$new_year 		= $year+1;
			    $new_dt 		= $new_day.'-'.$month.'-'.$new_year;
			    $memb_reg_dt 	= date("d/m/Y", strtotime($new_dt));
			}
		}
		else if($package_type =='Monthly'){

			$month       	= date("m", strtotime(str_replace('/','-',$membership_reg_dt)));
			$year 			= date("Y", strtotime(str_replace('/','-',$membership_reg_dt)));
			$days		 	= cal_days_in_month(CAL_GREGORIAN, $month, $year);

			if($days == 30){
				$memb_reg_dt = date("d/m/Y", strtotime(date("d-m-Y", strtotime(str_replace('/','-',$membership_reg_dt))) . " + 29 days"));
			}
			if($days == 31){
				$memb_reg_dt = date("d/m/Y", strtotime(date("d-m-Y", strtotime(str_replace('/','-',$membership_reg_dt))) . " + 30 days"));
			}
			if($days == 28){
				$memb_reg_dt = date("d/m/Y", strtotime(date("d-m-Y", strtotime(str_replace('/','-',$membership_reg_dt))) . " + 27 days"));
			}
			if($days == 29){
				$memb_reg_dt = date("d/m/Y", strtotime(date("d-m-Y", strtotime(str_replace('/','-',$membership_reg_dt))) . " + 28 days"));
			}
		}else if($package_type =='Custom'){
         /*-----------added by soma on 20-07-20-----------*/
          if($package_number!=0){
            $uploadDate= date('Y-m-d', strtotime(str_replace('/','-',$membership_reg_dt)));
			$date = strtotime($uploadDate);
			$date = strtotime("+ $package_number day", $date);
		    $memb_reg_dt = date('d/m/Y', $date);
			}else{
				$memb_reg_dt = "";

			}

         /*--------------------------------------------*/
		}
		
	}else{
	$memb_reg_dt = "";

}
echo $memb_reg_dt;exit;
}







}