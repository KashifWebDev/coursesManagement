<?php
require_once '../includes/app.php';
require_once '../includes/functions.php';

$courseID = $_POST["courseID"];
$email = $_POST["email"];
$response = $_POST["response"];

$sql= "SELECT * FROM courses WHERE id = $courseID";
$res = mysqli_query($con, $sql);
$courseRow = mysqli_fetch_array($res);
$courseName = $courseRow["title"];
$courseLink = $courseRow["courseID"];

$sql= "SELECT * FROM users WHERE email = '$email'";
$checkEmail = mysqli_query($con, $sql);
if(mysqli_num_rows($checkEmail)>0) {
    $userRow = mysqli_fetch_array($checkEmail);
    $userId = $userRow["id"];
    $message = '<h2>Congrats!</h2>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">Thank you for your purchase. You can now log into your account and begin the course.</p>';
    $message .= '<a href="https://teachmehow.me" style="background: black; color: white; padding: 11px 22px; font-size: larger; margin-left: 15px; border-radius: 20px;text-decoration: none;">Start Learning</a>';

}else{
    $pass = generateRandomString(8);
    $pass_md5 = md5($pass);
    $message = '<html><body>';
    $message .= '<h2>Congratulations!</h2>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">Thank you for your purchase. You can now log into your account and begin the course.</p>';
    $message .= '<p style="font-size:18px;margin-left: 15px;">Link to course: <a href="https://teachmehow.me/course-'.$courseLink.'">'.$courseName.'</a></p>';
    $message .= '<p style="font-size:18px;margin-left: 15px;">Email: '.$email.'</p>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">Password: '.$pass.'</p>';
    $message .= '<a href="https://teachmehow.me" style="background: black; color: white; padding: 11px 22px; font-size: larger; margin-left: 15px; border-radius: 20px;text-decoration: none;">Start Learning</a>';
    $message .= '</body></html>';
    $sql = "INSERT INTO users(firstname, lastname, email, contactNum, address, username, password, type, verified, pic) VALUES
            ('New','User','$email','','','','$pass_md5','Student', 1, 'default.jpg')";
    mysqli_query($con,$sql);
    $userId = mysqli_insert_id($con);
}


$s = "INSERT INTO users_courses(course_id, user_id) VALUES ($courseID, $userId)";
mysqli_query($con, $s);

$s = "INSERT INTO users_payments(course_id, user_id, response) VALUES ($courseID, $userId, '$response')";

if(mysqli_query($con, $s)){
    echo "yes";
}

$subject = 'Course payment successful | TeachMeHow';
sendMail($email, $subject, $message);