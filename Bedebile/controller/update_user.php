<?php
require 'models/user.php';

$ERROR = array("UPDATEUSER" => "");
$SUCCES = array("UPDATEUSER" => "");

$login='';
$email ='';
$adresse ='';
$id='';
$role='';


if (isset($_POST)) {
  if (isset($_POST["update_submit-submit"])) {
      $errMsg = "";
      if ((!isset($_POST['login_update']) || !isset($_POST['login_update_default'])) || (empty($_POST['login_update'])) || empty($_POST['login_update_default'])) { //Pourquoi isset ou empty ?
          $errMsg .= "<li>Login vide</li>";
      }
      if (!isset($_POST['password_update']) || empty($_POST['password_update'])) {
          $errMsg .= "<li>Password vide</li>";
      }
      if (!isset($_POST['password_verify_update']) || empty($_POST['password_verify_update'])) {
          $errMsg .= "<li>Password verification vide</li>";
      }
      if ($_POST['password_update'] !== $_POST['password_verify_update']) {
          $errMsg = "<li>Les mots de passe ne correspondent pas</li>";
      }
      if ($_POST['login_update'] !== $_POST['login_update_default']) {
          $user = getUser($_POST['login_update']);
          if ($user) {
            $errMsg .= "<li>Login déjà existant</li>";
          }
          else {
              $login ='nochange';
          }
      }
      if ($_POST['email_update'] !== $_POST['email_update_default']) {
          $email = getUserByMail($_POST['email_register']);
          if ($email) {
            $errMsg .= "<li>Email déjà existant</li>";
          }
          else {
            $mail ='nochange';
          }
      }
      if (strlen($errMsg) != 0) {
        echo "string";
        $ERROR["UPDATEUSER"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
      }
      else {
        $SUCCES["UPDATEUSER"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
      }
      if (strlen($errMsg) == 0) {
        echo "string";
      }

    }
  }
  /*if ($login != 'nochange') {$login = $_POST['login_update'];}
  if ($email != 'nochange') {$mail = $_POST['email_update'];}
    $password = password_hash($_POST['password_update'], PASSWORD_DEFAULT);
    updateUser($login, $password,$mail,$adresse,$id,$role);
    header('Location: welcome');
    exit();*/





/*if(!empty($_POST['login_update']) && !empty($_POST['password_update']) && !empty($_POST['password_verify_update']) && !empty($_POST['email_update'])){
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
   }*/
?>
