<?php
require 'models/db.class.php';

function getArticle()
{
    $DB = new DB();
    $req = $DB->db->prepare('SELECT * FROM articles');
    $req->execute();
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function articlePanier($article_id)
{
    $DB = new DB();
    $req = $DB->db->prepare('SELECT * FROM articles where article_id IN (' . implode(',', $article_id) . ')');
    $req->execute($article_id);
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function articlePanierIdPrice($article_id)
{
    $DB = new DB();
    $req = $DB->db->prepare('SELECT article_id , article_prix  FROM articles where article_id IN (' . implode(',', $article_id) . ')');
    $req->execute($article_id);
    return $req->fetchAll(PDO::FETCH_OBJ);
}

function getArticleByKind($article_categorie)
{
    $DB = new DB();
    $req = $DB->db->prepare('SELECT * FROM articles WHERE article_categorie = :article_categorie');
    $req->execute(array('article_categorie' => $article_categorie));
    $donnees = $req->fetchAll(PDO::FETCH_OBJ);
    $req->closeCursor();
    return $donnees;
}

function searchArticle($data)
{  //Tuto expliquer en russe, j'ai rien compris.
    $DB = new DB();
    $value = "%$data%";
    if (isset($value)) {
        $req = $DB->db->prepare('SELECT * FROM articles WHERE article_nom LIKE  ?'); // TODO: Ne pas baser le moteur de recherche que sur le nom
        $req->execute([$value]);
        $donnees = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor(); // Termine le traitement de la requête
        return $donnees;
    } else {
        return null;// FIXME: Faire en sorte que la le bouton ne renvoie rien
    }
}


function newArticle($nom, $prix, $date, $auteur, $editeur, $isbn, $image, $description, $categorie)
{
    $DB = new DB();
    if (empty($auteur) && empty($editeur) && empty($isbn)) {
        $query = "INSERT INTO articles
    (article_nom, article_prix, article_date, article_image, article_description, article_categorie)
    VALUES('$nom','$prix','$date', '$image', '$description','$categorie')";
        $transaction = $DB->db->prepare($query); // Faire cela s'appele une transaction.
        $transaction->execute();
        return $transaction;
    } else {
        $query = "INSERT INTO articles
    (article_nom, article_prix, article_date, article_auteur, article_editeur , article_isbn, article_image,article_description,article_categorie)
    VALUES('$nom','$prix','$date' ,'$auteur' , '$editeur' , '$isbn', '$image', '$description','$categorie')";
        $transaction = $DB->db->prepare($query); // Faire cela s'appele une transaction.
        $transaction->execute();
        return $transaction;
    }
}


function getArticleByIsbn($article_isbn)
{
    $DB = new DB();
    $req = $DB->db->prepare('SELECT article_isbn FROM articles WHERE article_isbn = :article_isbn');
    $req->execute(array('article_isbn' => $article_isbn));
    $donnees = $req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();
    return $donnees;
}

function getArticleById($article_id)
{
    $DB = new DB();
    $req = $DB->db->prepare('SELECT * FROM articles WHERE article_id = :article_id');
    $req->execute(array('article_id' => $article_id));
    $donnees = $req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();
    return $donnees;
}

function getArticleIdById($article_id)
{
    $DB = new DB();
    $req = $DB->db->prepare('SELECT article_id FROM articles WHERE article_id = :article_id');
    $req->execute(array('article_id' => $article_id));
    $donnees = $req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();
    return $donnees;
}

function deleteArticle($article_id)
{
    $DB = new DB();
    $req = $DB->db->prepare('DELETE FROM articles WHERE article_id = :article_id');
    $req->execute(array('article_id' => $article_id));
    $req->closeCursor();
}

function deleteArticleFromPanier($article_id)
{
    unset($_SESSION['panier'][$article_id]);
}

function updateArticle($nom, $prix, $article_date, $auteur, $editeur, $isbn, $image, $description, $categorie, $id)
{
    $DB = new DB();
    if (!empty($auteur) && !empty($editeur) && !empty($isbn)) {
        $req = $DB->db->prepare('UPDATE articles SET article_nom =:article_nom,
      article_prix = :article_prix,
      article_date = :article_date,
      article_auteur = :article_auteur,
      article_editeur = :article_editeur,
      article_isbn = :article_isbn,
      article_image = :article_image,
      article_description = :article_description,
      article_categorie = :article_categorie
      WHERE article_id = :article_id ');
        $req->execute(array(
            'article_nom' => $nom,
            'article_prix' => $prix,
            'article_date' => $article_date,
            'article_auteur' => $auteur,
            'article_editeur' => $editeur,
            'article_isbn' => $isbn,
            'article_image' => $image,
            'article_description' => $description,
            'article_categorie' => $categorie,
            'article_id' => $id
        ));
    } else {
        $req = $DB->db->prepare('UPDATE articles SET article_nom =:nom, article_prix =:prix, article_date = :article_date, article_image =:image, article_description =:description,article_categorie =:categorie WHERE article_id = :id ');
        $req->execute(array(
            'nom' => $nom,
            'prix' => $prix,
            'article_date' => $article_date,
            'image' => $image,
            'description' => $description,
            'categorie' => $categorie
        ));
    }
}

?>
