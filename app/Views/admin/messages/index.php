<style>
    /* ── Stats row ─────────────────────────── */
    .grid-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.85rem;margin-bottom:1.8rem}
    .stat{background:#fff;border:1px solid #eceae6;border-radius:.4rem;padding:1.1rem 1.2rem}
    .stat .n{font-family:'DM Serif Display',serif;font-size:1.6rem;color:#03558C;line-height:1}
    .stat .t{font-size:.6rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#94a3b8;margin-top:.3rem}

    /* ── Inbox wrapper ─────────────────────── */
    .inbox-wrap{background:#fff;border:1px solid #eceae6;border-radius:.4rem;overflow:hidden}

    /* ── Inbox toolbar ─────────────────────── */
    .inbox-bar{display:flex;align-items:center;justify-content:space-between;padding:.55rem 1rem;border-bottom:1px solid #eceae6;background:#fafaf9}
    .inbox-bar .bar-label{font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8}
    .inbox-bar .bar-count{font-size:.68rem;color:#64748b}

    /* ── Message rows (Gmail-style) ────────── */
    .msg-row{display:grid;grid-template-columns:32px 160px 1fr auto;align-items:center;gap:0;padding:.55rem 1rem;border-bottom:1px solid #f4f3f0;cursor:pointer;transition:background .12s;text-decoration:none;color:inherit}
    .msg-row:last-child{border-bottom:none}
    .msg-row:hover{background:#f6f8fc}
    .msg-row.active{background:#edf2fc}

    /* Unread state */
    .msg-row.unread .row-name,
    .msg-row.unread .row-preview{font-weight:700;color:#1e293b}
    .msg-row.unread .row-date{font-weight:600;color:#1e293b}

    /* Dot */
    .dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}
    .dot-unread{background:#03558C}
    .dot-read{background:transparent;border:1.5px solid #d4d4d4}

    /* Row cells */
    .row-name{font-size:.78rem;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;padding-right:.6rem}
    .row-preview{font-size:.76rem;color:#64748b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:400;padding-right:1rem}
    .row-preview span.row-subject{color:#1e293b;font-weight:500}
    .row-date{font-size:.68rem;color:#94a3b8;white-space:nowrap;text-align:right;font-variant-numeric:tabular-nums}

    /* ── Empty state ────────────────────────── */
    .empty{text-align:center;padding:2.5rem 1.5rem;color:#94a3b8;font-size:.82rem}

    /* ══════════════════════════════════════════
       READER (detail view — hidden by default)
       ══════════════════════════════════════════ */
    .reader{display:none;background:#fff;border:1px solid #eceae6;border-radius:.4rem;overflow:hidden;animation:readerIn .2s ease}
    .reader.open{display:block}
    @keyframes readerIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}

    /* ── Reader toolbar ────────────────────── */
    .reader-bar{display:flex;align-items:center;gap:.3rem;padding:.5rem .9rem;border-bottom:1px solid #eceae6;background:#fafaf9}
    .r-btn{display:inline-flex;align-items:center;justify-content:center;gap:.3rem;background:none;border:1px solid transparent;border-radius:.25rem;cursor:pointer;padding:.3rem .55rem;font-size:.62rem;font-weight:600;color:#64748b;transition:all .12s;font-family:'DM Sans',sans-serif}
    .r-btn:hover{background:#fff;border-color:#e4e2dd;color:#1e293b}
    .r-btn svg{width:16px;height:16px}
    .r-btn.back{padding-left:.35rem}
    .r-btn.danger:hover{color:#991b1b;border-color:#fecaca;background:#fef2f2}
    .bar-sep{width:1px;height:18px;background:#e4e2dd;margin:0 .15rem}

    /* ── Reader header ─────────────────────── */
    .reader-head{padding:1.3rem 1.5rem 0}
    .reader-head .rh-subject{font-family:'DM Serif Display',serif;font-size:1.15rem;font-weight:400;color:#1e293b;line-height:1.3;margin:0 0 1rem}

    .sender-row{display:flex;align-items:center;gap:.7rem;padding:0 1.5rem .9rem;border-bottom:1px solid #f1efeb}
    .sender-avatar{width:36px;height:36px;border-radius:50%;background:#03558C;color:#fff;display:flex;align-items:center;justify-content:center;font-size:.82rem;font-weight:700;flex-shrink:0;text-transform:uppercase}
    .sender-info{flex:1;min-width:0}
    .sender-name{font-size:.82rem;font-weight:600;color:#1e293b}
    .sender-email{font-size:.7rem;color:#64748b}
    .sender-email a{color:#03558C;text-decoration:none}
    .sender-email a:hover{text-decoration:underline}
    .sender-date{font-size:.65rem;color:#94a3b8;white-space:nowrap;font-variant-numeric:tabular-nums}

    /* ── Reader body ───────────────────────── */
    .reader-body{padding:1.3rem 1.5rem 1.5rem;padding-left:calc(1.5rem + 36px + .7rem);font-size:.84rem;color:#1e293b;line-height:1.75;white-space:pre-line;min-height:120px}

    /* ── Reply strip ───────────────────────── */
    .reply-strip{padding:0 1.5rem 1.4rem;padding-left:calc(1.5rem + 36px + .7rem)}
    .reply-btn{display:inline-flex;align-items:center;gap:.4rem;font-size:.72rem;font-weight:600;padding:.55rem 1.1rem;border-radius:.35rem;border:1px solid #e4e2dd;background:#fff;color:#1e293b;cursor:pointer;transition:all .15s;text-decoration:none;font-family:'DM Sans',sans-serif}
    .reply-btn:hover{border-color:#03558C;color:#03558C;background:#f6f8fc}
    .reply-btn svg{width:15px;height:15px}

    /* ── Confirm Dialog ────────────────────── */
    .confirm-bg{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);backdrop-filter:blur(2px);z-index:950;justify-content:center;align-items:center}
    .confirm-bg.open{display:flex}
    .confirm-box{background:#fff;border-radius:.5rem;width:340px;box-shadow:0 16px 48px rgba(0,0,0,.18);animation:readerIn .18s ease;overflow:hidden}
    .confirm-icon{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .6rem}
    .confirm-icon.red{background:#fef2f2;color:#991b1b}
    .confirm-icon svg{width:20px;height:20px}
    .confirm-body{padding:1.4rem 1.4rem .8rem;text-align:center}
    .confirm-body h3{font-size:.85rem;font-weight:600;color:#1e293b;margin:0 0 .3rem}
    .confirm-body p{font-size:.74rem;color:#64748b;margin:0;line-height:1.5}
    .confirm-actions{display:flex;border-top:1px solid #eceae6}
    .confirm-actions button{flex:1;padding:.7rem;font-size:.72rem;font-weight:600;border:none;cursor:pointer;transition:background .12s;font-family:inherit}
    .confirm-actions .c-cancel{background:#fff;color:#64748b;border-right:1px solid #eceae6}
    .confirm-actions .c-cancel:hover{background:#f4f3f0}
    .confirm-actions .c-delete{background:#fff;color:#991b1b}
    .confirm-actions .c-delete:hover{background:#fef2f2}

    /* ── Toast ──────────────────────────────── */
    .toast{position:fixed;bottom:1.2rem;left:50%;transform:translateX(-50%) translateY(80px);background:#1e293b;color:#fff;font-size:.74rem;font-weight:500;padding:.6rem 1.2rem;border-radius:.35rem;box-shadow:0 6px 20px rgba(0,0,0,.18);z-index:999;opacity:0;transition:all .3s ease}
    .toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
</style>

<!-- Stats -->
<div class="grid-stats">
    <div class="stat">
        <div class="n"><?= $counts['total'] ?></div>
        <div class="t">Total Messages</div>
    </div>
    <div class="stat">
        <div class="n" style="color:#03558C"><?= $counts['unread'] ?></div>
        <div class="t">Unread</div>
    </div>
    <div class="stat">
        <div class="n" style="color:#94a3b8"><?= $counts['read'] ?></div>
        <div class="t">Read</div>
    </div>
</div>

<!-- ═══════════ INBOX LIST ═══════════ -->
<div class="inbox-wrap" id="inbox">
    <?php if (empty($messages)): ?>
        <div class="empty">No messages yet. When visitors submit the contact form, their messages will appear here.</div>
    <?php else: ?>
        <div class="inbox-bar">
            <span class="bar-label">Inbox</span>
            <span class="bar-count"><?= $counts['total'] ?> message<?= $counts['total'] !== 1 ? 's' : '' ?></span>
        </div>
        <?php foreach ($messages as $m): ?>
            <div class="msg-row <?= $m['isRead'] ? '' : 'unread' ?>" data-id="<?= $m['id'] ?>" onclick="openMsg(<?= $m['id'] ?>)">
                <span class="dot <?= $m['isRead'] ? 'dot-read' : 'dot-unread' ?>"></span>
                <span class="row-name"><?= esc($m['name']) ?></span>
                <span class="row-preview"><?= esc(mb_substr($m['message'], 0, 120)) ?></span>
                <span class="row-date"><?= date('M j', strtotime($m['createdAt'])) ?></span>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- ═══════════ READER (detail view) ═══════════ -->
<div class="reader" id="reader">
    <!-- Toolbar -->
    <div class="reader-bar">
        <button class="r-btn back" onclick="backToInbox()" title="Back to Inbox">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </button>
        <div class="bar-sep"></div>
        <button class="r-btn" id="btnToggleRead" onclick="toggleRead()" title="Mark as unread">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span id="toggleLabel">Mark unread</span>
        </button>
        <button class="r-btn danger" onclick="confirmDelete()" title="Delete">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Delete
        </button>
    </div>

    <!-- Header -->
    <div class="reader-head">
        <h1 class="rh-subject" id="rSubject">Message</h1>
    </div>

    <!-- Sender row -->
    <div class="sender-row">
        <div class="sender-avatar" id="rAvatar">?</div>
        <div class="sender-info">
            <div class="sender-name" id="rName">—</div>
            <div class="sender-email">to me &lt;<span id="rEmail">—</span>&gt;</div>
        </div>
        <div class="sender-date" id="rDate">—</div>
    </div>

    <!-- Body -->
    <div class="reader-body" id="rBody">—</div>

    <!-- Reply strip -->
    <div class="reply-strip">
        <a class="reply-btn" id="rReply" href="#">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a5 5 0 015 5v4M3 10l6 6M3 10l6-6"/></svg>
            Reply
        </a>
    </div>
</div>

<!-- ═══════════ CONFIRM DELETE DIALOG ═══════════ -->
<div class="confirm-bg" id="confirmDel">
    <div class="confirm-box">
        <div class="confirm-body">
            <div class="confirm-icon red">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </div>
            <h3>Delete message?</h3>
            <p id="confirmText">This message will be permanently deleted.</p>
        </div>
        <div class="confirm-actions">
            <button class="c-cancel" onclick="closeConfirm()">Cancel</button>
            <button class="c-delete" id="confirmDelBtn" onclick="doDelete()">Delete</button>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"></div>

<script>window.MSG_BASE = '<?= site_url('admin/messages') ?>';</script>
<script src="<?= base_url('assets/js/adminMessages.js') ?>"></script>
