<link rel="stylesheet" href="<?= base_url('assets/css/adminPosts.css') ?>">

<div class="toolbar">
    <span class="count"><?= count($posts ?? []) ?> posts</span>
    <a href="<?= site_url('admin/posts/create') ?>" class="btn btn-p">New post</a>
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
                            <span class="tbl-thumb-empty">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
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
                            <form action="<?= site_url('admin/posts/' . $p['id']) ?>" method="POST" onsubmit="return confirm('Delete this post?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="del" style="background:none;border:none;cursor:pointer;font:inherit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
