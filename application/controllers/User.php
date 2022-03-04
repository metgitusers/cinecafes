<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function __construct() {		
		parent::__construct();

		//$this->redirect_guest_user();
		
		$this->load->model('mcommon');	
		
		/*if($this->session->userdata('user_id') == '')
		{
			redirect('commission/login');
			die();
		}*/
				
	}

	public function index()
	{
	   	//$condition['is_delete'] =0;
    	$data['list']= $this->mcommon->getDetails('banner',['status'=> 1, 'is_delete'=> 0]);
    	$data['home_section']= $this->mcommon->getDetails('content',['status'=> 1, 'is_delete'=> 0]);
    	//print_r($data['content']);die;
	   	$data['title']='cinecafe2 | Home';
		$data['content']='front/pages/index';
		$this->front_load_view($data);
	}

	public function aboutUs()
	{
		$data['list'] 	= $this->mcommon->getDetails('cms',['cms_slug'=>'about-us' ,'status' =>1]);
		//print_r($data['list']);die;
		$data['title']='cinecafe2 | About Us';
		$data['content']='front/pages/about-us';
		$this->front_load_view($data);
	}

	public function termsCondition()
	{
		$data['list'] 	= $this->mcommon->getDetails('cms',['cms_slug'=>'terms-condition' ,'status' =>1]);
		//print_r($data['list']);die;
		$data['title']='cinecafe2 | Terms & Condition';
		$data['content']='front/pages/about-us';
		$this->front_load_view($data);
	}

	public function privacyPolicy()
	{
		$data['list'] 	= $this->mcommon->getDetails('cms',['cms_slug'=>'privacy-policy' ,'status' =>1]);
		//print_r($data['list']);die;
		$data['title']='cinecafe2 | Privacy - Policy';
		$data['content']='front/pages/about-us';
		$this->front_load_view($data);
	}

	public function contactmail()
	{
		if($this->input->method() == 'post'):
			$postData = $this->input->post();
		 	$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
		 	if(!empty($recaptchaResponse)){
	         	$userIp=$this->input->ip_address();
	         	$secret = $this->config->item('google_secret');
	        	$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
		        $ch = curl_init(); 
		        curl_setopt($ch, CURLOPT_URL, $url); 
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		        $output = curl_exec($ch); 
		        curl_close($ch);  
	        	$cap_status= json_decode($output, true);
	        	if(!empty($cap_status)){
		        	if($cap_status['success']) {
		        		$data = array(
									'first_name' => $this->input->post('first_name'),
									'last_name' => $this->input->post('last_name'),
									'email' => $this->input->post('email'),
									'phone_no' => $this->input->post('phone_no'),
									'message' => $this->input->post('message')
							);	

						$this->mcommon->insert('contact',$data);
						//$email_to='sourav.bhowmick@met-technologies.com';
						
						$email_to='avishek.chakraborty@met-technologies.com';
						//$email_to='franchise.enquiry@cinecafes.com';

						$subject = 'Contact us mail received';
						$message = '<div style="border:2px solid #333;padding:20px;background:#eee;text-align:center;">
							<img src="'.LOGOURL.'"/ style="display:block;">
							<p>Contact us mail<br>
							Someone has contacted you.Please find Out Below Enquiry.</p><br>

							<table cellpadding="10" cellspacing="0" width="100%" style="border: 1px solid #ccc">
		                     <tr>
		                        <td>First Name</td>
		                        <td>'.$postData['first_name'].'</td>
		                     </tr>
		                     <tr>
		                        <td>Last Name</td>
		                        <td>'.$postData['last_name'].'</td>
		                     </tr>
		                     <tr>
		                        <td>Email</td>
		                        <td>'.$postData['email'].'</td>
		                     </tr>
		                     <tr>
		                        <td>Phone No</td>
		                        <td>'.$postData['phone_no'].'</td>
		                     </tr>
		                     <tr>
		                        <td>Message</td>
		                        <td>'.$postData['message'].'</td>
		                     </tr>
		                  </table><br>
							
							<p>Thanks
							 & Regards,Cinecafes</p>
							</div>';
							
						$mail['name']     = 'Cinecafes';
				        $mail['to']       = $email_to;
				        $mail['subject']  = $subject;
						$mail['message']  = $message;
						sendmail($mail);
						$response['status']= TRUE;
						$response['message']= 'Your enquiry successfully submitted!';
						$response['redirect']= 'User';
			        }else{
			            $response['status']= FALSE;
						$response['message']= 'Sorry Google Recaptcha Unsuccessful!!';
						$response['redirect']= '';
			        }
			    }else{
			    	$response['status']= FALSE;
					$response['message']= 'Something Went Wrong!!';
					$response['redirect']= '';
			    }
			}else{
				$response['status']= FALSE;
				$response['message']= 'Please check Google Recaptcha!!';
				$response['redirect']= '';
			}
			$this->outputJson($response);	
		endif;
	}


	public function gallery()
	{
		$data['home_section']= $this->mcommon->getDetails('content',['status'=> 1, 'is_delete'=> 0]);
		$data['title']='cinecafe2 | Gallery';
		$data['content']='front/pages/gallery';
		$this->front_load_view($data);
	}

	/*public function banner()
	{
		$data['title']= 'Banner';
		$condition['is_delete'] =0;
    	$List = $this->mcommon->getDetails('banner',$condition);
		$data['title']='cinecafe2 | About Us';
		$data['content']='front/pages/about-us';
		$this->front_load_view($data);
		
	}*/


}