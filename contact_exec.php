<?php



$fnm = $_POST['fnm'];
$lnm = $_POST['lnm'];
$sub = $_POST['sub'];
$email = $_POST['email'];
$msg = $_POST['msg'];
$today=date('h:i:s a'); 



		
$to = $email;
$subject = "Thank You For Contact With Us";

$message = "Thank You For Contact With Us";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@cinecafes.com>' . "\r\n";
$headers .= 'Cc: puja.j@cinecafes.com' . "\r\n";

mail($to,$subject,$message,$headers);
	

	
$to1="puja.j@cinecafes.com";
$subject1 = $sub;

$message1 .= '<p>Name: '.$fnm.' '.$lnm.'</p>';
$message1 .= '<p>Email: '.$email.'</p>';
$message1 .= '<p>'.$msg.'</p>';

// Always set content-type when sending HTML email
$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers1 .= 'From: <info@cinecafes.com>' . "\r\n";
//$headers1 .= 'Cc: info@cinecafes.com' . "\r\n";

mail($to1,$subject1,$message1,$headers1);
	
    header('location: ../index.php');


?>

