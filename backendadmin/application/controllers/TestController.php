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
		//$email_to='anindya.paul@met-technologies.com';

		$email_to='avishek.chakraborty@met-technologies.com';

		$subject = 'Contact us mail received - 52889566656333';
		$message = '<div style="border:2px solid #333;padding:20px;background:#eee;text-align:center;">
					<img src="'.LOGOURL.'"/ style="display:block;">
					<p>Contact us mail - 52889566656333<br>
					Someone has contacted you.Please login to your admin panel to see the details.</p>
					
					<p>Cinecafe,
					This message was sent to '.$email_to.' and intended for your account. Not your account? Remove your email from this account.</p>
					</div>';
					
		$mail['name']     = 'Test Email';
        $mail['to']       = $email_to;
        $mail['subject']  = $subject;
		$mail['message']  = $message;
		
		sendmail($mail);
		show_error($this->email->print_debugger());
	}
	
	//********** for testing all SMS gateway ****************//
	public function testReservationSMS()
	{
		//https://cinecafes.com/backendadmin/TestController/testReservationSMS
		$cafe_row['cafe_name'] = 'Cine Cafes';
		$cafe_row['cafe_place'] = 'Sec V';
		$reservation_date = '12/11/2021';
		$reservation_time = '08:20 AM';
		$no_of_guests = 20;
		$mobile = '9851609064';
		
		$template_id = '1207163653375517655';
		$message = "Dear Santu\n";
		$message .= "Thank you for confirming your Reservation at Cinecafes.\n";
		$message .= "Your reservation details are:\n";
		$message .= "Cafe: ".$cafe_row['cafe_name']."-".$cafe_row['cafe_place']."\n";
		$message .= "Date: ".$reservation_date."\n";
		$message .= "Time: ".$reservation_time."\n";
		$message .= "No. of Guests: ".$no_of_guests."\n";
		$message .= "CINE CAFES";
		
		echo $message;echo '<br>';
		echo smsSend($mobile, $message, $template_id);
	}
	
	public function testMembershipSMS()
	{
		//https://cinecafes.com/backendadmin/TestController/testMembershipSMS
		$user_row['name'] = 'Santu';
		$user_row['last_name'] = 'Dutta';
		$package_name = 'Basic Plan';
		$package_type_name = 'Yearly';
		$package_price = 200;
		$mobile = '9851609064';

		$template_id = '1207163653356833332';
		$message  = "Dear ".$user_row['name'].' '.$user_row['last_name']."\n";
		$message  .= "Your Membership at CineCafes is Active. Membership details are mentioned below:\n";
		$message  .= "Membership name: ".$package_name."\n";
		$message  .= "Membership type: ".$package_type_name."\n";
		$message  .= "Membership Price: ".$package_price."\n";
		$message .= "CINE CAFES";
		
		echo $message;echo '<br>';
		echo smsSend($mobile, $message, $template_id);
	}
	public function testWalletSMS()
	{
		//https://cinecafes.com/backendadmin/TestController/testWalletSMS
		$user_row['name'] = 'Santu';
		$user_row['last_name'] = 'Dutta';
		$ap['amount'] = 200;
		$updated_amount = 5000;
		$mobile = '9851609064';
		
		$template_id = '1207163653337268173';
		$message = 'Dear '.$user_row['name'].' '.$user_row['last_name']."\n";
        $message .= $ap['amount']." points added to your wallet at Cinecafes. Present wallet balance is : ".$updated_amount."\n";
        $message .= "CINE CAFES";
              
        echo $message;echo '<br>';
		echo smsSend($mobile, $message, $template_id);
	}
	public function testRegistrationSMS()
	{
		//https://cinecafes.com/backendadmin/TestController/testRegistrationSMS
		$name = 'Santu Dutta';
		$mobile = '9851609064';
		
		$template_id = '1207163653382438936';
		$message = "Dear ".$name."\n";
        $message .= "Welcome to Cine Cafes .Thank you for your registration. Your profile has been created.\n";
        $message .= "CINE CAFES";

        echo $message;echo '<br>';
		echo smsSend($mobile, $message, $template_id);
	}
	
	public function testOTPSMS()
	{
		//https://cinecafes.com/backendadmin/TestController/testOTPSMS
		$otp = '548897';
		$mobile = '9851609064';
		
		$template_id = '1207163697491581491';
        $message = $otp." is the OTP.\n";
        $message .= "CINE CAFES";

        echo $message;echo '<br>';
		echo smsSend($mobile, $message, $template_id);
	}

	public function smsSend1()
	{

		//phpinfo();exit;
		//$api_key = '46868818/zXTHBjnJMGehFE0qRrgMBp9v0zNH6OfusLY3kbMN5Y=rR#4b6iPs$VEfT$uOW0c';
		//$contacts = '97656XXXXX,97612XXXXX,76012XXXXX,80012XXXXX,89456XXXXX,88010XXXXX,98442XXXXX';
		$message = 'Dear {#var#}⏎⏎Thank you for confirming your Reservation at Cinecafes.⏎Your re servation details are: ⏎⏎Cafe: {#var#} ⏎Date: {#var#} ⏎Time: {#var#} ⏎No. of Guests: {#var#}⏎⏎⏎CINE CAFES';
		$mobile = '9007856855';
		//$message = 'Test';
		

		$from = 'CINCAF';
		$sms_text = urlencode($message);

		 
 
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://103.229.250.200/smpp/sendsms?to='.$mobile."&from=".$from."&text=".$sms_text,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaS5teXZhbHVlZmlyc3QuY29tL3BzbXMiLCJzdWIiOiJjaW5jYWYiLCJleHAiOjE2NDk5MjkxOTN9.WCOlgskvyiOPMlZRWc-leAb0WlKMyf-lZGKWBrNh0to'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		var_dump($response);



		
	}

}
?>