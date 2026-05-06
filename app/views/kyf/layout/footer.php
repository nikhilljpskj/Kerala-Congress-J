    <!-- Footer -->
    <footer class="footer bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 text-center text-md-start">
                    <img src="<?= BASE_URL ?>/images/logo_kyf.svg" alt="KYF Logo" class="mb-4 bg-white p-2 rounded" style="max-width: 120px;">
                    <p class="mb-4 p-0 pe-md-4" style="font-weight: 300; opacity: 0.8;">The Kerala Youth Front (KYF) is the dynamic youth wing of Kerala Congress, committed to empowering youth and building a better Kerala.</p>
                </div>
                
                <div class="col-lg-2 col-md-6 text-center text-md-start">
                    <h5 class="text-white fw-bold mb-4">Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= BASE_URL ?>/" class="text-decoration-none text-white-50">Main Home</a></li>
                        <li class="mb-2"><a href="#vision" class="text-decoration-none text-white-50">Vision</a></li>
                        <li class="mb-2"><a href="<?= BASE_URL ?>/join" class="text-decoration-none text-white-50">Join Us</a></li>
                        <li class="mb-2"><a href="#contact" class="text-decoration-none text-white-50">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 text-center text-md-start">
                    <h5 class="text-white fw-bold mb-4">Connect</h5>
                    <div class="d-flex gap-2 justify-content-center justify-content-md-start">
                        <a href="#" class="btn btn-outline-light rounded-circle shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 text-center text-md-start">
                    <h5 class="text-white fw-bold mb-4">Contact Details</h5>
                    <p class="text-white-50 mb-2"><i class="fas fa-map-marker-alt me-2 text-danger"></i> State Committee Office, Kottayam</p>
                    <p class="text-white-50 mb-3"><i class="fas fa-phone-alt me-2 text-danger"></i> +91 9447355775</p>
                    <p class="text-white-50 mb-1"><i class="fas fa-envelope me-2 text-danger"></i> <a href="mailto:info@keralacongress.org.in" class="text-white-50 text-decoration-none">info@keralacongress.org.in</a></p>
                    <p class="text-white-50 mb-0"><i class="fas fa-envelope me-2 text-danger"></i> <a href="mailto:info@redeemertechnologies.com" class="text-white-50 text-decoration-none">info@redeemertechnologies.com</a></p>
                </div>
            </div>
            
            <hr class="mt-5 mb-4 border-secondary">
            <div class="text-center text-white-50 small">
                <p class="mb-0">Kerala Youth Front (KYF) &copy; <?= date('Y') ?>. Empowering Kerala's Youth.</p>
            </div>
        </div>
    </footer>

    <style>
        .footer {
            background-color: #1a1a1a !important;
        }
        .bg-whatsapp { background-color: #25d366; color: white; }
        .bg-phone { background-color: #b71c1c; color: white; }
        .float-btn {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 30px;
            right: 30px;
            border-radius: 50px;
            text-align: center;
            font-size: 24px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: 0.3s;
        }
        .float-btn:hover { transform: scale(1.1); color: white; }
        .bg-phone { bottom: 90px; }
    </style>

    <!-- Floating Contact Buttons -->
    <div class="floating-contact">
        <a href="https://wa.me/919447355775" target="_blank" class="float-btn bg-whatsapp" title="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="tel:+919447355775" class="float-btn bg-phone" title="Call Us">
            <i class="fas fa-phone-alt"></i>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
