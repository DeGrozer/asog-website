<?php
    $isEdit  = isset($incubatee);
    $formUrl = $isEdit ? site_url('admin/incubatees/' . $incubatee['id']) : site_url('admin/incubatees');
?>

<style>
    .form-card{background:#fff;border-radius:.5rem;box-shadow:0 1px 4px rgba(0,0,0,.04);padding:1.75rem 2rem;max-width:860px}
    .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem}
    .form-full{grid-column:1/-1}
    .form-group{display:flex;flex-direction:column;gap:.35rem}
    .form-group label{font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#03558C}
    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="url"],
    .form-group select,
    .form-group textarea{width:100%;padding:.6rem .8rem;border:1px solid #d4d0cb;border-radius:.3rem;font-size:.88rem;font-family:'DM Sans',sans-serif;color:#1e293b;background:#fff;outline:none;transition:border .2s,box-shadow .2s;resize:vertical}
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus{border-color:#F8AF21;box-shadow:0 0 0 3px rgba(248,175,33,.1)}
    .form-group .hint{font-size:.72rem;color:#94a3b8}
    .img-preview{margin-top:.5rem;width:120px;height:120px;object-fit:contain;border-radius:.3rem;border:1px solid #e5e7eb;display:none;background:#f9fafb}
    .img-preview.show{display:block}
    .toggle-row{display:flex;gap:2rem;align-items:center;padding:.5rem 0}
    .toggle-label{display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:#334155;cursor:pointer}
    .toggle-label input[type="checkbox"]{width:16px;height:16px;accent-color:#F8AF21;cursor:pointer}
    .form-actions{display:flex;gap:.75rem;margin-top:1.5rem;padding-top:1.25rem;border-top:1px solid #f1f0ed}
    .quill-editor{min-height:200px;background:#fff;border:1px solid #d4d0cb;border-top:none;border-radius:0 0 .3rem .3rem;font-family:'DM Sans',sans-serif;font-size:.88rem}
    .quill-editor .ql-editor{min-height:200px}
</style>

<a href="<?= site_url('admin/incubatees') ?>" style="display:inline-flex;align-items:center;gap:.35rem;font-size:.75rem;color:#64748b;margin-bottom:1rem;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#03558C'" onmouseout="this.style.color='#64748b'">← Back to incubatees</a>

<div class="form-card">
    <form method="POST" action="<?= $formUrl ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <?php if ($isEdit): ?>
            <input type="hidden" name="_method" value="PUT"/>
        <?php endif; ?>

        <div class="form-grid">
            <div class="form-group">
                <label for="companyName">Company Name</label>
                <input type="text" id="companyName" name="companyName"
                       value="<?= esc($incubatee['companyName'] ?? old('companyName', '')) ?>"
                       placeholder="Startup / Company name" required>
            </div>

            <div class="form-group">
                <label for="founderName">Founder</label>
                <input type="text" id="founderName" name="founderName"
                       value="<?= esc($incubatee['founderName'] ?? old('founderName', '')) ?>"
                       placeholder="Founder full name">
            </div>

            <div class="form-group">
                <label for="cohort">Cohort</label>
                <input type="text" id="cohort" name="cohort"
                       value="<?= esc($incubatee['cohort'] ?? old('cohort', '')) ?>"
                       placeholder="e.g. Cohort 1 · 2024">
            </div>

            <div class="form-group">
                <label for="websiteUrl">Website URL</label>
                <input type="text" id="websiteUrl" name="websiteUrl"
                       value="<?= esc($incubatee['websiteUrl'] ?? old('websiteUrl', '')) ?>"
                       placeholder="https://...">
            </div>

            <div class="form-group">
                <label for="sortOrder">Sort Order</label>
                <input type="number" id="sortOrder" name="sortOrder"
                       value="<?= esc($incubatee['sortOrder'] ?? old('sortOrder', '0')) ?>" min="0">
            </div>

            <div class="form-group">
                <label>&nbsp;</label>
            </div>

            <div class="form-group form-full">
                <label for="shortDescription">Short Description</label>
                <input type="text" id="shortDescription" name="shortDescription"
                       value="<?= esc($incubatee['shortDescription'] ?? old('shortDescription', '')) ?>"
                       placeholder="Brief description shown on cards">
            </div>

            <div class="form-group form-full">
                <label>Content</label>
                <input type="hidden" name="content" class="quill-content"
                       value="<?= esc($incubatee['content'] ?? old('content', '')) ?>">
                <div class="quill-editor"></div>
            </div>

            <div class="form-group form-full">
                <label>Company Logo</label>
                <?php if ($isEdit && ! empty($incubatee['logoPath'])): ?>
                    <img src="<?= base_url($incubatee['logoPath']) ?>" alt="Current logo" class="img-preview show" id="currentImg"/>
                <?php endif; ?>
                <input type="file" name="logo" accept="image/*" id="imageInput"
                       style="margin-top:.35rem;font-size:.82rem;color:#64748b">
                <img id="imgPreview" class="img-preview" alt="Preview"/>
                <span class="hint">JPG, PNG, GIF, or WEBP · Max 2 MB</span>
            </div>

            <div class="form-full">
                <div class="toggle-row">
                    <label class="toggle-label">
                        <input type="checkbox" name="isPublished" value="1"
                            <?= (isset($incubatee) && $incubatee['isPublished']) || old('isPublished') ? 'checked' : '' ?>>
                        Publish
                    </label>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold"><?= $isEdit ? 'Update Incubatee' : 'Add Incubatee' ?></button>
            <a href="<?= site_url('admin/incubatees') ?>" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imgPreview');
    const current = document.getElementById('currentImg');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            preview.src = ev.target.result;
            preview.classList.add('show');
            if (current) current.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
});
</script>
