<?php $pageTitle = $pageTitle ?? 'Kerala Congress - Working for the People'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script>const BASE_URL = '<?= BASE_URL ?>';</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #d32f2f; /* Deep Red */
            --primary-dark: #b71c1c; /* Darker Red */
            --secondary: #ff5252; /* Lighter Red/Accent */
            --dark: #1e293b;
            --light: #f8fafc;
        }
        body {
            font-family: 'Poppins', 'Mukta', sans-serif;
            color: #334155;
            background-color: var(--light);
            overflow-x: hidden;
        }
        /* Navbar */
        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        .navbar-brand {
            font-weight: 800;
            color: var(--primary) !important;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            max-height: 50px;
            margin-right: 10px;
        }
        .nav-link {
            font-weight: 600;
            color: var(--dark) !important;
            margin: 0 10px;
            text-transform: uppercase;
            font-size: 0.9rem;
            transition: 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }
        .btn-join {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff !important;
            border-radius: 50px;
            padding: 8px 25px;
            font-weight: 600;
            border: none;
            box-shadow: 0 4px 10px rgba(14, 165, 164, 0.3);
            text-transform: uppercase;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(30, 41, 59, 0.9), rgba(30, 41, 59, 0.8)), url("<?= BASE_URL ?>/images/flag_bg.jpg") center/cover;
            padding: 120px 0 100px;
            color: #fff;
            position: relative;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 40px;
            color: #e2e8f0;
        }
        
        /* Sections */
        .section-padding { padding: 80px 0; }
        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 15px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        .text-center .section-title::after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        /* Cards */
        .feature-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: 0.3s transform;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.02);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }
        .feature-icon {
            width: 70px;
            height: 70px;
            background: rgba(211, 47, 47, 0.1);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 25px;
        }
        
        /* Leadership */
        .leader-img {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            display: block;
            margin: 0 auto;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: #f8fafc;
            padding: 70px 0 30px;
        }
        .footer-heading {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .social-btn {
            display: inline-flex;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            color: #fff;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
            transition: 0.3s;
            text-decoration: none;
        }
        .social-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        /* Floating Contact */
        .floating-contact {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .float-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 26px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            text-decoration: none;
            transition: transform 0.2s;
        }
        .float-btn:hover {
            transform: scale(1.1);
            color: white;
        }
        .bg-whatsapp { background-color: #25D366; }
        .bg-phone { background-color: var(--primary); }

        /* Floating right side tags (from old design) */
        .rside-tag { position: fixed; right: 0; top: 30%; z-index: 1040; display: flex; flex-direction: column; gap: 10px; }
        .rside-tag-item { background: #fff; padding: 10px; border-radius: 50px 0 0 50px; box-shadow: -5px 5px 15px rgba(0,0,0,0.1); display: flex; align-items: center; border-right: 4px solid var(--primary); transition: 0.3s; transform: translateX(calc(100% - 70px)); }
        .rside-tag-item:hover { transform: translateX(0); }
        .rside-avtar { display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; background: #f1f5f9; border-radius: 50%; padding: 2px; }
        .rside-avtar img { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-left: -20px; }
        .rside-avtar img:first-child { margin-left: 0; position: relative; z-index: 2; }
        .rside-link-area { padding-left: 15px; padding-right: 20px; white-space: nowrap; }
        .rside-link { color: var(--dark); text-decoration: none; font-weight: 600; font-size: 0.9rem; }
        .rside-link:hover { color: var(--primary); }
        
        .hero-carousel .carousel-item { height: 80vh; min-height: 600px; background: #000; position: relative; }
        .hero-carousel .carousel-item::before { content: ''; position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(rgba(30, 41, 59, 0.7), rgba(183, 28, 28, 0.7)); z-index: 1; }
        .hero-carousel .carousel-item img { width: 100%; height: 100%; object-fit: cover; opacity: 0.8; }
        .hero-carousel .carousel-caption { bottom: 20%; z-index: 2; text-align: left; left: 10%; right: 10%; padding: 0; }
        /* Add CSS rules for Contact page elements (previously in contact.php) */
        .contact-card {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }
        .hero-title { font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 20px; text-shadow: 0 2px 10px rgba(0,0,0,0.5); }
        .hero-subtitle { font-size: 1.2rem; font-weight: 300; margin-bottom: 40px; color: #f8fafc; text-shadow: 0 2px 5px rgba(0,0,0,0.5); max-width: 600px;}
        
        @media (max-width: 991.98px) {
            .navbar-custom { 
                padding: 10px 0; 
                background: linear-gradient(to right, #ffffff, #fff5f5) !important;
                border-bottom: 2px solid var(--primary);
            }
            .nav-link { margin: 5px 0; padding: 10px 15px; border-radius: 8px; }
            .nav-link:hover { background: rgba(211, 47, 47, 0.05); }
            .btn-join { width: 100%; text-align: center; margin-top: 10px; padding: 10px; font-size: 0.9rem; }
            .navbar-collapse { background: #fff; padding: 20px; border-radius: 15px; margin-top: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
            .navbar-brand span { font-size: 1.1rem; }
            .btn-lg { padding: 10px 20px !important; font-size: 0.95rem !important; }
            .btn { padding: 8px 16px; font-size: 0.85rem; }
            .btn-submit { padding: 10px; font-size: 0.95rem; width: 100%; }
        }

        @media (max-width: 768px) {
            .navbar-brand { width: auto; justify-content: flex-start; margin-right: 0; margin-bottom: 0; }
            .navbar-toggler { padding: 4px 8px; font-size: 1rem; }
            .hero-title { font-size: 2rem; }
            .hero-section { padding: 60px 0 40px; text-align: center;}
            .section-title::after { left: 50%; transform: translateX(-50%); }
            .section-title { text-align: center; font-size: 1.6rem; }
            .section-padding { padding: 40px 0; }
            .navbar-brand img { max-height: 35px; }
            .navbar-brand { font-size: 1.1rem; }
        }

        @media (max-width: 576px) {
            .hero-title { font-size: 1.8rem; }
            .hero-subtitle { font-size: 1rem; }
            .display-1 { font-size: 2.5rem; }
            .display-2 { font-size: 2.2rem; }
            .display-3 { font-size: 2rem; }
            .container { padding-left: 20px; padding-right: 20px; }
        }

        /* Specific CSS for Join Page */
        .header-bg {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            padding: 60px 0 100px;
            color: white;
            text-align: center;
        }
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            margin-top: -60px;
            margin-bottom: 60px;
            border: 1px solid rgba(0,0,0,0.02);
        }
        @media (max-width: 768px) {
            .form-card { padding: 25px; margin-top: -30px; margin-bottom: 30px; }
            .header-bg { padding: 40px 0 60px; }
            .border-start { border-start: 0 !important; border-top: 1px solid #dee2e6 !important; padding-top: 30px !important; margin-top: 20px !important; padding-left: 0 !important; }
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 164, 0.25);
            background-color: #fff;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 8px;
        }
        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            box-shadow: 0 4px 15px rgba(14, 165, 164, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 164, 0.4);
            color: white;
        }
        .section-divider {
            display: flex;
            align-items: center;
            color: #94a3b8;
            margin: 30px 0 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }
        .section-divider::before, .section-divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        .section-divider::before { margin-right: 15px; }
        .section-divider::after { margin-left: 15px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>/">
                <img src="<?= BASE_URL ?>/images/logo_kc.svg" alt="Kerala Congress Logo">
                <span class="d-inline-block">KERALA CONGRESS</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <i class="fas fa-bars fa-lg text-dark"></i>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="<?= BASE_URL ?>/">Home</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/#leadership">Leadership</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/#history">History</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/#mission">Mission</a></li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="orgDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Organizations
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="orgDropdown">
                            <li><a class="dropdown-item py-2" href="<?= BASE_URL ?>/youthfront">Kerala Youth Front (KYF)</a></li>
                            <li><a class="dropdown-item py-2" href="<?= BASE_URL ?>/kitproc">Kerala IT & Professional Congress (KITPROC)</a></li>
                            <li><a class="dropdown-item py-2" href="#">Kerala Student Congress (KSC)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2 fw-bold text-primary" href="<?= BASE_URL ?>/organizations">View All Frontal Organizations</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/media">Media</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/contact">Contact Us</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="nav-link btn-join" href="<?= BASE_URL ?>/join">Join The Party</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Floating Right Side Tags (Old Design Restored) -->
    <div class="rside-tag d-none d-md-flex">
        <div class="rside-tag-item">
            <div class="rside-avtar">
                <img src="<?= BASE_URL ?>/images/apu.jpg" alt="Apu" onerror="this.src='<?= BASE_URL ?>/images/logo_kc.svg'">
                <img src="<?= BASE_URL ?>/images/jais.jpg" alt="Jais" onerror="this.src='<?= BASE_URL ?>/images/logo_kc.svg'">
            </div>
            <div class="rside-link-area">
                <a class="rside-link" href="<?= BASE_URL ?>/kitproc">Kerala IT &<br>Professional Congress</a>
            </div>
        </div>
        <div class="rside-tag-item">
            <div class="rside-avtar">
                <img src="<?= BASE_URL ?>/images/ajith.jpg" alt="Ajith" onerror="this.src='<?= BASE_URL ?>/images/logo_kc.svg'">
                <img src="<?= BASE_URL ?>/images/kannan.jpg" alt="Kannan" onerror="this.src='<?= BASE_URL ?>/images/logo_kc.svg'">
            </div>
            <div class="rside-link-area">
                <a class="rside-link" href="<?= BASE_URL ?>/youthfront">Kerala Youth<br>Front</a>
            </div>
        </div>
    </div>
