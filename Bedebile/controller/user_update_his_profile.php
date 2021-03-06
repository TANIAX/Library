<?php
//Charge le le fichier user qui contient toutes les requete à propos des utilisateurs
require 'models/user.php';
//Set les variable à vide
$ERROR = array("UPDATEUSER" => "");
$SUCCES = array("UPDATEUSER" => "");

//Variable afin de préremplir le formulaire

$user = getUserById($_SESSION['id']);


// Set les variables à vide afin de prévenir des erreurs
$name = '';
$firstname = '';
$login = '';
$email = '';
$adresse = '';
$id = '';
$role = '';
$tel = '';

// Test de l'envoi du formulaire, si remplit ne met rien dans la variable errMsg
if (isset($_POST["update-user"])) {

    $errMsg = "";
    //Si le formulaire du login est vide
    if (!isset($_POST['login_update']) || empty($_POST['login_update'])) { //Pourquoi isset ou empty ?
        // Place une erreur dans errMsg
        $errMsg .= "<li>Login vide</li>";
    }
    if (strlen($_POST['login_update']) >= 255) {
        $errMsg .= "<li>Login trop grand</li>";
    }
    //Pareille pour le nom
    if (!isset($_POST['name_update']) || empty($_POST['name_update'])) {
        $errMsg .= "<li>Nom vide</li>";
    }
    if (strlen($_POST['name_update']) >= 50) {
        $errMsg .= "<li>Nom trop grand</li>";
    }
    //Pareille pour le prénom
    if (!isset($_POST['firstname_update']) || empty($_POST['firstname_update'])) {
        $errMsg .= "<li>Prénom vide</li>";
    }
    if (strlen($_POST['firstname_update']) >= 50) {
        $errMsg .= "<li>Prénom trop grand</li>";
    }
    //Pareille pour le mdp
    if (!isset($_POST['password_update']) || empty($_POST['password_update'])) {
        $errMsg .= "<li>Password vide</li>";
    }
    if (strlen($_POST['password_update']) >= 50) {
        $errMsg .= "<li>Mot de passe trop grand</li>";
    }
    //Pareille pour la verification de mdp
    if (!isset($_POST['password_verify_update']) || empty($_POST['password_verify_update'])) {
        $errMsg .= "<li>Password verification vide</li>";
    }//Pareille pour l'email
    if (!isset($_POST['email_update']) || empty($_POST['email_update'])) {
        $errMsg .= "<li>email vide</li>";
    }
    if (strlen($_POST['email_update']) >= 50) {
        $errMsg .= "<li>Email trop grand</li>";
    }
    //Si le mdp et la verification de mdp ne sont pas exactement les même, même type et même string
    if (strlen($_POST['phonenumber_update']) > 11) {
        $errMsg .= "<li>Numéro de telephone invalide</li>";
    }
    if ($_POST['password_update'] !== $_POST['password_verify_update']) {
        $errMsg = "<li>Les mots de passe ne correspondent pas</li>";
    }//Si le login mis à jours est différent de celui avant la mise à jours
    if ($_POST['login_update'] !== $_POST['login_update_default']) {
        //Vérifie si il n'existe pas déjà dans la base de donnée
        $usertest = getUser($_POST['login_update']);
        //Si il existe déjà,Met une erreur dans la variabel errMsg
        if ($usertest) {
            $errMsg .= "<li>Login déjà existant</li>";
        }
    }//Pareille que pour le login
    if ($_POST['email_update'] !== $_POST['email_update_default']) {
        $email = getUserByMail($_POST['email_update']);
        if ($email) {
            $errMsg .= "<li>Email déjà existant</li>";
        }
    }
    //Si errMsg à une longeur differente que 0 on en conclu qu'il y a eu une erreur
    if (strlen($errMsg) != 0) {
        // Place la dans la variable settée au début du fichier. et contatene la avec une alert bootstrap
        $ERROR["UPDATEUSER"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
    } //Si pas c'est qu'il n'y a pas eu d'erreur, envoie une alerte comme quoi l'utilisateur à bien été enregistrer
    else {
        $SUCCES["UPDATEUSER"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
        //Place toutes les données que tu as besoins dans des variables
        $name = htmlspecialchars($_POST['name_update']);
        $firstname = htmlspecialchars($_POST['firstname_update']);
        $login = htmlspecialchars($_POST['login_update']);
        $mail = htmlspecialchars($_POST['email_update']);
        $password = password_hash($_POST['password_update'], PASSWORD_DEFAULT); //Pas besoin de proteger le mdp pcq il est haché // TODO: poser la question au prof
        $id = $_SESSION['id'];
        $role = $_SESSION['role'];
        $adresse = htmlspecialchars($_POST['adresse_update']);
        $tel = htmlspecialchars($_POST['phonenumber_update']);
        //Envoie les à la base de données + securisation avec htmlspecialchars
        updateUser($name, $firstname, $login, $password, $mail, $adresse, $id, $role, $tel);
    }
}
//Inclu la vue*/
include 'views/user_update_his_profile.php';

?>
