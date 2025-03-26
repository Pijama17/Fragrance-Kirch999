<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bevestiging - Le Fragrance</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f3ef; /* Lichtbruin achtergrondkleur */
        }

        /* Navigatiebalk styling */
        .navbar {
            background-color: #8B4513; /* Donkerbruine kleur voor de navigatiebalk */
        }
 
        .navbar a {
            color: white !important;
        }

        /* Aankondigingsbalk styling */
        .announcement-bar {
            background-color: #d2b48c; /* Bruinige kleur */
            color: white;              /* Witte tekstkleur */
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }

        /* Styling voor de bevestigingssectie */
        .confirmation {
            text-align: center;
            padding: 50px 0; /* Ruimte boven en onder de bevestiging */
        }

        .confirmation h2 {
            color: #4b3621; /* Donkerbruine tekstkleur */
        }

        .confirmation p {
            color: #4b3621; /* Donkerbruine tekstkleur */
        }

        /* Container voor afbeelding en knop */
        .image-button-container {
            position: relative;
            text-align: center; /* Centraal uitlijnen */
            margin: 20px auto; /* Marges boven en onder */
            width: 100%; /* Volledige breedte */
        }

        /* Styling voor de rechthoekige afbeelding */
        .rectangle-image {
            width: 100%; /* Volledige breedte */
            height: auto; /* Automatische hoogte om verhoudingen te behouden */
        }

        /* Styling voor de knop */
        .product-button {
            position: absolute; /* Absoluut positioneren */
            top: 50%; /* Midden van de afbeelding */
            left: 50%; /* Midden van de afbeelding */
            transform: translate(-50%, -50%); /* Centreren van de knop */
            padding: 15px 30px;
            background-color: #8B4513; /* Donkerbruine achtergrondkleur */
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-button:hover {
            background-color: #A0522D; /* Iets lichtere bruine kleur bij hover */
        }

        /* Footer styling */
        .footer {
            background-color: #8B4513; /* Donkerbruine kleur voor de footer */
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px; /* Ruimte boven de footer */
        }

        .footer h5 {
            margin: 0;
            font-weight: bold;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: white; /* Witte kleur voor links in de footer */
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline; /* Onderstreep link bij hover */
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

    <!-- Aankondigingsbalk -->
    <div class="announcement-bar">
        🎉 CODE24 voor €35 korting! 🎉
    </div>

    <!-- Confirmation Section -->
    <section class="confirmation">
        <div class="container">
            <h2>Bestelling Bevestigd</h2>
            <p>Bedankt voor uw bestelling! U ontvangt een bevestigingsmail met uw bestelgegevens.</p>
            <!-- Container voor afbeelding en knop -->
            <div class="image-button-container">
                <img src="images/wood1.jpg" class="rectangle-image" alt="Bevestiging afbeelding" />
                <a href="index.php" class="product-button">Terug naar Home</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="footer">
        <h5>Bedrijf Informatie</h5>
        <p>Adres: Tilted Towers</p>
        <p>Telefoon: +31 6 12345678</p>
        <p>Email: info@parfumboutique.nl</p>
        
        <h5>Volg Ons</h5>
        <p>
            <a href="#">Facebook</a> | 
            <a href="#">Instagram</a> | 
            <a href="#">Twitter</a>
        </p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

