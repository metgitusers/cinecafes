<?php


$servername = "localhost";
$username = "Smartsystems";
$password = 'FT-85ck$H8v65Hbm';
$dbname = "Smartsystems";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fnm = $_POST['fnm'];
$lnm = $_POST['lnm'];
$phn = $_POST['phn'];
$email = $_POST['email'];
$today=date('h:i:s a'); 

$sql = "INSERT INTO contact_tb (fnm, lnm,phone, email, contact_time)
VALUES ('$fnm','$lnm','$phn','$email','$today')";

if ($conn->query($sql) === TRUE) {
	
		
$to = $email;
$subject = "Thank You For Contact With Us";

$message = "Thank You For Contact With Us";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@smartsystem.com>' . "\r\n";
$headers .= 'Cc: info@smartsystem.com' . "\r\n";

mail($to,$subject,$message,$headers);
	
	
	$to1 = $email;


$subject = "Thank You For Contact With Us";

$message = "Thank You For Contact With Us";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@smartsystem.com>' . "\r\n";
$headers .= 'Cc: info@smartsystem.com' . "\r\n";

mail($to,$subject,$message,$headers);
	
$to="ahunt@sstsun.com";
$$subject1 = "New Rquest For Contact";

$message1 .= '<p>'.$fnm.' '.$lnm.'</p>';
$message1 .= '<p>'.$phn.'</p>';
$message1 .= '<p>'.$email.'</p>';

// Always set content-type when sending HTML email
$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers1 .= 'From: <noreply@smartsystem.com>' . "\r\n";
$headers1 .= 'Cc: info@smartsystem.com' . "\r\n";

mail($to1,$subject1,$message1,$headers1);
	
    header('location: ../thank-you.php');
} else {
    header('location: ../contact.php');
}

$conn->close();
?>

