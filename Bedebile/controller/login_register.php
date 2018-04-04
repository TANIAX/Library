<?php
$ERROR = array("REGISTER" => "", "LOGIN" => "");
$SUCCES = array("REGISTER" => "");
$forLogin = true;
require 'models/user.php';

$LG_Login = isset($_POST['login']) ? $_POST['login'] : "";
$LG_Password = isset($_POST['password']) ? $_POST['password'] : "";

$RE_Login = '';
$RE_Password = '';
$RE_Email = '';
$errMsg='';
// Test de l'envoi du formulaire
if (isset($_POST)) {
          /*Partie login*/
    if (isset($_POST["login-submit"])) {
        $errMsg = "";
        if (!isset($_POST['login']) || empty($_POST['login'])) { //Pourquoi isset ou empty ?
            $errMsg .= "<li>Login vide</li>";
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            $errMsg .= "<li>Password vide</li>";
        }
        if (strlen($errMsg) == 0) {
            $user = getUser($_POST['login']);
            if (!$user) {
                $errMsg = "<li>Compte inconnu</li>";
            } else {
                $password = getPassword($_POST['login']);
                if (!password_verify($_POST['password'], $password['user_password'])) {
                    $errMsg = "<li>Password invalid</li>";
                }
            }
        }
        if (strlen($errMsg) != 0) {
            $ERROR["LOGIN"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
        } else {
            // On enregistre le login en session
            $_SESSION['login'] = $user['user_login'];
            $_SESSION['role'] = $user['user_role'];
            // On redirige vers le fichier index.php
            header('Location: index');
            exit();
        }
    }
        /*Partie enregistrement*/
    if (isset($_POST["register-submit"])) {
        $forLogin = false;
        $errMsg = "";
        if (!isset($_POST['login_register']) || empty($_POST['login_register'])) { //Pourquoi isset ou empty ?
            $errMsg .= "<li>Login vide</li>";
        }
        if (!isset($_POST['password_register']) || empty($_POST['password_register'])) {
            $errMsg .= "<li>Password vide</li>";
        }
        if (!isset($_POST['confirm-password_register']) || empty($_POST['password_register'])) {
            $errMsg .= "<li>Password verification vide</li>";
        }
        if (!isset($_POST['email_register']) ||empty($_POST['email_register'])){
            $errMsg .= "<li>Email vide</li>";
        }
        $user = getUser($_POST['login_register']);
        if ($user) {
          $errMsg .= "<li>Login déjà existant</li>";
        }
        $email = getUserByMail($_POST['email_register']);
        if ($email) {
          $errMsg .= "<li>Email déjà existant</li>";
        }
        if ($_POST['password_register'] !== $_POST['confirm-password_register']) {
            $errMsg = "<li>Les mots de passe ne correspondent pas</li>";
        }

        if (strlen($errMsg) == 0) {
            $login = $_POST['login_register'];
            $password = password_hash($_POST['password_register'], PASSWORD_DEFAULT);
            $mail = $_POST['email_register'];
            $message = newUser($login, $password, $mail);
            if ($message) {
              $SUCCES["REGISTER"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
            }
        }
      }
        if (strlen($errMsg) != 0) {
            $ERROR["REGISTER"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
        }
    }


include 'views/login_register.php';
?>
