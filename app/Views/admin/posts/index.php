<style>
    .toolbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
    .toolbar .count{font-size:.78rem;color:#94a3b8}
    .posts-tbl{width:100%;background:#fff;border:1px solid #eceae6;border-radius:.4rem;border-collapse:separate;border-spacing:0;overflow:hidden}
    .posts-tbl th{font-size:.6rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;text-align:left;padding:.5rem 1rem;background:#fafaf9;border-bottom:1px solid #eceae6}
    .posts-tbl td{font-size:.8rem;color:#1e293b;padding:.65rem 1rem;border-bottom:1px solid #f4f3f0;vertical-align:middle}
    .posts-tbl tr:last-child td{border-bottom:none}
    .posts-tbl tbody tr:hover{background:#fafaf9}
    .tbl-thumb{width:36px;height:36px;border-radius:.25rem;object-fit:cover;background:#eceae6;vertical-align:middle}
    .tbl-thumb-empty{display:inline-block;width:36px;height:36px;border-radius:.25rem;background:#eceae6;vertical-align:middle}
    .tbl-title{font-weight:600}
    .tbl-desc{font-size:.7rem;color:#94a3b8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:220px;display:block}
    .tag{font-size:.52rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:.15rem .4rem;border-radius:.15rem;white-space:nowrap}
    .tag-live{background:#ecfdf5;color:#065f46}
    .tag-draft{background:#f1f5f9;color:#64748b}
    .tag-feat{background:#fef3c7;color:#92400e}
    .tag-cat{background:#edf5fc;color:#03558C}
    .acts{display:flex;gap:.4rem}
    .acts a{font-size:.72rem;color:#03558C;text-decoration:none}
    .acts a:hover{text-decoration:underline}
    .acts .del{color:#be123c}
    .empty-row{text-align:center;padding:2rem;color:#94a3b8;font-size:.82rem}
    .empty-row a{color:#03558C;text-decoration:underline}
    .pagination{display:flex;align-items:center;gap:.25rem;margin-top:1rem;font-size:.78rem}
    .pagination a,.pagination span{padding:.3rem .6rem;border-radius:.25rem;text-decoration:none;color:#03558C}
    .pagination .cur{background:#03558C;color:#fff}
</style>

<div class="toolbar">
    <span class="count"><?= count($posts ?? []) ?> posts</span>
    <a href="<?= site_url('admin/posts/create') ?>" class="btn-p">New post</a>
</div>

<?php if (empty($posts)): ?>
    <div class="empty-row">No posts yet. <a href="<?= site_url('admin/posts/create') ?>">Create one.</a></div>
<?php else: ?>
    <table class="posts-tbl">
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $p): ?>
                <tr>
                    <td>
                        <?php if (! empty($p['imagePath'])): ?>
                            <img src="<?= site_url($p['imagePath']) ?>" alt="" class="tbl-thumb"/>
                        <?php else: ?>
                            <span class="tbl-thumb-empty"></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="tbl-title"><?= esc($p['title']) ?></span>
                        <?php if (! empty($p['shortDescription'])): ?>
                            <span class="tbl-desc"><?= esc($p['shortDescription']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td><span class="tag tag-cat"><?= esc(ucfirst($p['category'])) ?></span></td>
                    <td>
                        <span class="tag <?= $p['isPublished'] ? 'tag-live' : 'tag-draft' ?>"><?= $p['isPublished'] ? 'Published' : 'Draft' ?></span>
                        <?php if (! empty($p['isFeatured'])): ?>
                            <span class="tag tag-feat">Featured</span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:.72rem;color:#94a3b8;white-space:nowrap"><?= $p['publishedAt'] ? date('M j, Y', strtotime($p['publishedAt'])) : '—' ?></td>
                    <td>
                        <div class="acts">
                            <a href="<?= site_url('admin/posts/' . $p['id'] . '/edit') ?>">Edit</a>
                            <form action="<?= site_url('admin/posts/' . $p['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Delete this post?')">
                                <?= csrf_field() ?>
                                <button type="submit" class="del" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
