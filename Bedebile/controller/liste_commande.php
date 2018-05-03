<?php
require 'models/commande.php';

//Si l'utilisateur est connecté
if (!empty($_SESSION['login'])) {
  //Si il est admin
  if ($_SESSION['role'] == 1 ) {
    //Cherche la liste de toutes les commandes dans la base de données
    $liste  = getListeCommande();
    //Initialise un tableau "commandes" vide
    $commandes = array();
    //Pour chaque commande de la liste
    foreach($liste as $commande){ //Je boucle dans l'ensemble de mes commandes
      //Initialisation de info à vide à chaque tour de boucle, pour effacé les données des anciennes commandes
      $info = array();
      //Crée un tableau avec la clé commande, qui contiendra toutes les information de commande
      $info['commande'] = $commande;
      //Crée un tableau avec la clé user, qui contiendra toutes les information de l'utilisateur
      $info['user'] = getUserById($commande->commande_user_id); // Je récupère l'utilisateur de la commande
      //Crée un tableau avec la clé articles, qui contiendra toutes les information des articles
      $info['articles'] = getArticlesByCommandeId($commande->commande_id); // Je récupère l'ensemble des articles de la commande
      //Place toutes les information du tableau info, dans une liste qui s'appelles, commandes
      array_push($commandes, $info);
    }
    //Inclu la vue
    include 'views/liste_commande.php';
  }
}
?>
