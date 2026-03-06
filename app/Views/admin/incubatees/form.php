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
    ? site_url('admin/incubatees/' . $incubatee['id'] . '/update')
    : site_url('admin/incubatees');
?>

<style>
.form-card {
    background: #fff;
    border: 1px solid #eceae6;
    border-radius: .4rem;
    padding: 1.4rem
}

.form-grid {
    display: grid;
    gap: 1rem
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem
}

.form-row-3 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 1rem
}

.field label {
    display: block;
    font-size: .62rem;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: .3rem
}

.field input[type=text],
.field input[type=url],
.field input[type=number],
.field textarea,
.field select {
    width: 100%;
    font-family: 'DM Sans', sans-serif;
    font-size: .82rem;
    color: #1e293b;
    padding: .5rem .65rem;
    border: 1px solid #ddd;
    border-radius: .25rem;
    background: #fff;
    outline: none;
    transition: border .15s
}

.field input:focus,
.field textarea:focus,
.field select:focus {
    border-color: #03558C
}

.field textarea {
    resize: vertical;
    min-height: 70px
}

.editor-wrap {
    border: 1px solid #ddd;
    border-radius: .25rem;
    overflow: hidden
}

.editor-wrap .ql-toolbar {
    border: none;
    border-bottom: 1px solid #eee;
    background: #fafaf9
}

.editor-wrap .ql-container {
    border: none;
    font-family: 'DM Sans', sans-serif;
    font-size: .82rem;
    min-height: 200px
}

.upload-zone {
    border: 1.5px dashed #d4d0ca;
    border-radius: .35rem;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: border-color .15s, background .15s;
    position: relative
}

.upload-zone:hover {
    border-color: #03558C;
    background: #fafcff
}

.upload-zone input[type=file] {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0
}

.upload-zone .label {
    font-size: .78rem;
    color: #94a3b8
}

.upload-zone .label strong {
    color: #03558C
}

.upload-preview {
    margin-top: .6rem
}

.upload-preview img {
    max-height: 140px;
    max-width: 100%;
    border-radius: .3rem;
    border: 1px solid #eceae6
}

.switch-row {
    display: flex;
    gap: 1.5rem;
    align-items: center;
    margin-top: .25rem
}

/* Team members repeater */
.tm-section {
    margin-top: .25rem
}

.tm-section .section-label {
    font-size: .62rem;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: .5rem;
    display: block
}

.tm-rows {
    display: flex;
    flex-direction: column;
    gap: .45rem
}

.tm-row {
    display: flex;
    gap: .5rem;
    align-items: center
}

.tm-row input {
    flex: 1;
    font-family: 'DM Sans', sans-serif;
    font-size: .82rem;
    color: #1e293b;
    padding: .45rem .6rem;
    border: 1px solid #ddd;
    border-radius: .25rem;
    background: #fff;
    outline: none;
    transition: border .15s
}

.tm-row input:focus {
    border-color: #03558C
}

.tm-row .tm-remove {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 1px solid #e4e2dd;
    background: #fff;
    color: #94a3b8;
    font-size: 1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .15s;
    flex-shrink: 0
}

.tm-row .tm-remove:hover {
    border-color: #ef4444;
    color: #ef4444;
    background: #fef2f2
}

.tm-add {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    font-size: .68rem;
    font-weight: 600;
    color: #03558C;
    background: none;
    border: 1px dashed #ccc;
    border-radius: .25rem;
    padding: .4rem .8rem;
    cursor: pointer;
    margin-top: .4rem;
    transition: all .15s
}

.tm-add:hover {
    border-color: #03558C;
    background: #f0f9ff
}

.switch {
    display: flex;
    align-items: center;
    gap: .45rem;
    cursor: pointer;
    font-size: .78rem;
    color: #334155
}

.switch input {
    display: none
}

.switch .track {
    width: 32px;
    height: 18px;
    border-radius: 9px;
    background: #d4d0ca;
    position: relative;
    transition: background .2s
}

.switch input:checked+.track {
    background: #03558C
}

.switch .track::after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #fff;
    transition: transform .2s
}

.switch input:checked+.track::after {
    transform: translateX(14px)
}

.form-actions {
    display: flex;
    gap: .55rem;
    justify-content: flex-end;
    align-items: center;
    margin-top: 1rem;
    padding-top: .8rem;
    border-top: 1px solid #eceae6
}

.form-actions .btn-p,
.form-actions .btn-o {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    font-size: .68rem;
    font-weight: 600;
    padding: .55rem 1.1rem;
    border-radius: .3rem;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all .15s
}

.form-actions .btn-p {
    background: #03558C;
    color: #fff
}

