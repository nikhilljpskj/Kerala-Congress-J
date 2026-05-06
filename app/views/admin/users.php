<div class="card p-4">
    <div class="admin-toolbar mb-4">
        <h5 class="fw-bold m-0">District Authorities</h5>
        <form action="<?= BASE_URL ?>/admin/users" method="GET" class="admin-filters">
            <input type="text" name="q" class="form-control form-control-sm" placeholder="Search name, email, phone..." value="<?= htmlspecialchars($search ?? '') ?>">
            <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i> Search</button>
            <?php if (!empty($search)): ?>
                <a href="<?= BASE_URL ?>/admin/users" class="btn btn-light btn-sm">Clear</a>
            <?php endif; ?>
        </form>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDistrictAdminModal"><i class="fas fa-plus"></i> Add New District Admin</button>
    </div>
    
    <div class="table-responsive mobile-cards">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Authority Name</th>
                    <th>Email / Login</th>
                    <th>Phone</th>
                    <th>District Assigned</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td data-label="Authority Name">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($u['name']) ?>&background=random" class="rounded-circle me-2" width="30">
                                <strong><?= htmlspecialchars($u['name']) ?></strong>
                            </div>
                        </td>
                        <td data-label="Email / Login"><?= htmlspecialchars($u['email']) ?></td>
                        <td data-label="Phone"><?= htmlspecialchars($u['phone']) ?></td>
                        <td data-label="District Assigned"><span class="badge bg-secondary"><?= htmlspecialchars($u['district']) ?></span></td>
                        <td data-label="Status">
                            <?php if ($u['status'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Disabled</span>
                            <?php endif; ?>
                        </td>
                        <td data-label="Actions">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light text-primary" title="Edit Authority" onclick='editAuthority(<?= json_encode($u) ?>)'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light text-info" title="Change Password" onclick="preparePasswordChange(<?= $u['id'] ?>, '<?= htmlspecialchars($u['name']) ?>')">
                                    <i class="fas fa-key"></i>
                                </button>
                                <a href="<?= BASE_URL ?>/admin/users/toggle?id=<?= $u['id'] ?>" class="btn btn-sm btn-light text-warning" title="Toggle Access">
                                    <i class="fas fa-power-off"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/admin/users/delete?id=<?= $u['id'] ?>" class="btn btn-sm btn-light text-danger" title="Delete Authority" onclick="return confirm('Are you sure you want to delete this District Authority?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No District Authorities found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php render_admin_pagination($currentPage ?? 1, $totalItems ?? 0, $perPage ?? 10); ?>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addDistrictAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add District Authority</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/users/add" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address (Login ID)</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign District</label>
                        <select name="district_id" class="form-select" required>
                            <option value="">Select District...</option>
                            <?php foreach($districts as $dist): ?>
                                <option value="<?= htmlspecialchars($dist['id']) ?>"><?= htmlspecialchars($dist['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Authority</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editDistrictAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit District Authority</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/users/update" method="POST">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign District</label>
                        <select name="district_id" id="edit_district" class="form-select" required>
                            <option value="">Select District...</option>
                            <?php foreach($districts as $dist): ?>
                                <option value="<?= htmlspecialchars($dist['id']) ?>"><?= htmlspecialchars($dist['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Authority</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password: <span id="pass_name"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/users/change-password" method="POST">
                <input type="hidden" name="id" id="pass_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required minlength="6">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editAuthority(user) {
    document.getElementById('edit_id').value = user.id;
    document.getElementById('edit_name').value = user.name;
    document.getElementById('edit_email').value = user.email;
    document.getElementById('edit_phone').value = user.phone;
    document.getElementById('edit_district').value = user.district_id;
    new bootstrap.Modal(document.getElementById('editDistrictAdminModal')).show();
}

function preparePasswordChange(id, name) {
    document.getElementById('pass_id').value = id;
    document.getElementById('pass_name').innerText = name;
    new bootstrap.Modal(document.getElementById('passwordModal')).show();
}
</script>
