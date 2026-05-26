<?php
require_once 'classes/BrochurePDF.php';

try {
    $nomFichier = BrochurePDF::genererBrochure($pdo, "BateauVoyageur");
    
    // Return success response
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'PDF généré avec succès',
        'fichier' => $nomFichier . '.pdf',
        'url' => 'BateauVoyageur.pdf'
    ]);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Erreur : ' . $e->getMessage()
    ]);
}
