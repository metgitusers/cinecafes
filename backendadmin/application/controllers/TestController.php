<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
	}
	
	public function index(){
		echo base_url();
 	}
	
	public function testEmail()
	{
		$email_to='santu.dutta@met-technologies.com';
		
		$subject = 'Contact us mail received - 52889566656333';
		$message = '<div style="border:2px solid #333;padding:20px;background:#eee;text-align:center;">
					<img src="'.LOGOURL.'"/ style="display:block;">
					<p>Contact us mail - 52889566656333<br>
					Someone has contacted you.Please login to your admin panel to see the details.</p>
					
					<p>Cinecafe,
					This message was sent to '.$email_to.' and intended for your account. Not your account? Remove your email from this account.</p>
					</div>';
					
					
		$mail['name']     = 'Santu dutta';
        $mail['to']       = $email_to;
        $mail['subject']  = 'cinecafe Recover Password';
		
		$mail['message']    = $message;
        $mail['from_email']    = FROM_EMAIL;
        $mail['from_name']    = ORGANIZATION_NAME;
		
		
		sendmail($mail);
		show_error($this->email->print_debugger());
	}
}
?>