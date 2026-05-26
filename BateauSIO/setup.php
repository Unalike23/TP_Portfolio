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

// Read and execute SQL file
$sqlFile = file_get_contents('insertData.sql');
$statements = explode(';', $sqlFile);

$count = 0;
foreach ($statements as $statement) {
    $statement = trim($statement);
    if (!empty($statement)) {
        try {
            $pdo->exec($statement);
            $count++;
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution : " . $e->getMessage() . "<br>";
        }
    }
}

echo "<h2>Insertion des données réussie</h2>";
echo "<p>$count instructions SQL exécutées avec succès</p>";
echo "<p><a href='index.php'>Retour à l'accueil</a></p>";
?>
