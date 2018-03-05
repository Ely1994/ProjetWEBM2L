<?php
class Rectangle {
    private $long;
    private $larg;
    function __construct($long, $larg) {
        $this->long = $long;
        $this->larg = $larg;
    }

    function afficher() {
        return "La surface est : ".$this->calcul();
    }
    function calcul() {
        return $this->long * $this->larg;
    }
    public static function staAff() {
        return "Bonjour le rectangle";
    }
    public static function aze($a, $b) {
        return $a * $b;
    }
}
/* un livre est défini par son titre et son prix. Un librairie contient plusieurs livres
On peut afficher tous les livres de la librairie, et afficher la moyenne des prix, et un en particulier
on peut ajouter un livre à la librairie.
Créer une liste de livres, puis afficher les prix et afficher la moyenne.
*/
?>