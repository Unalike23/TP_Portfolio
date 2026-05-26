<?php

class Equipement {
    private $idEquip;
    private $libEquip;
    
    public function __construct($unId, $unLib) {
        $this->idEquip = $unId;
        $this->libEquip = $unLib;
    }
    
    public function versChaine() {
        return $this->libEquip;
    }
    
    // Getters
    public function getIdEquip() {
        return $this->idEquip;
    }
    
    public function getLibEquip() {
        return $this->libEquip;
    }
}
