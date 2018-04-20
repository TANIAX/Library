<?php
require 'models/commande.php';
//require 'models/article.php';

if (!empty($_SESSION['login'])) {
  if (!empty($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    $article = articlePanier($ids);
    $ok = newCommand($_SESSION['id'],$article);
    if($ok) {
      unset($_SESSION['panier']);
      header('Location: index');
    } else {
      echo "pute";//// TODO: afficher erreur
    }
    // $ids = array_keys($_SESSION['panier']);
  }
}

 ?>
