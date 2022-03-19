<?php
require_once '../includes/app.php';

$courseID = $_POST["courseID"];
$email = $_POST["email"];
$response = $_POST["response"];

$sql= "SELECT * FROM courses WHERE id = $courseID";
$courseRow = mysqli_query($con, $sql);
$courseName = $courseRow["title"];
$courseLink = $courseRow["courseID"];

$sql= "SELECT * FROM users WHERE email = '$email'";
$checkEmail = mysqli_query($con, $sql);
if(mysqli_num_rows($checkEmail)>0) {
    $userRow = mysqli_fetch_array($checkEmail);
    $userId = $userRow["id"];
    $message = '<html><body>';
    $message .= '<h2>Congrats!</h2>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">It is to inform you that, you recently purchased a course, and now you can log in to your account to start learning without any interruptions!.</p>';
    $message .= '<a href="https://teachmehow.me" style="background: black; color: white; padding: 11px 22px; font-size: larger; margin-left: 15px; border-radius: 20px;text-decoration: none;">Start Learning</a>';
    $message .= '</body></html>';
}else{
    $pass = generateRandomString(8);
    $message = '<html><body>';
    $message .= '<h2>Congratulations!</h2>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">It is to inform you that, you recently purchased a course. In order to watch the course use the following details:</p>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">Link to course: <a href="https://teachmehow.me/course-'.$courseLink.'"></a>'.$courseName.'</p>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">Email: '.$email.'</p>';
    $message .= '<p style="font-size:18px;margin-left: 15px; margin-bottom: 28px;">Password: '.md5($pass).'</p>';
    $message .= '<a href="https://teachmehow.me" style="background: black; color: white; padding: 11px 22px; font-size: larger; margin-left: 15px; border-radius: 20px;text-decoration: none;">Start Learning</a>';
    $message .= '</body></html>';
    $sql = "INSERT INTO users(firstname, lastname, email, contactNum, address, username, password, type) VALUES
            ('New','User','$email','','','','$pass','Student')";
    mysqli_query($con,$sql);
    $userId = mysqli_insert_id($con);
}


$s = "INSERT INTO users_courses(course_id, user_id) VALUES ($courseID, $userId)";
mysqli_query($con, $s);

$s = "INSERT INTO users_payments(course_id, user_id, response) VALUES ($courseID, $userId, '$response')";

if(mysqli_query($con, $s)){
    echo "yes";
}

$subject = 'Course purchase successful | TeachMeHow';
sendMail($email, $subject, $message);