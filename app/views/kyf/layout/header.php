<?php $pageTitle = $pageTitle ?? 'Kerala Youth Front (KYF)'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
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
            position: sticky;
            top: 0;
            z-index: 1000;
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
        .btn-join-kyf {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff !important;
            border-radius: 50px;
            padding: 8px 25px;
            font-weight: 600;
            border: none;
            box-shadow: 0 4px 10px rgba(211, 47, 47, 0.3);
            text-transform: uppercase;
        }
        
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
        .section-title.text-center::after {
            left: 50%;
            transform: translateX(-50%);
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(211, 47, 47, 0.15) !important;
        }

        @media (max-width: 991.98px) {
            .navbar-custom { 
                padding: 10px 0; 
                background: linear-gradient(to right, #ffffff, #fff5f5) !important;
                border-bottom: 2px solid var(--primary);
            }
            .navbar-collapse { background: #fff; padding: 20px; border-radius: 15px; margin-top: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
            .nav-link { margin: 5px 0; padding: 10px; border-radius: 8px; }
            .btn-join-kyf { width: 100%; text-align: center; padding: 10px; font-size: 0.9rem; }
            .btn-lg { padding: 10px 20px !important; font-size: 0.95rem !important; }
            .btn { padding: 8px 16px; font-size: 0.85rem; }
        }
        @media (max-width: 768px) {
            .navbar-brand { width: auto; justify-content: flex-start; }
            .navbar-toggler { padding: 4px 8px; }
            .navbar-brand span { font-size: 1rem; }
            .navbar-brand img { max-height: 35px; }
        }
    </style>
</head>
<script>const BASE_URL = '<?= BASE_URL ?>';</script>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>/">
                <img src="<?= BASE_URL ?>/images/logo_kyf.svg" alt="KYF Logo">
                <span>Kerala Youth Front</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/">Main Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#vision">Vision</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">News & Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn-join-kyf ms-lg-3" href="<?= BASE_URL ?>/join">Join KYF</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
