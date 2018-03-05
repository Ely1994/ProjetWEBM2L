<?php
class Librairie {
    public $libr;
    function __construct() {
        $this->libr = array();
    }

    function addLivre($livre) {
        array_push($this->libr, $livre);
    }

    function afficheTout() {
        foreach ($this->libr as $line) {
            echo $line->afficheLivre();
        }
    }

    function moyenne() {
        $tot = 0;
        $num = 0;
        foreach ($this->libr as $line) {
            $tot = $tot + $line->getPrix();
            $num++;
        }
        return $tot / $num;
    }
}
?>