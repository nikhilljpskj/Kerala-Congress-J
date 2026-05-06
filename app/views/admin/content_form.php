<div class="row mb-4">
    <div class="col-md-12">
        <div class="card p-4 border-0 shadow-sm">
            <div class="admin-page-header">
                <div>
                    <h5 class="fw-bold m-0"><?= isset($item) ? 'Edit' : 'Create' ?> Content</h5>
                    <p class="text-muted small m-0">Fill out the details below to publish your content.</p>
                </div>
                <a href="<?= BASE_URL ?>/admin/content" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back to List</a>
            </div>
        </div>
    </div>
</div>

<form action="<?= BASE_URL ?>/admin/content/<?= isset($item) ? 'edit?id='.$item['id'] : 'create' ?>" method="POST" enctype="multipart/form-data">
    <div class="row g-3 g-xl-4">
        <div class="col-12 col-xl-8">
            <div class="card p-4 border-0 shadow-sm mb-4">
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Title</label>
                    <input type="text" name="title" class="form-control form-control-lg border-0 shadow-sm" placeholder="Enter title here" value="<?= $item['title'] ?? '' ?>" required style="background: #f8fafc;">
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Content Body</label>
                    <textarea name="body" class="form-control border-0 shadow-sm" rows="15" placeholder="Write your content here..." style="background: #f8fafc;"><?= $item['body'] ?? '' ?></textarea>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-xl-4">
            <div class="card p-4 border-0 shadow-sm mb-4">
                <h6 class="fw-bold mb-4">Settings</h6>
                
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Type</label>
                    <select name="type" class="form-select border-0 shadow-sm" required style="background: #f8fafc;">
                        <option value="news" <?= ($item['type'] ?? '') == 'news' ? 'selected' : '' ?>>News</option>
                        <option value="update" <?= ($item['type'] ?? '') == 'update' ? 'selected' : '' ?>>Update</option>
                        <option value="event" <?= ($item['type'] ?? '') == 'event' ? 'selected' : '' ?>>Event</option>
                        <option value="history" <?= ($item['type'] ?? '') == 'history' ? 'selected' : '' ?>>History</option>
                        <option value="leadership" <?= ($item['type'] ?? '') == 'leadership' ? 'selected' : '' ?>>Leadership Profile</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Category</label>
                    <select name="category" class="form-select border-0 shadow-sm" required style="background: #f8fafc;">
                        <option value="main" <?= ($item['category'] ?? '') == 'main' ? 'selected' : '' ?>>Main Site</option>
                        <option value="kyf" <?= ($item['category'] ?? '') == 'kyf' ? 'selected' : '' ?>>KYF</option>
                        <option value="kitproc" <?= ($item['category'] ?? '') == 'kitproc' ? 'selected' : '' ?>>KITPROC</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Status</label>
                    <select name="status" class="form-select border-0 shadow-sm" style="background: #f8fafc;">
                        <option value="1" <?= ($item['status'] ?? 1) == 1 ? 'selected' : '' ?>>Published</option>
                        <option value="0" <?= ($item['status'] ?? 1) == 0 ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small">Event Date (optional)</label>
                    <input type="datetime-local" name="event_date" class="form-control border-0 shadow-sm" value="<?= isset($item['event_date']) ? date('Y-m-d\TH:i', strtotime($item['event_date'])) : '' ?>" style="background: #f8fafc;">
                </div>
            </div>

            <div class="card p-4 border-0 shadow-sm">
                <h6 class="fw-bold mb-4">Featured Image</h6>
                
                <?php if (isset($item['image']) && $item['image']): ?>
                    <div class="mb-3">
                        <img src="<?= BASE_URL ?><?= $item['image'] ?>" class="img-fluid rounded-3 shadow-sm">
                        <input type="hidden" name="existing_image" value="<?= $item['image'] ?>">
                    </div>
                <?php endif; ?>
                
                <div class="mb-4">
                    <input type="file" name="image" class="form-control border-0 shadow-sm" style="background: #f8fafc;">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow">
                    <i class="fas fa-save me-2"></i> Save Content
                </button>
            </div>
        </div>
    </div>
</form>
