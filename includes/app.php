<?php
const ROOT_DIR = "./";

$con = mysqli_connect("localhost","root","","project_course");
//$con = mysqli_connect("localhost","j18jocnn_18joris","CPvvGapgy)Oy","j18jocnn_18jor");

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