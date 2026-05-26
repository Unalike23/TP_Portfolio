<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../models/Jouet.php";
require_once __DIR__ . "/../models/Categorie.php";
require_once __DIR__ . "/../models/TrancheAge.php";
require_once __DIR__ . "/../models/Quantite.php";
require_once __DIR__ . "/../models/Catalogue.php";

global $pdo;

// ON UTILISE EXCLUSIVEMENT LES COLLECTIONS :
// 1. On récupère les catégories (Point d'entrée)
$categories = Categorie::getAll($pdo);

// 2. On demande à chaque catégorie de charger sa collection de jouets
foreach ($categories as $categorie) {
    $categorie->loadLesJouets($pdo);
}

// (Le calcul des quantités via les catalogues reste le même, très propre en POO)
$catalogues = Catalogue::getAll($pdo);
$quantiteParJouet = [];
foreach ($catalogues as $catalogue) {
    $catalogue->loadLesJouets($pdo);
    foreach ($catalogue->getLesJouets() as $quantite) {
        $jouetId = $quantite->getJouet()->getId();
        $quantiteParJouet[$jouetId] = ($quantiteParJouet[$jouetId] ?? 0) + $quantite->getQuantite();
    }
}

$titre = "Liste des jouets";
include_once __DIR__ . "/../vue/vueHeader.php";
include_once __DIR__ . "/../vue/main.php";
include_once __DIR__ . "/../vue/vueFooter.php";
?>
