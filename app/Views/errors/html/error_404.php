<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= lang('Errors.pageNotFound') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">

    <style>
    :root {
        --asog-navy: #03558c;
        --asog-navy-2: #0e3f63;
        --asog-gold: #f8af21;
        --asog-ink: #1b2430;
        --asog-muted: #5a6f84;
        --asog-bg: #d7dde2;
        --asog-card: #ffffff;
        --asog-border: #e4e2dd;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    html,
    body {
        height: 100%;
    }

    body {
        font-family: 'DM Sans', system-ui, sans-serif;
        color: var(--asog-ink);
        background: #cdd5dc;
        overflow: hidden;
    }

    /* ── Full-bleed wrapper ─────────────────────────────── */
    .wrap {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background:
            radial-gradient(ellipse 900px 500px at 15% -5%, #d8e6f0 0%, transparent 60%),
            radial-gradient(ellipse 700px 420px at 95% 5%, #ece9e0 0%, transparent 55%),
            radial-gradient(ellipse 600px 600px at 50% 110%, #b8c9d6 0%, transparent 60%),
            #cdd5dc;
    }

    /* Soft vignette overlay */
    .wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: radial-gradient(ellipse 130% 130% at 50% 50%, transparent 55%, rgba(10, 28, 44, .12) 100%);
        z-index: 0;
    }

    /* ── Scene canvas ───────────────────────────────────── */
    .scene {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    .scene-art {
        width: 100%;
        height: 100%;
        display: block;
    }

    /* ── Text content ───────────────────────────────────── */
    .glass-panel {
        position: absolute;
        inset: 0;
        z-index: 2;
        pointer-events: none;
        background: linear-gradient(105deg,
                rgba(248, 252, 255, .92) 0%,
                rgba(248, 252, 255, .82) 32%,
                rgba(248, 252, 255, .38) 55%,
                rgba(248, 252, 255, .00) 72%);
    }

    .text-block {
        position: absolute;
        inset: 0;
        z-index: 3;
        max-width: 620px;
        padding: clamp(2.4rem, 6vw, 4.2rem) clamp(1.6rem, 5vw, 3.6rem);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* ── Kicker ─────────────────────────────────────────── */
    .kicker {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        margin-bottom: .9rem;
        font-size: .62rem;
        letter-spacing: .18em;
        text-transform: uppercase;
        font-weight: 700;
        color: var(--asog-navy);
    }

    .kicker::before {
        content: '';
        display: inline-block;
        width: 18px;
        height: 2px;
        border-radius: 1px;
        background: var(--asog-gold);
    }

    /* ── Heading ────────────────────────────────────────── */
    h1 {
        font-family: 'DM Serif Display', Georgia, serif;
        font-size: clamp(5rem, 12vw, 8.5rem);
        line-height: .88;
        color: var(--asog-navy-2);
        letter-spacing: -.02em;
        position: relative;
        display: inline-block;
    }

    h1::after {
        content: '';
        position: absolute;
        left: 4px;
        bottom: -6px;
        width: 56px;
        height: 4px;
        border-radius: 2px;
        background: var(--asog-gold);
    }

    h2 {
        margin: 1.2rem 0 .65rem;
        font-size: clamp(1.2rem, 2.4vw, 1.72rem);
        font-weight: 500;
        line-height: 1.22;
        color: var(--asog-ink);
        letter-spacing: -.01em;
    }

    .message {
        font-size: clamp(.9rem, 1.6vw, 1rem);
        line-height: 1.65;
        color: #4a5f72;
        max-width: 50ch;
    }

    /* ── Actions ────────────────────────────────────────── */
    .actions {
        margin-top: 1.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: .55rem;
        pointer-events: all;
    }

    .btn {
        appearance: none;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .72rem 1.18rem;
        border-radius: 12px;
        border: 1.5px solid transparent;
        font-family: inherit;
        font-size: .83rem;
        font-weight: 700;
        letter-spacing: .01em;
        text-decoration: none;
        cursor: pointer;
        transition: transform .14s ease, box-shadow .14s ease, background .14s ease, border-color .14s ease, color .14s ease;
    }

    .btn:active {
        transform: scale(.97) !important;
    }

    .btn-primary {
        background: var(--asog-navy);
        color: #fff;
        box-shadow:
            0 1px 2px rgba(3, 85, 140, .18),
            0 8px 24px rgba(3, 85, 140, .22),
            inset 0 1px 0 rgba(255, 255, 255, .12);
    }

    .btn-primary:hover {
        background: #024b7a;
        box-shadow:
            0 1px 3px rgba(3, 85, 140, .22),
            0 14px 32px rgba(3, 85, 140, .28),
            inset 0 1px 0 rgba(255, 255, 255, .14);
        transform: translateY(-2px);
    }

    .btn-ghost {
        background: rgba(255, 255, 255, .72);
        border-color: rgba(180, 196, 212, .7);
        color: #3b4d60;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
    }

    .btn-ghost:hover {
        background: rgba(255, 255, 255, .9);
        border-color: var(--asog-navy);
        color: var(--asog-navy);
        transform: translateY(-2px);
    }

    /* ── Help chip ──────────────────────────────────────── */
    .help-chip {
        margin-top: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        border-radius: 999px;
        padding: .38rem .78rem .38rem .48rem;
        font-size: .7rem;
        font-weight: 600;
        color: #4e6275;
        background: rgba(255, 255, 255, .62);
        border: 1px solid rgba(193, 210, 224, .7);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        pointer-events: all;
        width: fit-content;
    }

    .help-chip-dot {
        width: 1.3rem;
        height: 1.3rem;
        border-radius: 50%;
        background: #fff;
        border: 1.5px solid #c6daea;
        display: grid;
        place-items: center;
        color: var(--asog-navy);
        font-weight: 700;
        font-size: .74rem;
        flex-shrink: 0;
    }

    /* ── Map animations ─────────────────────────────────── */
    @keyframes mapFloat {

        0%,
        100% {
            transform: translateY(0px) rotate(-1.8deg);
        }

        50% {
            transform: translateY(-6px) rotate(-2.05deg);
        }
    }

    @keyframes shadowPulse {

        0%,
        100% {
            rx: 212;
            opacity: .34;
        }

        50% {
            rx: 204;
            opacity: .28;
        }
    }

    @keyframes qPop {

        0%,
        55%,
        100% {
            transform: translateY(14px) scale(.78);
            opacity: 0;
        }

        20%,
        38% {
            transform: translateY(-12px) scale(1.06);
            opacity: 1;
        }
    }

    @keyframes qPopB {

        0%,
        55%,
        100% {
            transform: translateY(14px) scale(.78);
            opacity: 0;
        }

        20%,
        38% {
            transform: translateY(-12px) scale(1.06);
            opacity: 1;
        }
    }

    .map-group {
        transform-box: fill-box;
        transform-origin: center bottom;
        animation: mapFloat 5s ease-in-out infinite;
    }

    .map-shadow {
        animation: shadowPulse 5s ease-in-out infinite;
    }

    .q-a {
        transform-box: fill-box;
        transform-origin: center bottom;
        animation: qPop 2.6s ease-in-out infinite;
    }

    .q-b {
        transform-box: fill-box;
        transform-origin: center bottom;
        animation: qPopB 2.6s ease-in-out infinite .72s;
    }

    /* ── Responsive ─────────────────────────────────────── */
    @media (max-width: 860px) {
        .glass-panel {
            background: linear-gradient(180deg,
                    rgba(248, 252, 255, .97) 0%,
                    rgba(248, 252, 255, .92) 36%,
                    rgba(248, 252, 255, .55) 62%,
                    rgba(248, 252, 255, .10) 100%);
        }

        .text-block {
            justify-content: flex-start;
            max-width: 100%;
            padding-top: 2.6rem;
        }
    }

    @media (max-width: 540px) {
        h1::after {
            width: 40px;
        }

        .btn {
            padding: .65rem 1rem;
        }
    }
    </style>
</head>

<body>
    <div class="wrap">

        <!-- Decorative scene -->
        <div class="scene" aria-hidden="true">
            <svg class="scene-art" viewBox="0 0 1440 900" fill="none" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice">

                <!-- Sky gradient base -->
                <rect width="1440" height="900" fill="#C9D6DE" />

                <!-- Layered forest horizon ── each band slightly more saturated -->
                <path
                    d="M0 310 L120 258 L248 298 L368 244 L508 300 L648 232 L778 288 L906 236 L1040 298 L1176 248 L1312 304 L1440 258 V900 H0Z"
                    fill="#9ABFB5" opacity=".9" />
                <path
                    d="M0 400 L140 338 L274 380 L400 322 L542 374 L682 310 L822 364 L950 314 L1086 380 L1220 326 L1358 388 L1440 348 V900 H0Z"
                    fill="#5BBBA6" />
                <path
                    d="M0 498 L154 434 L302 478 L438 416 L590 472 L732 406 L878 466 L1012 414 L1154 480 L1298 420 L1440 476 V900 H0Z"
                    fill="#2B8B7E" />
                <path
                    d="M0 592 L168 526 L332 572 L480 506 L644 562 L800 498 L958 558 L1112 502 L1266 568 L1440 516 V900 H0Z"
                    fill="#13706A" />
                <path d="M0 696 L194 624 L376 670 L540 606 L714 660 L890 594 L1058 654 L1236 598 L1440 658 V900 H0Z"
                    fill="#0A5552" />

                <!-- Ground plane -->
                <rect x="0" y="800" width="1440" height="100" fill="#08413F" />

                <!-- === Floating map composition === -->
                <!-- Drop shadow (animated) -->
                <ellipse class="map-shadow" cx="1060" cy="794" rx="212" ry="34" fill="#062E2E" opacity=".34" />

                <!-- Floating question marks -->
                <text class="q-a" x="1048" y="332" fill="#f8af21" font-family="'DM Sans', sans-serif" font-weight="700"
                    font-size="64">?</text>
                <text class="q-b" x="1126" y="304" fill="#f8af21" font-family="'DM Sans', sans-serif" font-weight="700"
                    font-size="50">?</text>

                <!-- Map group (floats up/down) -->
                <g class="map-group">

                    <!-- Map paper with subtle fold lines -->
                    <g transform="translate(840 350) rotate(-2)">

                        <!-- Paper shadow -->
                        <rect x="8" y="10" width="410" height="268" rx="16" fill="rgba(6,46,62,.18)" />

                        <!-- Paper surface -->
                        <rect width="410" height="268" rx="16" fill="#F5EDDA" />

                        <!-- Fold crease lines -->
                        <line x1="103" y1="0" x2="103" y2="268" stroke="#DDD4B8" stroke-width="2.2" />
                        <line x1="205" y1="0" x2="205" y2="268" stroke="#DDD4B8" stroke-width="2.2" />
                        <line x1="307" y1="0" x2="307" y2="268" stroke="#DDD4B8" stroke-width="2.2" />
                        <line x1="0" y1="134" x2="410" y2="134" stroke="#DDD4B8" stroke-width="1.7"
                            stroke-dasharray="6 4" />

                        <!-- Terrain patches -->
                        <path
                            d="M16 48 L82 28 L136 52 L191 34 L246 54 L302 32 L394 56 V108 L322 126 L258 106 L198 130 L138 102 L72 124 L16 108Z"
                            fill="#D2E2BB" opacity=".9" />
                        <path
                            d="M18 160 L84 138 L142 164 L212 140 L274 167 L342 144 L396 160 V224 L336 242 L270 222 L206 246 L142 218 L80 242 L18 224Z"
                            fill="#C2D8A6" opacity=".85" />

                        <!-- Mountain-like icons -->
                        <path d="M118 100L142 64L166 100H118Z" fill="#b8c8a1"/>
                        <path d="M152 100L176 74L200 100H152Z" fill="#afc09a"/>
                        <path d="M238 114L264 74L290 114H238Z" fill="#b8c8a1"/>
                        <path d="M274 114L296 86L318 114H274Z" fill="#afc09a"/>

                        <!-- Meandering route path -->
                        <path d="M68 199 C110 154 126 112 180 116 C225 120 228 178 280 183 C325 186 346 148 380 126"
                            stroke="#4D7A48" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"
                            fill="none" />

                        <!-- Start marker + flag -->
                        <circle cx="68" cy="199" r="12" fill="#2B8B7E" />
                        <circle cx="68" cy="199" r="7" fill="#fff" />
                        <path d="M104 196V152" stroke="#3f5f59" stroke-width="4" stroke-linecap="round"/>
                        <path d="M104 154L136 163L104 174Z" fill="#2f8d7f"/>

                        <!-- Dead-end circle -->
                        <circle cx="345" cy="110" r="42" fill="#ECD8C5" stroke="#B07748" stroke-width="3.2" />

                        <!-- X cross -->
                        <path d="M316 81 L374 139" stroke="#8C3530" stroke-width="9" stroke-linecap="round" />
                        <path d="M374 81 L316 139" stroke="#8C3530" stroke-width="9" stroke-linecap="round" />

                        <!-- Corner pin nail detail -->
                        <circle cx="16" cy="16" r="6" fill="#C4A97A" stroke="#A88C5A" stroke-width="1.6" />
                        <circle cx="394" cy="16" r="6" fill="#C4A97A" stroke="#A88C5A" stroke-width="1.6" />
                        <circle cx="16" cy="252" r="6" fill="#C4A97A" stroke="#A88C5A" stroke-width="1.6" />
                        <circle cx="394" cy="252" r="6" fill="#C4A97A" stroke="#A88C5A" stroke-width="1.6" />
                    </g>

                </g>
                <!-- === End map === -->

            </svg>
        </div>

        <!-- Frosted gradient panel (left-side wash) -->
        <div class="glass-panel" aria-hidden="true"></div>

        <!-- Text content -->
        <div class="text-block">
            <p class="kicker">Navigation Error</p>

            <h1>404</h1>

            <h2>Oops, this path is still<br>under exploration.</h2>

            <p class="message">
                <?= lang('Errors.sorryCannotFind') ?>
            </p>

            <div class="actions">
                <a class="btn btn-primary" href="<?= base_url('/') ?>">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path d="M6.5 3L2 8L6.5 13M2 8H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Back to Home
                </a>
                <a class="btn btn-ghost" href="javascript:history.back()">Go Back</a>
            </div>

            <div class="help-chip">
                <span class="help-chip-dot">i</span>
                Need help? Contact ASOG TBI support.
            </div>
        </div>

    </div>
</body>

</html>