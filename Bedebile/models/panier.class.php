<?php
class panier{

	public function __construct($DB){
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();
		}
	}
	public function add($article_id){
		$_SESSION['panier'][$article_id] = 1;
	}
}
?>
