<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_name = $_SESSION['user_name'] ?? 'Admin';
$roles = $_SESSION['roles'] ?? [];
$permissions = $_SESSION['permissions'] ?? [];

function can($perm, $roles, $permissions) {
    if (in_array('super_admin', $roles)) return true;
    return in_array($perm, $permissions);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kerala Congress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #c62828;
            --primary-dark: #8e1b1b;
            --sidebar-bg: #111827;
            --accent: #2563eb;
            --light-bg: #f5f7fb;
            --surface: #ffffff;
            --border: #e5e7eb;
            --muted: #64748b;
            --text: #172033;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --shadow-sm: 0 1px 2px rgba(15, 23, 42, 0.06);
            --shadow-md: 0 12px 28px rgba(15, 23, 42, 0.08);
        }
        * { box-sizing: border-box; }
        html { min-width: 320px; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            overflow-x: hidden;
            color: var(--text);
            font-size: 15px;
        }
        
        /* Sidebar */
        .sidebar { 
            min-height: 100vh; 
            background: var(--sidebar-bg);
            background-image: linear-gradient(180deg, rgba(198, 40, 40, 0.14), transparent 36%);
            color: #fff; 
            padding-top: 24px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
            width: 264px;
            z-index: 1000;
            box-shadow: 10px 0 30px rgba(0,0,0,0.12);
        }
        .sidebar-brand {
            padding: 0 22px 24px;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 18px;
        }
        .sidebar a { 
            color: #94a3b8; 
            text-decoration: none; 
            display: flex;
            align-items: center;
            padding: 13px 18px;
            border-radius: 8px;
            margin: 0 14px 7px;
            transition: 0.3s;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .sidebar a:hover { 
            background: var(--glass);
            color: #fff; 
            transform: translateX(5px);
        }
        .sidebar a.active { 
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff; 
            box-shadow: 0 10px 20px rgba(198, 40, 40, 0.24);
            font-weight: 600;
        }
        .sidebar i { 
            width: 25px; 
            font-size: 1.1rem;
            margin-right: 15px; 
            transition: 0.3s;
        }
        .sidebar a.active i { transform: scale(1.1); color: #fff; }
        
        /* Main Content */
        .main-container { flex-grow: 1; min-width: 0; overflow-y: auto; height: 100vh; }
        .navbar { 
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-sm);
            padding: 14px clamp(16px, 3vw, 36px);
            z-index: 10; 
            position: sticky; 
            top: 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .navbar > div { min-width: 0; }
        .navbar h5 { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .main-content { padding: clamp(16px, 3vw, 36px); }
        
        /* Generic Modern Classes */
        .card { 
            border: none; 
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            transition: 0.3s;
        }
        .card:hover { box-shadow: var(--shadow-md); }
        .btn { border-radius: 8px; min-height: 38px; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; }
        .btn-sm { min-height: 32px; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border: none; padding: 10px 18px; font-weight: 600; transition: 0.3s; }
        .btn-primary:hover { box-shadow: 0 5px 15px rgba(198, 40, 40, 0.22); filter: brightness(1.06); }
        .form-control,
        .form-select { border-radius: 8px; min-height: 42px; }
        .badge { font-weight: 650; }
        .admin-page-header,
        .admin-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .admin-page-header > div,
        .admin-toolbar > div { min-width: 0; }
        .admin-page-header h5,
        .admin-toolbar h5 { overflow-wrap: anywhere; }
        .admin-actions,
        .admin-filters {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .admin-filters > * { flex: 1 1 160px; min-width: 0; }
        .table-responsive {
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #fff;
        }
        .table {
            margin-bottom: 0;
            --bs-table-hover-bg: #f8fafc;
        }
        .table thead th {
            border-bottom: 1px solid var(--border);
            color: #475569;
            font-size: 0.76rem;
            letter-spacing: 0;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .table td,
        .table th {
            padding: 0.95rem;
            vertical-align: middle;
        }
        .table td { overflow-wrap: anywhere; }
        .btn-group { flex-wrap: nowrap; }
        .btn-group .btn {
            width: 34px;
            padding-left: 0;
            padding-right: 0;
        }
        .stat-card {
            min-height: 150px;
            border: 1px solid rgba(255,255,255,0.15);
        }
        .chart-panel { min-height: 430px; }
        .chart-frame { height: clamp(260px, 36vw, 350px); }
        .modal-dialog { margin-left: auto; margin-right: auto; max-width: min(96vw, var(--bs-modal-width)); }
        .modal-content { border-radius: 8px !important; }
        
        @media (max-width: 991.98px) {
            .sidebar { position: fixed; left: -264px; height: 100vh; overflow-y: auto; }
            .sidebar.show { left: 0; }
            .sidebar-overlay { 
                display: none; 
                position: fixed; 
                top: 0; 
                left: 0; 
                width: 100vw; 
                height: 100vh; 
                background: rgba(0,0,0,0.4); 
                backdrop-filter: blur(4px);
                z-index: 999; 
            }
            .sidebar-overlay.show { display: block; }
            .main-container { width: 100%; }
            .navbar { padding: 12px 16px; }
        }

        @media (max-width: 767.98px) {
            body { font-size: 14px; }
            .main-content { padding: 14px; }
            .card { padding: 1rem !important; }
            .admin-page-header,
            .admin-toolbar,
            .admin-actions,
            .admin-filters {
                align-items: stretch;
                flex-direction: column;
                width: 100%;
            }
            .admin-page-header .btn,
            .admin-toolbar .btn,
            .admin-actions .btn,
            .admin-filters .btn,
            .admin-filters .form-control,
            .admin-filters .form-select {
                width: 100% !important;
            }
            .table-responsive.mobile-cards {
                border: 0;
                background: transparent;
                overflow: visible;
            }
            .mobile-cards table,
            .mobile-cards thead,
            .mobile-cards tbody,
            .mobile-cards tr,
            .mobile-cards th,
            .mobile-cards td {
                display: block;
                width: 100%;
            }
            .mobile-cards thead { display: none; }
            .mobile-cards tr {
                border: 1px solid var(--border);
                border-radius: 8px;
                background: #fff;
                margin-bottom: 12px;
                padding: 12px;
                box-shadow: var(--shadow-sm);
            }
            .mobile-cards td {
                border: 0;
                padding: 8px 0;
            }
            .mobile-cards td::before {
                content: attr(data-label);
                display: block;
                color: var(--muted);
                font-size: 0.72rem;
                font-weight: 700;
                text-transform: uppercase;
                margin-bottom: 3px;
            }
            .mobile-cards td[colspan]::before { display: none; }
            .mobile-cards td[data-label="Actions"]::before { margin-bottom: 8px; }
            .mobile-cards td.text-end { text-align: left !important; }
            .mobile-cards .btn-group,
            .mobile-cards td[data-label="Actions"] {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }
            .mobile-cards .btn-group .btn,
            .mobile-cards td[data-label="Actions"] > .btn,
            .mobile-cards td[data-label="Actions"] > a {
                width: 40px;
                height: 38px;
            }
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
                gap: 6px;
            }
            .pagination .page-link { margin: 0 !important; }
            .modal-dialog { width: calc(100vw - 20px); margin: 10px auto; }
            .modal-body { padding: 1rem !important; }
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0" id="sidebar">
            <div class="sidebar-brand text-center">
                <h4 class="text-white fw-bold m-0" style="letter-spacing: 2px;">KC ADMIN</h4>
                <div class="small text-muted mt-1 text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 1px;">Control Panel</div>
            </div>
            
            <?php $current_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>
            
            <a href="<?= BASE_URL ?>/admin/dashboard" class="<?= strpos($current_uri, 'dashboard') !== false ? 'active' : '' ?>"><i class="fas fa-th-large"></i> Dashboard</a>
            
            <?php if (can('manage_members', $roles, $permissions)): ?>
                <a href="<?= BASE_URL ?>/admin/members" class="<?= strpos($current_uri, 'members') !== false ? 'active' : '' ?>"><i class="fas fa-user-plus"></i> Members</a>
                <a href="<?= BASE_URL ?>/admin/contacts" class="<?= strpos($current_uri, 'contacts') !== false ? 'active' : '' ?>"><i class="fas fa-comment-dots"></i> Inquiries</a>
            <?php endif; ?>

            <?php if (can('manage_content', $roles, $permissions)): ?>
                <a href="<?= BASE_URL ?>/admin/content" class="<?= strpos($current_uri, 'admin/content') !== false ? 'active' : '' ?>"><i class="fas fa-edit"></i> Content</a>
                <a href="<?= BASE_URL ?>/admin/gallery" class="<?= strpos($current_uri, 'admin/gallery') !== false ? 'active' : '' ?>"><i class="fas fa-images"></i> Gallery</a>
            <?php endif; ?>

            <?php if (can('manage_users', $roles, $permissions)): ?>
                <a href="<?= BASE_URL ?>/admin/users" class="<?= strpos($current_uri, 'users') !== false ? 'active' : '' ?>"><i class="fas fa-users-cog"></i> Authorities</a>
            <?php endif; ?>

            <?php if (can('manage_roles', $roles, $permissions)): ?>
                <a href="<?= BASE_URL ?>/admin/roles" class="<?= strpos($current_uri, 'roles') !== false ? 'active' : '' ?>"><i class="fas fa-shield-alt"></i> Roles</a>
            <?php endif; ?>

            <div class="mt-5 pt-5 px-3">
                <a href="<?= BASE_URL ?>/admin/logout" class="text-danger border border-danger border-opacity-25" style="background: rgba(220, 38, 38, 0.05);"><i class="fas fa-power-off"></i> Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-container">
            <nav class="navbar d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn btn-light d-lg-none me-3 rounded-circle shadow-sm" id="menuToggle" aria-label="Open menu"><i class="fas fa-bars"></i></button>
                    <h5 class="m-0 text-dark fw-bold" style="letter-spacing: -0.5px;"><?= $pageTitle ?? 'Overview' ?></h5>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-end me-3 d-none d-sm-block">
                        <div class="fw-bold text-dark small leading-tight"><?= htmlspecialchars($user_name) ?></div>
                        <div class="text-muted small" style="font-size: 0.75rem;">Administrator</div>
                    </div>
                    <div class="position-relative">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($user_name) ?>&background=d32f2f&color=fff&bold=true" class="rounded-circle shadow-sm border border-2 border-white" width="45" alt="User">
                        <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle" style="width: 12px; height: 12px;"></span>
                    </div>
                </div>
            </nav>

            <div class="main-content">
                <?php if(isset($contentPath)) require $contentPath; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('menuToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('show');
            document.getElementById('sidebarOverlay').classList.add('show');
        });
        document.getElementById('sidebarOverlay')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
        document.querySelectorAll('#sidebar a').forEach(function(link) {
            link.addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('show');
                document.getElementById('sidebarOverlay').classList.remove('show');
            });
        });
    </script>
</body>
</html>
