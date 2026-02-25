<style>
    .settings-grid{display:grid;gap:2rem;max-width:860px}
    .settings-section{background:#fff;border-radius:.5rem;box-shadow:0 1px 4px rgba(0,0,0,.04);overflow:hidden}
    .section-head{padding:1rem 1.5rem;background:#f9fafb;border-bottom:1px solid #e8e5e0;display:flex;align-items:center;gap:.5rem}
    .section-head h3{font-family:'DM Serif Display',serif;font-size:1rem;font-weight:400;color:#03558C}
    .section-body{padding:1.25rem 1.5rem;display:grid;grid-template-columns:1fr 1fr;gap:1rem}
    .section-body .full{grid-column:1/-1}
    .field{display:flex;flex-direction:column;gap:.3rem}
    .field label{font-size:.62rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#03558C}
    .field input[type="text"],
    .field input[type="email"],
    .field textarea{width:100%;padding:.55rem .75rem;border:1px solid #d4d0cb;border-radius:.3rem;font-size:.85rem;font-family:'DM Sans',sans-serif;color:#1e293b;background:#fff;outline:none;transition:border .2s}
    .field input:focus,
    .field textarea:focus{border-color:#F8AF21;box-shadow:0 0 0 3px rgba(248,175,33,.1)}
    .field textarea{resize:vertical;min-height:80px}
    .field .hint{font-size:.7rem;color:#94a3b8}
    .settings-footer{padding:1.25rem 1.5rem;border-top:1px solid #f1f0ed;display:flex;gap:.75rem}
    .quill-editor{min-height:160px;background:#fff;border:1px solid #d4d0cb;border-top:none;border-radius:0 0 .3rem .3rem;font-family:'DM Sans',sans-serif;font-size:.85rem}
    .quill-editor .ql-editor{min-height:160px}
</style>

<form method="POST" action="<?= site_url('admin/settings') ?>">
    <?= csrf_field() ?>

    <div class="settings-grid">

        <!-- ── About Section ── -->
        <div class="settings-section">
            <div class="section-head"><h3>About Section</h3></div>
            <div class="section-body">
                <div class="field">
                    <label>Title</label>
                    <input type="text" name="aboutTitle" value="<?= esc($about['aboutTitle'] ?? '') ?>">
                </div>
                <div class="field">
                    <label>Subtitle</label>
                    <input type="text" name="aboutSubtitle" value="<?= esc($about['aboutSubtitle'] ?? '') ?>">
                </div>
                <div class="field full">
                    <label>Content</label>
                    <input type="hidden" name="aboutContent" class="quill-content"
                           value="<?= esc($about['aboutContent'] ?? '') ?>">
                    <div class="quill-editor"></div>
                </div>
                <div class="field full">
                    <label>Tags (comma-separated)</label>
                    <input type="text" name="aboutTags" value="<?= esc($about['aboutTags'] ?? '') ?>"
                           placeholder="AI Research,Food Value Chain,...">
                </div>
            </div>
        </div>

        <!-- ── Hero Section ── -->
        <div class="settings-section">
            <div class="section-head"><h3>Hero Section</h3></div>
            <div class="section-body">
                <div class="field full">
                    <label>Tagline</label>
                    <input type="text" name="heroTagline" value="<?= esc($hero['heroTagline'] ?? '') ?>"
                           placeholder="Join the Ecosystem">
                    <span class="hint">Small text above the hero title.</span>
                </div>
            </div>
        </div>

        <!-- ── CTA Section ── -->
        <div class="settings-section">
            <div class="section-head"><h3>Call to Action</h3></div>
            <div class="section-body">
                <div class="field full">
                    <label>Title</label>
                    <input type="text" name="ctaTitle" value="<?= esc($cta['ctaTitle'] ?? '') ?>">
                </div>
                <div class="field full">
                    <label>Description</label>
                    <textarea name="ctaDescription" rows="2"><?= esc($cta['ctaDescription'] ?? '') ?></textarea>
                </div>
                <div class="field">
                    <label>Primary Button Text</label>
                    <input type="text" name="ctaButtonText" value="<?= esc($cta['ctaButtonText'] ?? '') ?>">
                </div>
                <div class="field">
                    <label>Primary Button URL</label>
                    <input type="text" name="ctaButtonUrl" value="<?= esc($cta['ctaButtonUrl'] ?? '') ?>">
                </div>
                <div class="field">
                    <label>Secondary Button Text</label>
                    <input type="text" name="ctaSecondaryText" value="<?= esc($cta['ctaSecondaryText'] ?? '') ?>">
                </div>
                <div class="field">
                    <label>Secondary Button URL</label>
                    <input type="text" name="ctaSecondaryUrl" value="<?= esc($cta['ctaSecondaryUrl'] ?? '') ?>">
                </div>
            </div>
        </div>

        <!-- ── Contact Section ── -->
        <div class="settings-section">
            <div class="section-head"><h3>Contact Info</h3></div>
            <div class="section-body">
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="contactEmail" value="<?= esc($contact['contactEmail'] ?? '') ?>">
                </div>
                <div class="field">
                    <label>Phone</label>
                    <input type="text" name="contactPhone" value="<?= esc($contact['contactPhone'] ?? '') ?>">
                </div>
                <div class="field full">
                    <label>Address</label>
                    <input type="text" name="contactAddress" value="<?= esc($contact['contactAddress'] ?? '') ?>">
                </div>
                <div class="field">
                    <label>Facebook URL</label>
                    <input type="text" name="facebookUrl" value="<?= esc($contact['facebookUrl'] ?? '') ?>">
                </div>
                <div class="field">
                    <label>Instagram URL</label>
                    <input type="text" name="instagramUrl" value="<?= esc($contact['instagramUrl'] ?? '') ?>">
                </div>
            </div>
        </div>

    </div>

    <div class="settings-footer" style="max-width:860px;margin-top:1.5rem">
        <button type="submit" class="btn btn-gold">Save Settings</button>
    </div>
</form>
