<div class="card p-4">
    <div class="admin-toolbar mb-4">
        <h5 class="fw-bold m-0">Member Update Requests</h5>
        <form action="<?= BASE_URL ?>/admin/member-update-requests" method="GET" class="admin-search">
            <div class="admin-search-field">
                <i class="fas fa-search"></i>
                <input type="text" name="q" class="form-control" placeholder="Search name, reg no, phone..." value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
            <select name="status" class="form-select" aria-label="Filter by status">
                <option value="" <?= ($statusFilter ?? '') === '' ? 'selected' : '' ?>>All Status</option>
                <option value="pending" <?= ($statusFilter ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="approved" <?= ($statusFilter ?? '') === 'approved' ? 'selected' : '' ?>>Approved</option>
                <option value="rejected" <?= ($statusFilter ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
            </select>
            <button class="btn btn-primary" type="submit">Apply</button>
            <?php if (!empty($search) || ($statusFilter ?? '') !== ''): ?>
                <a href="<?= BASE_URL ?>/admin/member-update-requests" class="btn btn-light">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-responsive mobile-cards admin-table-wrap">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Member</th>
                    <th>Contact</th>
                    <th>District</th>
                    <th>Requested Update</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($requests)): ?>
                    <?php foreach ($requests as $request): ?>
                        <?php
                            $fullName = trim(($request['fname'] ?? '') . ' ' . ($request['lname'] ?? ''));
                            $status = $request['status'] ?? 'pending';
                            $badge = $status === 'approved' ? 'bg-success' : ($status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark');
                        ?>
                        <tr>
                            <td data-label="Member">
                                <div class="fw-bold"><?= htmlspecialchars($fullName ?: 'Member') ?></div>
                                <div class="small text-muted">#<?= htmlspecialchars($request['reg_no'] ?? '') ?></div>
                            </td>
                            <td data-label="Contact">
                                <div><?= htmlspecialchars($request['mobile'] ?? '') ?></div>
                                <div class="small text-muted"><?= htmlspecialchars($request['email'] ?? '') ?></div>
                            </td>
                            <td data-label="District"><?= htmlspecialchars($request['district_name'] ?? $request['district'] ?? 'N/A') ?></td>
                            <td data-label="Requested Update" class="request-text">
                                <?= nl2br(htmlspecialchars($request['requested_changes'] ?: 'Photo update requested.')) ?>
                            </td>
                            <td data-label="Photo">
                                <?php if (!empty($request['requested_photo'])): ?>
                                    <a href="<?= BASE_URL . '/' . htmlspecialchars($request['requested_photo']) ?>" target="_blank" class="request-photo-link">
                                        <img src="<?= BASE_URL . '/' . htmlspecialchars($request['requested_photo']) ?>" alt="Requested photo" class="request-photo-thumb" loading="lazy">
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">No photo</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Status">
                                <span class="badge <?= $badge ?>"><?= htmlspecialchars(ucfirst($status)) ?></span>
                                <?php if (!empty($request['reviewed_by_name'])): ?>
                                    <div class="small text-muted mt-1">By <?= htmlspecialchars($request['reviewed_by_name']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td data-label="Actions">
                                <?php if ($status === 'pending'): ?>
                                    <form action="<?= BASE_URL ?>/admin/member-update-requests/approve" method="POST" class="request-action-form mb-2">
                                        <input type="hidden" name="id" value="<?= (int)$request['id'] ?>">
                                        <input type="text" name="admin_note" class="form-control form-control-sm mb-2" placeholder="Admin note optional">
                                        <button type="submit" class="btn btn-sm btn-success w-100" onclick="return confirm('Mark this request as approved?');">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <form action="<?= BASE_URL ?>/admin/member-update-requests/reject" method="POST" class="request-action-form">
                                        <input type="hidden" name="id" value="<?= (int)$request['id'] ?>">
                                        <input type="text" name="admin_note" class="form-control form-control-sm mb-2" placeholder="Reason optional">
                                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Reject this request?');">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <div class="small text-muted"><?= nl2br(htmlspecialchars($request['admin_note'] ?? 'Reviewed')) ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-folder-open fa-2x mb-3 text-light"></i><br>
                            No update requests found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php render_admin_pagination($currentPage ?? 1, $totalItems ?? 0, $perPage ?? 10); ?>
</div>

<style>
    .request-text {
        max-width: 340px;
        min-width: 240px;
        white-space: normal;
    }
    .request-photo-thumb {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        height: 56px;
        object-fit: cover;
        width: 56px;
    }
    .request-action-form {
        min-width: 170px;
    }
</style>
