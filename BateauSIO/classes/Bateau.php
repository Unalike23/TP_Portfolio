<?php

class Bateau {
    private $idBat;
    private $nomBat;
    private $longueurBat;
    private $largeurBat;
    
    public function __construct($unId, $unNom, $uneLongueur, $uneLargeur) {
        $this->idBat = $unId;
        $this->nomBat = $unNom;
        $this->longueurBat = $uneLongueur;
        $this->largeurBat = $uneLargeur;
    }
    
    public function versChaine() {
        return "Nom du bateau : " . $this->nomBat . "\n" .
               "Longueur : " . number_format($this->longueurBat, 2, ',', ' ') . " mètres\n" .
               "Largeur : " . number_format($this->largeurBat, 2, ',', ' ') . " mètres";
    }
    
    // Getters
    public function getIdBat() {
        return $this->idBat;
    }
    
    public function getNomBat() {
        return $this->nomBat;
    }
    
    public function getLongueurBat() {
        return $this->longueurBat;
    }
    
    public function getLargeurBat() {
        return $this->largeurBat;
    }
}
