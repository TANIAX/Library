<?php
require 'models/db.class.php';

function newCommand($commande_user_id,$article)
{
  $DB = new DB();

  $query = "INSERT INTO commandes (commande_user_id) VALUES('$commande_user_id')";
  $transaction = $DB->db->prepare($query); // Faire cela s'appele une transaction.
  $transaction->execute();

  $req = $DB->db->prepare("SELECT MAX(commande_id) FROM commandes WHERE commande_user_id = commande_user_id ");
  $req->execute(array('commande_user_id' => $commande_user_id));
  $commandeId = $req->fetch();
  $req->closeCursor();

  foreach ($article as $article) {
     $query = "INSERT INTO jointable (jointure_commande_id, jointure_article_id, jointure_prix) VALUES('$commandeId[0]', '$article->article_id', '$article->article_prix')";
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
?>
