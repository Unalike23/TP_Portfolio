<?php
// Database connection
$host = "localhost";
$dbname = "dbbat";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Load classes
require_once 'classes/Passerelle.php';

// Set PDO for Passerelle
Passerelle::setPDO($pdo);

// Load all passenger boats
$bateauxCollection = Passerelle::chargerLesBateauxVoyageurs();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compagnie Pitaine - Bateaux Voyageurs</title>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cas Pitaine</h1>
            <p>Bateaux Voyageurs</p>
        </div>
        
        <div class="controls">
            <button class="btn" onclick="generatePDFClient()">Télécharger PDF</button>
        </div>
        
        <div class="content" id="printContent">
            <?php if ($bateauxCollection->cardinal() === 0): ?>
                <div class="empty">
                    <p>Aucun bateau voyageur trouvé dans la base de données.</p>
                </div>
            <?php else: ?>
                <?php for ($i = 1; $i <= $bateauxCollection->cardinal(); $i++): 
                    $bateau = $bateauxCollection->obtenirObjet($i);
                    $equipements = $bateau->getLesEquipements();
                    $image = $bateau->getImageBatVoy();
                ?>
                    <div class="boat-card">
                        <?php if (!empty($image)): ?>
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($bateau->getNomBat()); ?>">
                        <?php endif; ?>
                        
                        <h2 class="boat-name">Nom du bateau : <?php echo htmlspecialchars($bateau->getNomBat()); ?></h2>
                        
                        <div class="boat-specs">
                            <p><strong>Longueur :</strong> <?php echo number_format($bateau->getLongueurBat(), 2, ',', ' '); ?> mètres</p>
                            <p><strong>Largeur :</strong> <?php echo number_format($bateau->getLargeurBat(), 2, ',', ' '); ?> mètres</p>
                            <p><strong>Vitesse :</strong> <?php echo number_format($bateau->getVitesseBatVoy(), 0); ?> nœuds</p>
                        </div>
                        
                        <p class="equipements-title">Liste des équipements du bateau :</p>
                        <div class="equipements">
                            <?php if ($equipements->cardinal() === 0): ?>
                                <ul>
                                    <li>Aucun équipement enregistré</li>
                                </ul>
                            <?php else: ?>
                                <ul>
                                    <?php for ($j = 1; $j <= $equipements->cardinal(); $j++): 
                                        $equip = $equipements->obtenirObjet($j);
                                    ?>
                                        <li><?php echo htmlspecialchars($equip->getLibEquip()); ?></li>
                                    <?php endfor; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        function generatePDFClient() {
            const element = document.getElementById('printContent');
            const opt = {
                margin: [10, 10, 10, 10],
                filename: 'BateauVoyageur.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>
