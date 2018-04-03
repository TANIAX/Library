<?php
session_start();
require 'models/user.php';
// Test de l'envoie du formulaire
if(!empty($_GET) && $_SESSION['role'] == 1){
   $user = getUserById($_GET['id']);
}
else {
  header('Location: login_register');
  exit();
}
include 'views/edit_user.php';
?>
