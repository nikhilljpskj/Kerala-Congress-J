<?php 
$pageTitle = 'Frontal Organizations - Kerala Congress'; 
require_once __DIR__ . '/../layout/header.php'; 
?>

    <style>
        .org-hero {
            background: linear-gradient(rgba(183, 28, 28, 0.9), rgba(183, 28, 28, 0.7)), url("<?= BASE_URL ?>/images/flag_bg.jpg");
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            margin-bottom: 60px;
        }
        .org-card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            background: #fff;
            border-top: 5px solid transparent;
        }
        .org-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(211, 47, 47, 0.15);
            border-top-color: #d32f2f;
        }
        .org-logo-wrapper {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f8fafc;
        }
        .org-logo-wrapper img {
            max-height: 100%;
            max-width: 100%;
            transition: transform 0.3s ease;
        }
        .org-card:hover .org-logo-wrapper img {
            transform: scale(1.1);
        }
        .org-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }
        .org-desc {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.6;
        }
        .section-header {
            margin-bottom: 50px;
        }
        .section-header h2 {
            font-weight: 800;
            color: #1e293b;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: #d32f2f;
            border-radius: 2px;
        }
        
        .premium-badge {
            display: inline-block;
            padding: 5px 15px;
            background: rgba(211, 47, 47, 0.1);
            color: #d32f2f;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
    </style>

    <!-- Hero Section -->
    <section class="org-hero">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3">Frontal Organizations</h1>
            <p class="lead opacity-90 max-w-700 mx-auto">Strengthening the pillars of Kerala Congress through dedicated wings for every section of society.</p>
        </div>
    </section>

    <div class="container mb-5 pb-5">
        <div class="row g-4">
            <!-- KYF -->
            <div class="col-lg-4 col-md-6">
                <div class="org-card">
                    <div class="org-logo-wrapper">
                        <img src="<?= BASE_URL ?>/images/logo_kyf.svg" alt="KYF Logo">
                    </div>
                    <div class="card-body p-4 text-center">
                        <span class="premium-badge">Youth Wing</span>
                        <h4 class="org-title">Kerala Youth Front (KYF)</h4>
                        <p class="org-desc">The dynamic pulse of Kerala Congress, empowering the youth to lead the future.</p>
                        <a href="<?= BASE_URL ?>/youthfront" class="btn btn-outline-danger btn-sm rounded-pill px-4 mt-3 fw-bold">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- KSC -->
            <div class="col-lg-4 col-md-6">
                <div class="org-card">
                    <div class="org-logo-wrapper">
                        <img src="<?= BASE_URL ?>/images/logo plain.svg" alt="KSC Logo">
                    </div>
                    <div class="card-body p-4 text-center">
                        <span class="premium-badge">Students Wing</span>
                        <h4 class="org-title">Kerala Students Congress (KSC)</h4>
                        <p class="org-desc">Championing student rights and fostering democratic values in academic institutions.</p>
                    </div>
                </div>
            </div>

            <!-- KITPROC -->
            <div class="col-lg-4 col-md-6">
                <div class="org-card">
                    <div class="org-logo-wrapper">
                        <img src="<?= BASE_URL ?>/images/kitproc logo.svg" alt="KITPROC Logo">
                    </div>
                    <div class="card-body p-4 text-center">
                        <span class="premium-badge">Professionals Wing</span>
                        <h4 class="org-title">KITPROC</h4>
                        <p class="org-desc">Connecting IT experts and professionals to the vision of a progressive Kerala.</p>
                        <a href="<?= BASE_URL ?>/kitproc" class="btn btn-outline-danger btn-sm rounded-pill px-4 mt-3 fw-bold">Learn More</a>
                    </div>
                </div>
            </div>

            <?php 
            $otherOrgs = [
                "Kerala Vanitha Congress" => ["desc" => "The powerful women's wing leading social and political change.", "type" => "Women's Wing"],
                "Kerala Karshaka Union" => ["desc" => "Dedicated to the welfare and rights of Kerala's hardworking farmers.", "type" => "Farmers Wing"],
                "Kerala Trade Union Congress" => ["desc" => "Protecting the interests and dignity of the working class.", "type" => "Labor Wing"],
                "Kerala Pravasi Congress" => ["desc" => "Supporting the vibrant Malayali diaspora worldwide.", "type" => "Expatriates Wing"],
                "Kerala NGO Front" => ["desc" => "Representing the voice of non-governmental employees.", "type" => "Employees Wing"],
                "Kerala Dalit Front" => ["desc" => "Committed to social justice and empowerment of the marginalized.", "type" => "Social Wing"],
                "Kerala Lawyers Front" => ["desc" => "Advocating for justice and legal professional excellence.", "type" => "Legal Wing"],
                "Kerala NGO Front" => ["desc" => "Representing the voice of non-governmental employees.", "type" => "Employees Wing"],
                "Kerala Private Teachers Front" => ["desc" => "Upholding the rights of educators in the private sector.", "type" => "Teachers Wing"],
                "Kerala Sahakarana Forum" => ["desc" => "Strengthening the cooperative movement across the state.", "type" => "Cooperative Wing"],
                "Kerala Fishermen Forum" => ["desc" => "Standing with the coastal communities for their livelihood.", "type" => "Fishermen Wing"],
                "Kerala Paddy Farmers Forum" => ["desc" => "Exclusive focus on supporting rice cultivators of Kerala.", "type" => "Agriculture Wing"],
                "Kerala Samskarika Vedi" => ["desc" => "Preserving and promoting the rich cultural heritage of Kerala.", "type" => "Cultural Wing"]
            ];

            foreach ($otherOrgs as $name => $info): ?>
            <div class="col-lg-4 col-md-6">
                <div class="org-card">
                    <div class="org-logo-wrapper">
                        <img src="<?= BASE_URL ?>/images/logo plain.svg" alt="Logo" style="opacity: 0.6;">
                    </div>
                    <div class="card-body p-4 text-center">
                        <span class="premium-badge"><?= $info['type'] ?></span>
                        <h4 class="org-title"><?= htmlspecialchars($name) ?></h4>
                        <p class="org-desc"><?= htmlspecialchars($info['desc']) ?: 'Part of the Kerala Congress frontal organizations family.' ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
