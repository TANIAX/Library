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

function newArticle($nom, $prix, $date,$auteur,$editeur,$isbn,$image,$description,$categorie){
  $bdd = getDb();
    if (empty($auteur) && empty($editeur) && empty($isbn)) {
      $query = "INSERT INTO articles
      (article_nom, article_prix, article_date, article_image, article_description, article_categorie)
      VALUES('$nom','$prix','$date', '$image', '$description','$categorie')";
      $transaction = $bdd->prepare($query); // Faire cela s'appele une transaction.
      $transaction->execute();
      return $transaction;
    }else{
      $query = "INSERT INTO articles
      (article_nom, article_prix, article_date, article_auteur, article_editeur , article_isbn, article_image,article_description,article_categorie)
      VALUES('$nom','$prix','$date' ,'$auteur' , '$editeur' , '$isbn', '$image', '$description','$categorie')";
      $transaction = $bdd->prepare($query); // Faire cela s'appele une transaction.
      $transaction->execute();
      return $transaction;
    }
  }

function getArticleByIsbn($article_isbn){
  $bdd = getDb();
  $reponse = $bdd->prepare('SELECT article_isbn FROM articles WHERE article_isbn = :article_isbn');
  $reponse->execute(array('article_isbn' => $article_isbn));
  $donnees = $reponse->fetch();
  $reponse->closeCursor();
  return $donnees;
}
?>
