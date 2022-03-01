<?php
require_once "includes/app.php";
require_once "includes/functions.php";
$id = sanitizeParam($_GET["id"]);

$s = "UPDATE users SET verified=1 WHERE id = $id";
if(mysqli_query($con, $s)){
    header('Location: ../index.php?verified=1');
}