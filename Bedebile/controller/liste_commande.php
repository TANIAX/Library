<?php
require 'models/commande.php';

if (!empty($_SESSION)) {
  if ($_SESSION['role'] == 1 ) {
    //$commande  = getListeCommande();
    $commande = getTest();
      // var_dump($commande);
     // exit();
    include 'views/liste_commande.php';
  }
}
?>
