<?php
//Set les variable à vide
$ERROR = array("REGISTER" => "", "LOGIN" => "");
$SUCCES = array("REGISTER" => "");
//Si l'on viens de login
$forLogin = true;
//Charge le le fichier user qui contient toutes les requete à propos des utilisateurs
require 'models/user.php';
//Condition ternaire, Si le login transmis en post est remplit alors LG_Login = $_POST['login'] si pas LG_Login=""
$LG_Login = isset($_POST['login']) ? $_POST['login'] : "";
$LG_Password = isset($_POST['password']) ? $_POST['password'] : "";

//Set les variable à vide afin de prévenir des erreurs
$RE_Login = '';
$RE_Password = '';
$RE_Email = '';
$errMsg='';
// Test de l'envoi du formulaire
if (isset($_POST)) {
                                /*Partie login*/
      //Si le login submit est remplie, ne met rien dans la variable errMsg
    if (isset($_POST["login-submit"])) {
        $errMsg = "";
        //Si pas met une erreur dans la variable errMsg
        if (!isset($_POST['login']) || empty($_POST['login'])) { //Pourquoi isset ou empty ?
            $errMsg .= "<li>Login vide</li>";
        }
        //Pareille pour le mdp
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            $errMsg .= "<li>Password vide</li>";
        }
        //Si la longeur de la variable errMsg est 0 on en conclu que il n'a pas rencontrer d'erreur
        if (strlen($errMsg) == 0) {
            //Va chercher les informations de utilisateur via le login transmis dans le post + securisation avec htmlspecialchars
            $user = getUser(htmlspecialchars($_POST['login']));
            //A-til trouver des données ? non ?
            if (!$user) {
                //Place une erreur dans errMsg
                $errMsg = "<li>Compte inconnu</li>";
            //Pas d'erreur ?
            } else {
                //Verifie si le password de la base de données correspond avec celui transmis dans le formulaire / Ne correspondent t'il pas ?
                if (!password_verify($_POST['password'], $user['user_password'])) {
                    //Place une erreur dans errMsg
                    $errMsg = "<li>Password invalid</li>";
                }
            }
        }//Si errMsg à une longeur differente que 0 on en conclu qu'il y a eu une erreur
        if (strlen($errMsg) != 0) {
            // Place la dans la variable settée au début du fichier. et contatene la avec une alert bootstrap
            $ERROR["LOGIN"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
        } else {
            //Si pas d'erreur On enregistre le login et le rôle en session
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
        if (!isset($_POST['login_register']) || empty($_POST['login_register'])) {
            $errMsg .= "<li>Login vide</li>";
        }
        if (!isset($_POST['name_register']) || empty($_POST['name_register'])) {
            $errMsg .= "<li>Nom vide</li>";
        }
        if (!isset($_POST['firstname_register']) || empty($_POST['firstname_register'])) {
            $errMsg .= "<li>Prénom vide</li>";
        }
        if (!isset($_POST['adresse_register']) || empty($_POST['adresse_register'])) {
            $errMsg .= "<li>Adresse vide</li>";
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
            $name = $_POST['name_register'];
            $firstname = $_POST['firstname_register'];
            $adresse = $_POST['adresse_register'];
            $message = newUser($login, $password, $mail,$name,$firstname,$adresse);
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
