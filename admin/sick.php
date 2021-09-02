<?php 
session_start();

if($_SESSION["login"]) {
    include '../utils/connectdb.php';
    require '../model/task.php';
    
    changePersonForTask( $_GET['tasked_id'] );
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: /admin/");
} 