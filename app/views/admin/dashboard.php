<div class="row g-3 g-xl-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card stat-card p-4 border-0 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
            <div class="position-absolute end-0 top-0 p-3 opacity-10">
                <i class="fas fa-users fa-6x text-white"></i>
            </div>
            <div class="position-relative z-1">
                <div class="text-white-50 small fw-bold mb-1 text-uppercase" style="letter-spacing: 1px;">Total Members</div>
                <h2 class="mb-0 fw-bold text-white"><?= number_format($stats['total']) ?></h2>
                <div class="mt-3">
                    <span class="badge bg-primary bg-opacity-25 text-white" style="backdrop-filter: blur(5px);">Growth Phase</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card stat-card p-4 border-0 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
            <div class="position-absolute end-0 top-0 p-3 opacity-10">
                <i class="fas fa-check-double fa-6x text-white"></i>
            </div>
            <div class="position-relative z-1">
                <div class="text-white-50 small fw-bold mb-1 text-uppercase" style="letter-spacing: 1px;">Approved</div>
                <h2 class="mb-0 fw-bold text-white"><?= number_format($stats['approved']) ?></h2>
                <div class="mt-3">
                    <span class="badge bg-white bg-opacity-25 text-white" style="backdrop-filter: blur(5px);">Verified Contacts</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card stat-card p-4 border-0 shadow-sm h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #d32f2f 0%, #ef4444 100%);">
            <div class="position-absolute end-0 top-0 p-3 opacity-10">
                <i class="fas fa-hourglass-half fa-6x text-white"></i>
            </div>
            <div class="position-relative z-1">
                <div class="text-white-50 small fw-bold mb-1 text-uppercase" style="letter-spacing: 1px;">Pending Approval</div>
                <h2 class="mb-0 fw-bold text-white"><?= number_format($stats['pending']) ?></h2>
                <div class="mt-3">
                    <span class="badge bg-white bg-opacity-25 text-white" style="backdrop-filter: blur(5px);">Action Required</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 g-xl-4 mb-4">
    <?php if ($isSuperAdmin): ?>
    <div class="col-12 col-xl-8">
        <div class="card chart-panel p-4 shadow-sm border-0 h-100 bg-white">
            <div class="admin-toolbar mb-4">
                <h6 class="fw-bold m-0 text-dark">District-wise Distribution</h6>
                <button class="btn btn-sm btn-light px-3">View Detailed Report</button>
            </div>
            <div class="chart-frame">
                <canvas id="districtChart"></canvas>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-12 col-md-8 col-xl-<?= $isSuperAdmin ? '4' : '6' ?>">
        <div class="card chart-panel p-4 shadow-sm border-0 h-100 bg-white">
            <h6 class="fw-bold mb-4 text-dark text-center">Gender Demographics</h6>
            <div class="chart-frame">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gender Distribution Chart
    const genderData = <?= json_encode($genderStats) ?>;
    const genderLabels = genderData.map(item => item.gender || 'Not Specified');
    const genderCounts = genderData.map(item => item.count);
    
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderCounts,
                backgroundColor: ['#3b82f6', '#ec4899', '#cbd5e1'],
                hoverOffset: 15,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: { usePointStyle: true, padding: 25, font: { family: 'Inter', size: 12 } }
                }
            },
            cutout: '75%'
        }
    });

    <?php if ($isSuperAdmin): ?>
    // District-wise Distribution Chart
    const districtData = <?= json_encode(array_slice($districtStats, 0, 10)) ?>;
    const districtLabels = districtData.map(item => item.name);
    const districtCounts = districtData.map(item => item.count);

    new Chart(document.getElementById('districtChart'), {
        type: 'bar',
        data: {
            labels: districtLabels,
            datasets: [{
                label: 'Members',
                data: districtCounts,
                backgroundColor: '#3b82f6',
                borderRadius: 8,
                barThickness: 25,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: { font: { family: 'Inter' } }
                },
                x: { 
                    grid: { display: false },
                    ticks: { font: { family: 'Inter' } }
                }
            }
        }
    });
    <?php endif; ?>
});
</script>
