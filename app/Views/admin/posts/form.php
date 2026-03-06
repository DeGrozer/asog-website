<?php
/**
 * Post form — shared for Create and Edit.
 *
 * Variables:
 *   $pageTitle  — "New Post" or "Edit Post"
 *   $post       — (edit only) associative array of current values
 *   $activePage — always "posts"
 */

$isEdit  = isset($post);
$formUrl = $isEdit
    ? site_url('admin/posts/' . $post['id'])
    : site_url('admin/posts');
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
.field input[type=date],
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
    max-height: 220px;
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
.form-actions .btn-g,
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

.form-actions .btn-g {
    background: #F8AF21;
    color: #1e293b
}

.form-actions .btn-g:hover {
    background: #e9a210
}
</style>

<form action="<?= $formUrl ?>" method="POST" enctype="multipart/form-data" id="postForm">
    <?= csrf_field() ?>
    <?php if ($isEdit): ?>
    <input type="hidden" name="_method" value="PUT" />
    <?php endif; ?>
    <div class="form-card">
        <div class="form-grid">

            <!-- Title -->
            <div class="field">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= esc($isEdit ? $post['title'] : old('title')) ?>"
                    required placeholder="Post title">
            </div>

            <!-- Category + Author -->
            <div class="form-row">
                <div class="field">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <?php
                        $cat = $isEdit ? $post['category'] : old('category');
                        foreach (['news', 'events', 'features'] as $c):
                        ?>
                        <option value="<?= $c ?>" <?= $cat === $c ? 'selected' : '' ?>><?= ucfirst($c) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <label for="authorName">Author</label>
                    <input type="text" id="authorName" name="authorName"
                        value="<?= esc($isEdit ? $post['authorName'] : (old('authorName') ?: 'ASOG TBI')) ?>"
                        placeholder="Author name">
                </div>
            </div>

            <!-- Published date -->
            <div class="field">
                <label for="publishedAt">Publication date</label>
                <input type="date" id="publishedAt" name="publishedAt"
                    value="<?= esc($isEdit && !empty($post['publishedAt']) ? date('Y-m-d', strtotime($post['publishedAt'])) : old('publishedAt')) ?>"
                    placeholder="Leave blank for today">
            </div>

            <!-- Short description -->
            <div class="field">
                <label for="shortDescription">Short description</label>
                <textarea id="shortDescription" name="shortDescription" rows="2"
                    placeholder="A brief summary shown in previews"><?= esc($isEdit ? $post['shortDescription'] : old('shortDescription')) ?></textarea>
            </div>

            <!-- Content (Quill) -->
            <div class="field">
                <label>Content</label>
                <div class="editor-wrap">
                    <div class="quill-editor"><?= $isEdit ? $post['content'] : old('content') ?></div>
                    <input type="hidden" name="content" class="quill-content"
                        value="<?= esc($isEdit ? $post['content'] : old('content')) ?>">
                </div>
            </div>

            <!-- Image upload -->
            <div class="field">
                <label>Cover image</label>
                <div class="upload-zone" id="uploadZone">
                    <input type="file" name="image" id="imageInput" accept="image/*">
                    <div class="label" id="uploadLabel"><strong>Click to upload</strong> or drag an image here</div>
                    <div class="upload-preview" id="uploadPreview">
                        <?php if ($isEdit && ! empty($post['imagePath'])): ?>
                        <img src="<?= site_url($post['imagePath']) ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($isEdit && ! empty($post['imagePath'])): ?>
                <p style="font-size:.62rem;color:#94a3b8;margin-top:.35rem">Click the image to replace the current cover
                </p>
                <?php endif; ?>
            </div>

            <!-- Toggles -->
            <div class="switch-row">
                <label class="switch">
                    <input type="checkbox" name="isPublished" value="1"
                        <?= ($isEdit && $post['isPublished']) ? 'checked' : '' ?>>
                    <span class="track"></span>
                    Publish
                </label>
                <label class="switch">
                    <input type="checkbox" name="isFeatured" value="1"
                        <?= ($isEdit && ! empty($post['isFeatured'])) ? 'checked' : '' ?>>
                    <span class="track"></span>
                    Featured <span style="font-size:.65rem;color:#94a3b8;font-weight:400">(up to 5 show in hero)</span>
                </label>
            </div>

            <div class="form-actions">
                <a href="<?= site_url('admin/posts') ?>" class="btn-o">← Back to posts</a>
                <span style="flex:1"></span>
                <button type="submit" class="btn-p">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <?= $isEdit ? 'Save changes' : 'Publish post' ?>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
(function() {
    var zone = document.getElementById('uploadZone');
    var input = document.getElementById('imageInput');
    var preview = document.getElementById('uploadPreview');
    var label = document.getElementById('uploadLabel');

    // Hide prompt if there's already an image
    if (preview.querySelector('img')) {
        label.style.display = 'none';
    }

    // Click anywhere on zone → open file picker
    zone.addEventListener('click', function(e) {
        if (e.target === input) return; // avoid re-trigger
        input.click();
    });

    // Show preview on file select
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

    // Drag & drop support
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
})();
</script>