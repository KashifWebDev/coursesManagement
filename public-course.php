<?php
require_once "includes/app.php";
$courseID = sanitizeParam($_GET["id"]);


$s = "SELECT * FROM courses WHERE id=$courseID";
$res = mysqli_query($con, $s);
$courseRow = mysqli_fetch_array($res);
print_r($courseRow);