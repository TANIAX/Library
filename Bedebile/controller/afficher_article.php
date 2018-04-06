<?php
require 'models/article.php';

if (isset($_GET['article_categorie'])) {
  $article = getArticleByKind($_GET['article_categorie']);
  if (empty($article)){header('Location: erreur');} // Faire une page avertissant qu'il n'y a pas d'article
  else {include 'views/afficher_article.php';}
}
else {
  header('Location: index');
  exit();
}
?>
