<?php
require 'models/article.php';
$ERROR = array("UPDATED" => "");
$SUCCES = array("UPDATED" => "");
$errMsg = "";

if (isset($_POST["update"])) {
  $article = getArticleById($_POST['update']);
  $errMsg = "";
  if (!isset($_POST['article_nom']) || empty($_POST['article_nom'])) {
    $errMsg .= "<li>Nom article vide</li>";
  }
  if (!isset($_POST['article_prix']) || empty($_POST['article_prix'])) {
    $errMsg .= "<li>Prix article vide</li>";

  }
  if (!is_numeric($_POST['article_prix'])) {
    $errMsg .= "<li>Prix article érroné</li>";
  }
  if (!isset($_POST['article_date']) || empty($_POST['article_date'])){
    $errMsg .= "<li>Date non selectionée</li>";
  }
  if (isset($_POST['article_isbn']) || !empty($_POST['article_isbn'])) {
    if ($_POST['article_isbn'] != $_POST['defaultisbn']) {
      $message = getArticleByIsbn(htmlspecialchars($_POST['article_isbn']));
      if ($message) {
        $errMsg .= "<li>ISBN déjà existant</li>";
      }
    }
  }
  if (strlen($errMsg) == 0) {
    $nom = htmlspecialchars($_POST['article_nom']);
    $prix = htmlspecialchars($_POST['article_prix']);
    $date = $_POST['article_date'];
    $auteur = htmlspecialchars($_POST['article_author']);
    $editeur = htmlspecialchars($_POST['article_editor']);
    $isbn = htmlspecialchars($_POST['article_isbn']);
    $image = htmlspecialchars($_POST['article_image']);
    $description = htmlspecialchars($_POST['article_description']);
    $categorie = $_POST['article_categories'];
    $id = $_POST['defaultid'];

    updateArticle($nom, $prix, $date,$auteur,$editeur,$isbn,$image,$description,$categorie,$id);
    $SUCCES["ADDED"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
    include 'views/edit_article.php';

  }
  elseif (strlen($errMsg) != 0) {
    $ERROR["ADDED"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
    header('Location: welcome');
  }

}


if (isset($_POST)) {
  if ((isset($_POST['update_article']) || !empty($_POST['update_article'])) && $_SESSION['role']==1) {
    $article = getArticleById($_POST['update_article']);
    include 'views/edit_article.php';
  }
  if ((isset($_POST['delete_article']) || !empty($_POST['delete_article'])&& $_SESSION['role'])==1) {
    deleteArticle($_POST['delete_article']);
    header('Location: welcome');
  }
}
?>
