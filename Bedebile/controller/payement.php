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
      header('Location: erreur');//// TODO: afficher erreur
    }
  }else {
    header('Location: panier');
  }
}else {
  header('Location: login_register');
}

?>
