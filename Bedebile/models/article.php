<?php
require "db.php";

function getArticle() {
    $bdd = getDb();
    $reponse = $bdd->query('SELECT * FROM articles');
    $donnees = $reponse->fetchAll();
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
}

function getArticleByKind($article_categorie) {
  $bdd = getDb();
  $reponse = $bdd->prepare('SELECT * FROM articles WHERE article_categorie = :article_categorie');
  $reponse->execute(array('article_categorie' => $article_categorie));
  $donnees = $reponse->fetchAll();
  $reponse->closeCursor(); // Termine le traitement de la requête
  return $donnees;
}

function searchArticle($data){  //Tuto expliquer en russe, j'ai rien compris.
  $bdd = getDb();
  $value = "%$data%";
  $reponse = $bdd->prepare('SELECT * FROM articles WHERE article_nom LIKE  ?');
  $reponse ->execute([$value]);
  $donnees = $reponse->fetchAll(\PDO::FETCH_UNIQUE);
  $reponse->closeCursor(); // Termine le traitement de la requête
  return $donnees;
}
?>
