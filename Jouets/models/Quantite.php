<?php
require_once 'Catalogue.php';
require_once 'Jouet.php';

class Quantite {
    private $id;
    private $catalogue;
    private $jouet;
    private $quantite;

    public function __construct($id, $catalogue, $jouet, $quantite) {
        $this->id = $id;
        $this->catalogue = $catalogue;
        $this->jouet = $jouet;
        $this->quantite = $quantite;
    }

    public function getId() {
        return $this->id;
    }

    public function getCatalogue() {
        return $this->catalogue;
    }

    public function getJouet() {
        return $this->jouet;
    }

    public function getQuantite() {
        return $this->quantite;
    }

}
?>
