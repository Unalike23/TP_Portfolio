<?php
require_once 'Categorie.php';
require_once 'TrancheAge.php';

class Jouet {
    private $id;
    private $numero;
    private $libelle;
    private $categ;
    private $trancheAge;

    public function __construct($id, $numero, $libelle, $categ, $trancheAge) {
        $this->id = $id;
        $this->numero = $numero;
        $this->libelle = $libelle;
        $this->categ = $categ;
        $this->trancheAge = $trancheAge;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getCateg() {
        return $this->categ;
    }

    public function getTranche() {
        return $this->trancheAge;
    }

    public function convient($age) {
        return $age >= $this->trancheAge->getAgeMin() && $age <= $this->trancheAge->getAgeMax();
    }

    public function getInfos() {
        return "Jouet: " . $this->libelle . " (Numéro: " . $this->numero . ")";
    }

}
?>
