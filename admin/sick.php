<?php 
session_start();

if($_SESSION["login"]) {
    include '../utils/connectdb.php';
    require 'vue/partials/header.php';
    include 'vue/partials/nav.php';
    require '../model/task.php';
    require 'vue/sick.php';

    if(isset($_POST['tasked_id'])){
        changePersonForTask( $_POST['tasked_id'] );
        header("Location: /admin/callendar.php");;
    }
    
} else {
    header("Location: /admin/");
} 