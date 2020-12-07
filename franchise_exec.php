<?php



$fnm = $_POST['ffnm'];
$lnm = $_POST['flnm'];
$femail = $_POST['femail'];
$fmsg = $_POST['fmsg'];
$fsub = $_POST['fsub'];
$frnch = $_POST['frnch'];
$today=date('h:i:s a'); 



		
$to = $femail;
$subject = "Thank You For showing interest for franchise";

$message = "Thank You For Contact With Us";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@cinecafes.com>' . "\r\n";
$headers .= 'Cc: info@cinecafes.com' . "\r\n";

mail($to,$subject,$message,$headers);
	
	

	
$to1="puja.c@cinecafes.com";
$subject1 = $fsub;

$message1 .= '<p>Name:'.$fnm.' '.$lnm.'</p>';
$message1 .= '<p>Franchise Type:'.$frnch.'</p>';
$message1 .= '<p>Email:'.$femail.'</p>';
$message1 .= '<p>'.$fmsg.'</p>';

// Always set content-type when sending HTML email
$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers1 .= 'From: <noreply@cinecafes.com>' . "\r\n";
$headers1 .= 'Cc: info@cinecafes.com' . "\r\n";

mail($to1,$subject1,$message1,$headers1);
	
    header('location: ../thank-you.php');


?>

