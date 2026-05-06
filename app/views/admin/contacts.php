<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <div class="admin-toolbar mb-4">
            <h5 class="fw-bold m-0">Contact Inquiries</h5>
            <form action="<?= BASE_URL ?>/admin/contacts" method="GET" class="admin-search">
                <div class="admin-search-field">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" class="form-control" placeholder="Search name, mobile, email..." value="<?= htmlspecialchars($search ?? '') ?>">
                </div>
                <button class="btn btn-primary" type="submit">Search</button>
                <?php if (!empty($search)): ?>
                    <a href="<?= BASE_URL ?>/admin/contacts" class="btn btn-light">Clear</a>
                <?php endif; ?>
            </form>
            <span class="badge bg-primary rounded-pill"><?= number_format($totalItems ?? count($inquiries)) ?> Total</span>
        </div>

        <div class="table-responsive mobile-cards admin-table-wrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($inquiries)): ?>
                        <?php foreach ($inquiries as $item): ?>
                            <tr>
                                <td class="small text-muted" data-label="Date"><?= date('d M Y, h:i A', strtotime($item['created_at'])) ?></td>
                                <td class="fw-bold" data-label="Name"><?= htmlspecialchars($item['name']) ?></td>
                                <td data-label="District"><span class="badge bg-light text-dark border"><?= htmlspecialchars($item['district_name'] ?: 'State-level') ?></span></td>
                                <td data-label="Mobile"><?= htmlspecialchars($item['mobile']) ?></td>
                                <td class="small" data-label="Email"><?= htmlspecialchars($item['email'] ?: 'N/A') ?></td>
                                <td class="text-end" data-label="Actions">
                                    <button onclick="viewInquiry(<?= $item['id'] ?>)" class="btn btn-sm btn-light text-primary" title="View Message">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="<?= BASE_URL ?>/admin/contacts/delete?id=<?= $item['id'] ?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Archive this inquiry?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i><br>
                                No inquiries found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php render_admin_pagination($currentPage ?? 1, $totalItems ?? 0, $perPage ?? 10); ?>
    </div>
</div>

<!-- Inquiry Modal -->
<div class="modal fade" id="inquiryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Inquiry Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="inquiryContent">
                <div class="text-center py-4 text-muted"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</div>
            </div>
        </div>
    </div>
</div>

<script>
function viewInquiry(id) {
    const modal = new bootstrap.Modal(document.getElementById('inquiryModal'));
    modal.show();
    
    fetch(`<?= BASE_URL ?>/admin/contacts/view?id=${id}`)
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                const data = res.data;
                document.getElementById('inquiryContent').innerHTML = `
                    <div class="mb-3">
                        <label class="small text-muted mb-1 d-block">From</label>
                        <div class="fw-bold">${data.name}</div>
                        <div class="small text-muted">${data.mobile} | ${data.email || 'No email provided'}</div>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 d-block">District</label>
                        <div class="badge bg-light text-dark border">${data.district_name || 'State'}</div>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 d-block">Message</label>
                        <div class="p-3 bg-light rounded" style="white-space: pre-wrap;">${data.message}</div>
                    </div>
                    <div class="text-muted small">Received: ${new Date(data.created_at).toLocaleString()}</div>
                `;
            } else {
                document.getElementById('inquiryContent').innerHTML = `<div class="alert alert-danger">${res.message}</div>`;
            }
        });
}
</script>
