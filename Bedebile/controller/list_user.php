<?php
//Charge le le fichier user qui contient toutes les requete à propos des utilisateurs
require 'models/user.php';
//Set les variables afin de prévenir des erreurs.
$ERROR = array("UPDATEUSER" => "");
$SUCCES = array("UPDATEUSER" => "");
// Test de l'envoie du formulaire et verifie si l'utilisateur est admin
if(!empty($_GET['id']) && $_SESSION['role'] == 1){
  //Charge les données de l'utilisateur avec l'id transmis en get + sécurisation du get avec htmlspecialchars
  $user = getUserById(htmlspecialchars($_GET['id']));
  // une fois fais inclut la vue
  include 'views/edit_user.php';
  // Si pas admin ou pas de get transmis redirige vers le login
}else {
  header('Location: login_register');
}
?>
