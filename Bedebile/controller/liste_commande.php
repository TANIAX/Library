<?php
require 'models/commande.php';

if (!empty($_SESSION)) {
  if ($_SESSION['role'] == 1 ) {
    $commande  = getListeCommande();
    $test = getTest($commande->commande_user_id);

    var_dump($test);
    exit();
    include 'views/liste_commande.php';
  }
}
?>
