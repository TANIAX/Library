<?php
require 'models/article.php';
if (isset($_GET)) {
  if (isset($_GET['valeur'])) {
    $article = searchArticle($_GET['valeur']);
    include 'views/afficher_article.php';
    //echo '<h1>allahu akbar !</h1>';
    //echo '<img src="https://upload.wikimedia.org/wikipedia/commons/4/4f/Explosions_at_Miramar_Airshow.jpg" alt="">';
  }

}
?>
