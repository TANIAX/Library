<?php
require 'models/commande.php';
//require 'models/article.php';
//Si utilisateur connecté
if (!empty($_SESSION['login'])) {
  //Si le panier contient au moins un article
  if (!empty($_SESSION['panier'])) {
    //Valide la commande avec l'id de l'utilisateur en parametre et les id des articles de son panier
    $ok = newCommand($_SESSION['id'],$_SESSION['panier']);
    //Si la fonction new command a renvoyer vrai, c'est que tout c'est bien passé
    if($ok) {
      //Du coup vide le Panier
      unset($_SESSION['panier']);
      //Et retourne à l'acceuil
      header('Location: index');
      //Si tout ne c'est pas bien passé, affiche une erreur
    } else {
      header('Location: erreur');// TODO: afficher erreur
    }
    //Si panier esy vide, redirige vers welcome
  }else {
    header('Location: welcome');
  }
  //Si pas d'utilisateur connecté, redirige l'utilisateur vers le login
}else {
  header('Location: login_register');
}

?>
