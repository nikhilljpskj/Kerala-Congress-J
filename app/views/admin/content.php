<div class="row mb-4">
    <div class="col-md-12">
        <div class="card p-4 border-0 shadow-sm">
            <div class="admin-page-header">
                <div>
                    <h5 class="fw-bold m-0">Content Management</h5>
                    <p class="text-muted small m-0">Manage news, updates, events, and profiles across all sections.</p>
                </div>
                <a href="<?= BASE_URL ?>/admin/content/create" class="btn btn-primary"><i class="fas fa-plus"></i> New Content</a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card p-4 border-0 shadow-sm overflow-hidden">
            <div class="row g-3 mb-4">
                <div class="col-12 col-xl-9">
                    <form action="<?= BASE_URL ?>/admin/content" method="GET" class="admin-filters">
                        <input type="text" name="q" class="form-control shadow-sm" placeholder="Search title or body..." value="<?= htmlspecialchars($search ?? '') ?>" style="border: none; background: #f8fafc;">
                        <select name="category" class="form-select shadow-sm" style="border: none; background: #f8fafc;">
                            <option value="">All Categories</option>
                            <option value="main" <?= ($category ?? '') == 'main' ? 'selected' : '' ?>>Main Site</option>
                            <option value="kyf" <?= ($category ?? '') == 'kyf' ? 'selected' : '' ?>>KYF</option>
                            <option value="kitproc" <?= ($category ?? '') == 'kitproc' ? 'selected' : '' ?>>KITPROC</option>
                        </select>
                        <select name="type" class="form-select shadow-sm" style="border: none; background: #f8fafc;">
                            <option value="">All Types</option>
                            <option value="news" <?= ($type ?? '') == 'news' ? 'selected' : '' ?>>News</option>
                            <option value="update" <?= ($type ?? '') == 'update' ? 'selected' : '' ?>>Update</option>
                            <option value="event" <?= ($type ?? '') == 'event' ? 'selected' : '' ?>>Event</option>
                        </select>
                        <button type="submit" class="btn btn-light px-4 shadow-sm">Filter</button>
                        <?php if (!empty($search) || !empty($category) || !empty($type)): ?>
                            <a href="<?= BASE_URL ?>/admin/content" class="btn btn-light px-4 shadow-sm">Clear</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <div class="table-responsive mobile-cards">
                <table class="table table-hover align-middle">
                    <thead style="background: #f8fafc;">
                        <tr class="text-uppercase small fw-bold text-muted" style="letter-spacing: 1px;">
                            <th class="ps-4">Content</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-newspaper fa-3x mb-3 text-light"></i>
                                    <h6>No content found.</h6>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td class="ps-4" data-label="Content">
                                        <div class="d-flex align-items-center">
                                            <?php if ($item['image']): ?>
                                                <img src="<?= BASE_URL ?><?= $item['image'] ?>" class="rounded-3 me-3" width="50" height="40" style="object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" width="50" height="40" style="width: 50px; height: 40px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($item['title']) ?></div>
                                                <div class="small text-muted"><?= substr(strip_tags($item['body']), 0, 50) ?>...</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Type">
                                        <span class="badge rounded-pill bg-info bg-opacity-10 text-info px-3"><?= ucfirst($item['type']) ?></span>
                                    </td>
                                    <td data-label="Category">
                                        <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary px-3"><?= strtoupper($item['category']) ?></span>
                                    </td>
                                    <td data-label="Status">
                                        <?php if ($item['status']): ?>
                                            <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3">Published</span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-3">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="small text-muted" data-label="Date">
                                        <?= date('d M Y', strtotime($item['created_at'])) ?>
                                    </td>
                                    <td class="text-end pe-4" data-label="Actions">
                                        <a href="<?= BASE_URL ?>/admin/content/edit?id=<?= $item['id'] ?>" class="btn btn-sm btn-light rounded-circle me-1"><i class="fas fa-edit text-primary"></i></a>
                                        <a href="<?= BASE_URL ?>/admin/content/delete?id=<?= $item['id'] ?>" class="btn btn-sm btn-light rounded-circle" onclick="return confirm('Delete this content?')"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php render_admin_pagination($currentPage ?? 1, $totalItems ?? 0, $perPage ?? 10); ?>
        </div>
    </div>
</div>
