<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <h2>Panier</h2>
    </div>
    <table class="table table-fixed table-striped">
        <thead>
        <tr>
            <th>Quantité</th>
            <th>Image article</th>
            <th>Nom article</th>
            <!-- <th>Description article</th> -->
            <th>Prix article</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($article as $article): ?>
            <tr>
                <td><?= $_SESSION['panier'][$article->article_id] ?></td>
                <td><img src="<?= $article->article_image ?>" style="width:75px;height:100px;"></td>
                <td><?= $article->article_nom ?></td>
                <!-- <td><textarea readonly rows="2" cols="20"><?= $article->article_description ?></textarea></td>  -->
                <td><?= $article->article_prix . "€" ?></td>
                <td><a href="panier?del=<?= $article->article_id ?>"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
        <td></td>
        <td></td>
        <td><strong>Prix total</strong></td>
        <td><strong><?= number_format($prixtotal, 2, ',', ' ') . "€" ?></strong></td>
        <td>
          <?php if (!empty($_SESSION['panier'])): ?>
            <button onclick="window.location.href='<?=URL?>payement'" type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-ok"></span> Ok </button>
          <?php endif; ?>
        </td>
        </tbody>
    </table>
</div>
<?php
$title = "Panier";
$content = ob_get_clean();
include 'includes/layout.php'; ?>
