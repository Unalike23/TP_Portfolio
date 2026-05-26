<?php
require_once 'Quantite.php';

class Catalogue {
    private $id;
    private $annee;
    private $lesJouets = [];

    public function __construct($id, $annee) {
        $this->id = $id;
        $this->annee = $annee;
    }

    public function getId() {
        return $this->id;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function getLesJouets() {
        return $this->lesJouets;
    }

    public function loadLesJouets($pdo) {
        require_once __DIR__ . '/Quantite.php';
        require_once __DIR__ . '/Jouet.php';
        require_once __DIR__ . '/Categorie.php';
        require_once __DIR__ . '/TrancheAge.php';

        $stmt = $pdo->prepare("SELECT q.*, j.numero, j.libelle, j.categorie_id, j.tranche_age_id, cat.code as cat_code, cat.libelle as cat_libelle, t.code as tranche_code, t.age_min, t.age_max 
                               FROM quantite q 
                               JOIN jouet j ON q.jouet_id = j.id 
                               JOIN categorie cat ON j.categorie_id = cat.id 
                               JOIN tranche_age t ON j.tranche_age_id = t.id 
                               WHERE q.catalogue_id = ?");
        $stmt->execute([$this->id]);
        $this->lesJouets = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorie = new Categorie($row['categorie_id'], $row['cat_code'], $row['cat_libelle']);
            $tranche = new TrancheAge($row['tranche_age_id'], $row['tranche_code'], $row['age_min'], $row['age_max']);
            $jouet = new Jouet($row['jouet_id'], $row['numero'], $row['libelle'], $categorie, $tranche);
            $this->lesJouets[] = new Quantite($row['id'], $this, $jouet, $row['quantite']);
        }
    }

    public function quantiteDistribuee() {
        $total = 0;
        foreach ($this->lesJouets as $quantite) {
            $total += $quantite->getQuantite();
        }
        return $total;
    }

    public function statCateg() {
        $stats = [];
        foreach ($this->lesJouets as $quantite) {
            $categorieLibelle = $quantite->getJouet()->getCateg()->getLibelle();
            if (!isset($stats[$categorieLibelle])) {
                $stats[$categorieLibelle] = 0;
            }
            $stats[$categorieLibelle] += $quantite->getQuantite();
        }
        return $stats;
    }

    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM catalogue");
        $catalogues = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $catalogues[] = new Catalogue($row['id'], $row['annee']);
        }
        return $catalogues;
    }
}
?>
