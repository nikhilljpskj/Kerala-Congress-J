<?php 
$pageTitle = 'Kerala Youth Front - Kerala Congress'; 
require_once __DIR__ . '/layout/header.php'; 
?>

    <!-- Cyber Banner / Hero Section -->
    <header class="kyf-hero">
        <div id="kyfCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php for($i=1; $i<=4; $i++): ?>
                <div class="carousel-item <?= $i==1 ? 'active' : '' ?>" data-bs-interval="4000">
                    <img src="<?= BASE_URL ?>/images/Banner_<?= $i ?>.jpg" class="d-block w-100" alt="KYF Banner <?= $i ?>" style="height: 600px; object-fit: cover;">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption d-flex flex-column justify-content-center h-100">
                        <div class="container text-start">
                            <span class="badge bg-danger shadow-sm px-3 py-2 mb-3 rounded-pill animate-up">THE FUTURE OF KERALA</span>
                            <h1 class="display-3 fw-bold text-white mb-3 animate-up delay-1">Kerala Youth Front</h1>
                            <p class="lead mb-4 text-white-50 max-w-600 animate-up delay-2">Empowering the next generation of leaders to build a progressive and inclusive Kerala.</p>
                            <div class="d-flex flex-wrap gap-2 gap-md-3 animate-up delay-3">
                                <a href="<?= BASE_URL ?>/join" class="btn btn-danger btn-lg rounded-pill px-3 px-md-5 fw-bold shadow">Join KYF Today</a>
                                <a href="#vision" class="btn btn-outline-light btn-lg rounded-pill px-3 px-md-5 fw-bold">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#kyfCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#kyfCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </header>

    <style>
        .kyf-hero { position: relative; }
        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(183, 28, 28, 0.8) 0%, rgba(183, 28, 28, 0.4) 50%, rgba(0,0,0,0) 100%);
            z-index: 1;
        }
        .carousel-caption { 
            z-index: 2; 
            text-shadow: 2px 2px 20px rgba(0,0,0,0.5);
            padding-bottom: 10rem;
        }
        @media (max-width: 768px) {
            .kyf-hero .carousel-item img { height: 400px !important; }
            .kyf-hero .carousel-caption { padding-bottom: 2rem; justify-content: flex-end !important; }
            .kyf-hero .display-3 { font-size: 2.2rem; }
            .kyf-hero .lead { font-size: 1rem; margin-bottom: 1.5rem !important; }
            .kyf-hero .btn-lg { padding: 10px 25px; font-size: 0.9rem; }
        }
        .max-w-600 { max-width: 600px; }
        .text-red { color: #b71c1c !important; }
        .btn-danger { background-color: #d32f2f !important; border-color: #d32f2f !important; color: white !important; }
        .btn-danger:hover { background-color: #b71c1c !important; border-color: #b71c1c !important; }
    </style>

    <!-- Intro & Leadership (K.V. Kannan) -->
    <section class="section-padding bg-white overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 position-relative">
                    <div class="position-absolute translate-middle-x start-50 top-100 w-100 bg-danger opacity-10 rounded-4" style="height: 80%; z-index: 0; transform: translate(-50%, -85%) !important;"></div>
                    <img src="<?= BASE_URL ?>/images/president.jpg" alt="K.V. Kannan" class="img-fluid rounded-4 shadow-lg position-relative hover-lift" style="z-index: 1; border: 10px solid #fff;">
                </div>
                <div class="col-lg-7 ps-lg-5">
                    <div class="d-flex align-items-center mb-4">
                        <img src="<?= BASE_URL ?>/images/logo_kyf.svg" alt="KYF Logo" style="width: 80px;" class="me-3">
                        <div>
                            <h6 class="text-red fw-bold text-uppercase mb-1">State President</h6>
                            <h2 class="fw-bold m-0">K.V. Kannan</h2>
                        </div>
                    </div>
                    <p class="lead text-dark mb-4">"Kerala Youth Front (KYF) is the vibrant youth wing of the Kerala Congress party, acting as the dynamic pulse of our movement."</p>
                    <p class="text-muted" style="text-align: justify; line-height: 1.8;">
                        Under the leadership of K.V. Kannan, Kerala Youth Front has become the one of the most powerful youngsters organization in Kerala. KYF acts as the backbone of the party by mobilizing youth, conducting campaigns, and fighting for the rights and welfare of the younger generation.
                    </p>
                    <div class="row mt-4 g-3">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-red me-2"></i>
                                <span class="fw-bold">Dynamic Leadership</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 d-flex align-items-center">
                                <i class="fas fa-check-circle text-red me-2"></i>
                                <span class="fw-bold">Youth Empowerment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section id="vision" class="section-padding" style="background: #fdf2f2;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-5 rounded-4 bg-danger text-white">
                        <div class="mb-4">
                            <i class="fas fa-eye fa-3x opacity-50"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Our Vision</h2>
                        <p class="fs-5" style="line-height: 1.6; opacity: 0.9;">
                            The Kerala Youth Front envisions a progressive, inclusive, and dynamic Kerala, driven by the energy and ideals of its youth. We aim to foster a society where young people are empowered, engaged, and equipped to lead and innovate.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-5 rounded-4 border-top border-danger border-4">
                        <div class="mb-4">
                            <i class="fas fa-bullseye fa-3x text-red opacity-25"></i>
                        </div>
                        <h2 class="fw-bold mb-3 text-red">Our Mission</h2>
                        <p class="fs-5 text-muted" style="line-height: 1.6;">
                            Our mission is to mobilize and inspire the youth of Kerala to actively participate in the socio-political landscape. Through education, advocacy, and leadership training, we strive to cultivate a new generation of leaders.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do -->
    <section class="section-padding bg-white">
        <div class="container text-center">
            <h2 class="section-title mx-auto">What We Do</h2>
            <p class="text-muted max-w-600 mx-auto mb-5">Engaging youth through diverse initiatives to bridge the gap between people and governance.</p>
            
            <div class="row g-4 text-start">
                <div class="col-md-4">
                    <div class="p-4 border rounded-4 hover-shadow transition-all h-100 border-danger border-opacity-10">
                        <div class="icon-box bg-danger bg-opacity-10 text-red mb-3">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <h4 class="fw-bold">Political Workshops</h4>
                        <p class="text-muted mb-0">Educating the youth on democratic values and the political landscape of Kerala.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded-4 hover-lift transition-all h-100 border-danger border-opacity-10 shadow-sm bg-white">
                        <div class="icon-box bg-danger bg-opacity-10 text-red mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="fw-bold">Leadership Seminars</h4>
                        <p class="text-muted mb-0">Nurturing the next generation of decision-makers through expert-led training sessions.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded-4 hover-lift transition-all h-100 border-danger border-opacity-10 shadow-sm bg-white">
                        <div class="icon-box bg-danger bg-opacity-10 text-red mb-3">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="fw-bold">Social Campaigns</h4>
                        <p class="text-muted mb-0">Active involvement in community service and social justice movements across the state.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- History Highlight (P.J. Joseph) -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="row flex-lg-row-reverse align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <img src="<?= BASE_URL ?>/images/pjjoseph.png" alt="P.J. Joseph" class="img-fluid rounded-circle p-4 bg-light border border-5 border-danger border-opacity-10 shadow">
                </div>
                <div class="col-lg-7">
                    <h6 class="text-red fw-bold text-uppercase mb-2">Our Guiding Light</h6>
                    <h2 class="fw-bold display-5 mb-4">Shri. P.J. Joseph</h2>
                    <p class="lead text-red mb-4">Chairman, Kerala Congress & MLA</p>
                    <p style="text-align: justify; line-height: 1.8;">
                        P. J. Joseph entered Kerala politics through Kerala Congress in 1968. He won his first election from Thodupuzha in 1970 and has since served as a minister and Member of the Legislative Assembly on ten occasions. His vision for the youth is the foundation of KYF's energy.
                    </p>
                    <div class="p-4 bg-light border-start border-danger border-5 rounded-end">
                        <p class="mb-0 italic fw-bold">"The youth are not just the leaders of tomorrow, they are the catalysts of change today."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- History of KYF -->
    <section class="section-padding" style="background: linear-gradient(rgba(211, 47, 47, 0.08), rgba(211, 47, 47, 0.03));">
        <div class="container text-center">
            <h2 class="section-title mx-auto text-red">History of KYF</h2>
            <div class="max-w-800 mx-auto mt-4">
                <p class="fs-5 text-muted mb-4" style="line-height: 1.8;">
                    Founded in 1964 under the visionary leadership of Mathachan Kuruvinakunnel, K. M. George, and others, Kerala Congress has always prioritized youth participation. The Kerala Youth Front (KYF) stands as the powerful youth wing, carrying forward this legacy under the United Democratic Front (UDF).
                </p>
                <div class="row g-4 mt-2">
                    <div class="col-4">
                        <div class="p-3 border-top border-3 border-danger">
                            <h3 class="fw-bold m-0 text-red">1964</h3>
                            <small class="text-muted">Founded</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border-top border-3 border-danger">
                            <h3 class="fw-bold m-0 text-red">1979</h3>
                            <small class="text-muted">KC (Joseph)</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border-top border-3 border-danger">
                            <h3 class="fw-bold m-0 text-red"><?= date('Y') ?></h3>
                            <small class="text-muted">Stronger Than Ever</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="section-padding bg-white" id="gallery">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="section-title mb-0">Gallery</h2>
                    <p class="text-muted mt-3 mb-0">Moments of impact and mobilization across Kerala.</p>
                </div>
            </div>
            <div class="row g-3">
                <?php if (!empty($gallery)): ?>
                    <?php foreach ($gallery as $item): ?>
                    <?php $isVideo = ($item['media_type'] ?? 'image') === 'video' && !empty($item['video_url']); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card p-0 border-0 overflow-hidden shadow-sm h-100">
                            <?php if ($isVideo): ?>
                                <iframe src="<?= htmlspecialchars($item['video_url']) ?>" class="w-100" style="min-height: 250px; border: 0; background: #111827;" title="<?= htmlspecialchars($item['title'] ?: 'KYF video') ?>" allowfullscreen></iframe>
                            <?php else: ?>
                                <img src="<?= BASE_URL ?><?= $item['image_path'] ?>" class="w-100 h-100" style="object-fit: cover; min-height: 250px; transition: 0.5s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php for($i=1; $i<=6; $i++): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card p-0 border-0 overflow-hidden shadow-sm h-100">
                            <img src="<?= BASE_URL ?>/images/gallery_<?= $i ?>.jpeg" class="w-100 h-100" style="object-fit: cover; min-height: 250px; transition: 0.5s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" onerror="this.src="<?= BASE_URL ?>/images/flag_bg.jpg"">
                        </div>
                    </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section class="section-padding bg-light" id="news">
        <div class="container">
            <h2 class="section-title text-center mb-5">News & Events</h2>
            <div class="row g-4">
                <?php if (!empty($news) || !empty($events)): ?>
                    <?php 
                    $combined = array_merge(
                        array_map(function($n) { $n['display_type'] = 'NEWS UPDATE'; return $n; }, $news),
                        array_map(function($e) { $e['display_type'] = 'UPCOMING EVENT'; return $e; }, $events)
                    );
                    usort($combined, function($a, $b) { return strtotime($b['created_at']) - strtotime($a['created_at']); });
                    $combined = array_slice($combined, 0, 3);
                    ?>
                    <?php foreach ($combined as $item): ?>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden border-top border-danger border-4">
                            <?php if ($item['image']): ?>
                                <?php $itemImg = ltrim($item['image'], '/'); ?>
                                <img src="<?= BASE_URL . '/' . $itemImg ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?= BASE_URL ?>/images/flag_bg.jpg" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <span class="text-red small fw-bold mb-2 d-block text-uppercase"><?= $item['display_type'] ?></span>
                                <h5 class="fw-bold mb-3"><?= htmlspecialchars($item['title']) ?></h5>
                                <p class="text-muted small"><?= substr(strip_tags($item['body']), 0, 120) ?>...</p>
                                <a href="#" class="text-decoration-none fw-bold small text-red">Read More <i class="fas fa-chevron-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php for($i=1; $i<=3; $i++): ?>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden border-top border-danger border-4">
                            <img src="<?= BASE_URL ?>/images/event_<?= $i ?>.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;" onerror="this.src="<?= BASE_URL ?>/images/flag_bg.jpg"">
                            <div class="card-body p-4">
                                <span class="text-red small fw-bold mb-2 d-block">EVENT UPDATE</span>
                                <h5 class="fw-bold mb-3">KYF Regional Connect - Zone <?= $i ?></h5>
                                <p class="text-muted small">Mobilizing hundreds of youth volunteers for the upcoming community service campaign in Central Kerala.</p>
                                <a href="#" class="text-decoration-none fw-bold small text-red">Read More <i class="fas fa-chevron-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact Form Section (Duplicated from Contact page) -->
    <section class="section-padding bg-white" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="form-card p-5 shadow-lg rounded-4 border-top border-5 border-danger">
                        <div class="row g-5">
                            <div class="col-md-5">
                                <h2 class="fw-bold mb-4 text-red">Connect with KYF</h2>
                                <p class="text-muted mb-5">Join the movement. If you have questions or want to be part of our upcoming events, send us a message.</p>
                                
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-red me-3">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Phone / WhatsApp</h6>
                                        <p class="text-muted mb-0">+91 9447355775</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-red me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Email</h6>
                                        <p class="text-muted mb-0">info@keralacongress.org.in</p>
                                    </div>
                                </div>
                                
                                <a href="<?= BASE_URL ?>/join" class="btn btn-danger d-block mt-5 py-3 fw-bold rounded-pill">Become a KYF Member</a>
                            </div>

                            <div class="col-md-7 border-start ps-md-5">
                                <h4 class="fw-bold mb-4">Quick Message</h4>
                                <form action="<?= BASE_URL ?>/contact/store" method="POST">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control shadow-none" name="name" required placeholder="Enter your full name">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control shadow-none" name="email" placeholder="example@email.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control shadow-none" name="mobile" required placeholder="10-digit mobile number">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Select District <span class="text-danger">*</span></label>
                                            <select class="form-select shadow-none" name="district_id" required>
                                                <option value="" disabled selected>Choose your district</option>
                                                <?php foreach ($districts as $d): ?>
                                                    <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Message <span class="text-danger">*</span></label>
                                            <textarea class="form-control shadow-none" name="message" rows="4" required placeholder="Your message to KYF leadership..."></textarea>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-danger w-100 py-3 fw-bold rounded-pill shadow">
                                                <i class="fas fa-paper-plane me-2"></i> Send Message
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .icon-box {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 24px;
        }
        .hover-shadow:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
            transform: translateY(-5px);
        }
        .transition-all { transition: all 0.3s ease; }
        .form-control:focus, .form-select:focus {
            border-color: #d32f2f;
            box-shadow: 0 0 0 0.25rem rgba(211, 47, 47, 0.1);
        }
    </style>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
