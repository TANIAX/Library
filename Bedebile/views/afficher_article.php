<?php ob_start();
$categorie = '';
?>
<div class="window">
    <div class="main" role="main">
        <div class="movie-list">
            <ul class="list">
                <?php foreach ($article as $article):
                    switch ($article->article_categorie) {
                        case 1:
                            $categorie = 'Bande déssinée';
                            break;
                        case 2:
                            $categorie = 'Comics';
                            break;
                        case 3:
                            $categorie = 'Livre';
                            break;
                        case 4:
                            $categorie = 'Figurine';
                            break;
                        case 5:
                            $categorie = 'Manga';
                            break;
                        case 6:
                            $categorie = 'DVD';
                            break;
                        case 7:
                            $categorie = 'Jeux de plateau';
                            break;
                        case 8:
                            $categorie = 'Jeux de carte';
                            break;
                        case 9:
                            $categorie = 'Affiche';
                            break;
                        case 10:
                            $categorie = 'Divers';
                            break;

                        default:
                            $categorie = 'Erreur';
                            break;
                    }
                    ?>
                    <li>
                        <img src="<?= $article->article_image ?>" alt="" class="cover"/>
                        <p class="title"><?= $article->article_nom ?></p>
                        <p class="prix"><?= '<strong>Prix : </strong>' . $article->article_prix . '€' ?></p>
                        <?php if ($article->article_categorie <= 3 || $article->article_categorie == 5) { ?>
                            <p class="auteur"><?= '<strong>Auteur : </strong>' . $article->article_auteur ?></p>
                            <p class="editeur"><?= '<strong>Editeur : </strong>' . $article->article_editeur ?></p>
                            <p class="isbn"><?= '<strong>ISBN : </strong>' . $article->article_isbn ?></p><?php
                        } ?>
                        <p class="genre"><strong>Genre : </strong><?= $categorie ?></p>
                        <?php if (!empty($_SESSION['login'])): ?>
                            <a href="addpanier?article_id=<?= $article->article_id ?>"
                               class="btn btn-warning add addPanier" role="button">&nbsp+&nbsp</a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['role']) == 1) { ?>
                            <p class="editer">
                            <form class="test" action="edit_article" method="post">
                                <button type="submit" type="submit" name="update_article" class="btn btn-primary"
                                        value="<?= $article->article_id ?>">Editer
                                </button>
                                <button type="submit" type="submit" name="delete_article" class="btn btn-danger"
                                        value="<?= $article->article_id ?>">Supprimer
                                </button>
                            </form>
                            </p>
                        <?php } ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div> <!-- movie list -->
    </div> <!-- main -->
</div> <!-- window -->
<?php
$title = 'Article';
$content = ob_get_clean();
include 'includes/layout.php'; ?>
