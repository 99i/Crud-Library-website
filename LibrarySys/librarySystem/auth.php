<?php
session_start();
require_once("main.php");
$main=new Main();

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $phone_number = $_POST['phone_number'];
    $isAdmin = 0;

    if ($main->Register($email,$password,$age,$isAdmin,$location,$phone_number,$name)) {
        header("Location: Done.php");
    } else {
        header("Location: error.php");
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($main->login($email,$password) !=false){
        $_SESSION['user'] = $main->login($email,$password);
        header("Location: Done.php");
    }else{
        header("Location: error.php");
    }
}

?>
