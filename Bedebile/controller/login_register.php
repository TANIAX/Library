<?php
require 'models/user.php';
// Test de l'envoi du formulaire
if(!empty($_POST))
{
                        /*Partie login*/
    // Les identifiants sont transmis ?
    if(!empty($_POST['login']) && !empty($_POST['password']))
    {
        $user = getUser($_POST['login']);
        $password = getPassword($_POST['login']);
        // Sont-ils les mêmes que les constantes ?
        if(!$user || !password_verify($_POST['password'] , $password['user_password']))
        {
          echo '<script>alert("Mauvais login ou mauvais mot de passe");</script>'; // TODO: Changer ça et faire quelques chose de plus propre en JS
        }
        else
        {
            // On ouvre la session
            session_start();
            // On enregistre le login en session
            $_SESSION['login'] = $user['user_login'];
            $_SESSION['role'] = $user['user_role'];
            // On redirige vers le fichier index.php
            header('Location: index');
            exit();
        }
    }
                                /*Partie enregistrement*/
  //On regarde si les formulaire sont rempli
   if(!empty($_POST['login_register']) && !empty($_POST['password_register']) && !empty($_POST['confirm-password_register']) && !empty($_POST['email_register'])){
      //Est ce que les 2 mot de passe sont identique ?
        if ($_POST['password_register'] === $_POST['confirm-password_register']){
            //Placement des données récupérée dans les formulaire dans des variables
            $login = $_POST['login_register'];
            $password = password_hash($_POST['password_register'], PASSWORD_DEFAULT);
            $mail = $_POST['email_register'];

            $exists = ExistLoginOrEmail($login,$mail);
            if ($exists) {
              //TODO Afficher un message d'erreur
            }
            else {
              //Transmission des variables à la base de données.
              $message = newUser($login, $password,$mail);
              header('Location: login_register');
              exit();
            }
        }
        //La vérification de mot de passe est-elle mauvaise ?
        else {
          echo '<script>$(".alert.alert-error").attr("hidden","");</script>';//// FIXME: Ne fonctionne pas
        }
    }
    //Les données du formulaire lors de l'inscription sont t-elle vide ?
    else
    {
      $errorMessage ="Champ vide lors de l'enregistrement";//TODO Remplacer ça pas du javascrip qui fait une alerte dynamique sans bloquer la page
    }
  }

include 'views/login_register.php';
?>
