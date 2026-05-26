<?php
class TrancheAge {
    private $id;
    private $code;
    private $ageMin;
    private $ageMax;
    private $lesJouets = [];

    public function __construct($id, $code, $ageMin, $ageMax) {
        $this->id = $id;
        $this->code = $code;
        $this->ageMin = $ageMin;
        $this->ageMax = $ageMax;
    }

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getAgeMin() {
        return $this->ageMin;
    }

    public function getAgeMax() {
        return $this->ageMax;
    }

    public function getLesJouets() {
        return $this->lesJouets;
    }

    public function loadLesJouets($pdo) {
        require_once __DIR__ . '/Jouet.php';
        require_once __DIR__ . '/Categorie.php';
        
        $stmt = $pdo->prepare("SELECT j.*, c.code as cat_code, c.libelle as cat_libelle 
                               FROM jouet j 
                               JOIN categorie c ON j.categorie_id = c.id 
                               WHERE j.tranche_age_id = ?");
        $stmt->execute([$this->id]);
        $this->lesJouets = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorie = new Categorie($row['categorie_id'], $row['cat_code'], $row['cat_libelle']);
            $this->lesJouets[] = new Jouet($row['id'], $row['numero'], $row['libelle'], $categorie, $this);
        }
    }
}
?>
