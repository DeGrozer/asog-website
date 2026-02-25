<style>
    .stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;margin-bottom:2rem}
    .stat-card{background:#fff;border-radius:.5rem;padding:1.25rem 1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.04)}
    .stat-card .num{font-family:'DM Serif Display',serif;font-size:1.8rem;color:#03558C;line-height:1}
    .stat-card .label{font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;margin-top:.35rem}
    .recent-section h3{font-family:'DM Serif Display',serif;font-size:1.1rem;color:#03558C;font-weight:400;margin-bottom:1rem}
    .recent-list{background:#fff;border-radius:.5rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04)}
    .recent-item{display:flex;align-items:center;gap:1rem;padding:.85rem 1.25rem;border-bottom:1px solid #f1f0ed;transition:background .15s}
    .recent-item:last-child{border-bottom:none}
    .recent-item:hover{background:#fafaf8}
    .recent-item .thumb{width:40px;height:40px;border-radius:.25rem;object-fit:cover;background:#e8e5e0;flex-shrink:0}
    .recent-item .meta{flex:1;min-width:0}
    .recent-item .meta strong{display:block;font-size:.84rem;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .recent-item .meta span{font-size:.72rem;color:#94a3b8}
    .recent-item .badge-sm{font-size:.55rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;padding:.15rem .45rem;border-radius:.15rem;flex-shrink:0}
    .badge-sm.pub{background:#ecfdf5;color:#065f46}
    .badge-sm.draft{background:#f1f5f9;color:#64748b}
    .quick-links{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-top:2rem}
    .quick-link{display:flex;align-items:center;gap:.75rem;background:#fff;border-radius:.5rem;padding:1rem 1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.04);text-decoration:none;transition:box-shadow .2s,transform .2s}
    .quick-link:hover{box-shadow:0 4px 12px rgba(0,0,0,.08);transform:translateY(-1px)}
    .quick-link .icon{width:36px;height:36px;border-radius:.3rem;background:#03558C;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .quick-link .icon svg{width:18px;height:18px;color:#F8AF21}
    .quick-link .ql-text strong{display:block;font-size:.84rem;color:#1e293b}
    .quick-link .ql-text span{font-size:.72rem;color:#94a3b8}
</style>

<!-- Stats -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="num"><?= $totalPosts ?? 0 ?></div>
        <div class="label">Total Posts</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $publishedPosts ?? 0 ?></div>
        <div class="label">Published</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $draftPosts ?? 0 ?></div>
        <div class="label">Drafts</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $featuredPosts ?? 0 ?></div>
        <div class="label">Featured</div>
    </div>
</div>

<!-- Recent Posts -->
<div class="recent-section">
    <h3>Recent Posts</h3>
    <?php if (empty($recentPosts)): ?>
        <div class="recent-list" style="padding:2rem;text-align:center;color:#94a3b8;font-size:.84rem">
            No posts yet. <a href="<?= site_url('admin/posts/create') ?>" style="color:#03558C;text-decoration:underline">Create one</a>.
        </div>
    <?php else: ?>
        <div class="recent-list">
            <?php foreach ($recentPosts as $p): ?>
                <a href="<?= site_url('admin/posts/' . $p['id'] . '/edit') ?>" class="recent-item" style="text-decoration:none">
                    <?php if (! empty($p['imagePath'])): ?>
                        <img src="<?= site_url($p['imagePath']) ?>" alt="" class="thumb"/>
                    <?php else: ?>
                        <div class="thumb" style="display:flex;align-items:center;justify-content:center;font-size:.45rem;color:#a5a09a;text-transform:uppercase;letter-spacing:.06em">IMG</div>
                    <?php endif; ?>
                    <div class="meta">
                        <strong><?= esc($p['title']) ?></strong>
                        <span><?= esc(ucfirst($p['category'])) ?> · <?= $p['publishedAt'] ? date('M j, Y', strtotime($p['publishedAt'])) : 'Draft' ?></span>
                    </div>
                    <span class="badge-sm <?= $p['isPublished'] ? 'pub' : 'draft' ?>"><?= $p['isPublished'] ? 'Live' : 'Draft' ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Quick Links -->
<div class="quick-links">
    <a href="<?= site_url('admin/posts/create') ?>" class="quick-link">
        <div class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg></div>
        <div class="ql-text"><strong>New Post</strong><span>Create a blog post</span></div>
    </a>
    <a href="<?= site_url('admin/posts') ?>" class="quick-link">
        <div class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/></svg></div>
        <div class="ql-text"><strong>All Posts</strong><span>Manage existing content</span></div>
    </a>
    <a href="<?= site_url('/') ?>" class="quick-link" target="_blank">
        <div class="icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></div>
        <div class="ql-text"><strong>View Website</strong><span>Open public site</span></div>
    </a>
</div>
