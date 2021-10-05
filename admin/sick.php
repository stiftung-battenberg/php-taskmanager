<?php 
session_start();

if($_SESSION["login"]) {
    require '../config.php';
    require_once '../utils/connectdb.php';
    require '../model/task.php';
    require '../model/user.php';

    if(isset($_POST['tasked_id'])){
        randomPersonForTask( $_POST['tasked_id'] );
        header("Location: /admin/callendar.php");
    }
    if(isset($_POST['id_user'])){
        changePersonForTask( $_GET['tasked_id'], $_POST['id_user']);
        header("Location: /admin/callendar.php");
    }
    
    require 'vue/partials/header.php';
    include 'vue/partials/nav.php';

    $tasked = R::load('tasked',  $_GET['tasked_id']);
    $user = [];
    foreach ($tasked->task->sharedGroup as $group) {
        $user = array_merge($user, $group->ownUserList);
    }
    require 'vue/sick.php';


    
} else {
    header("Location: /admin/");
} 