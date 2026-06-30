<?php
$pageTitle = 'Edit Application Request';
require_once __DIR__ . '/../layout/header.php';
?>

    <div class="header-bg">
        <div class="container">
            <h1 class="fw-bold mb-3">Edit Submitted Application</h1>
            <p class="lead mb-0 text-white-50">Search your application and request the details that need to be updated.</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="form-card">
                    <?php if(isset($message)): ?>
                        <div class="alert <?= strpos($message, 'Error') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show mb-4" role="alert">
                            <strong><i class="fas <?= strpos($message, 'Error') !== false ? 'fa-exclamation-triangle' : 'fa-check-circle' ?> me-2"></i></strong> <?= htmlspecialchars($message) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>/join/edit" method="GET" class="mb-4">
                        <div class="section-divider">Find Application</div>
                        <label class="form-label">Mobile Number or Email</label>
                        <div class="row g-2">
                            <div class="col-md">
                                <input type="text" class="form-control" name="identifier" value="<?= htmlspecialchars($identifier ?? '') ?>" placeholder="Enter registered mobile number or email" required>
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-primary h-100 px-4">
                                    <i class="fas fa-search me-2"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <?php if (!empty($member)): ?>
                        <div class="alert alert-light border mb-4">
                            <div class="fw-bold"><?= htmlspecialchars(trim(($member['fname'] ?? '') . ' ' . ($member['lname'] ?? ''))) ?></div>
                            <div class="small text-muted">
                                Reg No: #<?= htmlspecialchars($member['reg_no'] ?? '') ?> ·
                                District: <?= htmlspecialchars($member['district_name'] ?? $member['district'] ?? 'N/A') ?>
                            </div>
                        </div>

                        <form action="<?= BASE_URL ?>/join/edit/request" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="identifier" value="<?= htmlspecialchars($identifier ?? '') ?>">

                            <div class="section-divider">Update Request</div>
                            <div class="mb-3">
                                <label class="form-label">Details to be Updated</label>
                                <textarea class="form-control" name="requested_changes" rows="6" placeholder="Example: Please update my address to..., change my ward to..., correct my name spelling to..."></textarea>
                                <div class="form-text mt-2">Mention both the existing detail and the new detail wherever possible.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Upload New Photo Optional</label>
                                <input type="file" class="form-control" name="photo" accept="image/jpeg, image/png">
                                <div class="form-text mt-2">JPG or PNG only, maximum 2MB.</div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i> Submit Update Request
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
