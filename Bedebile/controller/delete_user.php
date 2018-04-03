<?php
require 'models/user.php';
session_start();
if(empty($_SESSION['login'])){
    header('Location: welcome');
    exit();
}

if(!empty($_GET['id']))
{
    $user = deleteUser($_GET['id']);
    header('Location: welcome');
    exit();
}
?>
