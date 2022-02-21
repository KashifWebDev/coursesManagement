<?php
require_once '../includes/app.php';

$output = array();

$courseID = sanitizeParam($_POST["courseID"]);
$s = "SELECT * FROM lessons WHERE course_id=$courseID ORDER BY arrange_order ASC";
$res = mysqli_query($con, $s);
if(mysqli_num_rows($res)){
    while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
        array_push($output, $row);
    }
}

echo json_encode($output);