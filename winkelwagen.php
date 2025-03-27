<?php
session_start();

// Product database
$products = [
    1 => ["name" => "Tom Ford Oud Wood", "price" => 78.00, "image" => "images/tomford.jpg", "category" => "parfums"],
    2 => ["name" => "Jean Paul Le Male", "price" => 75.00, "image" => "images/jean paul1.jpg", "category" => "geuren"],
    3 => ["name" => "Gisada Ambassador", "price" => 100.00, "image" => "images/bif.jpg", "category" => "eau-du"],
];

// Initialize cart and add all products if empty (for testing)
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
    
    // Add all three products to cart with quantity 1
    foreach ($products as $id => $product) {
        $_SESSION['cart'][$id] = [
            'quantity' => 1,
            'added_at' => time()
        ];
    }
}

// Convert legacy cart items to new structure
foreach ($_SESSION['cart'] as $product_id => &$item) {
    if (!is_array($item)) {
        $item = [
            'quantity' => (int)$item,
            'added_at' => time()
        ];
    }
}
unset($item); // Break the reference

// Calculate totals
$total_items = 0;
$total_price = 0.00;
$cart_empty = true;

foreach ($_SESSION['cart'] as $product_id => $item) {
    if (isset($products[$product_id])) {
        $cart_empty = false;
        $quantity = (int)$item['quantity'];
        $total_items += $quantity;
        $total_price += (float)$products[$product_id]['price'] * $quantity;
    }
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    $response = ['success' => false];
    
    try {
        $product_id = (int)$_POST['product_id'];
        
        switch ($_POST['action']) {
            case 'add':
                $quantity = (int)$_POST['quantity'];
                if (isset($products[$product_id]) && $quantity > 0) {
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
                break;
                
            case 'update':
                $quantity = (int)$_POST['quantity'];
                if (isset($_SESSION['cart'][$product_id]) && $quantity > 0) {
                    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                    $response['success'] = true;
                }
                break;
                
            case 'remove':
                if (isset($_SESSION['cart'][$product_id])) {
                    unset($_SESSION['cart'][$product_id]);
                    $response['success'] = true;
                }
                break;
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
    <title>Winkelwagen - Le Fragrance</title>
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
        
        .cart-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #ffffff 0%, #f9f5f0 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin: 40px 0;
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
        
        .cart-item {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            transition: all 0.3s;
        }
        
        .cart-item:hover {
            background-color: rgba(139, 69, 19, 0.05);
        }
        
        .cart-item-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .quantity-input {
            width: 70px;
            text-align: center;
        }
        
        .btn-remove {
            color: #dc3545;
            background: none;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-remove:hover {
            color: #c82333;
            transform: scale(1.1);
        }
        
        .discount-box {
            border: 2px dashed var(--primary-color);
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            background-color: rgba(139, 69, 19, 0.05);
        }
        
        .summary-card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .btn-checkout {
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        
        .btn-checkout:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px 0;
        }
        
        .empty-cart-icon {
            font-size: 5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
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
                    <li class="nav-item"><a class="nav-link active" href="winkelwagen.php">Winkelwagen</a></li>
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
    <main class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <section class="cart-section p-4 p-md-5">
                    <h2 class="section-title text-center">Jouw Winkelwagen</h2>
                    
                    <?php if ($cart_empty): ?>
                        <div class="empty-cart">
                            <div class="empty-cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3>Je winkelwagen is leeg</h3>
                            <p class="mb-4">Begin met shoppen en voeg producten toe aan je winkelwagen</p>
                            <a href="producten.php" class="btn btn-primary px-5">Bekijk Producten</a>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-lg-8">
                                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                                    <?php if (isset($products[$id])): ?>
                                        <div class="cart-item row align-items-center" data-product-id="<?= $id ?>">
                                            <div class="col-3 col-md-2">
                                                <img src="<?= $products[$id]['image'] ?>" alt="<?= $products[$id]['name'] ?>" class="cart-item-img">
                                            </div>
                                            <div class="col-5 col-md-4">
                                                <h5><?= htmlspecialchars($products[$id]['name']) ?></h5>
                                                <p class="text-muted"><?= ucfirst($products[$id]['category']) ?></p>
                                                <p class="product-price" data-price="<?= $products[$id]['price'] ?>">€<?= number_format($products[$id]['price'], 2, ',', '.') ?></p>
                                            </div>
                                            <div class="col-2 col-md-2">
                                                <input type="number" class="form-control quantity-input" value="<?= $item['quantity'] ?>" min="1">
                                            </div>
                                            <div class="col-2 text-right">
                                                <p class="item-total">€<?= number_format($products[$id]['price'] * $item['quantity'], 2, ',', '.') ?></p>
                                            </div>
                                            <div class="col-1 text-right">
                                                <button class="btn btn-remove">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                
                                <div class="discount-box">
                                    <h5 class="mb-3">Kortingscode</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="discount-code" placeholder="Voer kortingscode in">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="apply-discount">Toepassen</button>
                                        </div>
                                    </div>
                                    <div id="discount-message" class="mt-2 small"></div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="summary-card sticky-top" style="top: 20px;">
                                    <h4 class="mb-4">Bestellingsoverzicht</h4>
                                    
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Totaal artikelen (<?= $total_items ?>):</span>
                                        <span id="subtotal">€<?= number_format($total_price, 2, ',', '.') ?></span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Verzending:</span>
                                        <span id="shipping">Gratis</span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mb-3" id="discount-row" style="display: none !important;">
                                        <span>Korting:</span>
                                        <span id="discount-amount">-€0,00</span>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5>Totaal:</h5>
                                        <h5 id="grand-total">€<?= number_format($total_price, 2, ',', '.') ?></h5>
                                    </div>
                                    
                                    <a href="afrekenen.php" class="btn btn-checkout btn-block">Verder naar betaling</a>
                                    
                                    <div class="mt-3 text-center">
                                        <small class="text-muted">Of <a href="producten.php">verder winkelen</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>
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
            // Update quantity
            $('.quantity-input').on('change', function() {
                const $item = $(this).closest('.cart-item');
                const productId = $item.data('product-id');
                const quantity = $(this).val();
                
                if (quantity < 1) {
                    $(this).val(1);
                    return;
                }
                
                $.ajax({
                    url: 'winkelwagen.php',
                    method: 'POST',
                    data: {
                        action: 'update',
                        product_id: productId,
                        quantity: quantity
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            });
            
            // Remove item
            $('.btn-remove').on('click', function() {
                const $item = $(this).closest('.cart-item');
                const productId = $item.data('product-id');
                
                if (confirm('Weet je zeker dat je dit product wilt verwijderen?')) {
                    $.ajax({
                        url: 'winkelwagen.php',
                        method: 'POST',
                        data: {
                            action: 'remove',
                            product_id: productId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $item.fadeOut(300, function() {
                                    $(this).remove();
                                    
                                    // If cart is empty, reload page
                                    if ($('.cart-item').length === 0) {
                                        location.reload();
                                    } else {
                                        // Update totals
                                        $.get('?refresh=1', function() {
                                            location.reload();
                                        });
                                    }
                                });
                            }
                        }
                    });
                }
            });
            
            // Apply discount
            $('#apply-discount').on('click', function() {
                const discountCode = $('#discount-code').val();
                
                if (discountCode === 'CODE24') {
                    $('#discount-row').show();
                    $('#discount-amount').text('-€35,00');
                    $('#discount-message').html('<span class="text-success"><i class="fas fa-check-circle"></i> Korting toegepast!</span>');
                    
                    // Update grand total
                    const subtotal = parseFloat($('#subtotal').text().replace('€', '').replace(',', '.'));
                    const newTotal = subtotal - 35;
                    $('#grand-total').text('€' + newTotal.toFixed(2).replace('.', ','));
                    
                    // Save discount in session
                    $.post('apply_discount.php', { code: discountCode });
                } else {
                    $('#discount-message').html('<span class="text-danger"><i class="fas fa-times-circle"></i> Ongeldige kortingscode</span>');
                }
            });
        });
    </script>
</body>
</html>
shjgdas
