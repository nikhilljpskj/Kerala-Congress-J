<div class="card p-4">
    <div class="admin-toolbar mb-4">
        <h5 class="fw-bold m-0">Admin Users</h5>
        <form action="<?= BASE_URL ?>/admin/users" method="GET" class="admin-search admin-search-wide">
            <div class="admin-search-field">
                <i class="fas fa-search"></i>
                <input type="text" name="q" class="form-control" placeholder="Search name, email, phone..." value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
            <select name="role" class="form-select">
                <option value="">All Roles</option>
                <?php foreach (($assignableRoles ?? []) as $role): ?>
                    <option value="<?= htmlspecialchars($role['slug']) ?>" <?= ($roleFilter ?? '') === $role['slug'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($role['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-primary" type="submit">Search</button>
            <?php if (!empty($search) || !empty($roleFilter)): ?>
                <a href="<?= BASE_URL ?>/admin/users" class="btn btn-light">Clear</a>
            <?php endif; ?>
        </form>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDistrictAdminModal"><i class="fas fa-plus"></i> Add Admin User</button>
    </div>
    
    <div class="table-responsive mobile-cards admin-table-wrap">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email / Login</th>
                    <th>Phone</th>
                    <th>District</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td data-label="Name">
                            <strong><?= htmlspecialchars($u['name']) ?></strong>
                        </td>
                        <td data-label="Role"><span class="badge bg-primary bg-opacity-10 text-primary"><?= htmlspecialchars($u['role_name'] ?? 'Admin') ?></span></td>
                        <td data-label="Email / Login"><?= htmlspecialchars($u['email']) ?></td>
                        <td data-label="Phone"><?= htmlspecialchars($u['phone']) ?></td>
                        <td data-label="District"><?= !empty($u['district']) ? '<span class="badge bg-secondary">' . htmlspecialchars($u['district']) . '</span>' : '<span class="text-muted small">State-wide</span>' ?></td>
                        <td data-label="Status">
                            <?php if ($u['status'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Disabled</span>
                            <?php endif; ?>
                        </td>
                        <td data-label="Actions">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light text-primary" title="Edit Admin User" onclick='editAuthority(<?= json_encode($u) ?>)'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light text-info" title="Change Password" onclick="preparePasswordChange(<?= $u['id'] ?>, '<?= htmlspecialchars($u['name']) ?>')">
                                    <i class="fas fa-key"></i>
                                </button>
                                <a href="<?= BASE_URL ?>/admin/users/toggle?id=<?= $u['id'] ?>" class="btn btn-sm btn-light text-warning" title="Toggle Access">
                                    <i class="fas fa-power-off"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/admin/users/delete?id=<?= $u['id'] ?>" class="btn btn-sm btn-light text-danger" title="Delete Admin User" onclick="return confirm('Are you sure you want to delete this admin user?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No admin users found.</td>
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
                <h5 class="modal-title">Add Admin User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/users/add" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_slug" class="form-select admin-role-select" data-district-target="addDistrictField" required>
                            <?php foreach (($assignableRoles ?? []) as $role): ?>
                                <option value="<?= htmlspecialchars($role['slug']) ?>"><?= htmlspecialchars($role['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
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
                    <div class="mb-3" id="addDistrictField">
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
                    <button type="submit" class="btn btn-primary">Create Admin User</button>
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
                <h5 class="modal-title">Edit Admin User</h5>
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
                        <label class="form-label">Role</label>
                        <select name="role_slug" id="edit_role" class="form-select admin-role-select" data-district-target="editDistrictField" required>
                            <?php foreach (($assignableRoles ?? []) as $role): ?>
                                <option value="<?= htmlspecialchars($role['slug']) ?>"><?= htmlspecialchars($role['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control" required>
                    </div>
                    <div class="mb-3" id="editDistrictField">
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
    document.getElementById('edit_role').value = user.role_slug || 'district_admin';
    document.getElementById('edit_district').value = user.district_id;
    toggleDistrictField(document.getElementById('edit_role'));
    new bootstrap.Modal(document.getElementById('editDistrictAdminModal')).show();
}

function preparePasswordChange(id, name) {
    document.getElementById('pass_id').value = id;
    document.getElementById('pass_name').innerText = name;
    new bootstrap.Modal(document.getElementById('passwordModal')).show();
}

function toggleDistrictField(select) {
    const target = document.getElementById(select.dataset.districtTarget);
    if (!target) return;
    const districtSelect = target.querySelector('select');
    const needsDistrict = select.value === 'district_admin';
    target.style.display = needsDistrict ? '' : 'none';
    if (districtSelect) {
        districtSelect.required = needsDistrict;
        if (!needsDistrict) {
            districtSelect.value = '';
        }
    }
}

document.querySelectorAll('.admin-role-select').forEach(select => {
    select.addEventListener('change', () => toggleDistrictField(select));
    toggleDistrictField(select);
});
</script>
