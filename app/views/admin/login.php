<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerala Congress - Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #d32f2f 0%, #7b1fa2 100%);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(211, 47, 47, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(123, 31, 162, 0.15) 0px, transparent 50%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 420px;
            padding: 50px 40px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .login-card .logo {
            text-align: center;
            margin-bottom: 35px;
        }
        .login-card h4 {
            font-weight: 700;
            color: #0f172a;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: -0.5px;
        }
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            width: 100%;
            padding: 14px;
            font-weight: 600;
            border-radius: 12px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(211, 47, 47, 0.3);
            filter: brightness(1.1);
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 18px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(211, 47, 47, 0.1);
            border-color: #d32f2f;
            background: #fff;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">
            <div class="d-inline-block p-3 rounded-circle mb-3" style="background: var(--primary-gradient);">
                <i class="fas fa-shield-halved fa-2x text-white"></i>
            </div>
            <h2 style="color: #0f172a; font-weight:800; letter-spacing: -1px; margin: 0;">KC ADMIN</h2>
            <p class="text-muted small fw-medium mt-1">Kerala Congress Control Panel</p>
        </div>
        <h4>Welcome Back</h4>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger p-3 border-0 rounded-4 small fw-medium mb-4" role="alert" style="background: rgba(220, 38, 38, 0.1); color: #dc2626;">
                <i class="fas fa-exclamation-circle me-2"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/admin/login">
            <div class="mb-4">
                <label for="email" class="form-label text-dark small fw-bold ms-1">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="admin@keralacongress.org.in">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label text-dark small fw-bold ms-1">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Sign In</button>
        </form>
    </div>
</body>
</html>
