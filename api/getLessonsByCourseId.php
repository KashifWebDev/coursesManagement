<?php
require_once '../includes/app.php';

header('Content-Type: application/json; charset=utf-8');
$output = array();

$courseID = sanitizeParam($_POST["courseID"]);
$chapterIDs = $_POST["chapterIDs"];

foreach($chapterIDs as $chapterID){
    $s = "SELECT id,course_id,chapter_id,name,type,arrange_order FROM lessons WHERE course_id=$courseID AND chapter_id=$chapterID ORDER BY arrange_order ASC";
//    echo $s;
    $res = mysqli_query($con, $s);
    if(mysqli_num_rows($res)){
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $lessons = array();
            array_push($output, $row);
        }
    }
}



echo json_encode($output);