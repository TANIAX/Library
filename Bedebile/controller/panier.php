<?php
//Charge le modele article
require 'models/article.php';
//Charge la classe Panier
require 'models/panier.class.php';
//Si il y a un utilisateur connecté
if (!empty($_SESSION['login'])) {
    //Crée une nouvelle instance à la bdd
    $DB = new DB();
    //Crée une nouvelle instance de panier
    $panier = new panier($DB);
    //Si le bouton delete du panier à été cliquer
    if (isset($_GET['del'])) {
        // Supprime l'objet du panier
        deleteArticleFromPanier($_GET['del']);
    }else {
      // TODO:
    }
    // Place dans la variable id  un tableau contenant les ids des items que l'ont a dans notre panier comme clés
    $ids = array_keys($_SESSION['panier']);
    //Si id est vide
    if (empty($ids)) {
      //Initialise le tableau article à vide
        $article = array();
      //Sinon va prendre toutes les informations des articles dont l'id est présent dans le tableau id , et le place dans la variable article
    } else {
        $article = articlePanier($ids);
    }
    //Apelle la méthode total de la classe Panier et place le dans la variable , prix total
    $prixtotal = $panier->total();
    //Inclu la vue panier
    include 'views/panier.php';
    //Si pas d'utilisateur connectés
}else {
  header('Location: login_register');
}

?>
