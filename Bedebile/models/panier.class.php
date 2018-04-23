<?php

class panier
{
    private $DB;

    public function __construct($DB)
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
    }

    public function add($product_id)
    {
        if (isset($_SESSION['panier'][$product_id])) {
            $_SESSION['panier'][$product_id]++;
        } else {
            $_SESSION['panier'][$product_id] = 1;
        }
    }


    public function total()
    {
        // $tva;
        $tva = 19.6/100;
        $prixHT = 0;
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $article = array();
        } else {
            $article = articlePanierIdPrice($ids);
        }
        foreach ($article as $article) {
            $prixHT += $article->article_prix * $_SESSION['panier'][$article->article_id];
        }

        $TVA = ($prixHT*$tva);
        $prixTTC  = $prixHT + $TVA;
        return $prixTTC;
    }
}

?>
