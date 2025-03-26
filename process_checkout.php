<?php
// Databaseconfiguratie
$host = "localhost";
$dbname = "fragrance_store";
$username = "root";
$password = "";

try {
    // Verbinden met de database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ontvang formulierdata
    $customer_name = $_POST['customer_name'] ?? 'Onbekend';
    $customer_email = $_POST['customer_email'] ?? 'Geen email';
    $order_details = $_POST['order_details'] ?? 'Geen details';
    $total_price = $_POST['total_price'] ?? 0.00;
    

    try {
        // Bestelling opslaan in de database
        $sql = "INSERT INTO orders (customer_name, customer_email, order_details, total_price) 
                VALUES (:customer_name, :customer_email, :order_details, :total_price)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':customer_name' => $customer_name,
            ':customer_email' => $customer_email,
            ':order_details' => $order_details,
            ':total_price' => $total_price,
        ]);

        // Haal de ID van de ingevoegde bestelling op
        $order_id = $pdo->lastInsertId();

        // Doorverwijzen naar de bevestigingspagina
        header("Location: confirmation.php?order_id=$order_id");
        exit;
    } catch (PDOException $e) {
        echo "Fout bij het opslaan van de bestelling: " . $e->getMessage();
    }
} else {
    echo "Ongeldige aanvraag.";
}
?>
 
 