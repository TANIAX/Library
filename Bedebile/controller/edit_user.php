<?php
session_start();
require 'models/user.php';
// Test de l'envoie du formulaire et est ce que l'utilsateur qui veux éditer est admin
if (!empty($_GET['id']) && $_SESSION['role'] == 1) {
    // Va chercher toutes les informations de l'utilisateur via l'id transmis du bouton
    $user = getUserById($_GET['id']);
    //Si pas admin ou pas d id transmis
} else {
    //Renvoie vers la page login
    header('Location: login_register');
    exit(); //Utile ? 
}
//Inclu la vue
include 'views/edit_user.php';
?>
