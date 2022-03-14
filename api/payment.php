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