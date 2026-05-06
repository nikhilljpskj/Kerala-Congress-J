<?php 
$pageTitle = 'Home - Kerala Congress'; 
require_once __DIR__ . '/../layout/header.php'; 
?>

    <!-- Hero Section (Restored to use all Banners in Carousel) -->
    <header class="hero-carousel">
        <div id="mainCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="<?= BASE_URL ?>/images/Banner_1.jpg" class="d-block w-100" alt="Banner 1">
                    <div class="carousel-caption">
                        <div class="container">
                            <h1 class="hero-title text-white">Working for the People of Kerala</h1>
                            <p class="hero-subtitle">Dedicated to the empowerment of the common man, farmers, and the working class. Join hands with us to build a stronger, prosperous Kerala.</p>
                            <div class="d-flex flex-wrap gap-2 gap-md-3">
                                <a href="<?= BASE_URL ?>/join" class="btn btn-primary btn-lg px-3 px-md-4 fs-6 fw-bold border-0 shadow" style="background: var(--primary); border-radius: 50px;">Become a Member</a>
                                <a href="#history" class="btn btn-outline-light btn-lg px-3 px-md-4 fs-6 fw-bold shadow" style="border-radius: 50px;">Our History</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="<?= BASE_URL ?>/images/Banner_2.jpg" class="d-block w-100" alt="Banner 2" onerror="this.src="<?= BASE_URL ?>/images/flag_bg.jpg"">
                    <div class="carousel-caption">
                        <div class="container">
                            <h1 class="hero-title text-white">United for Progress</h1>
                            <p class="hero-subtitle">Bringing together diverse voices to create sustainable development and social justice across all districts of Kerala.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="<?= BASE_URL ?>/organizations" class="btn btn-primary btn-lg px-4 fs-6 fw-bold border-0 shadow" style="background: var(--primary); border-radius: 50px;">Our Organizations</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="<?= BASE_URL ?>/images/Banner_3.jpg" class="d-block w-100" alt="Banner 3" onerror="this.src="<?= BASE_URL ?>/images/flag_bg.jpg"">
                    <div class="carousel-caption">
                        <div class="container">
                            <h1 class="hero-title text-white">Empowering Farmers</h1>
                            <p class="hero-subtitle">Our core foundation relies on the strength of the agricultural community. Protecting their rights and livelihoods is our paramount duty.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="<?= BASE_URL ?>/images/Banner_4.jpg" class="d-block w-100" alt="Banner 4" onerror="this.src="<?= BASE_URL ?>/images/flag_bg.jpg"">
                    <div class="carousel-caption">
                        <div class="container">
                            <h1 class="hero-title text-white">Kerala Youth Front</h1>
                            <p class="hero-subtitle">Energizing the next generation of leaders. Join KYF to make your voice heard and shape the future of our state.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="<?= BASE_URL ?>/youthfront" class="btn btn-light btn-lg px-4 fs-6 fw-bold text-dark shadow" style="border-radius: 50px;">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>

    <!-- Leadership Section -->
    <section id="leadership" class="section-padding bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <!-- Assuming pjjoseph.png is in the root directory under images -->
                    <img src="<?= BASE_URL ?>/images/pjjoseph.png" alt="P.J. Joseph" class="leader-img">
                </div>
                <div class="col-lg-7 ps-lg-5">
                    <h6 class="text-uppercase fw-bold text-muted mb-2" style="color: var(--primary) !important;">Party Chairman</h6>
                    <h2 class="section-title">Shri. P.J. Joseph</h2>
                    <p class="lead text-dark mb-4 p-0">Member of the Kerala Legislative Assembly</p>
                    <p class="mb-4" style="text-align: justify; line-height: 1.8;">
                        P. J. Joseph is a prominent Indian politician hailing from Kerala, representing the Kerala Congress. His political journey began in 1968. Over the years, he has made significant contributions to the state's governance, serving as a Member of the Legislative Assembly from Thodupuzha Assembly Constituency in Kerala on ten occasions.
                    </p>
                    <p class="mb-4" style="text-align: justify; line-height: 1.8;">
                        P. J. Joseph has held various ministerial positions, including Home Minister in 1978 and Revenue Minister from 1981 to 1987. He also served as the Education Minister from 1996 to 2001. Known for his dedication to public service, his commitment to his constituents makes him a respected leader in the region.
                    </p>
                    <a href="tel:+919447355775" class="btn btn-outline-dark rounded-pill px-4 fw-bold"><i class="fas fa-phone-alt me-2"></i> Contact Chairman's Office</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Focus Areas -->
    <section id="mission" class="section-padding">
        <div class="container">
            <div class="text-center mb-5 pb-3">
                <h2 class="section-title mx-auto">Our Mission & Vision</h2>
                <p class="text-muted max-w-700 mx-auto mt-3">We strive to protect the rights of agricultural families, advocate for social justice, and drive sustainable development across Kerala.</p>
            </div>
            
            <div class="row g-4 pt-3">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-seedling"></i></div>
                        <h4 class="fw-bold mb-3">Farmer Welfare</h4>
                        <p class="text-muted mb-0">Protecting the backbone of our state. We actively fight for the rights, subsidies, and fair pricing for Kerala's agricultural communities.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-balance-scale"></i></div>
                        <h4 class="fw-bold mb-3">Social Justice</h4>
                        <p class="text-muted mb-0">Ensuring equal opportunities and representation for all marginalized sections of society, regardless of caste, creed, or economic status.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-chart-line"></i></div>
                        <h4 class="fw-bold mb-3">Sustainable Growth</h4>
                        <p class="text-muted mb-0">Propelling Kerala into the future through strong IT policies, youth employment initiatives, and modernized infrastructure development.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Latest News & Events -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="row g-5">
                <!-- News Column -->
                <div class="col-lg-7">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <div>
                            <h2 class="section-title mb-0 text-start ms-0">Latest News</h2>
                            <div class="bg-primary mt-2" style="width: 50px; height: 3px;"></div>
                        </div>
                        <a href="#" class="text-primary fw-bold text-decoration-none small">View All News <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                    
                    <div class="news-list">
                        <?php if (!empty($news)): ?>
                            <?php foreach ($news as $item): ?>
                            <div class="news-item-horizontal mb-4 d-flex gap-4 align-items-center">
                                <div class="news-date-box text-center p-2 rounded-3 bg-light" style="min-width: 70px;">
                                    <span class="d-block fw-bold h4 mb-0 text-primary"><?= date('d', strtotime($item['created_at'])) ?></span>
                                    <span class="small text-muted text-uppercase"><?= date('M', strtotime($item['created_at'])) ?></span>
                                </div>
                                <?php if ($item['image']): ?>
                                    <div class="news-img-box rounded-3 overflow-hidden" style="min-width: 100px; height: 80px;">
                                        <img src="<?= BASE_URL . '/' . ltrim($item['image'], '/') ?>" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h5 class="fw-bold mb-1"><a href="#" class="text-dark text-decoration-none"><?= htmlspecialchars($item['title']) ?></a></h5>
                                    <p class="text-muted small mb-0 d-none d-sm-block"><?= substr(strip_tags($item['body']), 0, 120) ?>...</p>
                                    <p class="text-muted small mb-0 d-block d-sm-none"><?= substr(strip_tags($item['body']), 0, 80) ?>...</p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Stay tuned for the latest updates.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Events Column -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-lg rounded-4 p-4" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                        <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-calendar-alt text-primary me-2"></i> Upcoming Events</h4>
                        
                        <?php if (!empty($events)): ?>
                            <?php foreach ($events as $event): ?>
                            <div class="event-card-small mb-3 p-3 bg-white rounded-3 shadow-sm border-start border-4 border-primary">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3"><?= $event['event_date'] ? date('D, d M', strtotime($event['event_date'])) : 'TBA' ?></span>
                                    <span class="small text-muted"><i class="far fa-clock me-1"></i> <?= $event['event_date'] ? date('h:i A', strtotime($event['event_date'])) : 'TBA' ?></span>
                                </div>
                                <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($event['title']) ?></h6>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-calendar-day fa-3x text-light mb-3"></i>
                                <p class="text-muted small">No upcoming events scheduled at the moment.</p>
                            </div>
                        <?php endif; ?>
                        
                        <a href="<?= BASE_URL ?>/contact" class="btn btn-primary w-100 mt-3 rounded-pill fw-bold py-2" style="background: var(--primary);">Contact for Details</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Frontal Organizations Slider -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title mx-auto">Frontal Organizations</h2>
                <p class="text-muted">The pillars of our movement across various sectors.</p>
            </div>
            
            <div class="org-slider-container">
                <div class="org-track">
                    <!-- KYF -->
                    <div class="org-item">
                        <a href="<?= BASE_URL ?>/youthfront" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="KYF">
                            </div>
                            <h6 class="mt-3 fw-bold">Kerala Youth Front</h6>
                        </a>
                    </div>
                    <!-- KSC -->
                    <div class="org-item">
                        <a href="#" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="KSC">
                            </div>
                            <h6 class="mt-3 fw-bold">KSC Students</h6>
                        </a>
                    </div>
                    <!-- KITPROC -->
                    <div class="org-item">
                        <a href="<?= BASE_URL ?>/kitproc" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="KITPROC">
                            </div>
                            <h6 class="mt-3 fw-bold">KITPROC</h6>
                        </a>
                    </div>
                    <!-- KTUC -->
                    <div class="org-item">
                        <a href="#" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="KTUC">
                            </div>
                            <h6 class="mt-3 fw-bold">KTUC Labour</h6>
                        </a>
                    </div>
                    <!-- Vanitha Congress -->
                    <div class="org-item">
                        <a href="#" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="Vanitha Congress">
                            </div>
                            <h6 class="mt-3 fw-bold">Vanitha Congress</h6>
                        </a>
                    </div>
                    <!-- Karshaka Congress -->
                    <div class="org-item">
                        <a href="#" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="Karshaka Congress">
                            </div>
                            <h6 class="mt-3 fw-bold">Karshaka Congress</h6>
                        </a>
                    </div>
                    <!-- Repeat for smooth loop -->
                    <div class="org-item">
                        <a href="<?= BASE_URL ?>/youthfront" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="KYF">
                            </div>
                            <h6 class="mt-3 fw-bold">Kerala Youth Front</h6>
                        </a>
                    </div>
                    <div class="org-item">
                        <a href="<?= BASE_URL ?>/kitproc" class="org-link text-center">
                            <div class="org-logo-circle">
                                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="KITPROC">
                            </div>
                            <h6 class="mt-3 fw-bold">KITPROC</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <style>
        .hero-carousel .carousel-item { height: 80vh; min-height: 500px; background: #000; position: relative; }
        @media (max-width: 768px) {
            .hero-carousel .carousel-item { height: 60vh; min-height: 350px; }
            .hero-carousel .carousel-caption { bottom: 10%; left: 5%; right: 5%; width: 90%; }
            .news-item-horizontal { flex-direction: column; align-items: flex-start !important; }
            .news-img-box { width: 100%; height: 200px !important; }
            .news-date-box { position: absolute; top: 10px; left: 10px; z-index: 5; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
            .news-item-horizontal { position: relative; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        }
        .hero-carousel .carousel-item::before { content: ''; position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(rgba(30, 41, 59, 0.7), rgba(183, 28, 28, 0.7)); z-index: 1; }
        .org-slider-container {
            overflow: hidden;
            padding: 40px 0;
            position: relative;
        }
        .org-track {
            display: flex;
            gap: 50px;
            animation: scroll 25s linear infinite;
            width: fit-content;
        }
        .org-item {
            width: 180px;
            flex-shrink: 0;
        }
        .org-logo-circle {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border: 4px solid #fff;
            transition: 0.3s;
        }
        .org-logo-circle img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }
        .org-link {
            text-decoration: none;
            color: var(--dark);
            display: block;
        }
        .org-link:hover .org-logo-circle {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(211, 47, 47, 0.15);
            border-color: var(--primary);
        }
        .org-link:hover h6 {
            color: var(--primary);
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-180px * 6 - 50px * 6)); }
        }
        .org-slider-container:hover .org-track {
            animation-play-state: paused;
        }
    </style>
 
    <!-- History Summary -->
    <section id="history" class="section-padding bg-white">
        <div class="container">
            <div class="row flex-row-reverse align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center">
                    <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="Party Logo" class="img-fluid" style="max-width: 300px; opacity: 0.9;">
                </div>
                <div class="col-lg-6 pe-lg-5 text-center text-lg-start">
                    <h2 class="section-title">A Legacy of Service</h2>
                    <p class="mb-4" style="line-height: 1.8;">
                        Kerala Congress is a political party in Kerala, India founded in 1964. Spearheaded by the leadership of visionaries like Mathachan Kuruvinakunnel, K. M. George, R. Balakrishna Pillai, and Mannathu Padmanabha Pillai. 
                    </p>
                    <p class="mb-5" style="line-height: 1.8;">
                        Through decades of unwavering dedication, Kerala Congress (Joseph), a vital component of the United Democratic Front (UDF), has remained a powerful voice for the agrarian class and the common people in the Kerala Legislative Assembly.
                    </p>
                    <a href="<?= BASE_URL ?>/join" class="btn btn-primary btn-lg rounded-pill px-5 border-0" style="background: var(--primary);">Be Part of History</a>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Latest Media Gallery -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="section-title mb-0">Latest Media</h2>
                    <p class="text-muted mt-3 mb-0">Glimpses of our recent activities and public engagements.</p>
                </div>
                <a href="<?= BASE_URL ?>/media" class="btn btn-outline-primary rounded-pill px-4 fw-bold d-none d-md-block">View Full Gallery <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
            
            <div class="row g-3">
                <?php if (!empty($gallery)): ?>
                    <?php foreach ($gallery as $item): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="media-card rounded-4 overflow-hidden shadow-sm position-relative group">
                            <img src="<?= BASE_URL ?><?= $item['image_path'] ?>" class="w-100" style="height: 250px; object-fit: cover; transition: 0.5s;">
                            <div class="overlay position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50 text-white translate-y-full transition-all media-overlay">
                                <p class="small mb-0"><?= htmlspecialchars($item['title'] ?: 'Kerala Congress Event') ?></p>
                            </div>
                            <a href="<?= BASE_URL ?>/media" class="stretched-link"></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php for($i=1; $i<=4; $i++): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="media-card rounded-4 overflow-hidden shadow-sm position-relative group">
                            <img src="<?= BASE_URL ?>/images/gallery_<?= $i ?>.jpeg" class="w-100" style="height: 250px; object-fit: cover; transition: 0.5s;" onerror="this.src="<?= BASE_URL ?>/images/flag_bg.jpg"">
                            <div class="overlay position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50 text-white translate-y-full transition-all media-overlay">
                                <p class="small mb-0">Kerala Congress Event #<?= $i ?></p>
                            </div>
                            <a href="<?= BASE_URL ?>/media" class="stretched-link"></a>
                        </div>
                    </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
            <div class="text-center mt-5 d-md-none">
                <a href="<?= BASE_URL ?>/media" class="btn btn-primary rounded-pill px-5 fw-bold">View Gallery</a>
            </div>
        </div>
    </section>
 
    <style>
        .media-card {
            cursor: pointer;
        }
        .media-card:hover img {
            transform: scale(1.1);
        }
        .media-overlay {
            transform: translateY(100%);
        }
        .media-card:hover .media-overlay {
            transform: translateY(0);
        }
    </style>
 
    <!-- Call to Action -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white;">
        <div class="container text-center py-4">
            <h2 class="fw-bold mb-3 d-block d-md-inline-block me-md-4 mb-md-0">Ready to make a difference?</h2>
            <a href="<?= BASE_URL ?>/join" class="btn btn-light btn-lg rounded-pill px-5 fw-bold text-dark shadow-sm">Join Kerala Congress Today</a>
    </section>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
