<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fout - Pagina niet gevonden</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f3ef; /* Licht beige achtergrondkleur */
        }

        /* Navigatiebalk styling */
        .navbar {
            background-color: #d2b48c; /* Bruinige kleur voor de navigatiebalk */
        } 

        .navbar a {
            color: white !important;
        }
        

        /* Error message styling */
        .error-message {
            text-align: center;
            margin-top: 100px;
            padding: 20px;
        }

        .error-message h1 {
            font-size: 4em;
            color: #8B4513; /* Donkerbruine kleur */
        }

        .error-message p {
            font-size: 1.5em;
            color: #8B4513; /* Donkerbruine kleur */
        }

        /* Styling voor de zoekbalk */
        .search-bar {
            margin: 20px 0;
            text-align: center;
        }

        .search-bar input[type="text"] {
            width: 50%;
            padding: 10px;
            border: 2px solid #ced4da;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-bar select {
            padding: 10px;
            border: 2px solid #ced4da;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #8B4513; /* Donkerbruine kleur */
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
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

    <!-- Error Message Section -->
    <div class="error-message">
        <h1>Pagina niet gevonden</h1>
        <p>Sorry, we konden de pagina die je zoekt niet vinden.</p>
    </div>

    <!-- Zoekbalk en categorie-selectie -->
    <div class="search-bar">
        <form action="zoeken.php" method="GET">
            <input type="text" name="query" placeholder="Zoek naar producten...">
            <select name="categorie">
                <option value="">Alle categorieën</option>
                <option value="tom-ford">Tom Ford</option>
                <option value="jean-paul">Jean Paul</option>
                <option value="gisada">Gisada</option>
            </select>
            <button type="submit">Zoeken</button>
        </form>
    </div>

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

    <!-- Bootstrap JS en dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

