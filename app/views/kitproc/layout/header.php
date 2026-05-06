<?php $pageTitle = $pageTitle ?? 'Kerala IT and Professional Congress (KITPROC)'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #d32f2f; /* KC Red */
            --tech-blue: #0f172a; /* Slate/Dark blue for professional feel */
            --accent: #3b82f6; /* Professional blue */
            --light: #f8fafc;
            --dark: #1e293b;
        }
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            color: #334155;
            background-color: #fff;
            overflow-x: hidden;
        }
        /* Navbar */
        .navbar-kitproc {
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: 800;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            max-height: 55px;
            margin-right: 12px;
        }
        .navbar-brand span {
            color: var(--tech-blue);
            font-size: 1.2rem;
            line-height: 1.2;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 600;
            color: var(--tech-blue) !important;
            margin: 0 12px;
            font-size: 0.9rem;
            transition: 0.3s;
            text-transform: uppercase;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }
        .btn-action {
            background: var(--primary);
            color: #fff !important;
            border-radius: 6px;
            padding: 10px 24px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        .btn-action:hover {
            background: var(--tech-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .section-padding { padding: 90px 0; }
        .bg-tech { background-color: var(--tech-blue); color: white; }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 { font-weight: 800; color: var(--tech-blue); }
        .text-kc { color: var(--primary); }

        @media (max-width: 991.98px) {
            .navbar-kitproc { 
                background: linear-gradient(to right, #ffffff, #f0f4f8) !important;
                border-bottom: 2px solid var(--accent);
                padding: 10px 0;
            }
            .navbar-collapse { background: #fff; padding: 20px; border-radius: 12px; margin-top: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
            .nav-link { margin: 5px 0; padding: 10px; border-radius: 6px; }
            .btn-action { width: 100%; text-align: center; padding: 10px; font-size: 0.9rem; }
            .btn-lg { padding: 10px 20px !important; font-size: 0.95rem !important; }
            .btn { padding: 8px 16px; font-size: 0.85rem; }
        }
        @media (max-width: 768px) {
            .navbar-brand { width: auto; justify-content: flex-start; margin-bottom: 0; }
            .navbar-toggler { padding: 4px 8px; }
            .navbar-brand span { font-size: 0.9rem; }
            .navbar-brand img { max-height: 40px; }
        }
    </style>
    <script>const BASE_URL = '<?= BASE_URL ?>';</script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-kitproc">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>/kitproc">
                <img src="<?= BASE_URL ?>/assets/images/kitproc/kitproc logo.svg" alt="KITPROC Logo">
                <span class="d-inline-block">Kerala IT & <br>Professional Congress</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navKitproc">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navKitproc">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/">Main Site</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/kitproc">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/kitproc/about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/kitproc/news">News</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn-action" href="<?= BASE_URL ?>/join">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
