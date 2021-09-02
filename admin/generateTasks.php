<?php 
session_start();

if($_SESSION["login"]) {
    include '../utils/connectdb.php';
    require '../model/task.php';

    gennerateTasks(new DateTime($_POST['from']), new DateTime($_POST['to']));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: /admin/");
} 