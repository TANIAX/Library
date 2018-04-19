<?php
require 'models/article.php';
require 'models/panier.class.php';
$DB = new DB();
$panier = new panier($DB);

if(isset($_GET['article_id'])){
  $article = getArticleIdById($_GET['article_id']);
  if(empty($article)){
    echo "Ce produit n'existe pas";
  }else {
    $panier->add($article->article_id);
  }
}else{
  echo "Vous n'avez pas sélectionné de produit à ajouter au panier";
}
?>
<script>
  window.history.back();
</script>
