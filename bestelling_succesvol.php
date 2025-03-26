<?php
session_start();

// Check if order data exists
if (!isset($_SESSION['order'])) {
    header('Location: producten.php');
    exit;
}

// Get order data
$order = $_SESSION['order'];
$customer = $order['customer'];
$totals = $order['totals'];

// Generate random order number
$order_number = '#' . strtoupper(substr(md5(uniqid()), 0, 8));

// Clear cart after successful order
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling Succesvol - Le Fragrance</title>
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
            color: var(--text-dark);
        }
        
        .navbar {
            background-color: var(--primary-color);
            font-family: 'Playfair Display', serif;
        }
        
        .navbar a {
            color: var(--text-light) !important;
        }
        
        .confirmation-section {
            padding: 60px 0;
        }
        
        .confirmation-card {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin: 40px 0;
            text-align: center;
        }
        
        .confirmation-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 20px;
        }
        
        .confirmation-title {
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .order-details {
            max-width: 600px;
            margin: 30px auto;
            text-align: left;
        }
        
        .order-detail {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .order-detail-label {
            font-weight: 600;
        }
        
        .order-items {
            margin-top: 30px;
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
        }
        
        .order-item-meta {
            font-size: 0.9rem;
            color: #666;
        }
        
        .btn-continue {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-top: 30px;
            transition: all 0.3s;
        }
        
        .btn-continue:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            color: white;
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
        🎉 Bedankt voor uw bestelling! 🎉
    </div>

    <!-- Main Content -->
    <main class="confirmation-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="confirmation-card">
                        <div class="confirmation-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2 class="confirmation-title">Bestelling Succesvol!</h2>
                        <p>Bedankt voor uw bestelling, <?= htmlspecialchars($customer['name']) ?>! We hebben uw bestelling ontvangen en zullen deze zo snel mogelijk verwerken.</p>
                        <p>Een bevestiging is verzonden naar <strong><?= htmlspecialchars($customer['email']) ?></strong>.</p>
                        
                        <div class="order-details">
                            <div class="order-detail">
                                <span class="order-detail-label">Bestelnummer:</span>
                                <span><?= $order_number ?></span>
                            </div>
                            <div class="order-detail">
                                <span class="order-detail-label">Orderdatum:</span>
                                <span><?= date('d-m-Y H:i', strtotime($order['order_date'])) ?></span>
                            </div>
                            <div class="order-detail">
                                <span class="order-detail-label">Betaalmethode:</span>
                                <span><?= htmlspecialchars(ucfirst($order['payment_method'])) ?></span>
                            </div>
                            <div class="order-detail">
                                <span class="order-detail-label">Verzendadres:</span>
                                <span><?= htmlspecialchars($customer['address']) ?>, <?= htmlspecialchars($customer['city']) ?></span>
                            </div>
                        </div>
                        
                        <div class="order-items">
                            <h5 class="text-center mb-4">Uw bestelling</h5>
                            <?php foreach ($order['items'] as $item): ?>
                                <div class="order-item">
                                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="order-item-img">
                                    <div class="order-item-details">
                                        <div class="order-item-name"><?= htmlspecialchars($item['name']) ?></div>
                                        <div class="order-item-meta"><?= $item['quantity'] ?> × €<?= number_format($item['price'], 2, ',', '.') ?></div>
                                    </div>
                                    <div class="order-item-price">€<?= number_format($item['total'], 2, ',', '.') ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="order-details">
                            <div class="order-detail">
                                <span class="order-detail-label">Subtotaal:</span>
                                <span>€<?= number_format($totals['subtotal'], 2, ',', '.') ?></span>
                            </div>
                            <?php if ($totals['discount'] > 0): ?>
                            <div class="order-detail">
                                <span class="order-detail-label">Korting:</span>
                                <span>-€<?= number_format($totals['discount'], 2, ',', '.') ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="order-detail">
                                <span class="order-detail-label">Verzending:</span>
                                <span>€<?= number_format($totals['shipping'], 2, ',', '.') ?></span>
                            </div>
                            <div class="order-detail">
                                <span class="order-detail-label">BTW (21%):</span>
                                <span>€<?= number_format($totals['tax'], 2, ',', '.') ?></span>
                            </div>
                            <div class="order-detail" style="font-weight: 600; font-size: 1.1rem;">
                                <span class="order-detail-label">Totaal:</span>
                                <span>€<?= number_format($totals['total'], 2, ',', '.') ?></span>
                            </div>
                        </div>
                        
                        <a href="producten.php" class="btn btn-continue">Verder winkelen</a>
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
                    <p class="mb-0">&copy; <?= date('Y') ?> Le Fragrance. Alle rechten voorbehouden.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>