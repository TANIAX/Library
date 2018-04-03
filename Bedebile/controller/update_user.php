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
         $role = $_POST['role_update'];

         $exists = ExistLoginOrEmail($login,$mail);
         if ($exists) {
           if (($_POST['login_update'] === $_POST['login_update_default']) || ($_POST['email_update'] === $_POST['email_update_default'] && !empty($adresse)) ) {goto continue_;}
           echo "Changer e mail et login";//TODO Afficher un message d'erreur + exeception si pas de changement de login ou mail
         }
         elseif(!empty($adresse)) {
           //Transmission des variables à la base de données.
           continue_:
           updateUser($login, $password,$mail,$adresse,$id,$role);
           header('Location: welcome');
           exit();
         }

     }
     else {
       // TODO: Afficher erreur mot de passe non correspondant
     }
   }
   else {
     // TODO: Afficher une erreur de champs requis non rempli
   }
?>
