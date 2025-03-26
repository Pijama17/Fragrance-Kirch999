<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Le Fragrance</title>
    
    <!-- Bootstrap CSS + Font Awesome + Google Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #A0522D;
            --light-bg: #f8f3ef;
            --text-dark: #4b3621;
            --text-light: #f8f9fa;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Montserrat', sans-serif;
        }
        
        .navbar {
            background-color: var(--primary-color);
            font-family: 'Playfair Display', serif;
        }
        
        .hero-section {
            position: relative;
            height: 80vh;
            overflow: hidden;
            margin-bottom: 50px;
        }
        
        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
        }
        
        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            width: 100%;
            padding: 0 20px;
        }
        
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .btn-hero {
            background-color: white;
            color: var(--primary-color);
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            border: 2px solid white;
        }
        
        .btn-hero:hover {
            background-color: transparent;
            color: white;
            transform: translateY(-3px);
        }
        
        .search-section {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: -50px;
            position: relative;
            z-index: 10;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .search-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        
        .search-form input, .search-form select {
            flex: 1 1 300px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .search-form button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .search-form button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .featured-section {
            padding: 60px 0;
        }
        
        .section-title {
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            position: relative;
            display: inline-block;
            margin-bottom: 40px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }
        
        .featured-product {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            margin-bottom: 30px;
        }
        
        .featured-product:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .product-image {
            height: 250px;
            object-fit: cover;
        }
        
        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 0.8rem;
        }
        
        .product-body {
            padding: 20px;
            text-align: center;
        }
        
        .product-category {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .product-price {
            font-weight: 600;
            color: var(--primary-color);
            margin: 10px 0;
        }
        
        /* Announcement bar */
        .announcement-bar {
            background-color: var(--secondary-color);
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            position: relative;
            overflow: hidden;
        }
        
        .announcement-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 0 20px;
        }
        
        .footer a {
            color: white;
            transition: all 0.3s;
        }
        
        .footer a:hover {
            color: #f8f9fa;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Le Fragrance</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="producten.php">Producten</a></li>
                    <li class="nav-item"><a class="nav-link" href="winkelwagen.php">Winkelwagen</a></li>
                    <li class="nav-item"><a class="nav-link" href="afrekenen.php">Afrekenen</a></li>
                    <li class="nav-item"><a class="nav-link" href="track-order.php">Track Order</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Announcement Bar -->
    <div class="announcement-bar">
        🎉 CODE24 voor €35 korting! 🎉
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <img src="images/bakka.PNG" alt="Le Fragrance Collectie" class="hero-image">
        <div class="hero-content">
            <h1 class="hero-title">Ontdek Onze Exclusieve Collectie</h1>
            <p class="hero-subtitle">Premium geuren voor elke gelegenheid</p>
            <a href="producten.php" class="btn btn-hero">Shop Nu</a>
        </div>
    </section>

    <!-- Search Section -->
    <div class="container">
        <div class="search-section">
            <form class="search-form" action="zoeken.php" method="GET">
                <input type="text" name="query" placeholder="Zoek naar producten...">
                <select name="categorie">
                    <option value="">Alle categorieën</option>
                    <option value="parfums">Parfums</option>
                    <option value="geuren">Geuren</option>
                    <option value="Eaudetoillete">Eau de Toilette</option>
                </select>
                <button type="submit">Zoeken</button>
            </form>
        </div>
    </div>
    

    <!-- Featured Products -->
    <section class="featured-section">
        <div class="container">
            <h2 class="section-title text-center">Aanbevolen Producten</h2>
            
            <div class="row">
                <!-- Product 1 -->
                <div class="col-md-4">
                    <div class="featured-product">
                        <div class="product-badge">Nieuw</div>
                        <img src="images/tomford.jpg" alt="Tom Ford Oud Wood" class="product-image w-100">
                        <div class="product-body">
                            <p class="product-category">Parfums</p>
                            <h5>Tom Ford Oud Wood</h5>
                            <p class="product-price">€50,00</p>
                            <a href="product1-info.php" class="btn btn-outline-primary mr-2">Details</a>
                            <button class="btn btn-primary">In winkelwagen</button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="col-md-4">
                    <div class="featured-product">
                        <div class="product-badge">Bestseller</div>
                        <img src="images/jean paul1.jpg" alt="Jean Paul Le Male" class="product-image w-100">
                        <div class="product-body">
                            <p class="product-category">Geuren</p>
                            <h5>Jean Paul Le Male</h5>
                            <p class="product-price">€75,00</p>
                            <a href="product2-info.php" class="btn btn-outline-primary mr-2">Details</a>
                            <button class="btn btn-primary">In winkelwagen</button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="col-md-4">
                    <div class="featured-product">
                        <img src="images/bif.jpg" alt="Gisada Ambassador" class="product-image w-100">
                        <div class="product-body">
                            <p class="product-category">Eau de Toilette</p>
                            <h5>Gisada Ambassador</h5>
                            <p class="product-price">€100,00</p>
                            <a href="product3-info.php" class="btn btn-outline-primary mr-2">Details</a>
                            <button class="btn btn-primary">In winkelwagen</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="producten.php" class="btn btn-outline-primary btn-lg">Bekijk Alle Producten</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Le Fragrance</h5>
                    <p>Uw premium bestemming voor exclusieve geuren en parfums.</p>
                </div>
                
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Snelle Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="producten.php">Producten</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4">
                    <h5>Volg Ons</h5>
                    <div class="social-links">
                        <a href="#" class="mr-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="mr-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="mr-2"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            
            <hr class="mt-4 mb-3" style="border-color: rgba(255,255,255,0.1);">
            
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2023 Le Fragrance. Alle rechten voorbehouden.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Add to cart functionality
            $('.btn-primary').on('click', function() {
                if ($(this).text().trim() === "In winkelwagen") {
                    const productName = $(this).closest('.product-body').find('h5').text();
                    
                    // Change button text temporarily
                    $(this).html('<i class="fas fa-check"></i> Toegevoegd');
                    
                    // Reset after 2 seconds
                    setTimeout(() => {
                        $(this).text('In winkelwagen');
                    }, 2000);
                    
                    // In a real app, you would make an AJAX call here
                    console.log(`${productName} toegevoegd aan winkelwagen`);
                }
            });
        });
    </script>
</body>
</html>