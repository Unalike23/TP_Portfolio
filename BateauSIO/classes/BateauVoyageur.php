<?php

require_once 'Bateau.php';

class BateauVoyageur extends Bateau {
    private $vitesseBatVoy;
    private $imageBatVoy;
    private $lesEquipements;
    
    public function __construct($unId, $unNom, $uneLongueur, $uneLargeur, $uneVitesse, $uneImage, $uneCollEquip) {
        parent::__construct($unId, $unNom, $uneLongueur, $uneLargeur);
        $this->vitesseBatVoy = $uneVitesse;
        $this->imageBatVoy = $uneImage;
        $this->lesEquipements = $uneCollEquip;
    }
    
    public function versChaine() {
        $str = "Nom du bateau : " . $this->getNomBat() . "\n" .
               "Longueur : " . number_format($this->getLongueurBat(), 2, ',', ' ') . " mètres\n" .
               "Largeur : " . number_format($this->getLargeurBat(), 2, ',', ' ') . " mètres\n" .
               "Vitesse : " . number_format($this->vitesseBatVoy, 0) . " nœuds\n" .
               "Liste des équipements du bateau :\n";
        
        for ($i = 1; $i <= $this->lesEquipements->cardinal(); $i++) {
            $equip = $this->lesEquipements->obtenirObjet($i);
            $str .= "- " . $equip->versChaine() . "\n";
        }
        
        return $str;
    }
    
    public function getImageBatVoy() {
        return $this->imageBatVoy;
    }
    
    // Getters
    public function getVitesseBatVoy() {
        return $this->vitesseBatVoy;
    }
    
    public function getLesEquipements() {
        return $this->lesEquipements;
    }
}
