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
    ? site_url('admin/posts/' . $post['id'] . '/update')
    : site_url('admin/posts/store');
?>

<style>
    .form-card{background:#fff;border:1px solid #eceae6;border-radius:.4rem;padding:1.4rem}
    .form-grid{display:grid;gap:1rem}
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
    .field label{display:block;font-size:.62rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8;margin-bottom:.3rem}
    .field input[type=text],
    .field input[type=date],
    .field textarea,
    .field select{width:100%;font-family:'DM Sans',sans-serif;font-size:.82rem;color:#1e293b;padding:.5rem .65rem;border:1px solid #ddd;border-radius:.25rem;background:#fff;outline:none;transition:border .15s}
    .field input:focus,.field textarea:focus,.field select:focus{border-color:#03558C}
    .field textarea{resize:vertical;min-height:70px}
    .editor-wrap{border:1px solid #ddd;border-radius:.25rem;overflow:hidden}
    .editor-wrap .ql-toolbar{border:none;border-bottom:1px solid #eee;background:#fafaf9}
    .editor-wrap .ql-container{border:none;font-family:'DM Sans',sans-serif;font-size:.82rem;min-height:200px}
    .upload-zone{border:1.5px dashed #d4d0ca;border-radius:.35rem;padding:1.2rem;text-align:center;cursor:pointer;transition:border-color .15s,background .15s}
    .upload-zone:hover{border-color:#03558C;background:#fafcff}
    .upload-zone input{display:none}
    .upload-zone .label{font-size:.78rem;color:#94a3b8}
    .upload-zone .label strong{color:#03558C}
    .upload-preview{margin-top:.5rem}
    .upload-preview img{max-height:140px;border-radius:.25rem}
    .switch-row{display:flex;gap:1.5rem;align-items:center;margin-top:.25rem}
    .switch{display:flex;align-items:center;gap:.45rem;cursor:pointer;font-size:.78rem;color:#334155}
    .switch input{display:none}
    .switch .track{width:32px;height:18px;border-radius:9px;background:#d4d0ca;position:relative;transition:background .2s}
    .switch input:checked + .track{background:#03558C}
    .switch .track::after{content:'';position:absolute;top:2px;left:2px;width:14px;height:14px;border-radius:50%;background:#fff;transition:transform .2s}
    .switch input:checked + .track::after{transform:translateX(14px)}
    .form-actions{display:flex;gap:.5rem;justify-content:flex-end;margin-top:.25rem}
</style>

<form action="<?= $formUrl ?>" method="POST" enctype="multipart/form-data" id="postForm">
    <?= csrf_field() ?>
    <div class="form-card">
        <div class="form-grid">

            <!-- Title -->
            <div class="field">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= esc($isEdit ? $post['title'] : old('title')) ?>" required placeholder="Post title">
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
                    <input type="text" id="authorName" name="authorName" value="<?= esc($isEdit ? $post['authorName'] : (old('authorName') ?: 'ASOG TBI')) ?>" placeholder="Author name">
                </div>
            </div>

            <!-- Published date -->
            <div class="field">
                <label for="publishedAt">Publication date</label>
                <input type="date" id="publishedAt" name="publishedAt" value="<?= esc($isEdit && !empty($post['publishedAt']) ? date('Y-m-d', strtotime($post['publishedAt'])) : old('publishedAt')) ?>" placeholder="Leave blank for today">
            </div>

            <!-- Short description -->
            <div class="field">
                <label for="shortDescription">Short description</label>
                <textarea id="shortDescription" name="shortDescription" rows="2" placeholder="A brief summary shown in previews"><?= esc($isEdit ? $post['shortDescription'] : old('shortDescription')) ?></textarea>
            </div>

            <!-- Content (Quill) -->
            <div class="field">
                <label>Content</label>
                <div class="editor-wrap">
                    <div class="quill-editor"><?= $isEdit ? $post['content'] : old('content') ?></div>
                </div>
                <input type="hidden" name="content" class="quill-content" value="<?= esc($isEdit ? $post['content'] : old('content')) ?>">
            </div>

            <!-- Image upload -->
            <div class="field">
                <label>Cover image</label>
                <div class="upload-zone" id="uploadZone" onclick="document.getElementById('imageInput').click()">
                    <input type="file" name="image" id="imageInput" accept="image/*">
                    <div class="label"><strong>Click to upload</strong> or drag an image here</div>
                    <div class="upload-preview" id="uploadPreview">
                        <?php if ($isEdit && ! empty($post['imagePath'])): ?>
                            <img src="<?= site_url($post['imagePath']) ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Toggles -->
            <div class="switch-row">
                <label class="switch">
                    <input type="checkbox" name="isPublished" value="1" <?= ($isEdit && $post['isPublished']) ? 'checked' : '' ?>>
                    <span class="track"></span>
                    Publish
                </label>
                <label class="switch">
                    <input type="checkbox" name="isFeatured" value="1" <?= ($isEdit && ! empty($post['isFeatured'])) ? 'checked' : '' ?>>
                    <span class="track"></span>
                    Featured
                </label>
            </div>

            <div class="form-actions">
                <a href="<?= site_url('admin/posts') ?>" class="btn-g">Cancel</a>
                <button type="submit" class="btn-p"><?= $isEdit ? 'Save changes' : 'Publish post' ?></button>
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById('imageInput').addEventListener('change', function () {
    const file = this.files[0];
    if (! file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        document.getElementById('uploadPreview').innerHTML = '<img src="' + e.target.result + '" alt="">';
    };
    reader.readAsDataURL(file);
});
</script>
