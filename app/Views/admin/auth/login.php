<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in — ASOG TBI</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet"/>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'DM Sans',sans-serif;min-height:100vh;display:flex;background:#03558C}
        .brand-panel{display:none;width:44%;background:#03558C;padding:3rem;flex-direction:column;justify-content:space-between}
        @media(min-width:768px){.brand-panel{display:flex}}
        .brand-panel .logo{width:52px;opacity:.85}
        .brand-panel h1{font-family:'DM Serif Display',serif;font-size:2rem;line-height:1.15;color:#F8F6F2;font-weight:400;max-width:320px}
        .brand-panel h1 em{font-style:italic;color:#F8AF21}
        .brand-panel .foot{font-size:.7rem;letter-spacing:.06em;color:rgba(255,255,255,.25)}
        .form-panel{flex:1;background:#F8F6F2;display:flex;align-items:center;justify-content:center;padding:2rem}
        .form-box{width:100%;max-width:360px}
        .form-box h2{font-family:'DM Serif Display',serif;font-size:1.55rem;color:#03558C;margin-bottom:.35rem;font-weight:400}
        .form-box p.sub{font-size:.82rem;color:#64748b;margin-bottom:2rem}
        .field{margin-bottom:1.25rem}
        .field label{display:block;font-size:.65rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:#03558C;margin-bottom:.45rem}
        .field input{width:100%;padding:.7rem .85rem;border:1px solid #d4d0cb;border-radius:.3rem;font-size:.88rem;font-family:inherit;color:#1e293b;background:#fff;outline:none;transition:border .2s,box-shadow .2s}
        .field input:focus{border-color:#F8AF21;box-shadow:0 0 0 3px rgba(248,175,33,.12)}
        .field input::placeholder{color:#a5a09a}
        .btn-submit{width:100%;padding:.75rem;background:#F8AF21;color:#03558C;font-family:inherit;font-size:.78rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;border:none;border-radius:.3rem;cursor:pointer;transition:background .2s}
        .btn-submit:hover{background:#e8a900}
        .error-msg{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;border-radius:.3rem;padding:.6rem .85rem;font-size:.82rem;margin-bottom:1.25rem}
        .success-msg{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;border-radius:.3rem;padding:.6rem .85rem;font-size:.82rem;margin-bottom:1.25rem}
        .back-link{display:inline-block;margin-top:1.5rem;font-size:.75rem;color:#64748b;text-decoration:none;transition:color .2s}
        .back-link:hover{color:#03558C}
    </style>
</head>
<body>
    <div class="brand-panel">
        <img src="<?= base_url('asset/js/img/ASOG TBI/PNG/ASOG-TBI_seal_white.png') ?>" alt="ASOG TBI" class="logo"/>
        <h1>Technology Business <em>Incubator</em></h1>
        <span class="foot">© <?= date('Y') ?> ASOG TBI · Camarines Sur Polytechnic Colleges</span>
    </div>

    <div class="form-panel">
        <div class="form-box">
            <h2>Sign in</h2>
            <p class="sub">Access the content management workspace.</p>

            <?php if (session()->has('error')): ?>
                <div class="error-msg"><?= esc(session('error')) ?></div>
            <?php endif; ?>
            <?php if (session()->has('success')): ?>
                <div class="success-msg"><?= esc(session('success')) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= site_url('asog-admin') ?>">
                <?= csrf_field() ?>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autofocus placeholder="you@example.com">
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn-submit">Sign in</button>
            </form>

            <a href="<?= site_url('/') ?>" class="back-link">← Back to website</a>
        </div>
    </div>
</body>
</html>
