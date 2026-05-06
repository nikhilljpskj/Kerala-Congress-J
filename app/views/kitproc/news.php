<?php 
$pageTitle = 'News & Updates - KITPROC'; 
require_once __DIR__ . '/layout/header.php'; 
?>

    <!-- Page Header -->
    <header class="section-padding bg-tech text-white">
        <div class="container">
            <h1 class="display-4 fw-bold text-white">News & Updates</h1>
            <p class="lead opacity-75">Stay informed with the latest developments from Kerala IT and Professional Congress.</p>
        </div>
    </header>

    <section class="section-padding bg-white">
        <div class="container">
            <div class="row g-4">
                <?php 
                $combined = array_merge(
                    array_map(function($n) { $n['display_type'] = 'NEWS'; return $n; }, $news ?? []),
                    array_map(function($u) { $u['display_type'] = 'UPDATE'; return $u; }, $updates ?? [])
                );
                usort($combined, function($a, $b) { return strtotime($b['created_at']) - strtotime($a['created_at']); });
                ?>

                <?php if (!empty($combined)): ?>
                    <?php foreach ($combined as $item): ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 border-top <?= $item['display_type'] == 'NEWS' ? 'border-primary' : 'border-tech' ?> border-4">
                            <?php if ($item['image']): ?>
                                <?php $itemImg = ltrim(($item['image_path'] ?? $item['image'] ?? ''), '/'); ?>
                                <img src="<?= BASE_URL . '/' . $itemImg ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
                            <?php else: ?>
                                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="height: 220px; background: #f8fafc;">
                                    <img src="<?= BASE_URL ?>/images/logo_kc.svg" style="width: 80px; opacity: 0.1;">
                                </div>
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <span class="badge bg-light text-muted tiny mb-2"><?= $item['display_type'] ?></span>
                                <h5 class="fw-bold mb-3"><?= htmlspecialchars($item['title']) ?></h5>
                                <p class="text-muted small"><?= substr(strip_tags($item['body']), 0, 120) ?>...</p>
                                <a href="#" class="text-kc fw-bold small text-decoration-none">READ MORE <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 border-top border-primary border-4">
                            <img src="<?= BASE_URL ?>/assets/images/kitproc/in-chandy.jpeg" class="card-img-top" style="height: 220px; object-fit: cover;" onerror="this.src='<?= BASE_URL ?>/images/flag_bg.jpg'">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">Inconversation with Chandy Ommen</h5>
                                <p class="text-muted small">Mobilizing professionals through shared vision and collective action.</p>
                                <a href="#" class="text-kc fw-bold small text-decoration-none">READ MORE <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <?php for($i=1; $i<=2; $i++): ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 border-top border-tech border-4 opacity-75">
                            <div class="card-body p-4 d-flex align-items-center justify-content-center" style="height: 220px; background: #f8fafc;">
                                <h4 class="text-muted fw-bold">Professional Insights</h4>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">Empowerment Series - Workshop <?= $i ?></h5>
                                <p class="text-muted small">Stay tuned for more updates on our upcoming professional events.</p>
                                <a href="#" class="text-kc fw-bold small text-decoration-none">COMING SOON <i class="fas fa-lock ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php require_once __DIR__ . '/layout/footer.php'; ?>
