<?php
require 'models/article.php';
//Est ce que le lien recupere bien l'id de la catgegorie
if (isset($_GET['article_categorie']) && !empty($_GET['article_categorie'])) {
  //Envoie des données à la bdd en sécurisant l'envoie avec htmlspécialchar et place le résultat dans la variable article
  $article = getArticleByKind(htmlspecialchars($_GET['article_categorie']));
  //Si il n'y a pas d'article récuperer depuis la base de données
  if (empty($article)){header('Location: erreur');} // TODO: Faire une page avertissant qu'il n'y a pas d'article
  //Si il y a des articles, inclut la vue
  else {include 'views/afficher_article.php';}
}
//Si le get n'a pas l'id
else {
  header('Location: index');
}
?>
