<?php
require 'models/db.class.php';


function newCommand($commande_user_id,$article)
{
  $DB = new DB();

  $query = "INSERT INTO commandes (commande_user_id, commande_date) VALUES('$commande_user_id', NOW())";
  $transaction = $DB->db->prepare($query); // Faire cela s'appele une transaction.
  $transaction->execute();

  $req = $DB->db->prepare("SELECT MAX(commande_id) FROM commandes WHERE commande_user_id = commande_user_id ");
  $req->execute(array('commande_user_id' => $commande_user_id));
  $commandeId = $req->fetch();
  $req->closeCursor();

  foreach ($article as $article) {
    $tva = 19.6/100;
    $prixHT = 0;
    $prixHT = $article->article_prix;
    $TVA = ($prixHT*$tva);
    $prixTTC  = $prixHT + $TVA;
     $query = "INSERT INTO jointable (jointure_commande_id, jointure_article_id, jointure_prix) VALUES('$commandeId[0]', '$article->article_id', '$prixTTC')";
     $transaction = $DB->db->prepare($query);
     $transaction->execute();
  }
  return $transaction;
}

function articlePanier($article_id)
{
  $DB = new DB();
  $req = $DB->db->prepare('SELECT * FROM articles where article_id IN (' . implode(',', $article_id) . ')');
  $req->execute($article_id);
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function getListeCommande(){
  $DB = new DB();

  $req = $DB->db->prepare("SELECT * FROM commandes ");
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);
}

function getTest(){
  $DB = new DB();
  $req = $DB->db->prepare("SELECT user_login, jointure_prix , article_nom , user_id, commande_id , commande_date , commande_statut FROM commandes
                                                                          INNER JOIN jointable ON commande_id = jointure_commande_id
                                                                          INNER JOIN articles ON jointure_article_id = article_id
                                                                          INNER JOIN users ON commande_user_id = user_id
                                                                          WHERE commande_id IN (SELECT commande_id
                                                                                                FROM commandes , users
                                                                                                WHERE commande_user_id = user_id)");
  $req->execute();
  return $req->fetchAll(PDO::FETCH_OBJ);

}
?>
