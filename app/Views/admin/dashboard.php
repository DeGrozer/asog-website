<style>
    .grid-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:.85rem;margin-bottom:1.8rem}
    .stat{background:#fff;border:1px solid #eceae6;border-radius:.4rem;padding:1.1rem 1.2rem}
    .stat .n{font-family:'DM Serif Display',serif;font-size:1.6rem;color:#03558C;line-height:1}
    .stat .t{font-size:.6rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;margin-top:.3rem}
    .sec-title{font-size:.78rem;font-weight:600;color:#1e293b;margin-bottom:.8rem}
    .list{background:#fff;border:1px solid #eceae6;border-radius:.4rem;overflow:hidden}
    .row{display:flex;align-items:center;gap:.85rem;padding:.7rem 1rem;border-bottom:1px solid #f4f3f0;transition:background .1s}
    .row:last-child{border-bottom:none}
    .row:hover{background:#fafaf9}
    .row-img{width:38px;height:38px;border-radius:.25rem;object-fit:cover;background:#eceae6;flex-shrink:0}
    .row-img-empty{width:38px;height:38px;border-radius:.25rem;background:#eceae6;flex-shrink:0}
    .row-meta{flex:1;min-width:0}
    .row-meta strong{display:block;font-size:.8rem;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .row-meta span{font-size:.68rem;color:#94a3b8}
    .tag{font-size:.52rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:.15rem .4rem;border-radius:.15rem;flex-shrink:0}
    .tag-live{background:#ecfdf5;color:#065f46}
    .tag-draft{background:#f1f5f9;color:#64748b}
    .empty{text-align:center;padding:2.5rem 1.5rem;color:#94a3b8;font-size:.82rem}
    .empty a{color:#03558C;text-decoration:underline}
</style>

<div class="grid-stats">
    <div class="stat"><div class="n"><?= $totalPosts ?? 0 ?></div><div class="t">Total</div></div>
    <div class="stat"><div class="n"><?= $publishedPosts ?? 0 ?></div><div class="t">Published</div></div>
    <div class="stat"><div class="n"><?= $draftPosts ?? 0 ?></div><div class="t">Drafts</div></div>
    <div class="stat"><div class="n"><?= $featuredPosts ?? 0 ?></div><div class="t">Featured</div></div>
</div>

<div class="sec-title">Recent posts</div>
<?php if (empty($recentPosts)): ?>
    <div class="list"><div class="empty">Nothing published yet. <a href="<?= site_url('admin/posts/create') ?>">Write your first post.</a></div></div>
<?php else: ?>
    <div class="list">
        <?php foreach ($recentPosts as $p): ?>
            <a href="<?= site_url('admin/posts/' . $p['id'] . '/edit') ?>" class="row" style="text-decoration:none">
                <?php if (! empty($p['imagePath'])): ?>
                    <img src="<?= site_url($p['imagePath']) ?>" alt="" class="row-img"/>
                <?php else: ?>
                    <div class="row-img-empty"></div>
                <?php endif; ?>
                <div class="row-meta">
                    <strong><?= esc($p['title']) ?></strong>
                    <span><?= esc(ucfirst($p['category'])) ?> &middot; <?= $p['publishedAt'] ? date('M j, Y', strtotime($p['publishedAt'])) : 'Draft' ?></span>
                </div>
                <span class="tag <?= $p['isPublished'] ? 'tag-live' : 'tag-draft' ?>"><?= $p['isPublished'] ? 'Live' : 'Draft' ?></span>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
