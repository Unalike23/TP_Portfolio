<?php
class Categorie {
    private $id;
    private $code;
    private $libelle;
    private $lesJouets = [];

    public function __construct($id, $code, $libelle) {
        $this->id = $id;
        $this->code = $code;
        $this->libelle = $libelle;
    }

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getLesJouets() {
        return $this->lesJouets;
    }

    public function loadLesJouets($pdo) {
        require_once __DIR__ . '/Jouet.php';
        require_once __DIR__ . '/TrancheAge.php';
        
        $stmt = $pdo->prepare("SELECT j.*, t.code as tranche_code, t.age_min, t.age_max 
                               FROM jouet j 
                               JOIN tranche_age t ON j.tranche_age_id = t.id 
                               WHERE j.categorie_id = ?");
        $stmt->execute([$this->id]);
        $this->lesJouets = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tranche = new TrancheAge($row['tranche_age_id'], $row['tranche_code'], $row['age_min'], $row['age_max']);
            $this->lesJouets[] = new Jouet($row['id'], $row['numero'], $row['libelle'], $this, $tranche);
        }
    }

    public function ajouterJouet($pdo, Jouet $j) {
        $stmt = $pdo->prepare("UPDATE jouet SET categorie_id = ? WHERE id = ?");
        return $stmt->execute([$this->id, $j->getId()]);
    }

    public static function getAll($pdo) {
        $stmt = $pdo->query("SELECT * FROM categorie");
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Categorie($row['id'], $row['code'], $row['libelle']);
        }
        return $categories;
    }
}
?>
