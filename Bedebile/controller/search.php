<?php
require 'models/article.php';
//Est ce que la barre de recherche à transmis quelque chose ?
if (isset($_GET) && !empty($_GET)) {
    //Est ce que la barre de recherche à transmis les bonne valeur ?
    if (isset($_GET['valeur']) && !empty($_GET['valeur'])) {
        //Envoie des données à la bdd en sécurisant l'envoie avec htmlspécialchar et place le résultat dans la variable article
        $article = searchArticle(htmlspecialchars($_GET['valeur']));
        //Inclue la vue
        include 'views/afficher_article.php';
        //Si pas les bonne valeur, renvoie vers erreur
    } else {
        header('Location: erreur');
    }
}

?>
