<?php
require 'models/commande.php';

if (!empty($_SESSION)) {
  if ($_SESSION['role'] == 1 ) {
    $commandes  = getListeCommande();
    foreach($commandes as $commande){ //Je boucle dans l'ensemble de mes commandes
      //var_dump($commande); // Je print le contenu de mon objet commande
      $user = getUserById($commande->commande_user_id); // Je récupère l'utilisateur de la commande
      $articles = getArticlesByCommandeId($commande->commande_id); // Je récupère l'ensemble des articles de la commande
      //var_dump($user); // Je print le contenu de mon objet user
      //var_dump($articles);
      foreach($articles as $article) { // Je boucle dans les articles de la commande
         var_dump($article); // Je print le contenu de mon objet article
      }
    }

    include 'views/liste_commande.php';
  }
}
?>
