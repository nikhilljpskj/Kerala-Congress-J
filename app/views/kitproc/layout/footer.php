    <!-- Footer -->
    <footer class="footer py-5 mt-5" style="background-color: #0c1221; color: #94a3b8;">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <img src="<?= BASE_URL ?>/assets/images/kitproc/kitproc logo.svg" alt="KITPROC Logo" class="mb-4 bg-white p-2 rounded" style="max-height: 70px;">
                    <p class="mb-4" style="line-height: 1.8;">The Kerala IT and Professional Congress (KITPROC) is a vibrant community of professionals united by a common goal: to drive positive change in Kerala through expertise, energy, and innovation.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 ms-lg-auto">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= BASE_URL ?>/kitproc" class="text-decoration-none text-info-hover">Home</a></li>
                        <li class="mb-2"><a href="<?= BASE_URL ?>/kitproc/about" class="text-decoration-none text-info-hover">About Us</a></li>
                        <li class="mb-2"><a href="<?= BASE_URL ?>/kitproc/news" class="text-decoration-none text-info-hover">Latest News</a></li>
                        <li class="mb-2"><a href="<?= BASE_URL ?>/" class="text-decoration-none text-info-hover">Main Website</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="text-white mb-4">Contact KITPROC</h5>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-danger"></i> State Committee Office, Kochi/Kottayam</p>
                    <p class="mb-3"><i class="fas fa-phone-alt me-2 text-danger"></i> +91 9447355775</p>
                    <p class="mb-0"><i class="fas fa-envelope me-2 text-danger"></i> info@redeemertechnologies.com</p>
                </div>
            </div>
            
            <hr class="mt-5 mb-4 border-secondary opacity-25">
            <div class="text-center small">
                <p class="mb-0">&copy; <?= date('Y') ?> KITPROC - Kerala IT and Professional Congress. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
        }
        .social-icon:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-3px);
        }
        .text-info-hover { color: #94a3b8; transition: 0.3s; }
        .text-info-hover:hover { color: #fff; }
        
        .bg-whatsapp { background-color: #25d366; color: white; }
        .bg-phone { background-color: #2563eb; color: white; }
        .float-btn {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 30px;
            right: 30px;
            border-radius: 50px;
            text-align: center;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
