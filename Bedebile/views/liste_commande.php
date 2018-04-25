<?php ob_start(); ?>

<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Liste des commande</h3>
    </div>
    <ul class="list-group">
      <?php $i=0; ?>
      <?php foreach ($commande as $commande): ?>
        <?php

        $statut = "";
        switch ($commande->commande_statut) {
          case 1:
          $statut = "valider";
          break;
          case 2:
          $statut = "en attente";
          break;
          case 3:
          $statut = "refuser";
          break;
          default:
          $statut = "Pas de statut";
        }
        ?>

        <li class="list-group-item">
          <div class="row toggle" id="dropdown-detail-<?=$commande->commande_id?>" data-toggle="detail-<?=$commande->commande_id?>">
            <div class="col-xs-10">
              <div class="col-sm-4"><strong>Commande n°</strong> <?=$commande->commande_id?></div>
              <div class="col-sm-4"><strong>Statut :</strong><?=$statut?></div>
              <div class="col-sm-4"><strong>Date :</strong><?=$commande->commande_date?></div>
            </div>
            <div class="col-xs-2"><i class="fa fa-chevron-down pull-right"></i></div>
          </div>
          <div id="detail-<?=$commande->commande_id?>">
            <hr></hr>
            <div class="container">
              <div class="fluid-row">
                <div class="col-xs-1">
                  Nom :
                </div>
                <div class="col-xs-5">
                  test
                </div>
                <div class="col-xs-1">
                  Prix total :
                </div>
                <div class="col-xs-5">
                  test
                </div>
                <div class="col-xs-1">
                  Adresse :
                </div>
                <div class="col-xs-5">
                  test
                </div>
                <div class="col-xs-1">
                  Article :
                </div>
                <div class="col-xs-5">
                  test
                </div>
              </div>
            </div>
          </div>
        </li>
      <?php endforeach; ?>

    </ul>
  </div>
</div>
<?php
$title = "Liste des commande";
$content = ob_get_clean();
include 'includes/layout.php'; ?>
