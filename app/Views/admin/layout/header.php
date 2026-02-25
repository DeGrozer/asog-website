<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Admin') ?> — ASOG TBI</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet"/>
    <style>
        /* ── Reset ── */
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'DM Sans',sans-serif;background:#f7f6f3;color:#1e293b;min-height:100vh}
        a{text-decoration:none;color:inherit}
        button{font-family:inherit}

        /* ── Layout ── */
        .admin-shell{display:flex;min-height:100vh}

        /* ── Sidebar ── */
        .sidebar{width:240px;background:#03558C;color:#fff;display:flex;flex-direction:column;position:fixed;inset:0 auto 0 0;z-index:100}
        .sidebar-brand{padding:1.5rem 1.25rem;border-bottom:1px solid rgba(255,255,255,.08)}
        .sidebar-brand h2{font-family:'DM Serif Display',serif;font-size:1.1rem;font-weight:400;letter-spacing:.02em}
        .sidebar-brand span{display:block;font-size:.65rem;letter-spacing:.08em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-top:.25rem}
        .sidebar-nav{flex:1;padding:.75rem 0}
        .sidebar-nav a{display:flex;align-items:center;gap:.65rem;padding:.7rem 1.25rem;font-size:.8rem;font-weight:500;color:rgba(255,255,255,.55);transition:all .2s;border-left:3px solid transparent}
        .sidebar-nav a:hover{color:#fff;background:rgba(255,255,255,.06)}
        .sidebar-nav a.active{color:#F8AF21;background:rgba(248,175,33,.08);border-left-color:#F8AF21}
        .sidebar-nav a svg{width:16px;height:16px;opacity:.65;flex-shrink:0}
        .sidebar-nav a.active svg{opacity:1}
        .sidebar-foot{padding:1rem 1.25rem;border-top:1px solid rgba(255,255,255,.08);font-size:.72rem;color:rgba(255,255,255,.35)}
        .sidebar-foot a{color:rgba(255,255,255,.55);transition:color .2s;font-size:.78rem;display:inline-flex;align-items:center;gap:.4rem;margin-top:.35rem}
        .sidebar-foot a:hover{color:#F8AF21}

        /* ── Main ── */
        .main{flex:1;margin-left:240px;display:flex;flex-direction:column}

        /* ── Topbar ── */
        .topbar{display:flex;justify-content:space-between;align-items:center;padding:0 2rem;height:56px;background:#fff;border-bottom:1px solid #e8e5e0;position:sticky;top:0;z-index:50}
        .topbar h1{font-family:'DM Serif Display',serif;font-size:1.15rem;font-weight:400;color:#03558C}
        .topbar-right{display:flex;align-items:center;gap:.75rem}
        .topbar-user{font-size:.75rem;color:#64748b;text-align:right}
        .topbar-user strong{color:#1e293b}
        .btn-logout{font-size:.65rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:#03558C;background:#F8AF21;border:none;padding:.4rem .85rem;border-radius:.25rem;cursor:pointer;transition:background .2s}
        .btn-logout:hover{background:#e8a900}

        /* ── Content area ── */
        .content{padding:1.75rem 2rem;flex:1}

        /* ── Utility classes ── */
        .btn{display:inline-flex;align-items:center;gap:.4rem;font-size:.72rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;padding:.55rem 1.1rem;border-radius:.3rem;border:none;cursor:pointer;transition:all .2s}
        .btn-primary{background:#03558C;color:#fff}
        .btn-primary:hover{background:#024a7a}
        .btn-gold{background:#F8AF21;color:#03558C}
        .btn-gold:hover{background:#e8a900}
        .btn-danger{background:#ef4444;color:#fff}
        .btn-danger:hover{background:#dc2626}
        .btn-outline{background:transparent;border:1px solid #d1d5db;color:#64748b}
        .btn-outline:hover{border-color:#03558C;color:#03558C}
        .btn-sm{padding:.35rem .75rem;font-size:.65rem}
    </style>
</head>
<body>
<div class="admin-shell">

    <!-- ── Sidebar ── -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h2>ASOG TBI</h2>
            <span>Content Manager</span>
        </div>

        <nav class="sidebar-nav">
            <a href="<?= site_url('admin') ?>" class="<?= ($activePage ?? '') === 'dashboard' ? 'active' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>
            <a href="<?= site_url('admin/posts') ?>" class="<?= ($activePage ?? '') === 'posts' ? 'active' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/></svg>
                Posts
            </a>
            <a href="<?= site_url('admin/programs') ?>" class="<?= ($activePage ?? '') === 'programs' ? 'active' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Programs
            </a>
            <a href="<?= site_url('admin/facilities') ?>" class="<?= ($activePage ?? '') === 'facilities' ? 'active' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Facilities
            </a>
            <a href="<?= site_url('admin/incubatees') ?>" class="<?= ($activePage ?? '') === 'incubatees' ? 'active' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Incubatees
            </a>
            <a href="<?= site_url('admin/team') ?>" class="<?= ($activePage ?? '') === 'team' ? 'active' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Team
            </a>
            <a href="<?= site_url('admin/settings') ?>" class="<?= ($activePage ?? '') === 'settings' ? 'active' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Settings
            </a>
        </nav>

        <div class="sidebar-foot">
            <div><?= esc(session()->get('admin_email') ?? 'Admin') ?></div>
            <a href="<?= site_url('asog-admin/logout') ?>">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Sign out
            </a>
        </div>
    </aside>

    <!-- ── Main ── -->
    <div class="main">
        <header class="topbar">
            <h1><?= esc($pageTitle ?? 'Dashboard') ?></h1>
            <div class="topbar-right">
                <div class="topbar-user">
                    <strong><?= esc(session()->get('admin_email') ?? 'Admin') ?></strong>
                </div>
                <a href="<?= site_url('asog-admin/logout') ?>" class="btn-logout">Logout</a>
            </div>
        </header>

        <div class="content">
            <?php helper('toast'); ?>
            <?= renderToast() ?>
