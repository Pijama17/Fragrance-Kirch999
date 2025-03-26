<?php
// Verbind met de database en linkt met de website van dhl
try {
    $pdo = new PDO('mysql:host=localhost;dbname=1', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verkrijg de bestelnummer van het formulier
    $order_id = $_POST['order_id'];

    // Bereid de SQL-query voor om de status en het procesnummer van de bestelling op te halen
    $sql = 'SELECT process_number, status FROM track_order WHERE order_id = :order_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':order_id' => $order_id]);

    // Verkrijg het resultaat
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $process_number = $order['process_number'];
        $status = $order['status'];
        // Voeg hier de tracking URL voor DHL toe
        $tracking_url = "https://www.dhl.com/nl-nl/home/tracking.html?tracking-id=" . urlencode($process_number);
    } else {
        $process_number = 'N/A'; // Geen procesnummer gevonden
        $status = 'Geen gegevens gevonden voor dit bestelnummer.';
        $tracking_url = '#'; // Als er geen trackingnummer is, geen link toevoegen
    }

} catch (PDOException $e) {
    echo 'Fout: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order Result - Fragrance Store</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        body {
            background-color: #f8f3ef;
        }

        .navbar {
            background-color: #8B4513;
        }

        .navbar a {
            color: white !important;
        }

        .track-order-result {
            padding: 50px 0;
        }

        .track-order-result h2 {
            color: #4b3621;
            text-align: center;
            margin-bottom: 30px;
        }

        .status-table {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
            width: 80%;
        }

        .status-table th, .status-table td {
            text-align: center;
            color: #4b3621;
        }

        .btn-primary {
            background-color: #8B4513;
            border: none;
        }

        .btn-primary:hover {
            background-color: #A0522D;
        }

        .footer {
            background-color: #d2b48c;
            color: #4b3621;
            text-align: center;
            padding: 15px 0;
        }

        .tracking-link {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navigatiebalk -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="producten.php">Producten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="winkelwagen.php">Winkelwagen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="afrekenen.php">Afrekenen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="track-order.php">Track Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Track Order Result Section -->
    <section class="track-order-result py-5 content">
        <div class="container">
            <h2>Bestelling Status</h2>
            <div class="status-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Bestelnummer</th>
                            <th>Procesnummer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($order_id); ?></td>
                            <td><?php echo htmlspecialchars($process_number); ?></td>
                            <td><?php echo htmlspecialchars($status); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
 
            <!-- Track & Trace Link -->
            <?php if ($process_number !== 'N/A') : ?>
            <div class="tracking-link">
                <a href="<?php echo htmlspecialchars($tracking_url); ?>" target="_blank" class="btn btn-primary">
                    Volg Je Bestelling via DHL
                </a>
            </div>
            <?php endif; ?>

            <div class="text-center mt-4">
                <a href="track-order.php" class="btn btn-primary">Terug</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Fragrance Store. Alle rechten voorbehouden.</p>
    </footer>

    <!-- Bootstrap JS en dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>  

 
