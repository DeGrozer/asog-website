<link rel="stylesheet" href="<?= base_url('assets/css/adminDashboard.css') ?>">

<!-- Stat pills -->
<!-- <p class="dash-subtitle">Here's what's happening with your site today.</p> -->
<div class="stat-row">
    <div class="pill">
        <div class="pill-icon blue">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10" />
            </svg>
        </div>
        <div>
            <div class="pill-n"><?= $totalPosts ?? 0 ?></div>
            <div class="pill-t">Articles</div>
        </div>
    </div>
    <div class="pill">
        <div class="pill-icon green">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div>
            <div class="pill-n"><?= $publishedPosts ?? 0 ?></div>
            <div class="pill-t">Published</div>
        </div>
    </div>
    <div class="pill">
        <div class="pill-icon amber">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <div>
            <div class="pill-n"><?= $totalApps ?? 0 ?></div>
            <div class="pill-t">Applications</div>
        </div>
    </div>
    <div class="pill">
        <div class="pill-icon rose">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <div>
            <div class="pill-n"><?= $unreadMessages ?? 0 ?></div>
            <div class="pill-t">Unread Messages</div>
        </div>
    </div>
</div>

<!-- Two-column grid: Incubatees + Admins -->
<div class="dash-grid">
    <!-- Recent Incubatees -->
    <div class="card">
        <div class="card-head">
            <h3>Recent Incubatees</h3>
            <a href="<?= site_url('admin/incubatees') ?>">View all →</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentIncubatees)): ?>
            <div class="empty-card">No incubatees yet.</div>
            <?php else: ?>
            <?php foreach ($recentIncubatees as $inc): ?>
            <div class="line-row">
                <span class="line-dot"></span>
                <div class="line-meta">
                    <strong><?= esc($inc['companyName']) ?></strong>
                    <span>
                        <?= !empty($inc['cohort']) ? esc($inc['cohort']) : 'No cohort' ?>
                        ·
                        <?= !empty($inc['createdAt']) ? date('M j, Y', strtotime($inc['createdAt'])) : 'No date' ?>
                    </span>
                </div>
                <span class="tag <?= !empty($inc['isPublished']) ? 'tag-live' : 'tag-draft' ?>">
                    <?= !empty($inc['isPublished']) ? 'Published' : 'Draft' ?>
                </span>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Admins -->
    <div class="card">
        <div class="card-head">
            <h3>Recent Admins</h3>
            <a href="<?= site_url('admin/admins') ?>">View all →</a>
        </div>
        <div class="card-body">
            <?php if (empty($recentAdmins)): ?>
            <div class="empty-card">No admins found.</div>
            <?php else: ?>
            <?php foreach ($recentAdmins as $adm): ?>
            <div class="line-row">
                <span class="line-dot"></span>
                <div class="line-meta">
                    <strong><?= esc($adm['fullName']) ?></strong>
                    <span><?= esc($adm['email']) ?></span>
                </div>
                <span class="tag <?= !empty($adm['isActive']) ? 'tag-live' : 'tag-rejected' ?>">
                    <?= !empty($adm['isActive']) ? 'Active' : 'Inactive' ?>
                </span>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
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
                <span
                    class="tag tag-<?= esc($a['applicationStatus']) ?>"><?= esc($statusLabels[$a['applicationStatus']] ?? ucfirst($a['applicationStatus'])) ?></span>
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
            <div class="empty-card">Nothing published yet. <a href="<?= site_url('admin/posts/create') ?>">Write your
                    first post.</a></div>
            <?php else: ?>
            <?php foreach ($recentPosts as $p): ?>
            <a href="<?= site_url('admin/posts/' . $p['id'] . '/edit') ?>" class="post-row">
                <?php if (! empty($p['imagePath'])): ?>
                <img src="<?= site_url($p['imagePath']) ?>" alt="" class="post-thumb" />
                <?php else: ?>
                <div class="post-thumb-empty"></div>
                <?php endif; ?>
                <div class="post-meta">
                    <strong><?= esc($p['title']) ?></strong>
                    <span><?= esc(ucfirst($p['category'])) ?> ·
                        <?= $p['publishedAt'] ? date('M j, Y', strtotime($p['publishedAt'])) : 'Draft' ?></span>
                </div>
                <span
                    class="tag <?= $p['isPublished'] ? 'tag-live' : 'tag-draft' ?>"><?= $p['isPublished'] ? 'Live' : 'Draft' ?></span>
            </a>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>