.form-actions .btn-p:hover {
    background: #024a7a
}

.form-actions .btn-o {
    background: #fff;
    color: #64748b;
    border: 1px solid #e4e2dd
}

.form-actions .btn-o:hover {
    border-color: #03558C;
    color: #03558C
}
</style>

<form action="<?= $formUrl ?>" method="POST" enctype="multipart/form-data" id="incubateeForm">
    <?= csrf_field() ?>

    <div class="form-card">
        <div class="form-grid">

            <!-- Company Name -->
            <div class="field">
                <label for="companyName">Company Name</label>
                <input type="text" id="companyName" name="companyName"
                    value="<?= esc(old('companyName', $isEdit ? $incubatee['companyName'] : '')) ?>" required
                    placeholder="Startup or company name">
            </div>

            <!-- Founder + Cohort -->
            <div class="form-row">
                <div class="field">
                    <label for="founderName">Founder / Team</label>
                    <input type="text" id="founderName" name="founderName"
                        value="<?= esc(old('founderName', $isEdit ? $incubatee['founderName'] : '')) ?>"
                        placeholder="e.g. Maria Cruz & Team">
                </div>
                <div class="field">
                    <label for="cohort">Cohort</label>
                    <input type="text" id="cohort" name="cohort"
                        value="<?= esc(old('cohort', $isEdit ? $incubatee['cohort'] : '')) ?>"
                        placeholder="e.g. Cohort 1 · 2024">
                </div>
            </div>

            <!-- Website + Facebook -->
            <div class="form-row">
                <div class="field">
                    <label for="websiteUrl">Website URL</label>
                    <input type="url" id="websiteUrl" name="websiteUrl"
                        value="<?= esc(old('websiteUrl', $isEdit ? $incubatee['websiteUrl'] : '')) ?>"
                        placeholder="https://example.com">
                </div>
                <div class="field">
                    <label for="facebookUrl">Facebook Page URL</label>
                    <input type="url" id="facebookUrl" name="facebookUrl"
                        value="<?= esc(old('facebookUrl', $isEdit ? ($incubatee['facebookUrl'] ?? '') : '')) ?>"
                        placeholder="https://facebook.com/yourpage">
                </div>
            </div>

            <!-- Sort order -->
            <div class="form-row">
                <div class="field">
                    <label for="sortOrder">Sort Order</label>
                    <input type="number" id="sortOrder" name="sortOrder"
                        value="<?= esc(old('sortOrder', $isEdit ? $incubatee['sortOrder'] : 0)) ?>" min="0"
                        placeholder="0">
                </div>
                <div class="field"></div>
            </div>

            <!-- Short description -->
            <div class="field">
                <label for="shortDescription">Short Description</label>
                <textarea id="shortDescription" name="shortDescription" rows="2"
                    placeholder="One-liner shown on cards (max ~160 chars)"><?= esc(old('shortDescription', $isEdit ? $incubatee['shortDescription'] : '')) ?></textarea>
            </div>

            <!-- Content (Quill) -->
            <div class="field">
                <label>Full Description</label>
                <div class="editor-wrap">
                    <div class="quill-editor"><?= old('content', $isEdit ? $incubatee['content'] : '') ?></div>
                    <input type="hidden" name="content" class="quill-content"
                        value="<?= esc(old('content', $isEdit ? $incubatee['content'] : '')) ?>">
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

            <!-- White Logo upload (for big card) -->
            <div class="field">
                <label>White Logo <span style="font-weight:400;text-transform:none;letter-spacing:0;color:#b0aaa0">(used on the navy card)</span></label>
                <div class="upload-zone" id="uploadZoneWhite">
                    <input type="file" name="logoWhite" id="logoWhiteInput" accept="image/*">
                    <div class="label" id="uploadLabelWhite"><strong>Click to upload</strong> white version of the logo</div>
                    <div class="upload-preview" id="uploadPreviewWhite">
                        <?php if ($isEdit && ! empty($incubatee['logoWhitePath'])): ?>
                        <img src="<?= site_url($incubatee['logoWhitePath']) ?>" alt="" style="background:#03355a;padding:.5rem;border-radius:.3rem">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($isEdit && ! empty($incubatee['logoWhitePath'])): ?>
                <p style="font-size:.62rem;color:#94a3b8;margin-top:.35rem">Click to replace the current white logo</p>
                <?php endif; ?>
            </div>

            <!-- Team Members -->
            <?php
                $existingMembers = [];
                if ($isEdit && ! empty($incubatee['teamMembers'])) {
                    $existingMembers = json_decode($incubatee['teamMembers'], true) ?: [];
                }
            ?>
            <div class="tm-section">
                <span class="section-label">Team Members</span>
                <div class="tm-rows" id="tmRows">
                    <?php if (! empty($existingMembers)): ?>
                    <?php foreach ($existingMembers as $member): ?>
                    <div class="tm-row">
                        <input type="text" name="tm_name[]" value="<?= esc($member['name'] ?? '') ?>"
                            placeholder="Name">
                        <input type="text" name="tm_role[]" value="<?= esc($member['role'] ?? '') ?>"
                            placeholder="Role (e.g. CEO, CTO)">
                        <button type="button" class="tm-remove" title="Remove">×</button>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="tm-row">
                        <input type="text" name="tm_name[]" placeholder="Name">
                        <input type="text" name="tm_role[]" placeholder="Role (e.g. CEO, CTO)">
                        <button type="button" class="tm-remove" title="Remove">×</button>
                    </div>
                    <?php endif; ?>
                </div>
                <button type="button" class="tm-add" id="tmAdd">+ Add team member</button>
            </div>

            <!-- Toggle -->
            <div class="switch-row">
                <label class="switch">
                    <input type="checkbox" name="isPublished" value="1"
                        <?= old('isPublished', $isEdit ? $incubatee['isPublished'] : 0) ? 'checked' : '' ?>>
                    <span class="track"></span>
                    Publish
                </label>
            </div>

            <div class="form-actions">
                <a href="<?= site_url('admin/incubatees') ?>" class="btn-o">← Back to incubatees</a>
                <span style="flex:1"></span>
                <button type="submit" class="btn-p">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <?= $isEdit ? 'Save changes' : 'Add incubatee' ?>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
