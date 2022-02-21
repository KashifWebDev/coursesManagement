<?php
require_once '../includes/app.php';

$output = array();

$ids = $_POST['ids'];
$arr = explode(',',$ids);
for($i=1;$i<=count($arr);$i++)
{
    $q = "UPDATE lessons SET arrange_order = ".$i." WHERE id = ".$arr[$i-1];
    mysqli_query($con,$q);
}
echo json_encode(array("refresh"=>1));