<div class="card p-4">
    <div class="admin-toolbar mb-4">
        <div>
            <h5 class="fw-bold m-0">Edit Member</h5>
            <div class="text-muted small">Registration #<?= htmlspecialchars($member['reg_no'] ?? '') ?></div>
        </div>
        <a href="<?= BASE_URL ?>/admin/members" class="btn btn-light">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <?php if (($_GET['error'] ?? '') === 'photo'): ?>
        <div class="alert alert-danger">Photo upload failed. Please upload a JPG or PNG image under 2MB.</div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/admin/members/edit" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= (int)$member['id'] ?>">

        <div class="edit-section-title">Personal Details</div>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" value="<?= htmlspecialchars($member['fname'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" value="<?= htmlspecialchars($member['lname'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Mobile</label>
                <input type="tel" class="form-control" name="mobile" value="<?= htmlspecialchars($member['mobile'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($member['email'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dateofbirth" value="<?= htmlspecialchars($member['dateofbirth'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select class="form-select" name="gender">
                    <?php foreach (['' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'] as $value => $label): ?>
                        <option value="<?= htmlspecialchars($value) ?>" <?= ($member['gender'] ?? '') === $value ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Father / Guardian</label>
                <input type="text" class="form-control" name="fathername" value="<?= htmlspecialchars($member['fathername'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Aadhaar</label>
                <input type="number" class="form-control" name="aadhaar" value="<?= htmlspecialchars($member['aadhaar'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Religion</label>
                <input type="text" class="form-control" name="religion" value="<?= htmlspecialchars($member['religion'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Caste</label>
                <input type="text" class="form-control" name="caste" value="<?= htmlspecialchars($member['caste'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Blood Group</label>
                <select class="form-select" name="blood">
                    <?php foreach (['' => 'Select Blood Group', 'A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'] as $value => $label): ?>
                        <option value="<?= htmlspecialchars($value) ?>" <?= ($member['blood'] ?? '') === $value ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Reference</label>
                <input type="text" class="form-control" name="reference" value="<?= htmlspecialchars($member['reference'] ?? '') ?>">
            </div>
            <div class="col-12">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" rows="3"><?= htmlspecialchars($member['address'] ?? '') ?></textarea>
            </div>
        </div>

        <div class="edit-section-title">Membership & Location</div>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label">Membership</label>
                <input type="text" class="form-control" name="membership" value="<?= htmlspecialchars($member['membership'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="0" <?= (int)($member['status'] ?? 0) === 0 ? 'selected' : '' ?>>Pending</option>
                    <option value="1" <?= (int)($member['status'] ?? 0) === 1 ? 'selected' : '' ?>>Approved</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">District</label>
                <select class="form-select" name="district_id" id="edit_district_id" <?= empty($canChangeDistrict) ? 'disabled' : '' ?> required>
                    <option value="">Select District</option>
                    <?php foreach (($districts ?? []) as $district): ?>
                        <option value="<?= (int)$district['id'] ?>" <?= (int)($member['district_id'] ?? 0) === (int)$district['id'] ? 'selected' : '' ?>><?= htmlspecialchars($district['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (empty($canChangeDistrict)): ?>
                    <div class="form-text">District is fixed for district authority users.</div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <label class="form-label">Assembly</label>
                <select class="form-select" name="assembly_id" id="edit_assembly_id">
                    <option value="">Select Assembly</option>
                    <?php foreach (($assemblies ?? []) as $assembly): ?>
                        <option value="<?= (int)$assembly['id'] ?>" <?= (int)($member['assembly_id'] ?? 0) === (int)$assembly['id'] ? 'selected' : '' ?>><?= htmlspecialchars($assembly['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Local Body</label>
                <select class="form-select" name="local_body_id" id="edit_local_body_id">
                    <option value="">Select Local Body</option>
                    <?php foreach (($localBodies ?? []) as $localBody): ?>
                        <option value="<?= (int)$localBody['id'] ?>" <?= (int)($member['local_body_id'] ?? 0) === (int)$localBody['id'] ? 'selected' : '' ?>><?= htmlspecialchars($localBody['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Ward</label>
                <input type="text" class="form-control" name="ward" value="<?= htmlspecialchars($member['ward'] ?? '') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">President</label>
                <input type="text" class="form-control" name="president" value="<?= htmlspecialchars($member['president'] ?? '') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Secretary</label>
                <input type="text" class="form-control" name="secretary" value="<?= htmlspecialchars($member['secretary'] ?? '') ?>">
            </div>
        </div>

        <div class="edit-section-title">Photo</div>
        <div class="row g-3 align-items-center mb-4">
            <div class="col-md-auto">
                <?php if (!empty($member['photo'])): ?>
                    <img src="<?= BASE_URL . '/' . htmlspecialchars($member['photo']) ?>" class="member-edit-photo" alt="Current member photo">
                <?php else: ?>
                    <div class="member-edit-photo placeholder"><i class="fas fa-user"></i></div>
                <?php endif; ?>
            </div>
            <div class="col-md">
                <label class="form-label">Replace Photo Optional</label>
                <input type="file" class="form-control" name="photo" accept="image/jpeg, image/png">
                <div class="form-text">JPG or PNG, maximum 2MB.</div>
            </div>
        </div>

        <div class="admin-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="<?= BASE_URL ?>/admin/members" class="btn btn-light">Cancel</a>
        </div>
    </form>
</div>

<style>
    .edit-section-title {
        border-bottom: 1px solid #e5e7eb;
        color: #475569;
        font-size: 0.78rem;
        font-weight: 800;
        margin: 0 0 16px;
        padding-bottom: 8px;
        text-transform: uppercase;
    }
    .member-edit-photo {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        height: 96px;
        object-fit: cover;
        width: 96px;
    }
    .member-edit-photo.placeholder {
        align-items: center;
        color: #94a3b8;
        display: flex;
        font-size: 2rem;
        justify-content: center;
    }
</style>

<script>
(function() {
    const districtSelect = document.getElementById('edit_district_id');
    const assemblySelect = document.getElementById('edit_assembly_id');
    const localBodySelect = document.getElementById('edit_local_body_id');
    const baseUrl = '<?= BASE_URL ?>';

    if (!districtSelect || !assemblySelect || !localBodySelect) return;

    districtSelect.addEventListener('change', function() {
        assemblySelect.innerHTML = '<option value="">Loading Assemblies...</option>';
        localBodySelect.innerHTML = '<option value="">Select Local Body</option>';
        if (!this.value) {
            assemblySelect.innerHTML = '<option value="">Select Assembly</option>';
            return;
        }

        fetch(baseUrl + '/api/assemblies?district_id=' + encodeURIComponent(this.value))
            .then(response => response.json())
            .then(data => {
                assemblySelect.innerHTML = '<option value="">Select Assembly</option>';
                if (data.success && data.data) {
                    data.data.forEach(item => assemblySelect.add(new Option(item.name, item.id)));
                }
            })
            .catch(() => {
                assemblySelect.innerHTML = '<option value="">Error loading assemblies</option>';
            });
    });

    assemblySelect.addEventListener('change', function() {
        localBodySelect.innerHTML = '<option value="">Loading Local Bodies...</option>';
        if (!this.value) {
            localBodySelect.innerHTML = '<option value="">Select Local Body</option>';
            return;
        }

        fetch(baseUrl + '/api/local-bodies?assembly_id=' + encodeURIComponent(this.value))
            .then(response => response.json())
            .then(data => {
                localBodySelect.innerHTML = '<option value="">Select Local Body</option>';
                if (data.success && data.data) {
                    data.data.forEach(item => localBodySelect.add(new Option(item.name, item.id)));
                }
            })
            .catch(() => {
                localBodySelect.innerHTML = '<option value="">Error loading local bodies</option>';
            });
    });
})();
</script>
