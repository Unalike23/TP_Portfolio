<?php

require_once dirname(__DIR__) . '/fpdf/fpdf.php';

class PDF extends FPDF {
    private $nomDocument;
    
    public function __construct($nomDocument = "document") {
        parent::__construct();
        $this->nomDocument = $nomDocument;
        $this->SetFont("Arial", "", 12);
    }
    
    public function Header() {
        $this->SetFont("Arial", "B", 16);
        $this->Cell(0, 10, "Compagnie Pitaine", 0, 1, "C");
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 5, "Bateaux Voyageurs", 0, 1, "C");
        $this->Ln(5);
    }
    
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont("Arial", "I", 8);
        $this->Cell(0, 10, "Page " . $this->PageNo(), 0, 0, "C");
    }
    
    public function ecrireTexte($leTexte) {
        $this->SetFont("Arial", "", 11);
        $this->MultiCell(0, 5, $leTexte);
        $this->Ln(2);
    }
    
    public function chargerImage($chemin) {
        if (file_exists($chemin)) {
            try {
                $this->Image($chemin, 10, $this->GetY(), 190);
                $this->Ln(75);
            } catch (Exception $e) {
                
            }
        }
    }
    
    public function fermer() {
        $cheminFichier = dirname(__DIR__) . "/" . $this->nomDocument . ".pdf";
        $this->Output("F", $cheminFichier);
    }
    
    public function sauvegarder() {
        $cheminFichier = dirname(__DIR__) . "/" . $this->nomDocument . ".pdf";
        $this->Output("F", $cheminFichier);
        return $cheminFichier;
    }
}
