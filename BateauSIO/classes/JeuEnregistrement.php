<?php

class JeuEnregistrement {
    private $stmt;
    private $donnees;
    private $index = 0;
    private $fin = false;
    
    public function __construct($pdo, $chaineSQL) {
        try {
            $this->stmt = $pdo->prepare($chaineSQL);
            $this->stmt->execute();
            $this->donnees = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($this->donnees)) {
                $this->fin = true;
            }
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    
    public function suivant() {
        $this->index++;
        if ($this->index >= count($this->donnees)) {
            $this->fin = true;
        }
    }
    
    public function fin() {
        return $this->fin || $this->index >= count($this->donnees);
    }
    
    public function getValeur($nomChamp) {
        if ($this->index >= 0 && $this->index < count($this->donnees)) {
            return $this->donnees[$this->index][$nomChamp] ?? null;
        }
        return null;
    }
    
    public function fermer() {
        $this->stmt = null;
        $this->donnees = [];
    }
}
