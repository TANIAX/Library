<?php
require 'models/article.php';
require 'models/panier.class.php';
$DB = new DB();
$panier = new panier($DB);

if (isset($_GET['del'])) {
  deleteArticleFromPanier($_GET['del']);
}
if (!empty($_SESSION)) {
  $ids = array_keys($_SESSION['panier']);
  if (empty($ids)) {
    $article = array();
  }else {
    $article = articlePanier($ids);
  }
$prixtotal = $panier->total();
  include 'views/panier.php';
}

 ?>
