<?php

require_once 'Passerelle.php';
require_once 'PDF.php';

class BrochurePDF {
    
    public static function genererBrochure($pdo, $nomFichier = "BateauVoyageur") {
        // Set PDO for Passerelle
        Passerelle::setPDO($pdo);
        
        // Load all passenger boats
        $bateauxCollection = Passerelle::chargerLesBateauxVoyageurs();
        
        // Create PDF document
        $pdf = new PDF($nomFichier);
        $pdf->AddPage();
        
        // Iterate through all boats
        for ($i = 1; $i <= $bateauxCollection->cardinal(); $i++) {
            $bateau = $bateauxCollection->obtenirObjet($i);
            $equipements = $bateau->getLesEquipements();
            
            // Check if we need a new page (avoid cutting cards)
            if ($i > 1 && $pdf->GetY() > 200) {
                $pdf->AddPage();
            }
            
            // Add boat border
            $pdf->SetLineWidth(0.5);
            $startY = $pdf->GetY();
            
            // Boat name
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(0, 8, "Nom du bateau : " . $bateau->getNomBat(), 0, 1);
            
            // Boat specs
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(0, 6, "Longueur : " . number_format($bateau->getLongueurBat(), 2, ',', ' ') . " metres", 0, 1);
            $pdf->Cell(0, 6, "Largeur : " . number_format($bateau->getLargeurBat(), 2, ',', ' ') . " metres", 0, 1);
            $pdf->Cell(0, 6, "Vitesse : " . number_format($bateau->getVitesseBatVoy(), 0) . " noeuds", 0, 1);
            
            // Equipment list
            $pdf->SetFont("Arial", "B", 11);
            $pdf->Cell(0, 6, "Liste des equipements du bateau :", 0, 1);
            
            $pdf->SetFont("Arial", "", 10);
            for ($j = 1; $j <= $equipements->cardinal(); $j++) {
                $equip = $equipements->obtenirObjet($j);
                $pdf->Cell(10, 5, "-");
                $pdf->Cell(0, 5, $equip->getLibEquip(), 0, 1);
            }
            
            // Load and insert boat image if available
            $image = $bateau->getImageBatVoy();
            if (!empty($image) && file_exists($image)) {
                $pdf->Ln(5);
                $pdf->Image($image, 10, $pdf->GetY(), 190);
                $pdf->Ln(50);
            }
            
            // Add separator
            $pdf->SetLineWidth(0.2);
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(8);
        }
        
        // Save and return PDF
        $pdf->sauvegarder();
        return $nomFichier;
    }
}
