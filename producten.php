<?php
session_start();

// Product database
$products = [
    1 => ["name" => "Tom Ford Oud Wood", "price" => 50.00, "image" => "images/tomford.jpg", "category" => "parfums"],
    2 => ["name" => "Jean Paul Le Male", "price" => 75.00, "image" => "images/jeanpaul1.jpg", "category" => "geuren"],
    3 => ["name" => "Gisada Ambassador", "price" => 100.00, "image" => "images/bif.jpg", "category" => "eau"],
];

// Handle AJAX add to cart requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    header('Content-Type: application/json');
    $response = ['success' => false];
    
    try {
        $product_id = (int)$_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        
        if (isset($products[$product_id]) && $quantity > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = [
                    'quantity' => $quantity,
                    'added_at' => time()
                ];
            }
            
            $response['success'] = true;
            $response['cart_count'] = array_sum(array_column($_SESSION['cart'], 'quantity'));
        }
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten - Le Fragrance</title>
    
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
        
        .products-section {
            padding: 60px 0;
        }
        
        h2.section-title {
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            position: relative;
            display: inline-block;
            margin-bottom: 40px;
        }
        
        h2.section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }
        
        .product-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .product-img {
            height: 300px;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .product-category {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .product-price {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        .product-old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
            margin-left: 5px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 8px 20px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Filter sidebar */
        .filter-sidebar {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .filter-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
        }
        
        .filter-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--secondary-color);
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
                    <li class="nav-item"><a class="nav-link active" href="producten.php">Producten</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="winkelwagen.php">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">
                                <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?>
                            </span>
                        </a>
                    </li>
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

    <!-- Main Content -->
    <main class="products-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Filter Sidebar -->
                    <div class="filter-sidebar">
                        <h5 class="filter-title">Categorieën</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="category-parfums" checked>
                            <label class="form-check-label" for="category-parfums">Parfums</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="category-geuren" checked>
                            <label class="form-check-label" for="category-geuren">Geuren</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="category-eau" checked>
                            <label class="form-check-label" for="category-eau">Eau de Toilette</label>
                        </div>
                        
                        <h5 class="filter-title mt-4">Prijsbereik</h5>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <span>€0</span>
                                <span>€200</span>
                            </div>
                            <input type="range" class="custom-range" min="0" max="200" step="10" id="priceRange">
                            <div class="text-center">
                                <span id="priceRangeValue">€0 - €200</span>
                            </div>
                        </div>
                        
                        <h5 class="filter-title mt-4">Sorteren</h5>
                        <select class="form-control" id="sortProducts">
                            <option value="default">Standaard</option>
                            <option value="price-low">Prijs: Laag naar hoog</option>
                            <option value="price-high">Prijs: Hoog naar laag</option>
                            <option value="name-asc">Naam: A-Z</option>
                            <option value="name-desc">Naam: Z-A</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <h2 class="section-title text-center">Onze Collectie</h2>
                    
                    <div class="row" id="productsContainer">
                        <!-- Product 1 -->
                        <div class="col-md-6 col-lg-4" data-category="parfums" data-price="50">
                            <div class="product-card">
                                <div class="product-badge">Nieuw</div>
                                <img src="images/tomford.jpg" class="card-img-top product-img" alt="Tom Ford Oud Wood">
                                <div class="card-body text-center">
                                    <p class="product-category">Parfums</p>
                                    <h5 class="card-title">Tom Ford Oud Wood</h5>
                                    <p class="product-price">
                                        €50,00
                                        <span class="product-old-price">€65,00</span>
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <a href="product1-info.php" class="btn btn-outline-primary mr-2">Details</a>
                                        <button class="btn btn-primary add-to-cart" data-product-id="1">In winkelwagen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Product 2 -->
                        <div class="col-md-6 col-lg-4" data-category="geuren" data-price="75">
                            <div class="product-card">
                                <div class="product-badge">Bestseller</div>
                                <img src="images/jean paul1.jpg" class="card-img-top product-img" alt="Jean Paul Le Male">
                                <div class="card-body text-center">
                                    <p class="product-category">Geuren</p>
                                    <h5 class="card-title">Jean Paul Le Male</h5>
                                    <p class="product-price">€75,00</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="product2-info.php" class="btn btn-outline-primary mr-2">Details</a>
                                        <button class="btn btn-primary add-to-cart" data-product-id="2">In winkelwagen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Product 3 -->
                        <div class="col-md-6 col-lg-4" data-category="eau" data-price="100">
                            <div class="product-card">
                                <img src="images/bif.jpg" class="card-img-top product-img" alt="Gisada Ambassador">
                                <div class="card-body text-center">
                                    <p class="product-category">Eau de Toilette</p>
                                    <h5 class="card-title">Gisada Ambassador</h5>
                                    <p class="product-price">€100,00</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="product3-info.php" class="btn btn-outline-primary mr-2">Details</a>
                                        <button class="btn btn-primary add-to-cart" data-product-id="3">In winkelwagen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-5">
                        <button class="btn btn-outline-primary">Meer producten laden</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
            // Price range filter
            $('#priceRange').on('input', function() {
                const maxPrice = $(this).val();
                $('#priceRangeValue').text('€0 - €' + maxPrice);
                
                $('[data-price]').each(function() {
                    const price = parseFloat($(this).data('price'));
                    $(this).toggle(price <= maxPrice);
                });
            });
            
            // Category filter
            $('[id^="category-"]').change(function() {
                const categoryMap = {
                    'category-parfums': 'parfums',
                    'category-geuren': 'geuren',
                    'category-eau': 'eau'
                };
                
                const checkedCategories = [];
                $('[id^="category-"]:checked').each(function() {
                    checkedCategories.push(categoryMap[this.id]);
                });
                
                $('[data-category]').each(function() {
                    const productCategory = $(this).data('category');
                    const isVisible = checkedCategories.includes(productCategory);
                    $(this).toggle(isVisible);
                });
            });
            
            // Sort products
            $('#sortProducts').change(function() {
                const container = $('#productsContainer');
                const products = container.children('.col-md-6').get();
                
                products.sort(function(a, b) {
                    const priceA = parseFloat($(a).data('price'));
                    const priceB = parseFloat($(b).data('price'));
                    const nameA = $(a).find('.card-title').text().toLowerCase();
                    const nameB = $(b).find('.card-title').text().toLowerCase();
                    
                    switch($(this).val()) {
                        case 'price-low':
                            return priceA - priceB;
                        case 'price-high':
                            return priceB - priceA;
                        case 'name-asc':
                            return nameA.localeCompare(nameB);
                        case 'name-desc':
                            return nameB.localeCompare(nameA);
                        default:
                            return 0;
                    }
                }.bind(this));
                
                container.empty().append(products);
            });
            
            // Add to cart functionality
            $('.add-to-cart').click(function() {
                const button = $(this);
                const productId = button.data('product-id');
                const productCard = button.closest('.product-card');
                const productName = productCard.find('.card-title').text();
                
                // Show loading state
                const originalText = button.html();
                button.html('<i class="fas fa-spinner fa-spin"></i>');
                button.prop('disabled', true);
                
                // Make AJAX call to add to cart
                $.ajax({
                    url: 'producten.php',
                    method: 'POST',
                    data: {
                        action: 'add',
                        product_id: productId,
                        quantity: 1
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Show success message
                            button.html('<i class="fas fa-check"></i> Toegevoegd');
                            
                            // Update cart count in navbar
                            $('.cart-count').text(response.cart_count);
                            
                            // Reset button after 2 seconds
                            setTimeout(() => {
                                button.html(originalText);
                                button.prop('disabled', false);
                            }, 2000);
                        } else {
                            // Show error message
                            button.html('<i class="fas fa-times"></i> Fout');
                            setTimeout(() => {
                                button.html(originalText);
                                button.prop('disabled', false);
                            }, 2000);
                        }
                    },
                    error: function() {
                        button.html('<i class="fas fa-times"></i> Fout');
                        setTimeout(() => {
                            button.html(originalText);
                            button.prop('disabled', false);
                        }, 2000);
                    }
                });
            });
        });
    </script>
</body>
</html>