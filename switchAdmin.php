<?php

require_once 'includes/app.php';

if(isset($_GET["impersonate"])){
    $userID = sanitizeParam($_GET["impersonate"]);
    $s = "SELECT * FROM users WHERE id=$userID";
    $res = mysqli_query($con, $s);
    $row = mysqli_fetch_array($res);
    $_SESSION["impersonate"] = true;
    $_SESSION["impersonateAdminId"] = $_SESSION["userID"];
    $_SESSION["userID"] = $row["id"];
    $_SESSION["firstName"] = $row["firstname"];
    $_SESSION["fullName"] = $row["firstname"].' '.$row["lastname"];
    $_SESSION["role"] = $row["type"];
    if($row["type"]=="Instructor"){
        redirect('instructorDashboard.php');
    }
    if($row["type"]=="Student"){
        redirect('studentDashboard.php');
    }
}


if(isset($_GET["admin"])){
    $userID = $_SESSION["impersonateAdminId"];
    $s = "SELECT * FROM users WHERE id=$userID";
    $res = mysqli_query($con, $s);
    $row = mysqli_fetch_array($res);
    $_SESSION["impersonate"] = false;
    $_SESSION["impersonateAdminId"] = null;
    $_SESSION["userID"] = $row["id"];
    $_SESSION["firstName"] = $row["firstname"];
    $_SESSION["fullName"] = $row["firstname"].' '.$row["lastname"];
    $_SESSION["role"] = $row["type"];
    if($row["type"]=="Instructor"){
        redirect('instructorDashboard.php');
    }
    if($row["type"]=="Student"){
        redirect('studentDashboard.php');
    }
    if($_SESSION["role"]=="Admin"){
        redirect('adminDashboard.php');
    }
}

function redirect($addr){
    error_reporting(E_ALL | E_WARNING | E_NOTICE);
    ini_set('display_errors', TRUE);
    flush();

    echo '<script>window.location.replace("'.$addr.'");</script>';
    echo '<script>window.location("'.$addr.'");</script>';
//    header('Location: '.$addr);
}
?>