<div class="row mb-4">
    <div class="col-md-12">
        <div class="card p-4 border-0 shadow-sm">
            <div class="admin-page-header">
                <div>
                    <h5 class="fw-bold m-0">Gallery Management</h5>
                    <p class="text-muted small m-0">Manage photo galleries across all sections.</p>
                </div>
                <form action="<?= BASE_URL ?>/admin/gallery" method="GET" class="admin-search">
                    <?php if (!empty($category)): ?>
                        <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
                    <?php endif; ?>
                    <div class="admin-search-field">
                        <i class="fas fa-search"></i>
                        <input type="text" name="q" class="form-control" placeholder="Search images..." value="<?= htmlspecialchars($search ?? '') ?>">
                    </div>
                    <button class="btn btn-primary" type="submit">Search</button>
                    <?php if (!empty($search)): ?>
                        <a href="<?= BASE_URL ?>/admin/gallery<?= !empty($category) ? '?category=' . urlencode($category) : '' ?>" class="btn btn-light">Clear</a>
                    <?php endif; ?>
                </form>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
                    <i class="fas fa-plus"></i> Add Images
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 g-xl-4 overflow-hidden">
    <div class="col-12 col-lg-3">
        <div class="card border-0 shadow-sm p-3 h-100">
            <h6 class="fw-bold mb-3 small text-muted text-uppercase" style="letter-spacing: 1px;">Categories</h6>
            <div class="list-group list-group-flush">
                <a href="<?= BASE_URL ?>/admin/gallery" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= !($category ?? '') ? 'active' : '' ?>">All Images</a>
                <a href="<?= BASE_URL ?>/admin/gallery?category=main" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= ($category ?? '') == 'main' ? 'active' : '' ?>">Main Site</a>
                <a href="<?= BASE_URL ?>/admin/gallery?category=kyf" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= ($category ?? '') == 'kyf' ? 'active' : '' ?>">KYF</a>
                <a href="<?= BASE_URL ?>/admin/gallery?category=kitproc" class="list-group-item list-group-item-action border-0 rounded-3 mb-1 <?= ($category ?? '') == 'kitproc' ? 'active' : '' ?>">KITPROC</a>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-9">
        <div class="row g-3">
            <?php if (empty($items)): ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fas fa-images fa-3x mb-3 text-light"></i>
                    <h6>No images found in this category.</h6>
                </div>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden gallery-card position-relative">
                            <img src="<?= BASE_URL ?><?= $item['image_path'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body p-3">
                                <h6 class="card-title small fw-bold mb-1"><?= htmlspecialchars($item['title'] ?: 'Untitled') ?></h6>
                                <span class="badge bg-light text-muted tiny"><?= strtoupper($item['category']) ?></span>
                            </div>
                            <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center gap-2">
                                <button class="btn btn-white btn-sm rounded-pill px-3 shadow edit-gallery-btn" 
                                        data-id="<?= $item['id'] ?>" 
                                        data-title="<?= htmlspecialchars($item['title']) ?>" 
                                        data-category="<?= $item['category'] ?>" 
                                        data-image="<?= $item['image_path'] ?>">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </button>
                                <a href="<?= BASE_URL ?>/admin/gallery/delete?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm rounded-pill px-3 shadow" onclick="return confirm('Delete this image?')">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php render_admin_pagination($currentPage ?? 1, $totalItems ?? 0, $perPage ?? 12); ?>
    </div>
</div>

<!-- Edit Gallery Modal -->
<div class="modal fade" id="editGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Edit Image Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/gallery/edit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="existing_image" id="edit_existing_image">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category</label>
                        <select name="category" id="edit_category" class="form-select border-0 shadow-sm" style="background: #f8fafc;">
                            <option value="main">Main Site</option>
                            <option value="kyf">KYF</option>
                            <option value="kitproc">KITPROC</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control border-0 shadow-sm" style="background: #f8fafc;" placeholder="Photo caption">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Swap Image (optional)</label>
                        <div class="mb-2">
                            <img id="edit_preview" src="" class="rounded shadow-sm" style="height: 100px; width: 100%; object-fit: cover;">
                        </div>
                        <input type="file" name="image" class="form-control border-0 shadow-sm" style="background: #f8fafc;">
                        <p class="text-muted tiny mt-1">Leave blank to keep the current image.</p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Gallery Modal -->
<div class="modal fade" id="addGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Add New Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASE_URL ?>/admin/gallery/add" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category</label>
                        <select name="category" class="form-select border-0 shadow-sm" style="background: #f8fafc;">
                            <option value="main">Main Site</option>
                            <option value="kyf">KYF</option>
                            <option value="kitproc">KITPROC</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Title (optional)</label>
                        <input type="text" name="title" class="form-control border-0 shadow-sm" style="background: #f8fafc;" placeholder="Photo caption">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Image</label>
                        <input type="file" name="image" class="form-control border-0 shadow-sm" style="background: #f8fafc;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.gallery-card .gallery-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    opacity: 0;
    transition: 0.3s;
}
.gallery-card:hover .gallery-overlay {
    opacity: 1;
}
.btn-white {
    background: white;
    color: #0f172a;
}
.btn-white:hover {
    background: #f8fafc;
    color: #d32f2f;
}
.tiny { font-size: 0.65rem; }
@media (max-width: 767.98px), (hover: none) {
    .gallery-card .gallery-overlay {
        position: static;
        opacity: 1;
        background: #f8fafc;
        backdrop-filter: none;
        padding: 12px;
        flex-direction: row !important;
        justify-content: flex-start !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.edit-gallery-btn');
    const editModal = new bootstrap.Modal(document.getElementById('editGalleryModal'));

    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const title = btn.getAttribute('data-title');
            const category = btn.getAttribute('data-category');
            const image = btn.getAttribute('data-image');

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_category').value = category;
            document.getElementById('edit_existing_image').value = image;
            document.getElementById('edit_preview').src = '<?= BASE_URL ?>' + image;

            editModal.show();
        });
    });
});
</script>
