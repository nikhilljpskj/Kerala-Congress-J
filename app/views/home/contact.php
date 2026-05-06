<?php 
$pageTitle = 'Contact Us - Kerala Congress'; 
require_once __DIR__ . '/../layout/header.php'; 
?>
    <div class="header-bg">
        <div class="container">
            <h1 class="fw-bold mb-3">Contact Us</h1>
            <p class="lead mb-0 text-white-50">Have a question or inquiry? Reach out to us through the form below.</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-card">
                    <?php if(isset($message)): ?>
                        <div class="alert <?= strpos($message, 'Error') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show mb-4" role="alert">
                            <strong><i class="fas <?= strpos($message, 'Error') !== false ? 'fa-exclamation-triangle' : 'fa-check-circle' ?> me-2"></i></strong> <?= htmlspecialchars($message) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row g-5">
                        <div class="col-md-5">
                            <h4 class="fw-bold mb-4">Get in Touch</h4>
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary me-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Address</h6>
                                    <p class="text-muted mb-0">State Committee Office, Kottayam, Kerala</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary me-3">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Phone</h6>
                                    <p class="text-muted mb-0">+91 9447355775</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success me-3">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">WhatsApp</h6>
                                    <p class="text-muted mb-0">9447355775</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary me-3">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Email</h6>
                                    <p class="text-muted mb-0"><a href="mailto:info@keralacongress.org.in" class="text-muted text-decoration-none">info@keralacongress.org.in</a></p>
                                </div>
                            </div>

                            <hr class="my-4">
                            
                            <h5 class="fw-bold mb-3">Connect With Us</h5>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn btn-outline-info rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>

                        <div class="col-md-7 border-start ps-md-5">
                            <h4 class="fw-bold mb-4">Send Inquiry</h4>
                            <form action="<?= BASE_URL ?>/contact/store" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" required placeholder="Enter your full name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" placeholder="example@email.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" name="mobile" required placeholder="10-digit mobile number">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Select District <span class="text-danger">*</span></label>
                                        <select class="form-select" name="district_id" required>
                                            <option value="" disabled selected>Choose your district</option>
                                            <?php foreach ($districts as $d): ?>
                                                <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="message" rows="4" required placeholder="How can we help you?"></textarea>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn-submit">
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
<?php require_once __DIR__ . '/../layout/footer.php'; ?>
