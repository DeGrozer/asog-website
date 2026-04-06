<style>
    .lf-panel{margin-top:1rem;background:#fff;border:1px solid #eceae6;border-radius:.45rem;padding:.9rem 1rem}
    .lf-wrap{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:end;gap:.8rem}
    .lf-copy{display:flex;flex-direction:column;gap:.2rem;min-width:260px;flex:1}
    .lf-kicker{font-size:.56rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8}
    .lf-title{font-size:.86rem;font-weight:700;color:#1e293b;line-height:1.2;margin:0}
    .lf-desc{font-size:.72rem;line-height:1.42;color:#64748b;max-width:640px}
    .lf-form{display:flex;flex-wrap:wrap;align-items:end;gap:.5rem}
    .lf-field{display:flex;flex-direction:column;gap:.28rem}
    .lf-label{font-size:.56rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8}
    .lf-select{min-width:210px;font-size:.78rem;color:#1e293b;border:1px solid #d8dbe1;border-radius:.3rem;padding:.48rem .58rem;background:#fff}
    .lf-select:focus{outline:none;border-color:#03558C}

    @media (max-width: 740px){
        .lf-form{width:100%}
        .lf-field{width:100%}
        .lf-select{width:100%;min-width:0}
    }

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
    .tag{font-size:.52rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:.15rem .4rem;border-radius:.15rem;white-space:nowrap}
    .tag-live{background:#ecfdf5;color:#065f46}
    .tag-draft{background:#f1f5f9;color:#64748b}
    .tag-cohort{background:#edf5fc;color:#03558C}
    .acts{display:flex;align-items:center;gap:.35rem}
    .acts form{margin:0}
    .act-btn{display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:.35rem;border:1px solid #e4e2dd;background:#fff;color:#64748b;cursor:pointer;transition:all .15s;text-decoration:none}
    .act-btn svg{width:15px;height:15px;stroke:currentColor}
    .act-btn.edit:hover{color:#03558C;border-color:#03558C;background:#edf5fc}
    .act-btn.delete{color:#be123c;border-color:#f5c2cd}
    .act-btn.delete:hover{color:#be123c;border-color:#be123c;background:#fff1f2}
    .act-btn:focus-visible{outline:2px solid #03558C;outline-offset:1px}
    .empty-row{text-align:center;padding:2rem;color:#94a3b8;font-size:.82rem}
    .empty-row a{color:#03558C;text-decoration:underline}

    /* Cohort modal */
    .cm-overlay{position:fixed;inset:0;z-index:900;background:rgba(2,13,24,.45);backdrop-filter:blur(4px);display:none;align-items:center;justify-content:center;opacity:0;transition:opacity .2s}
    .cm-overlay.open{display:flex;opacity:1}
    .cm-modal{background:#fff;border-radius:.55rem;box-shadow:0 20px 60px rgba(0,0,0,.18);width:90%;max-width:520px;max-height:85vh;display:flex;flex-direction:column;transform:translateY(12px);transition:transform .25s ease}
    .cm-overlay.open .cm-modal{transform:translateY(0)}
    .cm-modal-head{display:flex;align-items:center;justify-content:space-between;padding:1.1rem 1.5rem;border-bottom:1px solid #eceae6}
    .cm-modal-head h3{font-size:.88rem;font-weight:700;color:#1e293b;margin:0}
    .cm-modal-close{background:none;border:none;cursor:pointer;color:#94a3b8;font-size:1.3rem;line-height:1;padding:.2rem;transition:color .15s}
    .cm-modal-close:hover{color:#1e293b}
    .cm-modal-body{padding:1rem 1.5rem;overflow-y:auto;flex:1}
    .cm-modal-foot{padding:.85rem 1.5rem;border-top:1px solid #eceae6;display:flex;justify-content:space-between;align-items:center}
    .cm-tbl{width:100%;border-collapse:collapse}
    .cm-tbl th{font-size:.55rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;text-align:left;padding:.45rem .6rem;border-bottom:1px solid #eceae6}
    .cm-tbl td{font-size:.78rem;color:#1e293b;padding:.55rem .6rem;border-bottom:1px solid #f4f3f0;vertical-align:middle}
    .cm-tbl tr:last-child td{border-bottom:none}
    .cm-tbl tbody tr:hover{background:#fafaf9}
    .cm-tbl .cm-name{font-weight:600;color:#03558C}
    .cm-tbl .cm-cnt{font-size:.68rem;color:#94a3b8}
    .cm-tbl .cm-status{font-size:.52rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:.15rem .4rem;border-radius:.15rem}
    .cm-active{background:#ecfdf5;color:#065f46}
    .cm-empty{background:#fef3c7;color:#92400e}
    .cm-del-btn{background:none;border:none;cursor:pointer;color:#be123c80;font-size:.72rem;transition:color .15s;padding:.15rem .3rem}
    .cm-del-btn:hover{color:#be123c}
    .cm-del-btn:disabled{opacity:.3;cursor:not-allowed}
    .cm-add-btn{display:inline-flex;align-items:center;gap:.35rem;background:#03558C;color:#fff;font-size:.68rem;font-weight:600;letter-spacing:.04em;padding:.45rem .9rem;border-radius:.25rem;border:none;cursor:pointer;transition:background .15s}
    .cm-add-btn:hover{background:#024a7a}
    .cm-add-btn:disabled{background:#94a3b8;cursor:wait}
    .cm-empty-state{text-align:center;padding:1.5rem 0;color:#94a3b8;font-size:.8rem}
    .cm-manage-btn{display:inline-flex;align-items:center;gap:.4rem;background:#fff;border:1px solid #eceae6;color:#64748b;font-size:.7rem;font-weight:600;padding:.4rem .85rem;border-radius:.3rem;cursor:pointer;transition:all .15s;text-decoration:none}
    .cm-manage-btn:hover{border-color:#03558C;color:#03558C;background:#edf5fc}
</style>

<!-- ─── Cohort Manager Modal ─── -->
<div class="cm-overlay" id="cmOverlay" onclick="if(event.target===this)closeCohortModal()">
    <div class="cm-modal">
        <div class="cm-modal-head">
            <h3>Manage Cohorts</h3>
            <button type="button" class="cm-modal-close" onclick="closeCohortModal()" title="Close">×</button>
        </div>
        <div class="cm-modal-body">
            <table class="cm-tbl" id="cmTable">
                <thead>
                    <tr>
                        <th>Cohort</th>
                        <th>Startups</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cmBody">
                    <?php foreach ($cohorts ?? [] as $c): ?>
                    <?php
                        $cnt = count(model('IncubateeModel')->where('cohort', $c['name'])->where('isPublished', 1)->findAll());
                    ?>
                    <tr data-id="<?= $c['id'] ?>">
                        <td class="cm-name"><?= esc($c['name']) ?></td>
                        <td class="cm-cnt"><?= $cnt ?> startup<?= $cnt !== 1 ? 's' : '' ?></td>
                        <td>
                            <?php if ($cnt > 0): ?>
                                <span class="cm-status cm-active">Active</span>
                            <?php else: ?>
                                <span class="cm-status cm-empty">Coming Soon</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:right">
                            <button type="button" class="cm-del-btn" title="Delete" onclick="deleteCohort(<?= $c['id'] ?>,'<?= esc($c['name'], 'js') ?>')" <?= $cnt > 0 ? 'disabled title="Remove incubatees first"' : '' ?>>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if (empty($cohorts)): ?>
            <div class="cm-empty-state" id="cmEmptyState">No cohorts yet. Add one below.</div>
            <?php endif; ?>
        </div>
        <div class="cm-modal-foot">
            <span style="font-size:.68rem;color:#94a3b8" id="cmTotal"><?= count($cohorts ?? []) ?> cohort<?= count($cohorts ?? []) !== 1 ? 's' : '' ?></span>
            <button type="button" class="cm-add-btn" id="cmAddBtn" onclick="addCohort()">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                Add Cohort
            </button>
        </div>
    </div>
</div>

<script>
var cohortCount = <?= count($cohorts ?? []) ?>;

function openCohortModal() {
    document.getElementById('cmOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeCohortModal() {
    document.getElementById('cmOverlay').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeCohortModal();
});

function addCohort() {
    var btn = document.getElementById('cmAddBtn');
    btn.disabled = true;
    btn.textContent = 'Adding…';
    fetch('<?= site_url('admin/cohorts/add') ?>', {
        method: 'POST',
        headers: {'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json'},
        body: JSON.stringify({<?= csrf_token() ?>: '<?= csrf_hash() ?>'})
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.ok) {
            var c = data.cohort;
            var empty = document.getElementById('cmEmptyState');
            if (empty) empty.remove();
            var tr = document.createElement('tr');
            tr.dataset.id = c.id;
            tr.innerHTML =
                '<td class="cm-name">' + c.name + '</td>' +
                '<td class="cm-cnt">0 startups</td>' +
                '<td><span class="cm-status cm-empty">Coming Soon</span></td>' +
                '<td style="text-align:right"><button type="button" class="cm-del-btn" title="Delete" onclick="deleteCohort(' + c.id + ',\'' + c.name + '\')">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button></td>';
            document.getElementById('cmBody').appendChild(tr);
            cohortCount++;
            document.getElementById('cmTotal').textContent = cohortCount + ' cohort' + (cohortCount !== 1 ? 's' : '');
        } else {
            alert(data.error || 'Failed to add cohort');
        }
    })
    .catch(function() { alert('Network error'); })
    .finally(function() {
        btn.disabled = false;
        btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg> Add Cohort';
    });
}

function deleteCohort(id, name) {
    if (!confirm('Delete ' + name + '?\nThis cannot be undone.')) return;
    fetch('<?= site_url('admin/cohorts/') ?>' + id + '/delete', {
        method: 'POST',
        headers: {'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json'},
        body: JSON.stringify({<?= csrf_token() ?>: '<?= csrf_hash() ?>'})
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.ok) {
            var row = document.querySelector('#cmBody tr[data-id="' + id + '"]');
            if (row) row.remove();
            cohortCount--;
            document.getElementById('cmTotal').textContent = cohortCount + ' cohort' + (cohortCount !== 1 ? 's' : '');
            if (cohortCount === 0) {
                var body = document.querySelector('.cm-modal-body');
                var empty = document.createElement('div');
                empty.className = 'cm-empty-state';
                empty.id = 'cmEmptyState';
                empty.textContent = 'No cohorts yet. Add one below.';
                body.appendChild(empty);
            }
        } else {
            alert(data.error || 'Failed to delete');
        }
    })
    .catch(function() { alert('Network error'); });
}
</script>

<div class="toolbar">
    <span class="count"><?= count($incubatees ?? []) ?> incubatees</span>
    <div style="display:flex;gap:.5rem;align-items:center">
        <button type="button" class="cm-manage-btn" onclick="openCohortModal()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Add Cohort
        </button>
        <a href="<?= site_url('admin/incubatees/create') ?>" class="btn btn-p">New incubatee</a>
    </div>
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
                <th>Action</th>
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
                            <a href="<?= site_url('admin/incubatees/' . $inc['id'] . '/edit') ?>" class="act-btn edit" title="Edit" aria-label="Edit incubatee">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                </svg>
                            </a>
                            <form action="<?= site_url('admin/incubatees/' . $inc['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Delete this incubatee?')">
                                <?= csrf_field() ?>
                                <button type="submit" class="act-btn delete" title="Delete" aria-label="Delete incubatee">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4h8v2"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 6l-1 14H6L5 6"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 11v6M14 11v6"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div class="lf-panel">
    <div class="lf-wrap">
        <div class="lf-copy">
            <p class="lf-kicker">Homepage Incubatees</p>
            <h3 class="lf-title">Display Filter</h3>
            <p class="lf-desc">Choose one cohort or all cohorts for the landing section. If the selected cohort has no published startups yet, the site shows "Will be announced soon".</p>
        </div>
        <form method="POST" action="<?= site_url('admin/incubatees/landing-filter') ?>" class="lf-form">
            <?= csrf_field() ?>
            <div class="lf-field">
                <label class="lf-label" for="landingCohortFilter">Cohort</label>
                <select id="landingCohortFilter" name="landingCohortFilter" class="lf-select">
                    <option value="all" <?= ($selectedLandingFilter ?? 'all') === 'all' ? 'selected' : '' ?>>All Cohorts</option>
                    <?php foreach (($landingFilterOptions ?? []) as $cohortName): ?>
                        <option value="<?= esc($cohortName) ?>" <?= ($selectedLandingFilter ?? 'all') === $cohortName ? 'selected' : '' ?>>
                            <?= esc($cohortName) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-p">Save</button>
        </form>
    </div>
</div>
