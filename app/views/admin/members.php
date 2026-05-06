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
</style>

<!-- Member Details Modal -->
<div class="modal fade" id="memberDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
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
    
    fetch(`<?= BASE_URL ?>/admin/members/view?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const member = data.data;
                let html = `
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="${member.photo ? '<?= BASE_URL ?>/' + member.photo : 'https://ui-avatars.com/api/?name=' + member.fname + '+' + member.lname}" class="img-fluid rounded mb-3 shadow-sm" style="max-height: 200px; width: 100%; object-fit: cover;">
                            <h5 class="fw-bold mb-0">${member.fname} ${member.lname}</h5>
                            <p class="text-secondary small">Reg No: #${member.reg_no}</p>
                            <div class="mt-3">
                                ${member.status == 1 ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-warning text-dark">Pending</span>'}
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-sm table-borderless">
                                <tr><th width="40%">Father/Husband:</th><td>${member.fathername || 'N/A'}</td></tr>
                                <tr><th>Email:</th><td>${member.email || 'N/A'}</td></tr>
                                <tr><th>Mobile:</th><td>${member.mobile}</td></tr>
                                <tr><th>DOB:</th><td>${member.dateofbirth}</td></tr>
                                <tr><th>Gender:</th><td>${member.gender}</td></tr>
                                <tr><th>District:</th><td>${member.district_name || member.district}</td></tr>
                                <tr><th>Assembly:</th><td>${member.assembly_name || member.assembly}</td></tr>
                                <tr><th>Local Body:</th><td>${member.local_body_name || member.local_body}</td></tr>
                                <tr><th>Address:</th><td>${member.address || member.perm_address}</td></tr>
                                <tr><th>Blood Group:</th><td>${member.blood || 'N/A'}</td></tr>
                                <tr><th>Reference:</th><td>${member.reference || 'N/A'}</td></tr>
                                <tr><th>Membership Area:</th><td>${member.membership}</td></tr>
                            </table>
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
