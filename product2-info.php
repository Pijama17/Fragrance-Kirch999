<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gisada Pure Perfection - Le Fragrance</title>
    
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
        
        .product-section {
            padding: 60px 0;
        }
        
        .product-image {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        
        .product-image:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .product-title {
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
            margin-bottom: 20px;
            position: relative;
        }
        
        .product-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }
        
        .product-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 20px 0;
        }
        
        .product-description {
            margin-bottom: 30px;
            line-height: 1.7;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .ingredients-toggle {
            background: none;
            border: none;
            color: var(--primary-color);
            font-weight: 600;
            padding: 0;
            margin: 20px 0;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .ingredients-toggle:hover {
            color: var(--secondary-color);
        }
        
        .ingredients-toggle i {
            margin-left: 5px;
            transition: transform 0.3s;
        }
        
        .ingredients-toggle.active i {
            transform: rotate(180deg);
        }
        
        .ingredients-panel {
            background-color: white;
            border-radius: 8px;
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease, padding 0.5s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .ingredients-panel.active {
            max-height: 500px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .ingredient-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .ingredient-name {
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .ingredient-function {
            color: #666;
            font-size: 0.9rem;
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

    <!-- Product Section -->
    <section class="product-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="images/jean paul1.jpg" class="img-fluid product-image" alt="Gisada Pure Perfection">
                </div>
                <div class="col-lg-6">
                    <h1 class="product-title">Gisada Pure Perfection</h1>
                    <p class="product-category text-uppercase small font-weight-bold" style="color: var(--secondary-color);">PARFUMS</p>
                    <p class="product-description">
                        Pure Perfection is een meesterwerk van Gisada dat de essentie van luxe en verfijning vastlegt. 
                        Deze geur is een harmonieuze combinatie van sprankelende citrus, delicate bloemen en warme 
                        houtachtige noten. Perfect voor de moderne man die zijn stijl en persoonlijkheid wil benadrukken.
                    </p>
                    <p class="product-price">€75,00</p>
                    
                    <form action="winkelwagen.php" method="post" class="mb-4">
                        <div class="form-group row align-items-center">
                            <label for="quantity" class="col-sm-3 col-form-label">Hoeveelheid:</label>
                            <div class="col-sm-4">
                                <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1" required>
                                <input type="hidden" name="product_id" value="2">
                            </div>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-shopping-cart mr-2"></i>In winkelwagen
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <button class="ingredients-toggle" id="ingredientsToggle">
                        Ingrediënten <i class="fas fa-chevron-down"></i>
                    </button>
                    
                    <div class="ingredients-panel" id="ingredientsPanel">
                        <h5 class="mb-3">Ingrediëntenanalyse</h5>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Alcohol Denat.</span>
                            <span class="ingredient-function">Oplosmiddel</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Parfum</span>
                            <span class="ingredient-function">Geurmengsel</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Aqua</span>
                            <span class="ingredient-function">Waterbasis</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Linalool</span>
                            <span class="ingredient-function">Lavendel geurstof</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Coumarin</span>
                            <span class="ingredient-function">Zoete hooigeur</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Limonene</span>
                            <span class="ingredient-function">Citrusgeur</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Alpha-Isomethyl Ionone</span>
                            <span class="ingredient-function">Violetgeur</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Cinnamal</span>
                            <span class="ingredient-function">Kaneelgeur</span>
                        </div>
                        <div class="ingredient-item">
                            <span class="ingredient-name">Geraniol</span>
                            <span class="ingredient-function">Roosachtige geur</span>
                        </div>
                        
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle mr-2"></i>
                            Alle ingrediënten voldoen aan de EU-veiligheidsnormen voor cosmetica.
                        </div>
                    </div>
                </div>
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
                    <h5>Klantenservice</h5>
                    <ul class="list-unstyled">
                        <li><a href="contact.php">Contact Opnemen</a></li>
                        <li><a href="faq.php">Veelgestelde Vragen</a></li>
                        <li><a href="retour.php">Retourneren</a></li>
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
            // Ingredients toggle functionality
            $('#ingredientsToggle').click(function() {
                $(this).toggleClass('active');
                $('#ingredientsPanel').toggleClass('active');
            });
            
            // Add to cart animation
            $('form').submit(function(e) {
                e.preventDefault();
                
                // Show success message
                const originalText = $('button[type="submit"]').html();
                $('button[type="submit"]').html('<i class="fas fa-check"></i> Toegevoegd');
                
                // Reset after 2 seconds
                setTimeout(() => {
                    $('button[type="submit"]').html(originalText);
                }, 2000);
                
                // In a real app, you would submit the form here
                // For demo purposes, we'll just log to console
                const quantity = $('#quantity').val();
                console.log(`Gisada Pure Perfection (${quantity}x) toegevoegd aan winkelwagen`);
                
                // Uncomment to actually submit the form
                // this.submit();
            });
        });
    </script>
</body>
</html>
