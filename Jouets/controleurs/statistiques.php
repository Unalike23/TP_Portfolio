<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../models/Catalogue.php";

global $pdo;

$catalogues = Catalogue::getAll($pdo);

$stats = [];
foreach ($catalogues as $catalogue) {
    $catalogue->loadLesJouets($pdo);
    $stats[$catalogue->getId()] = [
        'annee' => $catalogue->getAnnee(),
        'quantite_distribuee' => $catalogue->quantiteDistribuee(),
        'stat_categ' => $catalogue->statCateg()
    ];
}

$titre = "Statistiques";
include_once __DIR__ . "/../vue/vueHeader.php";
include_once __DIR__ . "/../vue/statistiques.php";
include_once __DIR__ . "/../vue/vueFooter.php";
?>