<?php
require 'models/article.php';
require 'models/panier.class.php';

if(isset($_GET['article_id'])){
  $article = getArticleIdById($_GET['article_id']);
  if(empty($article)){
    echo "Ce produit n'existe pas";
  }else {
    var_dump($article);
    $_SESSION['panier'][$article[0]->article_id] = 1;
    //$article->add($produit[0]->id);
  }
}else{
  echo "Vous n'avez pas sélectionné de produit à ajouter au panier";
}
?>