(function() {
    var zone = document.getElementById('uploadZone');
    var input = document.getElementById('logoInput');
    var preview = document.getElementById('uploadPreview');
    var label = document.getElementById('uploadLabel');

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

    zone.addEventListener('dragover', function(e) {
        e.preventDefault();
        zone.style.borderColor = '#03558C';
        zone.style.background = '#fafcff';
    });
    zone.addEventListener('dragleave', function() {
        zone.style.borderColor = '';
        zone.style.background = '';
    });
    zone.addEventListener('drop', function(e) {
        e.preventDefault();
        zone.style.borderColor = '';
        zone.style.background = '';
        var files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            input.files = files;
            input.dispatchEvent(new Event('change'));
        }
    });

    /* ── White Logo Upload Zone ── */
    var zoneW = document.getElementById('uploadZoneWhite');
    var inputW = document.getElementById('logoWhiteInput');
    var previewW = document.getElementById('uploadPreviewWhite');
    var labelW = document.getElementById('uploadLabelWhite');

    if (previewW.querySelector('img')) labelW.style.display = 'none';

    zoneW.addEventListener('click', function(e) {
        if (e.target === inputW) return;
        inputW.click();
    });

    inputW.addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            previewW.innerHTML = '<img src="' + e.target.result + '" alt="" style="background:#03355a;padding:.5rem;border-radius:.3rem">';
            labelW.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    zoneW.addEventListener('dragover', function(e) {
        e.preventDefault();
        zoneW.style.borderColor = '#03558C';
        zoneW.style.background = '#fafcff';
    });
    zoneW.addEventListener('dragleave', function() {
        zoneW.style.borderColor = '';
        zoneW.style.background = '';
    });
    zoneW.addEventListener('drop', function(e) {
        e.preventDefault();
        zoneW.style.borderColor = '';
        zoneW.style.background = '';
        var files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            inputW.files = files;
            inputW.dispatchEvent(new Event('change'));
        }
    });

    /* ── Team Members Repeater ── */
    var tmRows = document.getElementById('tmRows');
    var tmAdd = document.getElementById('tmAdd');

    tmAdd.addEventListener('click', function() {
        var row = document.createElement('div');
        row.className = 'tm-row';
        row.innerHTML = '<input type="text" name="tm_name[]" placeholder="Name">' +
            '<input type="text" name="tm_role[]" placeholder="Role (e.g. CEO, CTO)">' +
            '<button type="button" class="tm-remove" title="Remove">×</button>';
        tmRows.appendChild(row);
        row.querySelector('input').focus();
    });

    tmRows.addEventListener('click', function(e) {
        if (e.target.classList.contains('tm-remove')) {
            var row = e.target.closest('.tm-row');
            if (tmRows.querySelectorAll('.tm-row').length > 1) {
                row.remove();
            } else {
                // Last row — just clear inputs
                row.querySelectorAll('input').forEach(function(inp) {
                    inp.value = '';
                });
            }
        }
    });
})();
</script>