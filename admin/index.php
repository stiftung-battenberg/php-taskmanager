<?php
session_start();

$username = "admin";
$password = "Admlocal1";

if (isset($_POST['password']) && isset( $_POST['username']) ){
    if($password == $_POST['password'] && $username == $_POST['username']) {
        $_SESSION["login"] = true;
    }
}
if(isset($_SESSION["login"])){
    if($_SESSION["login"]) {
        header("Location: /admin/group.php");
    }
}

require 'vue/login.php';
?>
