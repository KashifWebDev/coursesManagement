<?php
require_once '../includes/app.php';
require_once '../includes/functions.php';

$output = array();

$courseID = sanitizeParam($_POST["courseID"]);

$s = "SELECT * FROM course_intro WHERE course_id = $courseID ORDER BY id DESC LIMIT 1";
$res = mysqli_query($con, $s);
$courseRow = mysqli_fetch_array($res);
echo $courseRow["content"];
