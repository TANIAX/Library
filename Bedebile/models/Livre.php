<?php
class Livre{

  private $titre;
  private $prix;
  private $isbn;
  private $auteurLivre;
  private $editeurLivre;

  public function __construct(){
    this->$titre = $titre;
    this->$prix = $prix;
    this->$isbn = $isbn;
    this->$auteur = $auteur;
    this->$editeur = $editeur;
  }

    public function getIsbn() {
        return $isbn;
    }

    public function getPrix() {
        return $prix;
    }

    public function getTitre() {
        return $titre;
    }

    public function setTitre($titre) {
        this->$titre = $titre;
    }

    public function setPrix($prix) {
        this->$prix = $prix;
    }

    public function setIsbn($isbn) {
        this->$isbn = $isbn;
    }

}
?>
