<?php 
$pageTitle = 'Kerala IT and Professional Congress - Driving Progress through Expertise'; 
require_once __DIR__ . '/layout/header.php'; 
?>

    <!-- Hero Carousel -->
    <header class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="<?= BASE_URL ?>/assets/images/kitproc/Banner 1.jpg" class="d-block w-100" alt="KITPROC Banner 1" style="height: 650px; object-fit: cover;">
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption">
                        <div class="container text-start">
                            <h1 class="display-2 fw-800 text-white mb-3 slide-in-top">Kerala IT and <br>Professional Congress</h1>
                            <p class="lead text-white-50 mb-4 slide-in-bottom" style="max-width: 700px;">A robust and dynamic forum where the voices of working professionals are heard and valued.</p>
                            <div class="d-flex flex-wrap gap-2 gap-md-3 slide-in-bottom delay-1">
                                <a href="<?= BASE_URL ?>/join" class="btn btn-action btn-sm btn-md-lg px-3 px-md-4">Register Now</a>
                                <a href="#involved" class="btn btn-outline-light btn-sm btn-md-lg px-3 px-md-5 border-2 fw-bold">Get Involved</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="<?= BASE_URL ?>/assets/images/kitproc/Banner 2.jpg" class="d-block w-100" alt="KITPROC Banner 2" style="height: 650px; object-fit: cover;">
                    <div class="hero-overlay"></div>
                    <div class="carousel-caption">
                        <div class="container text-start">
                            <h1 class="display-3 fw-800 text-white mb-3 slide-in-top">Building a Better <br>Kerala with Experts</h1>
                            <p class="lead text-white-50 mb-4 slide-in-bottom" style="max-width: 700px;">Bridge the gap between the professional community and the political sphere.</p>
                            <div class="d-flex gap-3 slide-in-bottom delay-1">
                                <a href="<?= BASE_URL ?>/join" class="btn btn-action btn-lg">Join the Movement</a>
                                <a href="#vision" class="btn btn-outline-light btn-lg px-5 border-2 fw-bold">Our Vision</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </header>

    <style>
        .hero-section { position: relative; }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to right, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 100%);
            z-index: 1;
        }
        .carousel-caption {
            z-index: 2;
            bottom: 20%;
            text-align: left;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }
        @media (max-width: 768px) {
            .hero-section .carousel-item img { height: 450px !important; }
            .hero-section .carousel-caption { bottom: 10%; text-align: center !important; }
            .hero-section .display-2 { font-size: 2rem; }
            .hero-section .display-3 { font-size: 1.8rem; }
            .hero-section .lead { font-size: 0.9rem; margin-bottom: 1.5rem !important; }
            .hero-section .container { text-align: center !important; }
            .hero-section .d-flex { justify-content: center; }
        }
        .fw-800 { font-weight: 800; }
        .slide-in-top { animation: slideInTop 0.8s ease-out forwards; }
        .slide-in-bottom { animation: slideInBottom 0.8s ease-out forwards; }
        .delay-1 { animation-delay: 0.3s; }
        
        @keyframes slideInTop { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInBottom { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <!-- Mission & Vision -->
    <section id="vision" class="section-padding bg-light">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg p-5 rounded-4 bg-tech mb-4">
                        <div class="mb-4 text-kc"><i class="fas fa-bullseye fa-3x"></i></div>
                        <h2 class="text-white mb-3">OUR MISSION</h2>
                        <p class="text-white-50" style="line-height: 1.8; font-size: 1.1rem; text-align: justify;">
                            Our mission is to provide a robust and dynamic forum where the voices of working professionals are heard, valued, and translated into actionable policies. We strive to bridge the gap between the professional community and the political sphere, ensuring that their insights and contributions help shape a more prosperous and equitable society.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <div class="mb-4 text-kc"><i class="fas fa-eye fa-3x"></i></div>
                        <h2 class="mb-3">OUR VISION</h2>
                        <p class="text-muted" style="line-height: 1.8; font-size: 1.1rem; text-align: justify;">
                            The Kerala Congress, led by P.J. Joseph, has established a dedicated platform for working professionals under the banner of the Kerala IT and Professional Congress. Our vision is to rejuvenate our voter base and broaden our social outreach by actively engaging with the professional community. We believe that professionals across various sectors are the backbone of societal progress and innovation.
                        </p>
                        <hr class="my-4 border-2 border-primary w-25">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do & Who We Are -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 border-start border-5 border-primary shadow-sm h-100 bg-light">
                        <h3 class="fw-bold mb-4">What We Do</h3>
                        <p class="text-muted" style="line-height: 1.7; text-align: justify;">
                            The Kerala IT and Professional Congress will kick off its journey with a grand convention at Ernakulam on July 23. This event marks the beginning of our concerted efforts to build a network of professionals who are dedicated to the collective well-being and progress of Kerala. Under the leadership of Apu John Joseph, elder son of P.J. Joseph, our team comprises passionate and committed individuals.
                        </p>
                        <div class="mt-4 d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-calendar-alt text-kc fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Upcoming Convension</h6>
                                <p class="mb-0 small text-muted">Ernakulam - July 23</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 border-start border-5 border-tech shadow-sm h-100 bg-white border">
                        <h3 class="fw-bold mb-4">Who We Are</h3>
                        <p class="text-muted" style="line-height: 1.7; text-align: justify;">
                            In essence, who are we? We are a vibrant and proactive community of professionals united by a common goal: to drive positive change in Kerala. We are doctors, engineers, IT specialists, educators, entrepreneurs, and more, each bringing our unique expertise and perspective to the table. We believe in the power of collective action.
                        </p>
                        <div class="row mt-4">
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center"><i class="fas fa-check-circle text-kc me-2"></i> <span>Doctors</span></div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center"><i class="fas fa-check-circle text-kc me-2"></i> <span>Engineers</span></div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center"><i class="fas fa-check-circle text-kc me-2"></i> <span>IT Specialists</span></div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex align-items-center"><i class="fas fa-check-circle text-kc me-2"></i> <span>Entreprenuers</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Updates -->
    <section class="section-padding bg-light" id="involved">
        <div class="container">
            <div class="row justify-content-between align-items-center mb-5">
                <div class="col-md-6">
                    <h2 class="fw-bold m-0">LATEST UPDATES</h2>
                    <p class="text-muted">News & insights from the professional front.</p>
                </div>
                <div class="col-md-auto text-end">
                    <a href="<?= BASE_URL ?>/kitproc/news" class="btn btn-action">View All News</a>
                </div>
            </div>
            
            <div class="row g-4">
                <?php if (!empty($news)): ?>
                    <?php $mainNews = $news[0]; ?>
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="row g-0 h-100">
                                <div class="col-md-6">
                                    <?php if ($mainNews['image']): ?>
                                        <?php $newsImg = ltrim($mainNews['image'], '/'); ?>
                                        <img src="<?= BASE_URL . '/' . $newsImg ?>" class="img-fluid h-100 w-100" style="object-fit: cover;">
                                    <?php else: ?>
                                        <img src="<?= BASE_URL ?>/assets/images/kitproc/in-chandy.jpeg" class="img-fluid h-100 w-100" style="object-fit: cover;" onerror="this.src='<?= BASE_URL ?>/images/flag_bg.jpg'">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 d-flex flex-column">
                                    <div class="card-body p-4 d-flex flex-column">
                                        <div class="badge bg-danger mb-3 align-self-start">LATEST NEWS</div>
                                        <h4 class="mb-3"><?= htmlspecialchars($mainNews['title']) ?></h4>
                                        <p class="text-muted"><?= substr(strip_tags($mainNews['body']), 0, 150) ?>...</p>
                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <span class="text-muted small"><i class="far fa-calendar-alt me-1"></i> <?= date('M d, Y', strtotime($mainNews['created_at'])) ?></span>
                                            <a href="#" class="text-kc fw-bold text-decoration-none small">READ MORE <i class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="row g-0 h-100">
                                <div class="col-md-6">
                                    <img src="<?= BASE_URL ?>/assets/images/kitproc/in-chandy.jpeg" class="img-fluid h-100 w-100" style="object-fit: cover;" onerror="this.src="<?= BASE_URL ?>/images/flag_bg.jpg"">
                                </div>
                                <div class="col-md-6 d-flex flex-column">
                                    <div class="card-body p-4 d-flex flex-column">
                                        <div class="badge bg-danger mb-3 align-self-start">LATEST NEWS</div>
                                        <h4 class="mb-3">In conversation with Adv Chandy Oommen</h4>
                                        <p class="text-muted">An exclusive session discussing the future of professional engagement in Kerala politics.</p>
                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <span class="text-muted small"><i class="far fa-calendar-alt me-1"></i> March 28, 2021</span>
                                            <a href="#" class="text-kc fw-bold text-decoration-none small">READ MORE <i class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-tech text-white text-center d-flex flex-column justify-content-center">
                        <i class="fab fa-twitter fa-3x mb-4 text-info"></i>
                        <h4 class="text-white mb-3">Twitter Feed</h4>
                        <p class="opacity-75 mb-4">Follow Kerala IT and Professional Congress on Twitter for real-time updates.</p>
                        <a href="#" class="btn btn-info text-white fw-bold rounded-pill mx-auto px-4">Follow Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Preview -->
    <section class="section-padding bg-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">OUR LEADERS</h2>
            <div class="row justify-content-center g-4">
                <div class="col-md-4">
                    <div class="leader-card p-4 rounded-4 border group shadow-hover">
                        <div class="rounded-4 overflow-hidden mb-3">
                            <img src="<?= BASE_URL ?>/assets/images/kitproc/mem0.jpg" alt="Apu John Joseph" class="img-fluid transition-all" style="width: 100%;">
                        </div>
                        <h4 class="mb-0">Apu John Joseph</h4>
                        <p class="text-kc fw-bold">State President</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="leader-card p-4 rounded-4 border group shadow-hover">
                        <div class="rounded-4 overflow-hidden mb-3">
                            <img src="<?= BASE_URL ?>/assets/images/kitproc/mem1.jpg" alt="Jais John Vettiyar" class="img-fluid transition-all" style="width: 100%;">
                        </div>
                        <h4 class="mb-0">Jais John Vettiyar</h4>
                        <p class="text-kc fw-bold">State General Secretary</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .shadow-hover { transition: 0.3s; }
        .shadow-hover:hover { 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
            transform: translateY(-5px);
            border-color: var(--primary) !important;
        }
    </style>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
