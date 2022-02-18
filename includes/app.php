<?php
const ROOT_DIR = "http://localhost:8080/courses/";

$con = mysqli_connect("localhost","root","","project_18j");
//$con = mysqli_connect("localhost","j18jocnn_18joris","CPvvGapgy)Oy","j18jocnn_18jor");

// Check connections
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$GLOBALS["con"] = $con;