<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	public function __construct() {		
		parent::__construct();
		//echo "1";exit;
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
			$data = [
							'first_name' => $postData['first_name'],
							'last_name' => $postData['last_name'],
							'email' => $postData['email'],
							'phone_no' => $postData['phone_no'],
							'message' => $postData['message']
					];	

			$this->mcommon->insert('contact',$data);
			/*$data['first_name'] =$first_name;
			$data['last_name'] =$last_name;
			$data['email'] =$email;
			$data['phone_no'] =$phone_no;
			$data['message'] =$msg;*/


			$email_to='franchise.enquiry@cinecafes.com';
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
					 & Regards,Cinecafe</p>
					</div>';
					
		$mail['name']     = 'Sourav Bhowmik';
        $mail['to']       = $email_to;
        $mail['subject']  = $subject;
		$mail['message']  = $message;
		
		sendmail($mail);
		//show_error($this->email->print_debugger());
			/*$html2 = $this->load->view('email_template/contact-mail',$data,TRUE);
			//$details = $this->mcommon->getRow('user_master',['role_id'=>1]);
			$responseMail = $this->sendMail('franchise.enquiry@cinecafes.com','Contact Enquiry Mail',$html2);*/
			$response['status']= TRUE;
			$response['message']= 'Your enquiry successfully submitted!';
			$response['redirect']= 'User';
			$this->outputJson($response);
            /*$this->session->set_flashdata('success_message', 'Your enquiry successfully submitted');
            redirect(base_url().'contact-us');*/





			
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