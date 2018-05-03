<?php
//Charge le models article
require 'models/article.php';
//Fais un dictionnaire d'erreur et initialise la premiere position, avec une valeur vide par défault, cee va nous servir à prevenir des erreurs
$ERROR = array("ADDED" => "");
$SUCCES = array("ADDED" => "");
//Crée une variable errMsg vide par défault, on la remplira si jamais on detecte une érreur
$errMsg = "";
//Si l'utilisateur connecté est admin
if ($_SESSION['role']==1) {
  // Si le le formulaire à été rempli
  if (isset($_POST["add-article"])) {
    //Si le nom de l'article est vide
    if (!isset($_POST['article_nom']) || empty($_POST['article_nom'])) {
      $errMsg .= "<li>Nom article vide</li>";
    }//Ou trop grand, Place dans la variable errMsg une erreur
    if (strlen($_POST['article_nom']) >= 255) {
      $errMsg .= "<li>Nom article trop grand</li>";
    }//Si le prix n'a pas été rentrer
    if (!isset($_POST['article_prix']) || empty($_POST['article_prix'])) {
      $errMsg .= "<li>Prix article vide</li>";
    }//Si le prix n'est pas un nombre
    if (!is_numeric($_POST['article_prix'])) {
      $errMsg .= "<li>Prix article érroné</li>";
    }//Si la date de l'article n'a pas été choisie
    if (!isset($_POST['article_date']) || empty($_POST['article_date'])){
      $errMsg .= "<li>Date non selectionée</li>";
    }//Si l'isbn  est rempli, vérifie si il n'existe pas déjà
    if (isset($_POST['article_isbn']) || !empty($_POST['article_isbn'])) {
      $article = getArticleByIsbn(htmlspecialchars($_POST['article_isbn']));
      //Si la requete getArticleByIsbn renvoie vrai, alors cela veux dire qu'il existe déjà
      if ($article) {
        $errMsg .= "<li>ISBN déjà existant</li>";
      }
    }//Si l'isbn est trop grand
    if (strlen($_POST['article_isbn']) >= 255) {
      $errMsg .= "<li>ISBN trop grand</li>";
    }//Si le nom de l'auteur est trop grand
    if (strlen($_POST['article_author']) >= 255) {
      $errMsg .= "<li>Auteur trop grand</li>";
    }//Si le nom de l'éditeur est trop grand
    if (strlen($_POST['article_editor']) >= 255) {
      $errMsg .= "<li>Editeur trop grand</li>";
    }//Si le liens de l'image de l'article est trop long
    if (strlen($_POST['article_image']) >= 1000) {
      $errMsg .= "<li>Lien image trop grand trop grand</li>";
    }

    //Si tout c'est bien passer la longeur de errMsg devraient être 0, on arrive donc ici
    //Place tout les retour du formulaire dans des variables spécifique

    if (strlen($errMsg) == 0) {
      $nom = htmlspecialchars($_POST['article_nom']);
      $prix = htmlspecialchars($_POST['article_prix']);
      $date = $_POST['article_date'];
      $auteur = htmlspecialchars($_POST['article_author']);
      $editeur = htmlspecialchars($_POST['article_editor']);
      $isbn = htmlspecialchars($_POST['article_isbn']);
      $image = htmlspecialchars($_POST['article_image']);
      $description = htmlspecialchars($_POST['article_description']);
      $newDescription = wordwrap($description, 15, "<br>", true);
      $categorie = $_POST['article_categories'];
      //Ajout de l'article dans la base de données
      newArticle($nom, $prix, $date,$auteur,$editeur,$isbn,$image,$newDescription,$categorie);
      // TODO: Verifier sur newArticle renvoie vrai ou ftp_pas
      // Alerte l'utilisateur de l'enregistrement de l'article
      $SUCCES["ADDED"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
    }
    //Si la longueur de la variable errMsg est différentes de 0 c'est qu'il y a eu une erreur
    elseif (strlen($errMsg) != 0) {
      $ERROR["ADDED"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
    }
  }
  //Inclu la vue
  include 'views/add_article.php';
}
//Si l'utilisateur connecté n'est pas admin
else {
  //Redirige vers welcome
  header('Location: Welcome');
}
?>
