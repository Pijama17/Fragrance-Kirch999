<?php
session_start();

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: winkelwagen.php');
    exit;
}

// Product database
$products = [
    1 => ["name" => "Tom Ford Oud Wood", "price" => 50.00, "image" => "images/tomford.jpg", "category" => "parfums"],
    2 => ["name" => "Jean Paul Le Male", "price" => 75.00, "image" => "images/jean paul1.jpg", "category" => "geuren"],
    3 => ["name" => "Gisada Ambassador", "price" => 100.00, "image" => "images/bif.jpg", "category" => "eau-du"],
];

// Convert legacy cart items to new structure if needed
foreach ($_SESSION['cart'] as $id => &$item) {
    if (!is_array($item)) {
        $item = [
            'quantity' => (int)$item,
            'added_at' => time()
        ];
    }
}
unset($item); // Break the reference

// Calculate cart totals
$subtotal = 0.00;
$cart_items = [];

foreach ($_SESSION['cart'] as $id => $item) {
    if (isset($products[$id])) {
        $product = $products[$id];
        $quantity = (int)$item['quantity'];
        $price = (float)$product['price'];
        $item_total = $price * $quantity;
        
        $subtotal += $item_total;
        $cart_items[] = [
            'id' => $id,
            'name' => $product['name'],
            'price' => $price,
            'quantity' => $quantity,
            'total' => $item_total,
            'image' => $product['image'],
            'category' => $product['category']
        ];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process order
    $required_fields = ['name', 'email', 'address', 'city', 'payment_method'];
    $valid = true;
    $errors = [];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $valid = false;
            $errors[$field] = 'Dit veld is verplicht';
        }
    }
    
    if ($valid) {
        // Process discount
        $discount = 0.00;
        if (!empty($_POST['discount_code']) && $_POST['discount_code'] === 'CODE24') {
            $discount = min(35.00, $subtotal);
        }
        
        // Process shipping
        $shipping_method = $_POST['shipping_method'] ?? 'standard';
        $shipping = ($shipping_method === 'fast') ? 20.00 : 10.00;
        
        // Calculate totals
        $tax_rate = 0.21;
        $taxable_amount = max(0.00, $subtotal - $discount + $shipping);
        $tax = $taxable_amount * $tax_rate;
        $total = $taxable_amount + $tax;
        
        // Save order data
        $_SESSION['order'] = [
            'customer' => [
                'name' => htmlspecialchars($_POST['name']),
                'email' => htmlspecialchars($_POST['email']),
                'address' => htmlspecialchars($_POST['address']),
                'city' => htmlspecialchars($_POST['city']),
                'create_account' => isset($_POST['create_account'])
            ],
            'items' => $cart_items,
            'totals' => [
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total
            ],
            'payment_method' => htmlspecialchars($_POST['payment_method']),
            'order_date' => date('Y-m-d H:i:s')
        ];
        
        header('Location: bestelling_succesvol.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afrekenen - Le Fragrance</title>
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
        
        .checkout-section {
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
        
        .form-control {
            border-radius: 0;
            border: 1px solid #ddd;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
        }
        
        .order-summary {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 20px;
        }
        
        .order-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .order-item-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }
        
        .order-item-details {
            flex-grow: 1;
        }
        
        .order-item-name {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .order-item-meta {
            font-size: 0.8rem;
            color: #666;
        }
        
        .order-item-price {
            font-weight: 600;
        }
        
        .totals-table {
            width: 100%;
            margin: 20px 0;
        }
        
        .totals-table tr:last-child td {
            border-top: 1px solid #ddd;
            font-weight: 600;
            padding-top: 10px;
        }
        
        .btn-checkout {
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-checkout:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .payment-method {
            display: none;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
            background: white;
        }
        
        .payment-method.active {
            display: block;
        }
        
        .payment-option {
            margin-bottom: 15px;
        }
        
        .payment-option input[type="radio"] {
            margin-right: 10px;
        }
        
        .discount-box {
            border: 2px dashed var(--primary-color);
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            background-color: rgba(139, 69, 19, 0.05);
        }
        
        .discount-message {
            margin-top: 10px;
            font-size: 0.9rem;
            display: none;
        }
        
        .discount-message.success {
            color: #28a745;
            display: block;
        }
        
        .discount-message.error {
            color: #dc3545;
            display: block;
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
        
        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 5px;
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
                    <li class="nav-item"><a class="nav-link active" href="afrekenen.php">Afrekenen</a></li>
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
    <main class="checkout-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form id="checkoutForm" method="post">
                        <h2 class="section-title">Afrekenen</h2>
                        
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5>Persoonlijke gegevens</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Volledige naam*</label>
                                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                                    <?php if (isset($errors['name'])): ?>
                                        <div class="error-message"><?= $errors['name'] ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">E-mailadres*</label>
                                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="error-message"><?= $errors['email'] ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-group">
                                    <label for="address">Adres*</label>
                                    <input type="text" class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" id="address" name="address" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" required>
                                    <?php if (isset($errors['address'])): ?>
                                        <div class="error-message"><?= $errors['address'] ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-group">
                                    <label for="city">Stad*</label>
                                    <input type="text" class="form-control <?= isset($errors['city']) ? 'is-invalid' : '' ?>" id="city" name="city" value="<?= htmlspecialchars($_POST['city'] ?? '') ?>" required>
                                    <?php if (isset($errors['city'])): ?>
                                        <div class="error-message"><?= $errors['city'] ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="create_account" name="create_account" <?= isset($_POST['create_account']) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="create_account">
                                        Account aanmaken voor snellere bestellingen
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5>Verzendmethode</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" id="standard_shipping" value="standard" <?= (!isset($_POST['shipping_method']) || $_POST['shipping_method'] === 'standard') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="standard_shipping">
                                        Standaard verzending (2-5 werkdagen) - €10,00
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" id="fast_shipping" value="fast" <?= isset($_POST['shipping_method']) && $_POST['shipping_method'] === 'fast' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="fast_shipping">
                                        Express verzending (1-2 werkdagen) - €20,00
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5>Betaalmethode</h5>
                            </div>
                            <div class="card-body">
                                <?php if (isset($errors['payment_method'])): ?>
                                    <div class="alert alert-danger"><?= $errors['payment_method'] ?></div>
                                <?php endif; ?>
                                
                                <div class="payment-option">
                                    <input type="radio" id="creditcard" name="payment_method" value="creditcard" <?= isset($_POST['payment_method']) && $_POST['payment_method'] === 'creditcard' ? 'checked' : '' ?> required>
                                    <label for="creditcard">Creditcard</label>
                                    <div class="payment-method" id="creditcard-method">
                                        <div class="form-group">
                                            <label>Kaartnummer</label>
                                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Vervaldatum</label>
                                                    <input type="text" class="form-control" placeholder="MM/JJ">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CVV</label>
                                                    <input type="text" class="form-control" placeholder="123">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="payment-option">
                                    <input type="radio" id="paypal" name="payment_method" value="paypal" <?= isset($_POST['payment_method']) && $_POST['payment_method'] === 'paypal' ? 'checked' : '' ?>>
                                    <label for="paypal">PayPal</label>
                                    <div class="payment-method" id="paypal-method">
                                        <p>Je wordt doorgestuurd naar PayPal om je betaling af te ronden.</p>
                                    </div>
                                </div>
                                
                                <div class="payment-option">
                                    <input type="radio" id="ideal" name="payment_method" value="ideal" <?= isset($_POST['payment_method']) && $_POST['payment_method'] === 'ideal' ? 'checked' : '' ?>>
                                    <label for="ideal">iDEAL</label>
                                    <div class="payment-method" id="ideal-method">
                                        <div class="form-group">
                                            <label>Selecteer je bank</label>
                                            <select class="form-control">
                                                <option>ABN AMRO</option>
                                                <option>ASN Bank</option>
                                                <option>ING</option>
                                                <option>Rabobank</option>
                                                <option>SNS Bank</option>
                                                <option>Triodos Bank</option>
                                                <option>van Lanschot</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="discount_code" id="discount_code_input" value="<?= htmlspecialchars($_POST['discount_code'] ?? '') ?>">
                        <button type="submit" class="btn btn-checkout mt-4">Bestelling bevestigen</button>
                    </form>
                </div>
                
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h4 class="mb-4">Jouw bestelling</h4>
                        
                        <?php foreach ($cart_items as $item): ?>
                            <div class="order-item">
                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="order-item-img">
                                <div class="order-item-details">
                                    <div class="order-item-name"><?= htmlspecialchars($item['name']) ?></div>
                                    <div class="order-item-meta"><?= $item['quantity'] ?> × €<?= number_format($item['price'], 2, ',', '.') ?></div>
                                </div>
                                <div class="order-item-price">€<?= number_format($item['total'], 2, ',', '.') ?></div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="discount-box">
                            <h6>Kortingscode</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" id="discount_code" placeholder="Voer code in" value="<?= htmlspecialchars($_POST['discount_code'] ?? '') ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="apply_discount">Toepassen</button>
                                </div>
                            </div>
                            <div class="discount-message" id="discount_message"></div>
                        </div>
                        
                        <table class="totals-table">
                            <tr>
                                <td>Subtotaal:</td>
                                <td class="text-right">€<span id="subtotal"><?= number_format($subtotal, 2, ',', '.') ?></span></td>
                            </tr>
                            <tr>
                                <td>Korting:</td>
                                <td class="text-right">-€<span id="discount">0,00</span></td>
                            </tr>
                            <tr>
                                <td>Verzending:</td>
                                <td class="text-right">€<span id="shipping">10,00</span></td>
                            </tr>
                            <tr>
                                <td>BTW (21%):</td>
                                <td class="text-right">€<span id="tax"><?= number_format($subtotal * 0.21, 2, ',', '.') ?></span></td>
                            </tr>
                            <tr>
                                <td>Totaal:</td>
                                <td class="text-right">€<span id="total"><?= number_format($subtotal * 1.21 + 10, 2, ',', '.') ?></span></td>
                            </tr>
                        </table>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Ik ga akkoord met de <a href="#">algemene voorwaarden</a>
                            </label>
                        </div>
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
            // Show payment method when selected
            $('input[name="payment_method"]').change(function() {
                $('.payment-method').removeClass('active');
                $('#' + this.id + '-method').addClass('active');
            });
            
            // Initialize payment method display
            $('input[name="payment_method"]:checked').trigger('change');
            
            // Apply discount
            $('#apply_discount').click(function() {
                const code = $('#discount_code').val();
                const discountMessage = $('#discount_message');
                
                if (code === 'CODE24') {
                    // Calculate new totals
                    const subtotal = parseFloat($('#subtotal').text().replace(',', '.'));
                    const discount = Math.min(35, subtotal);
                    const shipping = parseFloat($('#shipping').text().replace(',', '.'));
                    const taxable = subtotal - discount + shipping;
                    const tax = taxable * 0.21;
                    const total = taxable + tax;
                    
                    // Update display
                    $('#discount').text(discount.toFixed(2).replace('.', ','));
                    $('#tax').text(tax.toFixed(2).replace('.', ','));
                    $('#total').text(total.toFixed(2).replace('.', ','));
                    
                    // Set hidden field
                    $('#discount_code_input').val(code);
                    
                    // Show success message
                    discountMessage.removeClass('error').addClass('success').text('Korting van €35 toegepast!');
                } else if (code === '') {
                    discountMessage.removeClass('success').addClass('error').text('Voer een kortingscode in');
                } else {
                    discountMessage.removeClass('success').addClass('error').text('Ongeldige kortingscode');
                }
            });
            
            // Update shipping cost when method changes
            $('input[name="shipping_method"]').change(function() {
                const shippingCost = this.value === 'fast' ? 20 : 10;
                $('#shipping').text(shippingCost.toFixed(2).replace('.', ','));
                
                // Recalculate totals
                const subtotal = parseFloat($('#subtotal').text().replace(',', '.'));
                const discount = parseFloat($('#discount').text().replace(',', '.') || 0);
                const taxable = subtotal - discount + shippingCost;
                const tax = taxable * 0.21;
                const total = taxable + tax;
                
                $('#tax').text(tax.toFixed(2).replace('.', ','));
                $('#total').text(total.toFixed(2).replace('.', ','));
            });
            
            // Form validation
            $('#checkoutForm').submit(function(e) {
                if (!$('#terms').is(':checked')) {
                    alert('Je moet akkoord gaan met de algemene voorwaarden');
                    e.preventDefault();
                }
            });
            
            // If form was submitted with errors, reapply discount if one was set
            <?php if (isset($_POST['discount_code']) && $_POST['discount_code'] === 'CODE24'): ?>
                $('#apply_discount').trigger('click');
            <?php endif; ?>
        });
    </script>
</body>
</html>