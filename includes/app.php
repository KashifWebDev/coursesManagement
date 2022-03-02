<?php
session_start();
const ROOT_DIR = "./";

$con = mysqli_connect("localhost","root","","project_course");
//$con = mysqli_connect("localhost","spacezz_courses","spacezz_courses@123","spacezz_courses");

// Check connections
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$GLOBALS["con"] = $con;


function sanitizeParam($param){
    $con = $GLOBALS["con"];
    $param = $con->real_escape_string($param);
    return $param;
}

function validateSession(){
    if(!isset($_SESSION["fullName"])){
        header('Location: index.php?sessionOut=true');
    }
}