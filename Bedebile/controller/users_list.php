<?php
//Charge le le fichier user qui contient toutes les requete à propos des utilisateurs
require 'models/user.php';
//Si l'utilisateur connecter est admin
if ($_SESSION['role'] == 1) {
    //Prends tout les utilisateur de la bdd et stocke les dans la variable users
    $user = getUsers();
    //Inclu la vue
    include 'views/users_list.php';
    //Si pas redirige vers index
} else {
    header('Location: index');
}
?>
