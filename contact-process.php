<?php
// Verbind met de database
$pdo = new PDO('mysql:host=localhost;dbname=1', 'root', '');

// Ontvang ingevoerde gegevens van het formulier
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$address = $_POST['address'];


// Informatie naar de database sturen
$stmt = $pdo->prepare("INSERT INTO contact (name, email, message, address) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $email, $message, $address]);

// Geocode het adres voor Google Maps
$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=YOUR_GOOGLE_MAPS_API_KEY');
$response = json_decode($geocode);

if ($response->status == 'OK') {
    $lat = $response->results[0]->geometry->location->lat;
    $lng = $response->results[0]->geometry->location->lng;
} else {
    $lat = 0;
    $lng = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Bedankt - Home</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>

    <style>
        body {
            background-color: #f8f3ef;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #8B4513;
        }

        .navbar a {
            color: white !important;
        }

        .content {
            padding: 50px 0;
        }

        .footer {
            background-color: #8B4513;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <script>
        function initMap() {
            var mapOptions = {
                center: { lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?> },
                zoom: 14
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var marker = new google.maps.Marker({
                position: { lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?> },
                map: map
            });
        }
    </script>

</head>
<body>

    <!-- Navigatiebalk -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="producten.php">Producten</a></li>
                    <li class="nav-item"><a class="nav-link" href="winkelwagen.php">Winkelwagen</a></li>
                    <li class="nav-item"><a class="nav-link" href="afrekenen.php">Afrekenen</a></li>
                    <li class="nav-item"><a class="nav-link" href="track-order.php">Track Order</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bedankt bericht -->
    <section class="content">
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

            <h3>Uw locatie op de kaart:</h3>
            <div class="map-container">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>

            <a href="index.php" class="btn btn-primary">Terug naar Home</a>
        </div>
    </section>

    <!-- Footer -->
    <div class="footer">
        <h5>Bedrijf Informatie</h5>
        <p>Adres: Tilted Towers</p>
        <p>Telefoon: +31 6 12345678</p>
        <p>Email: info@parfumboutique.nl</p>
        <p>
            <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a> |
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a> |
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
        </p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
