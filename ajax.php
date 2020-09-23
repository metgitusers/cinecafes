<?php
if(isset($_POST['action']) && ($_POST['action'] == 'form_submit_act')){
	
	$msg = '';
	if(isset($_POST['recaptcha']) && !empty($_POST['recaptcha']))
  {
	  
	$secret = '6LfCstsUAAAAAGXEnwrynzp1IPr3v7xrht-ZCGg8';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['recaptcha']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {
            //$succMsg = 'Your contact request have submitted successfully.';
			$fname = trim($_POST['fname']);
			$lname = trim($_POST['lname']);
			$subject_contact = trim($_POST['subject']);
			$email = trim($_POST['email']);
			$msg = trim($_POST['msg']);
			
			$to = 'info@cinecafes.com';
			$subject = 'Contact Details';
			$from = $email;
			
			
			
			
			
			 
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			
			$message = '<html><body><table width="100%" id="msg_body">';
			if($fname != ''){
			$message .= '<tr><th width="20%" style="text-align:left; background-color:#ccc; color:black; padding:5px;">First Name: </th><td style="text-align:left; background-color:#ccc; color:black; padding:5px;">'.$fname.'</td></tr>';
			}
			if($lname != ''){
			$message .= '<tr><th width="20%" style="text-align:left; background-color:#ccc; color:black; padding:5px;">Last Name: </th><td style="text-align:left; background-color:#ccc; color:black; padding:5px;">'.$lname.'</td></tr>';
			}
			if($subject_contact != ''){
			$message .= '<tr><th width="20%" style="text-align:left; background-color:#ccc; color:black; padding:5px;">Subject: </th><td style="text-align:left; background-color:#ccc; color:black; padding:5px;">'.$subject_contact.'</td></tr>';
			}
			if($email != ''){	
			$message .= '<tr><th width="20%" style="text-align:left; background-color:#ccc; color:black; padding:5px;">Email: </th><td style="text-align:left; background-color:#ccc; color:black; padding:5px;">'.$email.'</td></tr>';
			}
			if($msg != ''){
			$message .= '<tr><th width="20%" style="text-align:left; background-color:#ccc; color:black; padding:5px;">Message: </th><td style="text-align:left; background-color:#ccc; color:black; padding:5px;">'.$msg.'</td></tr>';
			}
			$message .= '</table></body></html>';


			

			if(mail($to, $subject, $message, $headers)){
				$msg = 'success';
				//echo 'Your mail has been sent successfully.';
			} else{
				//echo 'Unable to send email. Please try again.';
				$msg = 'mail';
			}
			
			
			
			
        }
        else
        {
            $msg = 'captcha';
        }  
	  
	  
	
	
	
	  
  } else {
	  $msg = 'captcha';
  }
	
	echo $msg;
	exit;
}
?>