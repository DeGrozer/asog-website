<style>
    /* ── Welcome banner ────────────────────── */
    .dash-welcome{background:#fff;border:1px solid #eceae6;border-radius:.45rem;padding:1.3rem 1.5rem;margin-bottom:1.4rem;display:flex;align-items:center;justify-content:space-between}
    .dash-welcome h2{font-family:'DM Serif Display',serif;font-size:1.05rem;font-weight:400;color:#1e293b;margin:0}
    .dash-welcome p{font-size:.72rem;color:#94a3b8;margin:.25rem 0 0}
    .dash-welcome .dash-date{font-size:.6rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;white-space:nowrap}

    /* ── Stat pills ────────────────────────── */
    .stat-row{display:grid;grid-template-columns:repeat(4,1fr);gap:.7rem;margin-bottom:1.6rem}
    .pill{background:#fff;border:1px solid #eceae6;border-radius:.4rem;padding:.9rem 1.1rem;display:flex;align-items:center;gap:.85rem}
    .pill-icon{width:34px;height:34px;border-radius:.3rem;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .pill-icon svg{width:16px;height:16px}
    .pill-icon.blue{background:#edf5fc;color:#03558C}
    .pill-icon.green{background:#ecfdf5;color:#065f46}
    .pill-icon.amber{background:#fef9c3;color:#854d0e}
    .pill-icon.rose{background:#fef2f2;color:#991b1b}
    .pill-n{font-family:'DM Serif Display',serif;font-size:1.35rem;color:#1e293b;line-height:1}
    .pill-t{font-size:.54rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;margin-top:.15rem}

    /* ── Two-column grid ───────────────────── */
    .dash-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem}

    /* ── Card ───────────────────────────────── */
    .card{background:#fff;border:1px solid #eceae6;border-radius:.45rem;overflow:hidden;display:flex;flex-direction:column}
    .card-head{display:flex;align-items:center;justify-content:space-between;padding:.8rem 1.1rem;border-bottom:1px solid #f1efeb}
    .card-head h3{font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#64748b;margin:0}
    .card-head a{font-size:.58rem;font-weight:600;color:#03558C;letter-spacing:.04em}
    .card-head a:hover{text-decoration:underline}
    .card-body{flex:1;min-height:0}

    /* ── Application row ───────────────────── */
    .app-row{display:flex;align-items:center;gap:.75rem;padding:.6rem 1.1rem;border-bottom:1px solid #f4f3f0;transition:background .1s}
    .app-row:last-child{border-bottom:none}
    .app-row:hover{background:#fafaf9}
    .app-avatar{width:32px;height:32px;border-radius:50%;background:#edf5fc;color:#03558C;display:flex;align-items:center;justify-content:center;font-size:.6rem;font-weight:700;flex-shrink:0;text-transform:uppercase}
    .app-meta{flex:1;min-width:0}
    .app-meta strong{display:block;font-size:.76rem;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .app-meta span{font-size:.62rem;color:#94a3b8}

    /* ── Post row ──────────────────────────── */
    .post-row{display:flex;align-items:center;gap:.75rem;padding:.6rem 1.1rem;border-bottom:1px solid #f4f3f0;transition:background .1s;text-decoration:none}
    .post-row:last-child{border-bottom:none}
    .post-row:hover{background:#fafaf9}
    .post-thumb{width:36px;height:36px;border-radius:.25rem;object-fit:cover;background:#eceae6;flex-shrink:0}
    .post-thumb-empty{width:36px;height:36px;border-radius:.25rem;background:#eceae6;flex-shrink:0}
    .post-meta{flex:1;min-width:0}
    .post-meta strong{display:block;font-size:.76rem;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .post-meta span{font-size:.62rem;color:#94a3b8}

    /* ── Tags ──────────────────────────────── */
    .tag{font-size:.48rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:.15rem .4rem;border-radius:.15rem;flex-shrink:0;white-space:nowrap}
    .tag-pending{background:#f0f4ff;color:#3730a3}
    .tag-accepted{background:#ecfdf5;color:#065f46}
    .tag-rejected{background:#fef2f2;color:#991b1b}
    .tag-live{background:#ecfdf5;color:#065f46}
    .tag-draft{background:#f1f5f9;color:#64748b}

    /* ── Empty state ───────────────────────── */
    .empty-card{text-align:center;padding:2rem 1.2rem;color:#94a3b8;font-size:.78rem}
    .empty-card a{color:#03558C;text-decoration:underline}
</style>

<!-- Welcome -->
<div class="dash-welcome">
    <div>
        <h2>Welcome back, <?= esc(session()->get('admin_name') ?? 'Admin') ?></h2>
        <p>Here's what's happening with your site today.</p>
    </div>
    <div class="dash-date"><?= date('l, M j, Y') ?></div>
</div>

<!-- Stat pills -->
<div class="stat-row">
    <div class="pill">
        <div class="pill-icon blue">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/></svg>
        </div>
        <div><div class="pill-n"><?= $totalPosts ?? 0 ?></div><div class="pill-t">Articles</div></div>
    </div>
    <div class="pill">
        <div class="pill-icon green">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <div><div class="pill-n"><?= $publishedPosts ?? 0 ?></div><div class="pill-t">Published</div></div>
    </div>
    <div class="pill">
        <div class="pill-icon amber">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div><div class="pill-n"><?= $totalApps ?? 0 ?></div><div class="pill-t">Applications</div></div>
    </div>
    <div class="pill">
        <div class="pill-icon rose">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div><div class="pill-n"><?= $pendingApps ?? 0 ?></div><div class="pill-t">Under Review</div></div>
    </div>
</div>

<!-- Two-column grid: Applications + Articles -->
<div class="dash-grid">
    <!-- Recent Applications -->
    <div class="card">
        <div class="card-head">
            <h3>Recent Applications</h3>
            <a href="<?= site_url('admin/applications') ?>">View all →</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentApps)): ?>
                <div class="empty-card">No applications yet.</div>
            <?php else: ?>
                <?php foreach ($recentApps as $a): ?>
                    <?php $initials = implode('', array_map(fn($w) => $w[0] ?? '', array_slice(explode(' ', $a['applicantName']), 0, 2))); ?>
                    <div class="app-row">
                        <div class="app-avatar"><?= esc($initials) ?></div>
                        <div class="app-meta">
                            <strong><?= esc($a['startupName']) ?></strong>
                            <span><?= esc($a['applicantName']) ?> · <?= date('M j', strtotime($a['createdAt'])) ?></span>
                        </div>
                        <?php $statusLabels = ['pending' => 'Under Review', 'accepted' => 'Accepted', 'rejected' => 'Rejected', 'reviewed' => 'Reviewed']; ?>
                        <span class="tag tag-<?= esc($a['applicationStatus']) ?>"><?= esc($statusLabels[$a['applicationStatus']] ?? ucfirst($a['applicationStatus'])) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Articles -->
    <div class="card">
        <div class="card-head">
            <h3>Recent Articles</h3>
            <a href="<?= site_url('admin/posts') ?>">View all →</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentPosts)): ?>
                <div class="empty-card">Nothing published yet. <a href="<?= site_url('admin/posts/create') ?>">Write your first post.</a></div>
            <?php else: ?>
                <?php foreach ($recentPosts as $p): ?>
                    <a href="<?= site_url('admin/posts/' . $p['id'] . '/edit') ?>" class="post-row">
                        <?php if (! empty($p['imagePath'])): ?>
                            <img src="<?= site_url($p['imagePath']) ?>" alt="" class="post-thumb"/>
                        <?php else: ?>
                            <div class="post-thumb-empty"></div>
                        <?php endif; ?>
                        <div class="post-meta">
                            <strong><?= esc($p['title']) ?></strong>
                            <span><?= esc(ucfirst($p['category'])) ?> · <?= $p['publishedAt'] ? date('M j, Y', strtotime($p['publishedAt'])) : 'Draft' ?></span>
                        </div>
                        <span class="tag <?= $p['isPublished'] ? 'tag-live' : 'tag-draft' ?>"><?= $p['isPublished'] ? 'Live' : 'Draft' ?></span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
