<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Le Fragrance</title>
    
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
        
        .contact-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #ffffff 0%, #f9f5f0 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin: 40px 0;
            position: relative;
            overflow: hidden;
        }
        
        .contact-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="%238B4513" opacity="0.05"><path d="M50 0 L100 50 L50 100 L0 50 Z"/></svg>');
            background-size: contain;
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
        
        .contact-info-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: transform 0.3s;
        }
        
        .contact-info-card:hover {
            transform: translateY(-5px);
        }
        
        .contact-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin: 0 5px;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--secondary-color);
            transform: scale(1.1);
        }
        
        .map-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
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
        
        /* Success message */
        .success-message {
            display: none;
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
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
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <section class="contact-section p-4 p-md-5">
                    <h2 class="section-title text-center">Neem Contact Op</h2>
                    
                    <form id="contactForm" action="contact-process.php" method="post" novalidate>
                        <div class="form-group">
                            <label for="name">Volledige Naam</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Vul alstublieft uw naam in.</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mailadres</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Vul alstublieft een geldig e-mailadres in.</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefoonnummer (optioneel)</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Onderwerp</label>
                            <select class="form-control" id="subject" name="subject" required>
                                <option value="" selected disabled>Selecteer een onderwerp</option>
                                <option value="Vraag">Vraag</option>
                                <option value="Bestelling">Bestelling</option>
                                <option value="Retour">Retour</option>
                                <option value="Klacht">Klacht</option>
                                <option value="Anders">Anders</option>
                            </select>
                            <div class="invalid-feedback">Selecteer alstublieft een onderwerp.</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Uw Bericht</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            <div class="invalid-feedback">Vul alstublieft uw bericht in.</div>
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="consent" name="consent" required>
                            <label class="form-check-label" for="consent">Ik ga akkoord met de verwerking van mijn gegevens volgens de <a href="privacy.php">privacyverklaring</a>.</label>
                            <div class="invalid-feedback">U moet akkoord gaan met de verwerking van uw gegevens.</div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">
                                <span id="submitText">Verstuur Bericht</span>
                                <div id="loader" class="loader"></div>
                            </button>
                        </div>
                        
                        <div id="successMessage" class="success-message">
                            <i class="fas fa-check-circle mr-2"></i> Bedankt! Uw bericht is succesvol verzonden.
                        </div>
                    </form>
                </section>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Onze Locatie</h4>
                    <p>Tilted Towers<br>1234 AB Amsterdam</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>Bel Ons</h4>
                    <p>+31 6 12345678<br>Ma-Vr: 9:00 - 17:00</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4>E-mail Ons</h4>
                    <p>info@lefragrance.nl<br>support@lefragrance.nl</p>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <h3 class="section-title mb-4">Onze Locatie</h3>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2436.4769617833777!2d4.893758315801661!3d52.36244797978483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTLCsDIxJzQ0LjgiTiA0wrA1MyczMS42IkU!5e0!3m2!1sen!2snl!4v1620000000000!5m2!1sen!2snl" allowfullscreen="" loading="lazy"></iframe>
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
                    <h5>Snelle Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="producten.php">Producten</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="privacy.php">Privacybeleid</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4">
                    <h5>Volg Ons</h5>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
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
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();
                
                // Reset validation
                $('.is-invalid').removeClass('is-invalid');
                
                // Validate form
                let isValid = true;
                const form = this;
                
                // Check required fields
                $(form).find('[required]').each(function() {
                    if (!$(this).val()) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    }
                });
                
                // Validate email format
                const email = $('#email').val();
                if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    $('#email').addClass('is-invalid');
                    isValid = false;
                }
                
                if (isValid) {
                    // Show loading animation
                    $('#submitText').hide();
                    $('#loader').show();
                    
                    // Simulate AJAX submission (replace with actual AJAX call)
                    setTimeout(function() {
                        // Hide loader
                        $('#loader').hide();
                        $('#submitText').show();
                        
                        // Show success message
                        $('#successMessage').fadeIn();
                        
                        // Reset form
                        form.reset();
                        
                        // Scroll to success message
                        $('html, body').animate({
                            scrollTop: $('#successMessage').offset().top - 100
                        }, 500);
                        
                        // Hide success message after 5 seconds
                        setTimeout(function() {
                            $('#successMessage').fadeOut();
                        }, 5000);
                    }, 1500);
                    
                    // For actual implementation, use:
                    /*
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: $(form).serialize(),
                        success: function(response) {
                            $('#loader').hide();
                            $('#submitText').show();
                            $('#successMessage').fadeIn();
                            form.reset();
                            
                            setTimeout(function() {
                                $('#successMessage').fadeOut();
                            }, 5000);
                        },
                        error: function(xhr) {
                            $('#loader').hide();
                            $('#submitText').show();
                            alert('Er is een fout opgetreden. Probeer het later opnieuw.');
                        }
                    });
                    */
                }
            });
            
            // Real-time validation
            $('input, select, textarea').on('input change', function() {
                if ($(this).val()) {
                    $(this).removeClass('is-invalid');
                }
            });
            
            // Phone number formatting
            $('#phone').on('input', function() {
                let phone = $(this).val().replace(/\D/g, '');
                if (phone.length > 0) {
                    phone = phone.match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                    $(this).val(!phone[2] ? phone[1] : phone[1] + '-' + phone[2] + (phone[3] ? '-' + phone[3] : ''));
                }
            });
            
            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top - 80
                }, 800);
            });
        });
    </script>
</body>
</html>
