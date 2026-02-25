<style>
    .admin-toolbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem}
    .admin-toolbar .count{font-size:.82rem;color:#64748b}
    .admin-table{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border-radius:.5rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04)}
    .admin-table th{text-align:left;padding:.65rem 1rem;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#64748b;background:#f9fafb;border-bottom:1px solid #e8e5e0}
    .admin-table td{padding:.75rem 1rem;font-size:.84rem;color:#334155;border-bottom:1px solid #f1f0ed;vertical-align:middle}
    .admin-table tr:last-child td{border-bottom:none}
    .admin-table tr:hover td{background:#fafaf8}
    .thumb{width:48px;height:48px;border-radius:.3rem;object-fit:cover;background:#e8e5e0;display:block}
    .thumb-empty{width:48px;height:48px;border-radius:.3rem;background:#e8e5e0;display:flex;align-items:center;justify-content:center;font-size:.5rem;color:#a5a09a;text-transform:uppercase;letter-spacing:.08em}
    .badge{display:inline-block;font-size:.58rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;padding:.2rem .55rem;border-radius:.2rem}
    .badge-pub{background:#ecfdf5;color:#065f46}
    .badge-draft{background:#f1f5f9;color:#64748b}
    .actions{display:flex;gap:.4rem}
    .actions a,.actions button{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:.25rem;border:1px solid #e5e7eb;background:#fff;cursor:pointer;transition:all .15s;color:#64748b;font-size:.8rem;text-decoration:none}
    .actions a:hover,.actions button:hover{border-color:#03558C;color:#03558C}
    .actions button.del:hover{border-color:#ef4444;color:#ef4444}
    .empty-state{text-align:center;padding:4rem 2rem;color:#94a3b8}
    .empty-state h3{font-family:'DM Serif Display',serif;font-size:1.25rem;color:#64748b;margin-bottom:.5rem;font-weight:400}
    .empty-state p{font-size:.84rem;margin-bottom:1.25rem}
    .sort-num{font-size:.72rem;color:#94a3b8;font-weight:600}
</style>

<div class="admin-toolbar">
    <span class="count"><?= count($programs ?? []) ?> program<?= count($programs ?? []) !== 1 ? 's' : '' ?></span>
    <a href="<?= site_url('admin/programs/create') ?>" class="btn btn-gold">+ New Program</a>
</div>

<?php if (empty($programs)): ?>
    <div class="empty-state">
        <h3>No programs yet</h3>
        <p>Create your first program to get started.</p>
        <a href="<?= site_url('admin/programs/create') ?>" class="btn btn-primary">Create Program</a>
    </div>
<?php else: ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width:60px"></th>
                <th>Title</th>
                <th style="width:70px">Order</th>
                <th>Status</th>
                <th style="width:100px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($programs as $program): ?>
                <tr>
                    <td>
                        <?php if (! empty($program['imagePath'])): ?>
                            <img src="<?= base_url($program['imagePath']) ?>" alt="" class="thumb"/>
                        <?php else: ?>
                            <div class="thumb-empty">No img</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong style="display:block;margin-bottom:.15rem"><?= esc($program['title']) ?></strong>
                        <?php if (! empty($program['shortDescription'])): ?>
                            <span style="font-size:.75rem;color:#94a3b8"><?= esc(character_limiter($program['shortDescription'], 70)) ?></span>
                        <?php endif; ?>
                    </td>
                    <td><span class="sort-num"><?= $program['sortOrder'] ?></span></td>
                    <td>
                        <?php if ($program['isPublished']): ?>
                            <span class="badge badge-pub">Published</span>
                        <?php else: ?>
                            <span class="badge badge-draft">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="<?= site_url('admin/programs/' . $program['id'] . '/edit') ?>" title="Edit">✎</a>
                            <form method="POST" action="<?= site_url('admin/programs/' . $program['id']) ?>" onsubmit="return confirm('Delete this program?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE"/>
                                <button type="submit" class="del" title="Delete">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
