<?php
// Verbind met de database
$pdo = new PDO('mysql:host=localhost;dbname=1', 'root', '');

// Ontvang ingevoerde gegevens van het formulier
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$address = $_POST['address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedankt voor uw bericht</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Bedankt voor uw bericht!</h2>
        <p>We hebben uw bericht ontvangen en zullen zo snel mogelijk contact met u opnemen.</p>

        <h3>Uw ingevoerde gegevens:</h3>
        <table class="table">
            <tr>
                <th>Naam</th>
                <td><?php echo htmlspecialchars($name); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <tr>
                <th>Bericht</th>
                <td><?php echo nl2br(htmlspecialchars($message)); ?></td>
            </tr>
            <tr>
                <th>Adres</th>
                <td><?php echo htmlspecialchars($address); ?></td>
            </tr>
        </table>

        <a href="index.php" class="btn btn-primary">Terug naar Home</a>
    </div>
</body>
</html>
