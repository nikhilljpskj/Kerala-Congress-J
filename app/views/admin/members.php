<div class="card p-4">
    <div class="admin-toolbar mb-4">
        <h5 class="fw-bold m-0">Member Registrations</h5>
        <form action="<?= BASE_URL ?>/admin/members" method="GET" class="admin-search">
            <div class="admin-search-field">
                <i class="fas fa-search"></i>
                <input type="text" name="q" class="form-control" placeholder="Search name, reg no, phone..." value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
            <button class="btn btn-primary" type="submit">Search</button>
            <?php if (!empty($search)): ?>
                <a href="<?= BASE_URL ?>/admin/members" class="btn btn-light">Clear</a>
            <?php endif; ?>
        </form>
    </div>
    
    <div class="table-responsive mobile-cards admin-table-wrap">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>Membership Area</th>
                    <th>District</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($members)): ?>
                    <?php foreach ($members as $mem): ?>
                    <tr>
                        <td class="text-secondary fw-semibold" data-label="Reg No">#<?= htmlspecialchars($mem['reg_no']) ?></td>
                        <td data-label="Name">
                            <div class="d-flex align-items-center">
                                <?php if (!empty($mem['photo']) && file_exists(BASE_PATH . '/' . $mem['photo'])): ?>
                                    <?php $memPhoto = htmlspecialchars($mem['photo'] ?? ''); ?>
                                    <img src="<?= BASE_URL . '/' . $memPhoto ?>" class="rounded-circle me-2" width="30" height="30" style="object-fit: cover;">
                                <?php else: ?>
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($mem['fname'].' '.$mem['lname']) ?>&background=random" class="rounded-circle me-2" width="30">
                                <?php endif; ?>
                                <strong><?= htmlspecialchars($mem['fname'] . ' ' . $mem['lname']) ?></strong>
                            </div>
                        </td>
                        <td data-label="Membership Area"><?= htmlspecialchars($mem['membership']) ?></td>
                        <td data-label="District"><?= htmlspecialchars($mem['district_name'] ?? $mem['district']) ?></td>
                        <td data-label="Phone"><?= htmlspecialchars($mem['mobile']) ?></td>
                        <td data-label="Status">
                            <?php if ($mem['status'] == 1): ?>
                                <span class="badge bg-success">Approved</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td data-label="Actions">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-light text-primary" onclick="showMemberDetails(<?= $mem['id'] ?>)" title="View Details"><i class="fas fa-eye"></i></button>
                                <?php if ($mem['status'] == 0): ?>
                                    <a href="<?= BASE_URL ?>/admin/members/approve?id=<?= $mem['id'] ?>" class="btn btn-sm btn-light text-success" title="Approve Member" onclick="return confirm('Approve this member?');">
                                        <i class="fas fa-check"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= BASE_URL ?>/admin/members/id-card?id=<?= $mem['id'] ?>" class="btn btn-sm btn-light text-info" title="Download ID Card" target="_blank">
                                        <i class="fas fa-id-card"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>/admin/members/delete?id=<?= $mem['id'] ?>" class="btn btn-sm btn-light text-danger" title="Delete Member" onclick="return confirm('Are you sure you want to delete this member?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-folder-open fa-2x mb-3 text-light"></i><br>
                            No members found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php render_admin_pagination($currentPage ?? 1, $totalItems ?? 0, $perPage ?? 10); ?>
</div>

<style>
    .pagination .page-link { color: #475569; background: #fff; font-weight: 500; border: 1px solid #e2e8f0; margin: 0 2px; border-radius: 4px; }
    .pagination .page-item.active .page-link { background-color: #0ea5e9; color: #fff; border-color: #0ea5e9; }
    .pagination .page-link:hover:not(.active) { background-color: #f1f5f9; }
    .member-modal .modal-dialog { --bs-modal-width: 980px; }
    .member-modal .modal-content { overflow: hidden; }
    .member-profile {
        background: linear-gradient(135deg, #991b1b, #1f2937);
        color: #fff;
        display: grid;
        gap: 18px;
        grid-template-columns: auto minmax(0, 1fr) auto;
        padding: 22px;
    }
    .member-photo-lg {
        background: rgba(255,255,255,0.12);
        border: 4px solid rgba(255,255,255,0.35);
        border-radius: 16px;
        height: 132px;
        object-fit: cover;
        width: 132px;
    }
    .member-profile h4 { overflow-wrap: anywhere; }
    .member-status-pill {
        align-self: start;
        border-radius: 999px;
        font-weight: 700;
        padding: 8px 12px;
        white-space: nowrap;
    }
    .member-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }
    .member-meta span {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 999px;
        font-size: 0.82rem;
        padding: 7px 10px;
    }
    .member-detail-section {
        padding: 22px;
    }
    .member-detail-title {
        color: #0f172a;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0;
        margin: 0 0 12px;
        text-transform: uppercase;
    }
    .member-detail-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    .member-detail-item {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        min-width: 0;
        padding: 12px;
    }
    .member-detail-item.full { grid-column: 1 / -1; }
    .member-detail-label {
        color: #64748b;
        display: block;
        font-size: 0.72rem;
        font-weight: 800;
        margin-bottom: 4px;
        text-transform: uppercase;
    }
    .member-detail-value {
        color: #111827;
        font-weight: 650;
        overflow-wrap: anywhere;
    }
    @media (max-width: 767.98px) {
        .member-profile {
            grid-template-columns: 1fr;
            padding: 18px;
            text-align: center;
        }
        .member-photo-lg {
            height: 120px;
            margin: 0 auto;
            width: 120px;
        }
        .member-status-pill { justify-self: center; }
        .member-meta { justify-content: center; }
        .member-detail-section { padding: 16px; }
        .member-detail-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- Member Details Modal -->
<div class="modal fade member-modal" id="memberDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Member Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="memberDetailsContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showMemberDetails(id) {
    const modalElement = document.getElementById('memberDetailsModal');
    const modal = new bootstrap.Modal(modalElement);
    document.getElementById('memberDetailsContent').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';
    modal.show();

    const escapeHtml = (value) => String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

    const display = (value) => {
        if (value === null || value === undefined || value === '') return 'N/A';
        return escapeHtml(value);
    };

    const detailItem = (label, value, full = false) => `
        <div class="member-detail-item ${full ? 'full' : ''}">
            <span class="member-detail-label">${escapeHtml(label)}</span>
            <div class="member-detail-value">${display(value)}</div>
        </div>
    `;
    
    fetch(`<?= BASE_URL ?>/admin/members/view?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const member = data.data;
                const fullName = `${member.fname || ''} ${member.lname || ''}`.trim() || 'Member';
                const photoUrl = member.photo ? '<?= BASE_URL ?>/' + member.photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(fullName);
                const statusHtml = member.status == 1
                    ? '<span class="member-status-pill bg-success">Approved</span>'
                    : '<span class="member-status-pill bg-warning text-dark">Pending</span>';
                let html = `
                    <div class="member-profile">
                        <img src="${escapeHtml(photoUrl)}" class="member-photo-lg shadow-sm" alt="${escapeHtml(fullName)}">
                        <div>
                            <div class="small text-white-50 fw-bold text-uppercase mb-1">Registration #${display(member.reg_no)}</div>
                            <h4 class="fw-bold mb-1">${escapeHtml(fullName)}</h4>
                            <div class="text-white-50">${display(member.membership)}</div>
                            <div class="member-meta">
                                <span><i class="fas fa-phone me-1"></i>${display(member.mobile)}</span>
                                <span><i class="fas fa-map-marker-alt me-1"></i>${display(member.district_name || member.district)}</span>
                                <span><i class="fas fa-id-card me-1"></i>${display(member.gender)}</span>
                            </div>
                        </div>
                        ${statusHtml}
                    </div>
                    <div class="member-detail-section">
                        <h6 class="member-detail-title">Personal Information</h6>
                        <div class="member-detail-grid mb-4">
                            ${detailItem('Father / Guardian', member.fathername)}
                            ${detailItem('Date of Birth', member.dateofbirth)}
                            ${detailItem('Gender', member.gender)}
                            ${detailItem('Blood Group', member.blood)}
                            ${detailItem('Email', member.email)}
                            ${detailItem('Mobile', member.mobile)}
                            ${detailItem('Aadhaar', member.aadhaar)}
                            ${detailItem('Reference', member.reference)}
                            ${detailItem('Address', member.address || member.perm_address, true)}
                        </div>

                        <h6 class="member-detail-title">Membership & Location</h6>
                        <div class="member-detail-grid">
                            ${detailItem('Membership Area', member.membership)}
                            ${detailItem('District', member.district_name || member.district)}
                            ${detailItem('Assembly', member.assembly_name || member.assembly)}
                            ${detailItem('Local Body', member.local_body_name || member.local_body)}
                            ${detailItem('Ward', member.ward)}
                            ${detailItem('President', member.president)}
                            ${detailItem('Secretary', member.secretary)}
                        </div>
                    </div>
                `;
                document.getElementById('memberDetailsContent').innerHTML = html;
            } else {
                document.getElementById('memberDetailsContent').innerHTML = '<div class="alert alert-danger">Error loading details.</div>';
            }
        })
        .catch(err => {
            document.getElementById('memberDetailsContent').innerHTML = '<div class="alert alert-danger">Network error.</div>';
        });
}
</script>
