<?php



$fnm = $_POST['fnm'];
$lnm = $_POST['lnm'];
$sub = $_POST['sub'];
$email = $_POST['email'];
$today=date('h:i:s a'); 



		
$to = $email;
$subject = "Thank You For Contact With Us";

$message = "Thank You For Contact With Us";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@cinecafes.com>' . "\r\n";
$headers .= 'Cc: info@cinecafes.com' . "\r\n";

mail($to,$subject,$message,$headers);
	
	
	$to1 = $email;


$subject = "Thank You For Contact With Us";

$message = "Thank You For Contact With Us";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@cinecafes.com>' . "\r\n";
$headers .= 'Cc: info@cinecafes.com' . "\r\n";

mail($to,$subject,$message,$headers);
	
$to="arijitsom99@gmail.com";
$$subject1 = "New Rquest For Contact";

$message1 .= '<p>'.$fnm.' '.$lnm.'</p>';
$message1 .= '<p>'.$email.'</p>';

// Always set content-type when sending HTML email
$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers1 .= 'From: <noreply@cinecafes.com>' . "\r\n";
$headers1 .= 'Cc: info@cinecafes.com' . "\r\n";

mail($to1,$subject1,$message1,$headers1);
	
    header('location: ../thank-you.php');

$conn->close();
?>
