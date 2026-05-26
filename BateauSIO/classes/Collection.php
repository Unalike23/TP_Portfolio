<?php

class Collection {
    private $objets = [];
    
    public function __construct() {
        $this->objets = [];
    }
    
    public function cardinal() {
        return count($this->objets);
    }
    
    public function obtenirObjet($unIndex) {
        // Index starts at 1 in the specification
        if ($unIndex < 1 || $unIndex > $this->cardinal()) {
            return null;
        }
        return $this->objets[$unIndex - 1];
    }
    
    public function ajouter($unObjet) {
        $this->objets[] = $unObjet;
    }
    
    public function getAll() {
        return $this->objets;
    }
}
