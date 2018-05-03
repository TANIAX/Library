<?php
//Charge le model article
require 'models/article.php';
//Fais un dictionnaire d'erreur et initialise la premiere position, avec une valeur vide par défault, cee va nous servir à prevenir des erreurs
$ERROR = array("UPDATED" => "");
$SUCCES = array("UPDATED" => "");
//Crée une variable errMsg vide par défault, on la remplira si jamais on detecte une érreur
$errMsg = "";

//Test de l'envoie du formulaire
if (isset($_POST["update"])) {
   //Recherche toutes les informations de l'article dont l'id est transmis au formulaire
    $article = getArticleById($_POST['update']);
    //Si le nom de l'article est vide
    if (!isset($_POST['article_nom']) || empty($_POST['article_nom'])) {
      //Place une erreur dans la variabel errMsg
        $errMsg .= "<li>Nom article vide</li>";
    }
    //Si le prix de l'article est vide
    if (!isset($_POST['article_prix']) || empty($_POST['article_prix'])) {
        $errMsg .= "<li>Prix article vide</li>";
    }//Si le prix de l'article est pas un entierement un nombre
    if (!is_numeric($_POST['article_prix'])) {
        $errMsg .= "<li>Prix article érroné</li>";
    }//Si la date n'a pas été selectionnée
    if (!isset($_POST['article_date']) || empty($_POST['article_date'])) {
        $errMsg .= "<li>Date non selectionée</li>";
    }//Si l'isbn est rempli
    if (isset($_POST['article_isbn']) || !empty($_POST['article_isbn'])) {
      //Verifie si il est différents de avant la modification
        if ($_POST['article_isbn'] != $_POST['defaultisbn']) {
          //Si oui, regarde si l'isbn n'existe pas déjà
            $message = getArticleByIsbn(htmlspecialchars($_POST['article_isbn']));
            //Message contient un booleen en fonction de l'existance de l'isbn, si il existe $message contien vrai
            if ($message) {
                $errMsg .= "<li>ISBN déjà existant</li>";
            }
        }
    }
    //Si le nom de l'article est trop grand
    if (strlen($_POST['article_nom']) >= 255) {
        $errMsg .= "<li>Nom article trop grand</li>";
    }
    //Si l'isbn de l'article est trop grand
    if (strlen($_POST['article_isbn']) >= 255) {
        $errMsg .= "<li>ISBN trop grand</li>";
    }
    //Si le nom de l'auteur est trop grand
    if (strlen($_POST['article_author']) >= 255) {
        $errMsg .= "<li>Auteur trop grand</li>";
    }
    //Si le nom de l'editeur est trop grand
    if (strlen($_POST['article_editor']) >= 255) {
        $errMsg .= "<li>Editeur trop grand</li>";
    }//Si le lien de l'image est trop long
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
        $id = $_POST['defaultid'];
        //Met à jours l'article avec les variables que l'ont vien de settée
        updateArticle($nom, $prix, $date, $auteur, $editeur, $isbn, $image, $newDescription, $categorie, $id);
        // TODO: Verifier si update Article renvoie vrai ou pas
        //Alerte le visiteur du succès de l'édition
        $SUCCES["UPDATED"] = '<div class="alert alert-success" role="alert">Bien enregistrer!</div>';
        //Inclu la vue
        include 'views/edit_article.php';
        //Si par contre la longeur de errMsg est différentes de 0, on en conclu qu'il y a eu une erreur
    } elseif (strlen($errMsg) != 0) {
      //Alerte l'utilisateur de l'erreur rencontrée
        $ERROR["UPDATED"] = '<div class="alert alert-danger" role="alert"><ul>' . $errMsg . '</ul></div>';
        //Inclu la vue
        include 'views/edit_article.php';
    }

}

//Si les boutons édition ou supprimer ou été cliquer ( dans l'affichage des articles)
if (isset($_POST)) {
  //Si le bouton édité à été cliquer  et que tu es admin
    if ((isset($_POST['update_article']) || !empty($_POST['update_article'])) && $_SESSION['role'] == 1) {
        //Prends les données de l'article transmis avec l'id du bouton editer
        $article = getArticleById($_POST['update_article']);
        //Inclu la vue
        include 'views/edit_article.php';
    }
    //Pareil
    if ((isset($_POST['delete_article']) || !empty($_POST['delete_article']) && $_SESSION['role']) == 1) {
        deleteArticle($_POST['delete_article']);
        header('Location: welcome');
    }
}
?>
