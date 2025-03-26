<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order - Le Fragrance</title>
    
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
        
        .track-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #ffffff 0%, #f9f5f0 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin: 40px 0;
            position: relative;
            overflow: hidden;
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
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        /* Order status cards */
        .status-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #ddd;
            transition: all 0.3s;
        }
        
        .status-card.active {
            border-left-color: var(--primary-color);
            background-color: #f9f5f0;
        }
        
        .status-card.completed {
            border-left-color: #28a745;
        }
        
        .status-card h5 {
            color: var(--text-dark);
            margin-bottom: 5px;
        }
        
        .status-card .status-date {
            color: var(--primary-color);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .status-card .status-description {
            color: #666;
            font-size: 0.9rem;
        }
        
        /* Loading animation */
        .loader {
            display: none;
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 0 20px;
        }
        
        /* Announcement bar */
        .announcement-bar {
            background-color: var(--secondary-color);
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
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
                    <li class="nav-item"><a class="nav-link active" href="track-order.php">Track Order</a></li>
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
            <div class="col-lg-8 mx-auto">
                <section class="track-section p-4 p-md-5">
                    <h2 class="section-title text-center">Volg Je Bestelling</h2>
                    
                    <form id="trackOrderForm" novalidate>
                        <div class="form-group">
                            <label for="orderId">Bestelnummer</label>
                            <input type="text" class="form-control" id="orderId" name="orderId" required>
                            <small class="form-text text-muted">Vind je bestelnummer in de bevestigingsmail</small>
                            <div class="invalid-feedback">Vul alstublieft een geldig bestelnummer in.</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mailadres</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Vul alstublieft het e-mailadres in dat je bij de bestelling hebt gebruikt.</div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">
                                <span id="submitText">Volg Bestelling</span>
                                <div id="loader" class="loader"></div>
                            </button>
                        </div>
                    </form>
                    
                    <div id="orderResult" class="mt-5" style="display: none;">
                        <h3 class="text-center mb-4">Bestelstatus</h3>
                        <div id="statusCards">
                            <!-- Status cards will be populated by JavaScript -->
                        </div>
                        
                        <div class="text-center mt-4">
                            <button id="printBtn" class="btn btn-outline-primary mr-2">
                                <i class="fas fa-print mr-2"></i>Print Overzicht
                            </button>
                            <button id="helpBtn" class="btn btn-outline-secondary">
                                <i class="fas fa-question-circle mr-2"></i>Hulp Nodig?
                            </button>
                        </div>
                    </div>
                    
                    <div id="errorMessage" class="alert alert-danger mt-4" style="display: none;">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span id="errorText">Er is een fout opgetreden bij het ophalen van je bestelling.</span>
                    </div>
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
            // Form validation
            $('#trackOrderForm').on('submit', function(e) {
                e.preventDefault();
                
                // Reset validation
                $('.is-invalid').removeClass('is-invalid');
                $('#errorMessage').hide();
                
                // Validate form
                let isValid = true;
                const orderId = $('#orderId').val();
                const email = $('#email').val();
                
                // Check required fields
                if (!orderId) {
                    $('#orderId').addClass('is-invalid');
                    isValid = false;
                }
                
                if (!email) {
                    $('#email').addClass('is-invalid');
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    $('#email').addClass('is-invalid');
                    isValid = false;
                }
                
                if (isValid) {
                    // laad animatie
                    $('#submitText').hide();
                    $('#loader').show();
                    
                    // Simulate API call (replace with actual AJAX call)
                    setTimeout(function() {
                        // Hide loader
                        $('#loader').hide();
                        $('#submitText').show();
                        
                        // Check if order ID is "3" (as per your requirement)
                        if (orderId === "3") {
                            // Show order result - every email will work as requested
                            displayOrderStatus(orderId);
                        } else {
                            // Show error for other order IDs
                            $('#errorText').text('Bestelling niet gevonden. Alleen bestelnummer "3" is geldig in dit demo systeem.');
                            $('#errorMessage').fadeIn();
                        }
                    }, 1000);
                }
            });
            
            // Display order status with cards
            function displayOrderStatus(orderId) {
                // order nummer 3 
                const statusData = [
                    {
                        stage: "Bestelling Ontvangen",
                        date: new Date(Date.now() - 86400000 * 3).toLocaleDateString('nl-NL', {day: 'numeric', month: 'long', year: 'numeric'}) + " 14:30",
                        description: "We hebben je bestelling ontvangen en gaan deze verwerken.",
                        status: "completed"
                    },
                    {
                        stage: "In Verwerking",
                        date: new Date(Date.now() - 86400000 * 2).toLocaleDateString('nl-NL', {day: 'numeric', month: 'long', year: 'numeric'}) + " 09:15",
                        description: "Je bestelling wordt voorbereid voor verzending.",
                        status: "completed"
                    },
                    {
                        stage: "Verzonden",
                        date: new Date(Date.now() - 86400000 * 1).toLocaleDateString('nl-NL', {day: 'numeric', month: 'long', year: 'numeric'}) + " 11:45",
                        description: "Je bestelling is onderweg! Trackingsnummer: TRK" + orderId.padStart(8, '0'),
                        status: "completed"
                    },
                    {
                        stage: "Onderweg",
                        date: "Vandaag",
                        description: "Je pakket wordt bezorgd binnen 1-2 werkdagen.",
                        status: "active"
                    },
                    {
                        stage: "Bezorgd",
                        date: new Date(Date.now() + 86400000 * 1).toLocaleDateString('nl-NL', {day: 'numeric', month: 'long', year: 'numeric'}),
                        description: "Verwacht op bovenstaande datum",
                        status: "pending"
                    }
                ];
                
                // Build status cards
                let cardsHTML = '';
                statusData.forEach(item => {
                    cardsHTML += `
                        <div class="status-card ${item.status === 'active' ? 'active' : ''} ${item.status === 'completed' ? 'completed' : ''}">
                            <h5>${item.stage}</h5>
                            <p class="status-date">${item.date}</p>
                            ${item.description ? `<p class="status-description">${item.description}</p>` : ''}
                        </div>
                    `;
                });
                
                $('#statusCards').html(cardsHTML);
                $('#orderResult').fadeIn();
                
                // Scroll to results
                $('html, body').animate({
                    scrollTop: $('#orderResult').offset().top - 100
                }, 500);
            }
            
            // Print button
            $('#printBtn').on('click', function() {
                window.print();
            });
            
            // Help button
            $('#helpBtn').on('click', function() {
                window.location.href = 'contact.php?subject=Hulp bij bestelling ' + $('#orderId').val();
            });
            
            // Real-time validation
            $('input').on('input', function() {
                if ($(this).val()) {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>
</html>