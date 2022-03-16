<?php
require_once '../includes/app.php';

$courseID = $_POST["courseID"];
$email = $_POST["email"];
$response = $_POST["response"];

//print_r($_POST); exit(); die();

$s = "INSERT INTO users_payments(course_id, email, response) VALUES 
     ($courseID, '$email', '$response')";
if(mysqli_query($con, $s)){
    echo "yes";
}

$subject = 'Course purchase successful | TeachMeHow';
$from = 'no-reply@teachmehow.me';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h2>Congrats!</h2>';
$message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">It is to inform you that, you recently purchased a course and now you can start learning without any intruptions!.</p>';
$message .= '<a href="https://teachmehow.me" style="background: black; color: white; padding: 11px 22px; font-size: larger; margin-left: 15px; border-radius: 20px;text-decoration: none;">Start Learning</a>';
$message .= '</body></html>';

// Sending email
mail($email, $subject, $message, $headers);