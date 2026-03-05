<?php
/**
 * Incubatee form — shared for Create and Edit.
 *
 * Variables:
 *   $pageTitle  — "New Incubatee" or "Edit Incubatee"
 *   $incubatee  — (edit only) associative array of current values
 *   $activePage — always "incubatees"
 */

$isEdit  = isset($incubatee);
$formUrl = $isEdit
    ? site_url('admin/incubatees/' . $incubatee['id'])
    : site_url('admin/incubatees');
?>

<style>
    .form-card{background:#fff;border:1px solid #eceae6;border-radius:.4rem;padding:1.4rem}
    .form-grid{display:grid;gap:1rem}
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
    .form-row-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem}
    .field label{display:block;font-size:.62rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8;margin-bottom:.3rem}
    .field input[type=text],
    .field input[type=url],
    .field input[type=number],
    .field textarea,
    .field select{width:100%;font-family:'DM Sans',sans-serif;font-size:.82rem;color:#1e293b;padding:.5rem .65rem;border:1px solid #ddd;border-radius:.25rem;background:#fff;outline:none;transition:border .15s}
    .field input:focus,.field textarea:focus,.field select:focus{border-color:#03558C}
    .field textarea{resize:vertical;min-height:70px}
    .editor-wrap{border:1px solid #ddd;border-radius:.25rem;overflow:hidden}
    .editor-wrap .ql-toolbar{border:none;border-bottom:1px solid #eee;background:#fafaf9}
    .editor-wrap .ql-container{border:none;font-family:'DM Sans',sans-serif;font-size:.82rem;min-height:200px}
    .upload-zone{border:1.5px dashed #d4d0ca;border-radius:.35rem;padding:1.5rem;text-align:center;cursor:pointer;transition:border-color .15s,background .15s;position:relative}
    .upload-zone:hover{border-color:#03558C;background:#fafcff}
    .upload-zone input[type=file]{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);border:0}
    .upload-zone .label{font-size:.78rem;color:#94a3b8}
    .upload-zone .label strong{color:#03558C}
    .upload-preview{margin-top:.6rem}
    .upload-preview img{max-height:140px;max-width:100%;border-radius:.3rem;border:1px solid #eceae6}
    .switch-row{display:flex;gap:1.5rem;align-items:center;margin-top:.25rem}
    .switch{display:flex;align-items:center;gap:.45rem;cursor:pointer;font-size:.78rem;color:#334155}
    .switch input{display:none}
    .switch .track{width:32px;height:18px;border-radius:9px;background:#d4d0ca;position:relative;transition:background .2s}
    .switch input:checked + .track{background:#03558C}
    .switch .track::after{content:'';position:absolute;top:2px;left:2px;width:14px;height:14px;border-radius:50%;background:#fff;transition:transform .2s}
    .switch input:checked + .track::after{transform:translateX(14px)}
    .form-actions{display:flex;gap:.55rem;justify-content:flex-end;align-items:center;margin-top:1rem;padding-top:.8rem;border-top:1px solid #eceae6}
    .form-actions .btn-p,.form-actions .btn-o{display:inline-flex;align-items:center;gap:.3rem;font-size:.68rem;font-weight:600;padding:.55rem 1.1rem;border-radius:.3rem;border:none;cursor:pointer;text-decoration:none;transition:all .15s}
    .form-actions .btn-p{background:#03558C;color:#fff}
    .form-actions .btn-p:hover{background:#024a7a}
    .form-actions .btn-o{background:#fff;color:#64748b;border:1px solid #e4e2dd}
    .form-actions .btn-o:hover{border-color:#03558C;color:#03558C}
</style>

<form action="<?= $formUrl ?>" method="POST" enctype="multipart/form-data" id="incubateeForm">
    <?= csrf_field() ?>
    <?php if ($isEdit): ?>
        <input type="hidden" name="_method" value="PUT"/>
    <?php endif; ?>

    <div class="form-card">
        <div class="form-grid">

            <!-- Company Name -->
            <div class="field">
                <label for="companyName">Company Name</label>
                <input type="text" id="companyName" name="companyName" value="<?= esc($isEdit ? $incubatee['companyName'] : old('companyName')) ?>" required placeholder="Startup or company name">
            </div>

            <!-- Founder + Cohort -->
            <div class="form-row">
                <div class="field">
                    <label for="founderName">Founder / Team</label>
                    <input type="text" id="founderName" name="founderName" value="<?= esc($isEdit ? $incubatee['founderName'] : old('founderName')) ?>" placeholder="e.g. Maria Cruz & Team">
                </div>
                <div class="field">
                    <label for="cohort">Cohort</label>
                    <input type="text" id="cohort" name="cohort" value="<?= esc($isEdit ? $incubatee['cohort'] : old('cohort')) ?>" placeholder="e.g. Cohort 1 · 2024">
                </div>
            </div>

            <!-- Website + Sort order -->
            <div class="form-row">
                <div class="field">
                    <label for="websiteUrl">Website URL</label>
                    <input type="url" id="websiteUrl" name="websiteUrl" value="<?= esc($isEdit ? $incubatee['websiteUrl'] : old('websiteUrl')) ?>" placeholder="https://example.com">
                </div>
                <div class="field">
                    <label for="sortOrder">Sort Order</label>
                    <input type="number" id="sortOrder" name="sortOrder" value="<?= esc($isEdit ? $incubatee['sortOrder'] : (old('sortOrder') ?: '0')) ?>" min="0" placeholder="0">
                </div>
            </div>

            <!-- Short description -->
            <div class="field">
                <label for="shortDescription">Short Description</label>
                <textarea id="shortDescription" name="shortDescription" rows="2" placeholder="One-liner shown on cards (max ~160 chars)"><?= esc($isEdit ? $incubatee['shortDescription'] : old('shortDescription')) ?></textarea>
            </div>

            <!-- Content (Quill) -->
            <div class="field">
                <label>Full Description</label>
                <div class="editor-wrap">
                    <div class="quill-editor"><?= $isEdit ? $incubatee['content'] : old('content') ?></div>
                    <input type="hidden" name="content" class="quill-content" value="<?= esc($isEdit ? $incubatee['content'] : old('content')) ?>">
                </div>
            </div>

            <!-- Logo upload -->
            <div class="field">
                <label>Company Logo</label>
                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="logo" id="logoInput" accept="image/*">
                    <div class="label" id="uploadLabel"><strong>Click to upload</strong> or drag a logo here</div>
                    <div class="upload-preview" id="uploadPreview">
                        <?php if ($isEdit && ! empty($incubatee['logoPath'])): ?>
                            <img src="<?= site_url($incubatee['logoPath']) ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($isEdit && ! empty($incubatee['logoPath'])): ?>
                    <p style="font-size:.62rem;color:#94a3b8;margin-top:.35rem">Click to replace the current logo</p>
                <?php endif; ?>
            </div>

            <!-- Toggle -->
            <div class="switch-row">
                <label class="switch">
                    <input type="checkbox" name="isPublished" value="1" <?= ($isEdit && $incubatee['isPublished']) ? 'checked' : '' ?>>
                    <span class="track"></span>
                    Publish
                </label>
            </div>

            <div class="form-actions">
                <a href="<?= site_url('admin/incubatees') ?>" class="btn-o">← Back to incubatees</a>
                <span style="flex:1"></span>
                <button type="submit" class="btn-p">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    <?= $isEdit ? 'Save changes' : 'Add incubatee' ?>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
(function() {
    var zone    = document.getElementById('uploadZone');
    var input   = document.getElementById('logoInput');
    var preview = document.getElementById('uploadPreview');
    var label   = document.getElementById('uploadLabel');

    if (preview.querySelector('img')) label.style.display = 'none';

    zone.addEventListener('click', function(e) {
        if (e.target === input) return;
        input.click();
    });

    input.addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="">';
            label.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    zone.addEventListener('dragover', function(e) { e.preventDefault(); zone.style.borderColor='#03558C'; zone.style.background='#fafcff'; });
    zone.addEventListener('dragleave', function() { zone.style.borderColor=''; zone.style.background=''; });
    zone.addEventListener('drop', function(e) {
        e.preventDefault(); zone.style.borderColor=''; zone.style.background='';
        var files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) { input.files = files; input.dispatchEvent(new Event('change')); }
    });
})();
</script>
