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
                            <a href="<?= site_url('news/' . $p['slug']) ?>" target="_blank" title="Preview">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </a>
                            <a href="<?= site_url('admin/posts/' . $p['id'] . '/edit') ?>" title="Edit">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 7.125L16.862 4.487"/><path stroke-linecap="round" stroke-linejoin="round" d="M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                            </a>
                            <form action="<?= site_url('admin/posts/' . $p['id']) ?>" method="POST" onsubmit="return confirm('Delete this post?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="del" title="Delete">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
