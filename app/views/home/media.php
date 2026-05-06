<?php 
$pageTitle = 'Media Gallery - Kerala Congress'; 
require_once __DIR__ . '/../layout/header.php'; 
?>
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <style>
        :root {
            --kc-red: #d32f2f;
            --kc-dark: #1a1a1a;
        }

        .media-hero {
            background: linear-gradient(135deg, #d32f2f 0%, #1e293b 100%);
            padding: 100px 0 120px;
            position: relative;
            overflow: hidden;
        }

        .media-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.6;
        }

        .media-hero h1 {
            font-size: 3.5rem;
            letter-spacing: -1px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .filter-container {
            margin-top: -40px;
            position: relative;
            z-index: 10;
        }

        .glass-filter {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: inline-flex;
            padding: 8px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .filter-btn {
            border: none;
            background: transparent;
            padding: 10px 25px;
            border-radius: 40px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #475569;
        }

        .filter-btn.active {
            background: var(--kc-red);
            color: white;
            box-shadow: 0 4px 15px rgba(211, 47, 47, 0.3);
        }

        .gallery-card {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            background: white;
        }

        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .img-wrapper {
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .img-wrapper iframe {
            width: 100%;
            height: 100%;
            border: 0;
            background: #111827;
        }

        .gallery-card:hover .img-wrapper img {
            transform: scale(1.1);
        }

        .item-overlay {
            position: absolute;
            inset: 0;
            background: rgba(211, 47, 47, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-card:hover .item-overlay {
            opacity: 1;
        }

        .zoom-icon {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--kc-red);
            font-size: 1.5rem;
            transform: scale(0.5);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .gallery-card:hover .zoom-icon {
            transform: scale(1);
        }

        .gallery-item {
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .section-padding { padding: 100px 0; }
        
        .empty-state {
            padding: 80px 0;
            text-align: center;
            background: #f8fafc;
            border-radius: 30px;
            border: 2px dashed #e2e8f0;
        }
    </style>

    <div class="media-hero text-white text-center">
        <div class="container position-relative z-1">
            <h1 class="fw-bold mb-3 animate-up">Media Gallery</h1>
            <p class="lead mb-0 text-white-50 mx-auto" style="max-width: 600px;">Explore the visuals of our journey. Capturing moments of political reform, grassroots engagement, and leadership across Kerala.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-container text-center">
        <div class="container">
            <div class="glass-filter animate-up" style="animation-delay: 0.1s;">
                <button class="filter-btn active" data-filter="all">All Items</button>
                <button class="filter-btn" data-filter="photos">Photography</button>
                <button class="filter-btn" data-filter="videos">Video Gallery</button>
            </div>
        </div>
    </div>

    <div class="section-padding bg-white">
        <div class="container">
            <div class="row g-4 gallery-grid" id="galleryGrid">
                <?php if (!empty($gallery)): ?>
                    <?php foreach ($gallery as $item): 
                        $isVideo = ($item['media_type'] ?? 'image') === 'video' && !empty($item['video_url']);
                        $imagePath = BASE_URL . "/" . ltrim(($item['image_path'] ?? $item['image']), '/');
                    ?>
                    <div class="col-lg-4 col-md-6 gallery-item <?= $isVideo ? 'videos' : 'photos' ?>">
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <?php if ($isVideo): ?>
                                    <iframe src="<?= htmlspecialchars($item['video_url']) ?>" title="<?= htmlspecialchars($item['title'] ?: 'Kerala Congress video') ?>" allowfullscreen></iframe>
                                <?php else: ?>
                                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                                    <a href="<?= $imagePath ?>" class="glightbox item-overlay" data-gallery="gallery1" data-title="<?= htmlspecialchars($item['title']) ?>">
                                        <div class="zoom-icon">
                                            <i class="fas fa-expand-alt"></i>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <span class="badge <?= $isVideo ? 'bg-danger text-white' : 'bg-light text-primary border' ?> mb-2" style="font-size: 0.7rem;"><?= $isVideo ? 'VIDEO' : 'KERALA CONGRESS' ?></span>
                                <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($item['title'] ?: 'Political Event') ?></h5>
                                <p class="text-muted small mb-0"><i class="far fa-calendar-alt me-2 text-danger"></i> <?= date('F d, Y', strtotime($item['created_at'])) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="far fa-images fa-4x text-muted mb-4"></i>
                            <h4 class="fw-bold text-dark">No Media Found</h4>
                            <p class="text-muted">Our gallery is currently being curated. Check back soon for new updates.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lightbox
            const lightbox = GLightbox({
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });

            // Filtering Logic
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Update Active UI
                    filterBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const filter = btn.getAttribute('data-filter');

                    galleryItems.forEach(item => {
                        item.style.transition = 'all 0.4s ease';
                        
                        if (filter === 'all') {
                            item.classList.remove('d-none');
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 10);
                        } else if (item.classList.contains(filter)) {
                            item.classList.remove('d-none');
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 10);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                item.classList.add('d-none');
                            }, 400);
                        }
                    });
                });
            });

            // Reveal animations
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.gallery-item').forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(30px)';
                item.style.transition = 'all 0.6s ease-out';
                observer.observe(item);
            });
        });
    </script>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
