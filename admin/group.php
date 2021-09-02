<?php
session_start();

if($_SESSION["login"]) {

    require 'vue/partials/header.php';
    include '../utils/connectdb.php';
    include '../model/group.php';
    include 'vue/partials/nav.php';

    $group = getGroup();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if ($_POST['method'] == 'DELETE') {
            deleteGroup($_POST['id']);
        } else {
            createGroup($_POST['name']);
        }
        header("Refresh:0");
    }

    require 'vue/group.php';
    require 'vue/partials/footer.php'; 
} else {
    header("Location: /admin/");
} 
