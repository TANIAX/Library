<?php
require 'models/user.php';
$ERROR = array("UPDATEUSER" => "");
$SUCCES = array("UPDATEUSER" => "");
// Test de l'envoie du formulaire
if(/*!empty($_GET) && */$_SESSION['role'] == 1){
   $user = getUserById($_GET['id']);
}
else {
  header('Location: login_register');
  exit();
}
include 'views/edit_user.php';
?>
