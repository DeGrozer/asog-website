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
    .badge-cohort{background:#eff6ff;color:#1e40af}
    .actions{display:flex;gap:.4rem}
    .actions a,.actions button{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:.25rem;border:1px solid #e5e7eb;background:#fff;cursor:pointer;transition:all .15s;color:#64748b;font-size:.8rem;text-decoration:none}
    .actions a:hover,.actions button:hover{border-color:#03558C;color:#03558C}
    .actions button.del:hover{border-color:#ef4444;color:#ef4444}
    .empty-state{text-align:center;padding:4rem 2rem;color:#94a3b8}
    .empty-state h3{font-family:'DM Serif Display',serif;font-size:1.25rem;color:#64748b;margin-bottom:.5rem;font-weight:400}
    .empty-state p{font-size:.84rem;margin-bottom:1.25rem}
</style>

<div class="admin-toolbar">
    <span class="count"><?= count($incubatees ?? []) ?> incubatee<?= count($incubatees ?? []) !== 1 ? 's' : '' ?></span>
    <a href="<?= site_url('admin/incubatees/create') ?>" class="btn btn-gold">+ New Incubatee</a>
</div>

<?php if (empty($incubatees)): ?>
    <div class="empty-state">
        <h3>No incubatees yet</h3>
        <p>Add your first incubatee company.</p>
        <a href="<?= site_url('admin/incubatees/create') ?>" class="btn btn-primary">Add Incubatee</a>
    </div>
<?php else: ?>
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width:60px"></th>
                <th>Company</th>
                <th>Founder</th>
                <th>Cohort</th>
                <th>Status</th>
                <th style="width:100px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incubatees as $inc): ?>
                <tr>
                    <td>
                        <?php if (! empty($inc['logoPath'])): ?>
                            <img src="<?= base_url($inc['logoPath']) ?>" alt="" class="thumb"/>
                        <?php else: ?>
                            <div class="thumb-empty"><?= strtoupper(substr($inc['companyName'], 0, 2)) ?></div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong style="display:block;margin-bottom:.15rem"><?= esc($inc['companyName']) ?></strong>
                        <?php if (! empty($inc['shortDescription'])): ?>
                            <span style="font-size:.75rem;color:#94a3b8"><?= esc(character_limiter($inc['shortDescription'], 60)) ?></span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:.82rem;color:#64748b"><?= esc($inc['founderName'] ?? '—') ?></td>
                    <td>
                        <?php if (! empty($inc['cohort'])): ?>
                            <span class="badge badge-cohort"><?= esc($inc['cohort']) ?></span>
                        <?php else: ?>
                            <span style="color:#94a3b8">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($inc['isPublished']): ?>
                            <span class="badge badge-pub">Published</span>
                        <?php else: ?>
                            <span class="badge badge-draft">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="<?= site_url('admin/incubatees/' . $inc['id'] . '/edit') ?>" title="Edit">✎</a>
                            <form method="POST" action="<?= site_url('admin/incubatees/' . $inc['id']) ?>" onsubmit="return confirm('Delete this incubatee?')">
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
