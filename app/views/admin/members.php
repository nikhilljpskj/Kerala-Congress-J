<div class="card p-4">
    <div class="admin-toolbar mb-4">
        <h5 class="fw-bold m-0">Member Registrations</h5>
        <form action="<?= BASE_URL ?>/admin/members" method="GET" class="admin-search admin-search-wide members-filter-form">
            <div class="admin-search-field">
                <i class="fas fa-search"></i>
                <input type="text" name="q" class="form-control" placeholder="Search name, reg no, phone..." value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
            <select name="status" class="form-select" aria-label="Filter by status">
                <option value="" <?= ($statusFilter ?? '') === '' ? 'selected' : '' ?>>All Status</option>
                <option value="0" <?= (string)($statusFilter ?? '') === '0' ? 'selected' : '' ?>>Pending</option>
                <option value="1" <?= (string)($statusFilter ?? '') === '1' ? 'selected' : '' ?>>Approved</option>
            </select>
            <select name="membership" class="form-select" aria-label="Filter by membership area">
                <option value="">All Areas</option>
                <?php foreach (($membershipOptions ?? []) as $option): ?>
                    <option value="<?= htmlspecialchars($option) ?>" <?= ($membershipFilter ?? '') === $option ? 'selected' : '' ?>><?= htmlspecialchars($option) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($isSuperAdmin)): ?>
                <select name="district_id" class="form-select" aria-label="Filter by district">
                    <option value="0">All Districts</option>
                    <?php foreach (($districts ?? []) as $district): ?>
                        <option value="<?= (int)$district['id'] ?>" <?= (int)($districtFilter ?? 0) === (int)$district['id'] ? 'selected' : '' ?>><?= htmlspecialchars($district['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <select name="sort" class="form-select" aria-label="Sort members">
                <option value="newest" <?= ($sort ?? 'newest') === 'newest' ? 'selected' : '' ?>>Newest First</option>
                <option value="oldest" <?= ($sort ?? '') === 'oldest' ? 'selected' : '' ?>>Oldest First</option>
                <option value="name_asc" <?= ($sort ?? '') === 'name_asc' ? 'selected' : '' ?>>Name A-Z</option>
                <option value="name_desc" <?= ($sort ?? '') === 'name_desc' ? 'selected' : '' ?>>Name Z-A</option>
                <option value="reg_asc" <?= ($sort ?? '') === 'reg_asc' ? 'selected' : '' ?>>Reg No A-Z</option>
                <option value="reg_desc" <?= ($sort ?? '') === 'reg_desc' ? 'selected' : '' ?>>Reg No Z-A</option>
            </select>
            <button class="btn btn-primary" type="submit">Apply</button>
            <?php if (!empty($search) || ($statusFilter ?? '') !== '' || !empty($membershipFilter) || !empty($districtFilter) || ($sort ?? 'newest') !== 'newest'): ?>
                <a href="<?= BASE_URL ?>/admin/members" class="btn btn-light">Clear</a>
            <?php endif; ?>
        </form>
    </div>
    
    <div class="table-responsive mobile-cards admin-table-wrap">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Photo</th>
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
                    <?php
                        $fullName = trim(($mem['fname'] ?? '') . ' ' . ($mem['lname'] ?? ''));
                        $avatarName = $fullName !== '' ? $fullName : 'Member';
                        $placeholderUrl = 'https://ui-avatars.com/api/?name=' . urlencode($avatarName) . '&background=e5e7eb&color=475569&bold=true';
                    ?>
                    <tr>
                        <td data-label="Photo">
                            <?php if (!empty($mem['photo'])): ?>
                                <?php $memPhoto = htmlspecialchars($mem['photo'] ?? ''); ?>
                                <img src="<?= BASE_URL . '/' . $memPhoto ?>" class="member-table-photo" width="42" height="42" alt="<?= htmlspecialchars($avatarName) ?>" loading="lazy" onerror="this.src='<?= $placeholderUrl ?>'">
                            <?php else: ?>
                                <img src="<?= $placeholderUrl ?>" class="member-table-photo" width="42" height="42" alt="<?= htmlspecialchars($avatarName) ?>" loading="lazy">
                            <?php endif; ?>
                        </td>
                        <td class="text-secondary fw-semibold" data-label="Reg No">#<?= htmlspecialchars($mem['reg_no']) ?></td>
                        <td data-label="Name">
                            <strong><?= htmlspecialchars($avatarName) ?></strong>
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
                                <a href="<?= BASE_URL ?>/admin/members/edit?id=<?= $mem['id'] ?>" class="btn btn-sm btn-light text-secondary" title="Edit Member">
                                    <i class="fas fa-pen"></i>
                                </a>
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
                        <td colspan="8" class="text-center text-muted py-4">
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
    .member-table-photo {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        display: block;
        height: 42px;
        object-fit: cover;
        width: 42px;
    }
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
