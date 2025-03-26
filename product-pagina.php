<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productpagina - Le Fragrance </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
 
    <!-- Navbar -->
    <?php include 'menu.php'; ?>

    <!-- Product Page Section -->
    <section class="product py-5">
        <div class="container">
            <?php
            // Verbinden met de database
            $pdo = new PDO('mysql:host=localhost;dbname=1', 'root', ''); // Pas aan naar jouw databaseconfiguratie

            // Verkrijg productgegevens uit de database
            $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $stmt = $pdo->prepare("SELECT * FROM producten WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<img src="' . htmlspecialchars($product['image']) . '" class="img-fluid" alt="' . htmlspecialchars($product['product']) . '">';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<h1>' . htmlspecialchars($product['product']) . '</h1>';
                echo '<p>€' . htmlspecialchars($product['prijs']) . '</p>';
                echo '<p>' . htmlspecialchars($product['omschrijving']) . '</p>';
                echo '<form action="winkelwagen.php" method="post">';
                echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
                echo '<button type="submit" class="btn btn-success">Voeg toe aan winkelwagen</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<p>Product niet gevonden.</p>';
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

