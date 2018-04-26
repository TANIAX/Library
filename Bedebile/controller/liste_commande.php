<?php
require 'models/commande.php';

if (!empty($_SESSION)) {
  if ($_SESSION['role'] == 1 ) {
    $liste  = getListeCommande();
    $commandes = array();
    foreach($liste as $commande){ //Je boucle dans l'ensemble de mes commandes
      $info = array();
      $info['commande'] = $commande;
      $info['user'] = getUserById($commande->commande_user_id); // Je récupère l'utilisateur de la commande
      $info['articles'] = getArticlesByCommandeId($commande->commande_id); // Je récupère l'ensemble des articles de la commande
      array_push($commandes, $info);
    }
    include 'views/liste_commande.php';
  }
}
?>
