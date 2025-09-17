<?php

include_once "config.php";
session_start();
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];
$admin_email = $_SESSION['admin_email'];

$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];
$student_email = $_SESSION['student_email'];

if(isset($admin_id)){
    $status = 'Offline';
    $sql = mysqli_query($conn, "UPDATE users SET Status = '$status' WHERE ID = $admin_id");
    if($sql){
        session_unset();
        session_destroy();
        header("location: login.php");
    }
}

if(isset($student_id)){
    $status = 'Offline';
    $sql = mysqli_query($conn, "UPDATE users SET Status = '$status' WHERE ID = $student_id");
    if($sql){
        session_unset();
        session_destroy();
        header("location: login.php");
    }
}

?>