<?php
class Livre {
    private $titre;
    private $prix;
    function __construct($titre, $prix) {
        $this->titre = $titre;
        $this->prix = $prix;
    }

    function afficheLivre() {
        return $this->titre." coute ".$this->prix."   ";
    }

    function getTitre() {
        return $this->titre;
    }
    function getPrix() {
        return $this->prix;
    }
}
?>