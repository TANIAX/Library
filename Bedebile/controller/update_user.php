<?php
require 'models/user.php';

$ERROR = array("UPDATEUSER" => "");
$SUCCES = array("UPDATEUSER" => "");

$user = getUser($_POST['login_update']);

$name ='';
$firstname ='';
$login='';
$email ='';
$adresse ='';
$id='';
$role='';

if (isset($_POST)) {
      $errMsg = "";
      if (!isset($_POST['login_update']) || empty($_POST['login_update'])) { //Pourquoi isset ou empty ?
          $errMsg .= "<li>Login vide</li>";
      }
      if (!isset($_POST['name_update']) ||empty($_POST['name_update'])) {
          $errMsg .= "<li>Nom vide</li>";
      }
      if (!isset($_POST['firstname_update']) || empty($_POST['firstname_update'])) {
          $errMsg .= "<li>Prénom vide</li>";
      }
      if (!isset($_POST['password_update']) || empty($_POST['password_update'])) {
          $errMsg .= "<li>Password vide</li>";
      }
      if (!isset($_POST['password_verify_update']) || empty($_POST['password_verify_update'])) {
          $errMsg .= "<li>Password verification vide</li>";
      }
      if (!isset($_POST['email_update']) || empty($_POST['email_update'])) {
          $errMsg .= "<li>email vide</li>";
      }
      if ($_POST['password_update'] !== $_POST['password_verify_update']) {
          $errMsg = "<li>Les mots de passe ne correspondent pas</li>";
      }
      if ($_POST['login_update'] !== $_POST['login_update_default']) {
          $user = getUser($_POST['login_update']);
          if ($user) {
            $errMsg .= "<li>Login déjà existant</li>";
          }
      }
      if ($_POST['email_update'] !== $_POST['email_update_default']) {
          $email = getUserByMail($_POST['email_update']);
          if ($email) {
            $errMsg .= "<li>Email déjà existant</li>";
          }
      }
      if (strlen($errMsg) != 0) {
        $ERROR["UPDATEUSER"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
      }
      else {
        $SUCCES["UPDATEUSER"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
      }
      if (strlen($errMsg) == 0) {
            $name = $_POST['name_update'];
            $firstname = $_POST['firstname_update'];
            $login = $_POST['login_update'];
            $mail = $_POST['email_update'];
            $password = password_hash($_POST['password_update'], PASSWORD_DEFAULT);
            $id = $_POST['id_update'];
            $role=$_POST['role_update'];
            $adresse=$_POST['adresse_update'];

          updateUser($name,$firstname,$login, $password,$mail,$adresse,$id,$role);

      }

    }
    include 'views/edit_user.php';

?>
