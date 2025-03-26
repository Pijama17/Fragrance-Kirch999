<?php
$servername = "localhost";
$username = "root";
$password = ""; // Je database wachtwoord
$dbname = "1"; // Vervang met je database naam

// Maak verbinding met de database
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Fout bij verbinden met de database: " . $e->getMessage();
}
?>


 