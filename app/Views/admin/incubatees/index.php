<style>
    .toolbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
    .toolbar .count{font-size:.78rem;color:#94a3b8}
    .inc-tbl{width:100%;background:#fff;border:1px solid #eceae6;border-radius:.4rem;border-collapse:separate;border-spacing:0;overflow:hidden}
    .inc-tbl th{font-size:.6rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;text-align:left;padding:.5rem 1rem;background:#fafaf9;border-bottom:1px solid #eceae6}
    .inc-tbl td{font-size:.8rem;color:#1e293b;padding:.65rem 1rem;border-bottom:1px solid #f4f3f0;vertical-align:middle}
    .inc-tbl tr:last-child td{border-bottom:none}
    .inc-tbl tbody tr:hover{background:#fafaf9}
    .tbl-logo{width:44px;height:44px;border-radius:.35rem;object-fit:cover;background:#eceae6;vertical-align:middle;border:1px solid #eceae6}
    .tbl-logo-empty{display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:.35rem;background:#edf5fc;color:#03558C;font-weight:700;font-size:.82rem;vertical-align:middle}
    .tbl-name{font-weight:600}
    .tbl-founder{font-size:.7rem;color:#94a3b8;display:block}
    .tag{font-size:.52rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:.15rem .4rem;border-radius:.15rem;white-space:nowrap}
    .tag-live{background:#ecfdf5;color:#065f46}
    .tag-draft{background:#f1f5f9;color:#64748b}
    .tag-cohort{background:#edf5fc;color:#03558C}
    .acts{display:flex;gap:.4rem}
    .acts a{font-size:.72rem;color:#03558C;text-decoration:none}
    .acts a:hover{text-decoration:underline}
    .acts .del{color:#be123c}
    .empty-row{text-align:center;padding:2rem;color:#94a3b8;font-size:.82rem}
    .empty-row a{color:#03558C;text-decoration:underline}
</style>

<div class="toolbar">
    <span class="count"><?= count($incubatees ?? []) ?> incubatees</span>
    <a href="<?= site_url('admin/incubatees/create') ?>" class="btn btn-p">New incubatee</a>
</div>

<?php if (empty($incubatees)): ?>
    <div class="empty-row">No incubatees yet. <a href="<?= site_url('admin/incubatees/create') ?>">Add one.</a></div>
<?php else: ?>
    <table class="inc-tbl">
        <thead>
            <tr>
                <th></th>
                <th>Company</th>
                <th>Cohort</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incubatees as $inc): ?>
                <tr>
                    <td>
                        <?php if (! empty($inc['logoPath'])): ?>
                            <img src="<?= site_url($inc['logoPath']) ?>" alt="" class="tbl-logo"/>
                        <?php else: ?>
                            <span class="tbl-logo-empty"><?= strtoupper(mb_substr($inc['companyName'], 0, 2)) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="tbl-name"><?= esc($inc['companyName']) ?></span>
                        <?php if (! empty($inc['founderName'])): ?>
                            <span class="tbl-founder"><?= esc($inc['founderName']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (! empty($inc['cohort'])): ?>
                            <span class="tag tag-cohort"><?= esc($inc['cohort']) ?></span>
                        <?php else: ?>
                            <span style="color:#d4d0ca">—</span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:.75rem;color:#94a3b8"><?= (int)$inc['sortOrder'] ?></td>
                    <td>
                        <span class="tag <?= $inc['isPublished'] ? 'tag-live' : 'tag-draft' ?>"><?= $inc['isPublished'] ? 'Published' : 'Draft' ?></span>
                    </td>
                    <td>
                        <div class="acts">
                            <a href="<?= site_url('admin/incubatees/' . $inc['id'] . '/edit') ?>">Edit</a>
                            <form action="<?= site_url('admin/incubatees/' . $inc['id']) ?>" method="POST" onsubmit="return confirm('Delete this incubatee?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="del" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
