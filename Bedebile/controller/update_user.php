<?php
session_start();
require 'models/user.php';
if(!empty($_POST['login_update']) && !empty($_POST['password_update']) && !empty($_POST['password_verify_update']) && !empty($_POST['email_update'])){
   //Est ce que les 2 mot de passe sont identique ?
     if ($_POST['password_update'] === $_POST['password_verify_update']){
         //Placement des données récupérée dans les formulaire dans des variables
         $login = $_POST['login_update'];
         $password = password_hash($_POST['password_update'], PASSWORD_DEFAULT);
         $mail = $_POST['email_update'];
         $adresse = $_POST['adresse_update'];
         $id = $_POST['id_update'];
         if (empty($id)) {
           echo "empty id";
         }

         $exists = ExistLoginOrEmail($login,$mail);
         if ($exists) {
           echo "Changer e mail et login";//TODO Afficher un message d'erreur + exeception si pas de changement de login ou mail
         }
         elseif(!empty($adresse)) {
           //Transmission des variables à la base de données.
           updateUserWithAdress($login, $password,$mail,$adresse,$id);
           header('Location: welcome');
           exit();
         }
         else {
           updateUser($login, $password,$mail,$id);
           header('Location: welcome');
           exit();
         }
     }
   }
?>
