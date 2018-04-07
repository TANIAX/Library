<?php
require "db.php";
//Cette fonction récupère toutes les données de tout les articles
function getArticle() {
    $bdd = getDb();
    $reponse = $bdd->query('SELECT * FROM articles');
    $donnees = $reponse->fetchAll();
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
}
//Cette fonction récupere les toutes les données en fonction du genre d'article transmis en argument
function getArticleByKind($article_categorie) {
  $bdd = getDb();
  $reponse = $bdd->prepare('SELECT * FROM articles WHERE article_categorie = :article_categorie');
  $reponse->execute(array('article_categorie' => $article_categorie));
  $donnees = $reponse->fetchAll();
  $reponse->closeCursor();
  return $donnees;
}
//Cette fonction recher un article en fonction des données que lui as transmis le moteur de recherche du site
function searchArticle($data){  //Tuto expliquer en russe, j'ai rien compris.
  $bdd = getDb();
  $value = "%$data%";
  if (isset($value)) {
    $reponse = $bdd->prepare('SELECT * FROM articles WHERE article_nom LIKE  ?'); // TODO: Ne pas baser le moteur de recherche que sur le nom
    $reponse ->execute([$value]);
    $donnees = $reponse->fetchAll(\PDO::FETCH_UNIQUE);
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
  }
  else {
    return null;// FIXME: Faire en sorte que la le bouton ne renvoie rien
  }
}
?>
