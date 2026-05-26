<?php

require_once 'BateauVoyageur.php';
require_once 'Equipement.php';
require_once 'Collection.php';
require_once 'JeuEnregistrement.php';

class Passerelle {
    private static $pdo;
    
    public static function setPDO($pdoInstance) {
        self::$pdo = $pdoInstance;
    }
    
    private static function chargerLesEquipements($unIdBateau) {
        $collection = new Collection();
        
        $query = "
            SELECT e.idEquip, e.libEquip
            FROM equipement e
            JOIN posseder p ON e.idEquip = p.idEquip
            WHERE p.idBat = ?
            ORDER BY e.libEquip
        ";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->execute([$unIdBateau]);
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($resultats as $row) {
            $equipement = new Equipement($row['idEquip'], $row['libEquip']);
            $collection->ajouter($equipement);
        }
        
        return $collection;
    }
    
    public static function chargerLesBateauxVoyageurs() {
        $collection = new Collection();
        
        $query = "
            SELECT b.idBat, b.nomBat, b.longueurBat, b.largeurBat, bv.vitesseBatVoy, bv.imageBatVoy
            FROM bateau b
            JOIN bateauvoyageur bv ON b.idBat = bv.idBat
            ORDER BY b.nomBat
        ";
        
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($resultats as $row) {
            $equipements = self::chargerLesEquipements($row['idBat']);
            
            $bateau = new BateauVoyageur(
                $row['idBat'],
                $row['nomBat'],
                $row['longueurBat'],
                $row['largeurBat'],
                $row['vitesseBatVoy'],
                $row['imageBatVoy'],
                $equipements
            );
            
            $collection->ajouter($bateau);
        }
        
        return $collection;
    }
}
