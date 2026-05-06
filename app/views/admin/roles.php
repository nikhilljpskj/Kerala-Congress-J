<div class="card p-4">
    <div class="admin-toolbar mb-4">
        <div>
            <h5 class="fw-bold m-0">Roles & Permissions</h5>
            <p class="text-muted small m-0">Control what each admin role can access in the control panel.</p>
        </div>
    </div>

    <div class="row g-3">
        <?php foreach (($rolesList ?? []) as $role): ?>
            <?php
                $isSuperAdmin = $role['slug'] === 'super_admin';
                $icon = 'fa-user-cog text-secondary';
                if ($role['slug'] === 'super_admin') {
                    $icon = 'fa-shield-alt text-primary';
                } elseif ($role['slug'] === 'state_admin') {
                    $icon = 'fa-user-shield text-info';
                } elseif ($role['slug'] === 'district_admin') {
                    $icon = 'fa-map-marker-alt text-danger';
                } elseif ($role['slug'] === 'content_manager') {
                    $icon = 'fa-user-edit text-success';
                }
            ?>
            <div class="col-12 col-xl-6">
                <form action="<?= BASE_URL ?>/admin/roles/update-permissions" method="POST" class="border rounded p-3 bg-light h-100 role-permission-card">
                    <input type="hidden" name="role_id" value="<?= (int)$role['id'] ?>">
                    <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="role-icon bg-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas <?= $icon ?>"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1"><?= htmlspecialchars($role['name']) ?></h6>
                                <p class="small text-muted mb-0"><?= htmlspecialchars($role['description'] ?? '') ?></p>
                            </div>
                        </div>
                        <?php if ($isSuperAdmin): ?>
                            <span class="badge bg-primary">Locked</span>
                        <?php endif; ?>
                    </div>

                    <div class="row g-2">
                        <?php foreach (($permissionsList ?? []) as $permission): ?>
                            <?php $checked = $isSuperAdmin || in_array($permission['slug'], $role['permission_slugs'] ?? [], true); ?>
                            <div class="col-12 col-sm-6">
                                <label class="permission-option">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="<?= (int)$permission['id'] ?>" <?= $checked ? 'checked' : '' ?> <?= $isSuperAdmin ? 'disabled' : '' ?>>
                                    <span>
                                        <strong><?= htmlspecialchars($permission['name']) ?></strong>
                                        <small><?= htmlspecialchars($permission['slug']) ?></small>
                                    </span>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm" <?= $isSuperAdmin ? 'disabled' : '' ?>>
                            <i class="fas fa-save"></i> Save Permissions
                        </button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.role-icon {
    height: 44px;
    min-width: 44px;
    width: 44px;
}
.permission-option {
    align-items: flex-start;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    gap: 10px;
    min-height: 64px;
    padding: 12px;
}
.permission-option small {
    color: #64748b;
    display: block;
    font-size: 0.72rem;
    margin-top: 2px;
}
.role-permission-card .form-check-input {
    margin-top: 3px;
}
</style>
