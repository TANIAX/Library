<?php
require 'models/article.php';
$ERROR = array("ADDED" => "");
$SUCCES = array("ADDED" => "");
$errMsg = "";
if ($_SESSION['role']==1) {

  if (isset($_POST["add-article"])) {
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
        $article = getArticleByIsbn(htmlspecialchars($_POST['article_isbn']));
        if ($article) {
          $errMsg .= "<li>ISBN déjà existant</li>";
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

          newArticle($nom, $prix, $date,$auteur,$editeur,$isbn,$image,$description,$categorie);
          $SUCCES["ADDED"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
      }
      elseif (strlen($errMsg) != 0) {
          $ERROR["ADDED"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
      }
    }
    include 'views/add_article.php';
  }

else {
  header('Location: Welcome');
}
?>
