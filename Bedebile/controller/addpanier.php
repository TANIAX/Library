<?php
//Inclu le model article et la classe Panier
require 'models/article.php';
require 'models/panier.class.php';
//Crée une nouvelle connexion à la base de données
$DB = new DB();
//Si l'utilisateur est connecté à son compte
if (!empty($_SESSION['login'])) {
  //Crée un objet panier
    $panier = new panier($DB);
    //Si l'id de l'article est transmis dans l'url
    if (isset($_GET['article_id'])) {
      //Prends toutes les données de l'article en question et place le dans une variable
        $article = getArticleIdById($_GET['article_id']);
        //Si la variable est vide, c'est que l'article n'existe pas, cela ne devraient pas arriver normalement
        if (empty($article)) {
            header('Location: erreur'); //// TODO: Afficher une page comme quoi l'article n'existe pas
            //Sinon si l'article existe, ajoute le au panier
        } else {
            $panier->add($article->article_id);
        }
        // si l'id n'a pas été transmis
    } else {
        header('Location: erreur');
    }
}

?>
<!-- Cela permet de revenir en arriere automatiquement -->
<script>
    window.history.back();
</script>
