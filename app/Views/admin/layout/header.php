<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Admin') ?> — ASOG TBI</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet"/>
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'DM Sans',sans-serif;background:#f4f3f0;color:#1e293b;min-height:100vh}
        a{text-decoration:none;color:inherit}
        button{font-family:inherit}

        .shell{display:grid;grid-template-columns:220px 1fr;min-height:100vh}

        /* Sidebar */
        .side{background:#fff;border-right:1px solid #e4e2dd;display:flex;flex-direction:column}
        .side-brand{padding:1.4rem 1.3rem}
        .side-brand h2{font-family:'DM Serif Display',serif;font-size:.95rem;font-weight:400;color:#03558C}
        .side-brand span{font-size:.55rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8;display:block;margin-top:.15rem}
        .side-sep{height:1px;background:#eceae6;margin:0 1.3rem}
        .side-label{font-size:.55rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#b0ada7;padding:.9rem 1.3rem .4rem}
        .side-nav{padding:.25rem .6rem}
        .side-nav a{display:flex;align-items:center;gap:.55rem;padding:.55rem .7rem;font-size:.78rem;font-weight:500;color:#64748b;border-radius:.35rem;transition:all .15s}
        .side-nav a:hover{color:#1e293b;background:#f4f3f0}
        .side-nav a.on{color:#03558C;background:#edf5fc;font-weight:600}
        .side-nav a svg{width:15px;height:15px;flex-shrink:0;opacity:.55}
        .side-nav a.on svg{opacity:.85}
        .side-foot{margin-top:auto;padding:1rem 1.3rem;border-top:1px solid #eceae6}
        .side-foot .user{font-size:.72rem;color:#64748b;margin-bottom:.15rem}
        .side-foot .user strong{color:#1e293b;font-weight:600}
        .side-foot .out{font-size:.68rem;color:#94a3b8;transition:color .15s}
        .side-foot .out:hover{color:#ef4444}

        /* Main area */
        .body{display:flex;flex-direction:column;min-width:0}
        .bar{display:flex;justify-content:space-between;align-items:center;padding:0 2rem;height:52px;background:#fff;border-bottom:1px solid #e4e2dd;position:sticky;top:0;z-index:40}
        .bar h1{font-size:.82rem;font-weight:600;color:#1e293b}
        .bar-r a{font-size:.62rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:#64748b;padding:.3rem .7rem;border:1px solid #e4e2dd;border-radius:.25rem;transition:all .15s}
        .bar-r a:hover{border-color:#03558C;color:#03558C}
        .page{padding:1.6rem 2rem;flex:1}

        /* Shared button styles */
        .btn{display:inline-flex;align-items:center;gap:.35rem;font-size:.68rem;font-weight:600;letter-spacing:.03em;padding:.5rem 1rem;border-radius:.3rem;border:none;cursor:pointer;transition:all .15s}
        .btn-p{background:#03558C;color:#fff}.btn-p:hover{background:#024a7a}
        .btn-g{background:#F8AF21;color:#1e293b}.btn-g:hover{background:#e9a210}
        .btn-d{background:#fff;color:#ef4444;border:1px solid #fecaca}.btn-d:hover{background:#fef2f2}
        .btn-o{background:#fff;color:#64748b;border:1px solid #e4e2dd}.btn-o:hover{border-color:#03558C;color:#03558C}
        .btn-s{padding:.35rem .65rem;font-size:.62rem}
    </style>
</head>
<body>
<div class="shell">

    <aside class="side">
        <div class="side-brand">
            <h2>ASOG TBI</h2>
            <span>Content Manager</span>
        </div>
        <div class="side-sep"></div>

        <div class="side-label">Menu</div>
        <nav class="side-nav">
            <a href="<?= site_url('admin') ?>" class="<?= ($activePage ?? '') === 'dashboard' ? 'on' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                Dashboard
            </a>
            <a href="<?= site_url('admin/posts') ?>" class="<?= ($activePage ?? '') === 'posts' ? 'on' : '' ?>">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h10"/></svg>
                Posts
            </a>
        </nav>

        <div class="side-sep" style="margin-top:.4rem"></div>
        <nav class="side-nav" style="padding-top:.3rem">
            <a href="<?= site_url('/') ?>" target="_blank">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View website
            </a>
        </nav>

        <div class="side-foot">
            <div class="user"><strong><?= esc(session()->get('admin_name') ?? 'Admin') ?></strong></div>
            <div class="user" style="margin-bottom:.4rem"><?= esc(session()->get('admin_email') ?? '') ?></div>
            <a href="<?= site_url('asog-admin/logout') ?>" class="out">Sign out</a>
        </div>
    </aside>

    <div class="body">
        <header class="bar">
            <h1><?= esc($pageTitle ?? 'Dashboard') ?></h1>
            <div class="bar-r">
                <a href="<?= site_url('/') ?>" target="_blank">View site</a>
            </div>
        </header>

        <div class="page">
            <?php helper('toast'); ?>
            <?= renderToast() ?>
