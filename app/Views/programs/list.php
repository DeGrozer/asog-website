<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  PROGRAMS & SERVICES — TOC + ALTITUDE, Services, Facilities         ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->

<!-- TOC wrapper for programs page -->
<div class="relative bg-off">
    <div class="max-w-[1200px] mx-auto px-6 md:px-10 lg:px-14">
        <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-8 lg:gap-12">

            <!-- ── TOC Sidebar ── -->
            <div class="pt-16 md:pt-24 lg:pt-24 self-stretch">
                <?php
                    $tocTitle = 'Programs & Services';
                    $tocItems = [
                        ['id' => 'altitude-program', 'label' => 'ALTITUDE Program', 'children' => [
                            ['id' => 'trailhead', 'label' => 'Trailhead'],
                            ['id' => 'basecamp', 'label' => 'Basecamp'],
                            ['id' => 'ascent', 'label' => 'Ascent'],
                            ['id' => 'summit-launch', 'label' => 'Summit Launch'],
                        ]],
                    ];
                ?>
                <?= view('templates/toc', compact('tocTitle', 'tocItems')) ?>
            </div>

            <!-- ── Main Content Column ── -->
            <div class="min-w-0">

                <!-- ╔════════════════════════════════════════════════════════════════════╗
     ║  SECTION 1: ALTITUDE PROGRAM                                      ║
     ╚════════════════════════════════════════════════════════════════════╝ -->
                <section class="relative py-20 md:py-32">

                    <div id="altitude-program" class="scroll-mt-28"></div>

                    <div class="max-w-[760px] mx-auto relative z-[2]">
                        <!-- Hero text -->
                        <div class="text-center mb-14">
                            <div class="flex items-center justify-center gap-2 mb-4">
                                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Six-Month
                                    Incubation</span>
                                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                            </div>
                            <h1 class="font-display text-[2rem] md:text-[2.8rem] leading-[1.12] text-dark mb-6">ALTITUDE
                                Program</h1>
                            <p class="text-[.95rem] font-light leading-[1.8] text-dark/50 italic">Advancing Local
                                Technology and Innovation through Transformative Upskilling, Development, and
                                Entrepreneurship</p>
                        </div>

                        <!-- ── 3D Explore Card (horizontal) ── -->
                        <div id="altitude-3d" class="scroll-mt-28 mb-14">
                            <div id="altitudeExploreCard" class="alt3d-card" role="button" tabindex="0" aria-label="Open interactive 3D view">
                                <div class="alt3d-card-preview">
                                    <svg class="alt3d-card-svg" viewBox="0 0 220 180" fill="none">
                                        <rect width="220" height="180" fill="#87ceeb" rx="6"/>
                                        <!-- Clouds -->
                                        <ellipse cx="40" cy="28" rx="18" ry="8" fill="#fff" opacity=".8"/>
                                        <ellipse cx="50" cy="26" rx="12" ry="7" fill="#fff" opacity=".8"/>
                                        <ellipse cx="185" cy="22" rx="15" ry="7" fill="#fff" opacity=".8"/>
                                        <ellipse cx="175" cy="20" rx="10" ry="6" fill="#fff" opacity=".8"/>
                                        <!-- Dirt rim / base plate -->
                                        <ellipse cx="110" cy="155" rx="95" ry="18" fill="#c4a46c"/>
                                        <ellipse cx="110" cy="153" rx="92" ry="16" fill="#3d7a28"/>
                                        <!-- Green rolling hills -->
                                        <ellipse cx="108" cy="132" rx="78" ry="38" fill="#5a9e3e"/>
                                        <ellipse cx="85" cy="135" rx="40" ry="22" fill="#4a8c2a" opacity=".5"/>
                                        <!-- Pointed grassy peaks -->
                                        <path d="M102 40 L85 128 Q110 132 135 128 Z" fill="#5a9e3e"/>
                                        <path d="M55 68 L42 132 Q55 136 72 132 Z" fill="#3d7a28"/>
                                        <path d="M160 76 L148 134 Q160 138 175 134 Z" fill="#3d7a28"/>
                                        <path d="M72 80 L62 130 Q72 134 82 130 Z" fill="#4a8c2a"/>
                                        <!-- Rocky highlights near peaks -->
                                        <circle cx="100" cy="52" r="3" fill="#8a8070" opacity=".6"/>
                                        <circle cx="56" cy="75" r="2.5" fill="#6e655a" opacity=".6"/>
                                        <circle cx="158" cy="82" r="2" fill="#8a8070" opacity=".5"/>
                                        <!-- Dirt trail winding up -->
                                        <path d="M155 145 C140 135, 130 125, 120 118 S95 108, 80 100 S60 88, 58 80 S85 60, 102 42" stroke="#c4a46c" stroke-width="2.5" fill="none" stroke-linecap="round" opacity=".7"/>
                                        <!-- Trees -->
                                        <g transform="translate(78,116) scale(.6)"><rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1"/><polygon points="0,-8 5,1 -5,1" fill="#2d6b1a"/><polygon points="0,-5 4,0 -4,0" fill="#4a8c2a"/><polygon points="0,-3 3,1 -3,1" fill="#60a836"/></g>
                                        <g transform="translate(128,114) scale(.55)"><rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1"/><polygon points="0,-8 5,1 -5,1" fill="#2d6b1a"/><polygon points="0,-5 4,0 -4,0" fill="#4a8c2a"/></g>
                                        <g transform="translate(95,108) scale(.5)"><rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1"/><polygon points="0,-8 5,1 -5,1" fill="#4a8c2a"/><polygon points="0,-5 4,0 -4,0" fill="#60a836"/></g>
                                        <g transform="translate(145,122) scale(.45)"><rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1"/><polygon points="0,-8 5,1 -5,1" fill="#2d6b1a"/><polygon points="0,-5 4,0 -4,0" fill="#4a8c2a"/></g>
                                        <g transform="translate(65,120) scale(.5)"><rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1"/><polygon points="0,-8 5,1 -5,1" fill="#2d6b1a"/><polygon points="0,-5 4,0 -4,0" fill="#60a836"/></g>
                                        <!-- Flowers -->
                                        <circle cx="88" cy="125" r="1.5" fill="#f7d75a"/><circle cx="118" cy="122" r="1.5" fill="#e86040"/><circle cx="135" cy="128" r="1.5" fill="#d05aba"/>
                                        <!-- Red flags along trail -->
                                        <line x1="82" y1="102" x2="82" y2="92" stroke="#6b4226" stroke-width="1.2" stroke-linecap="round"/>
                                        <polygon points="82,92 90,94 82,97" fill="#e85040"/>
                                        <line x1="118" y1="118" x2="118" y2="108" stroke="#6b4226" stroke-width="1.2" stroke-linecap="round"/>
                                        <polygon points="118,108 126,110 118,113" fill="#e85040"/>
                                        <!-- Gold flag on summit -->
                                        <line x1="102" y1="42" x2="102" y2="26" stroke="#6b4226" stroke-width="1.5" stroke-linecap="round"/>
                                        <polygon points="102,26 113,29 102,33" fill="#F8AF21"/>
                                        <!-- Hero hiker near trailhead -->
                                        <g transform="translate(148,138) scale(.7)">
                                            <rect x="-3" y="-12" width="6" height="10" fill="#2a7a4a" rx="2"/>
                                            <circle cx="0" cy="-15" r="3" fill="#f0c8a0"/>
                                            <ellipse cx="0" cy="-18" rx="5" ry="2" fill="#5a3a1a"/>
                                            <rect x="-1.5" y="-2" width="3" height="5" fill="#4a4035"/>
                                            <rect x="1" y="-10" width="4" height="6" fill="#b85530" rx="1"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="alt3d-card-body">
                                    <span class="alt3d-card-tag">Interactive 3D</span>
                                    <h3 class="alt3d-card-title">The Journey to Summit</h3>
                                    <p class="alt3d-card-sub">Follow a hiker through each stage of the ALTITUDE program on an interactive grassland mountain.</p>
                                    <span class="alt3d-card-cta">
                                        Explore
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Main content -->
                        <div class="prose-content text-[.95rem] font-normal leading-[1.95] text-dark/60 space-y-8">

                            <!-- Intro -->
                            <div>
                                <h2 class="font-display text-[1.8rem] leading-[1.18] text-dark mb-6">Climbing with
                                    Purpose</h2>
                                <p class="mb-4">A closer look at ASOG TBI's ALTITUDE framework</p>
                                <p class="mb-4"><strong class="text-dark/75">Every startup dreams of reaching the top.
                                        Few are prepared for the climb.</strong></p>
                                <p class="mb-4">In conversations about innovation, success is often framed as a moment:
                                    a product launch, a funding round, a demo day applause. What gets less attention is
                                    the stretch before all that: the uncertain terrain where ideas are still fragile,
                                    assumptions remain untested, and founders are unsure whether they are moving forward
                                    or simply in circles.</p>
                                <p class="mb-4">This is where most startups fail, not because the summit is unreachable,
                                    but because the climb itself is poorly mapped.</p>
                                <p>At the ASOG Technology Business Incubator, the response to this problem is not speed,
                                    but structure. The incubator's official program, ALTITUDE, short for <strong
                                        class="text-dark/75">Advancing Local Technology and Innovation through
                                        Transformative Upskilling, Development, and Entrepreneurship</strong>, is
                                    designed around a simple belief: founders do not just need ambition. They also need
                                    orientation.</p>
                            </div>

                            <p>ALTITUDE runs over six months, but its real contribution is not the timeline. It is the
                                way the journey is broken down, deliberately and patiently, into stages that force
                                founders to confront the hardest questions early, before momentum disguises weak
                                foundations.</p>

                            <!-- Trailhead -->
                            <div>
                                <h3 id="trailhead" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28">
                                    <strong>Trailhead</strong><br><span
                                        class="text-[.85rem] font-normal text-dark/50">Pre-Incubation Phase (Month
                                        1)</span></h3>
                                <p class="mb-3">Each climb begins with a pause.</p>
                                <p class="mb-3">The Trailhead is where startups are asked to slow down before they move
                                    forward. In the first month of ALTITUDE, founders focus on clarifying the problem
                                    they want to solve and testing whether it truly exists in the way they imagine.
                                    Ideas are subjected to scrutiny, not encouragement for their own sake.</p>
                                <p className="mb-3">With industry mentors acting as validators, teams examine their
                                    assumptions against real market pain points. Many concepts shift here. Some are
                                    reworked. Others are abandoned altogether. The aim is not to discourage risk, but to
                                    prevent founders from investing deeply in solutions that have not yet earned the
                                    right to exist.</p>
                            </div>

                            <!-- Basecamp -->
                            <div>
                                <h3 id="basecamp" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28">
                                    <strong>Basecamp</strong><br><span
                                        class="text-[.85rem] font-normal text-dark/50">Incubation Phase (Months
                                        2–4)</span></h3>
                                <p class="mb-3">Basecamp is where effort becomes visible.</p>
                                <p class="mb-3">During the incubation phase, startups begin building. Minimum viable
                                    products take form. Features are tested with early adopters. Business models are
                                    refined alongside technical development. What once lived on whiteboards and pitch
                                    slides is forced into contact with reality.</p>
                                <p>Market access enters the picture here, as founders prepare for initial customer
                                    engagement and partnerships. Basecamp rewards learning that happens fast enough to
                                    evolve and carefully enough to endure.</p>
                            </div>

                            <!-- Ascent -->
                            <div>
                                <h3 id="ascent" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28">
                                    <strong>Ascent</strong><br><span
                                        class="text-[.85rem] font-normal text-dark/50">Post-Incubation Phase (Months
                                        5–6)</span></h3>
                                <p class="mb-3">The higher the climb, the more preparation matters.</p>
                                <p class="mb-3">The Ascent phase shifts the focus from building to positioning. With
                                    early validation in place, founders are introduced to the expectations of funders,
                                    grant institutions, and strategic partners. They work on the tools required for
                                    serious conversations: pitch decks, financial projections, and long-term viability
                                    plans.</p>
                                <p>This is where confidence is tested. Not through applause, but through questions that
                                    force clarity about scale, sustainability, and impact.</p>
                            </div>

                            <!-- Summit Launch -->
                            <div>
                                <h3 id="summit-launch" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28">
                                    <strong>Summit Launch</strong></h3>
                                <p class="mb-3">Reaching the summit does not mean standing still.</p>
                                <p class="mb-3">Summit Launch marks the transition beyond formal incubation, where
                                    startups continue to receive strategic support as they navigate growth. Access to
                                    networks, mentorship, and partnerships remains part of the relationship because
                                    scaling presents challenges that are just as complex as early development.</p>
                                <p class="mb-6">Throughout ALTITUDE, mentorship is treated not as a single intervention
                                    but as a continuous presence. Founders engage through one-on-one sessions, expert
                                    clinics, immersion activities, technical reviews, and pitch rehearsals. Learning
                                    happens in rooms and in the field, shaped by feedback that mirrors the pressures of
                                    the real world.</p>
                                <p class="text-[.88rem] text-dark/50 italic">In an ecosystem often driven by urgency and
                                    acceleration, ALTITUDE makes a quieter argument. That preparation matters. That
                                    clarity is earned. That progress is intentional.</p>
                                <p class="text-[.88rem] text-dark/50 italic">By combining structure, mentorship, and
                                    timing, ASOG TBI bridges the gap between dreaming of the summit and being ready for
                                    the climb.</p>
                            </div>

                        </div>
                    </div>

                </section>

            </div><!-- end main content column -->
        </div><!-- end grid -->
    </div><!-- end max-w container -->
</div><!-- end TOC wrapper -->

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  ALTITUDE 3D — Wilderness Zoom Overlay + Fullscreen 3D Scene      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<link rel="stylesheet" href="<?= base_url('assets/css/altitude3d.css') ?>">

<!-- Phase 1: Wilderness Zoom Transition Overlay -->
<div id="alt3dZoomOverlay" class="alt3d-zoom-overlay">
    <div class="alt3d-zoom-mountains">
        <svg viewBox="0 0 1440 800" preserveAspectRatio="none">
            <path id="alt3dMtnFar"  class="alt3d-mtn-far"  d="M0 800 L200 400 L360 520 L540 280 L720 450 L900 200 L1100 380 L1300 180 L1440 350 L1440 800Z"/>
            <path id="alt3dMtnMid"  class="alt3d-mtn-mid"  d="M0 800 L140 480 L300 560 L480 320 L660 500 L840 260 L1020 420 L1200 220 L1380 380 L1440 440 L1440 800Z"/>
            <path id="alt3dMtnNear" class="alt3d-mtn-near" d="M0 800 L100 560 L260 620 L400 440 L560 580 L720 380 L880 520 L1060 340 L1240 480 L1440 520 L1440 800Z"/>
        </svg>
    </div>
    <div id="alt3dZoomText" class="alt3d-zoom-text" style="opacity:0; transform:translateY(20px);">
        <p class="zt-eyebrow">ASOG-TBI · The ALTITUDE Program</p>
        <h2 class="zt-title">The Journey to Summit</h2>
    </div>
</div>

<!-- Phase 2: Fullscreen 3D Scene Overlay -->
<div id="alt3dOverlay" class="alt3d-overlay">
    <canvas id="alt3dCanvas"></canvas>

    <!-- Close button -->
    <button id="alt3dClose" class="alt3d-close" aria-label="Close 3D view">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
        </svg>
    </button>

    <!-- Title -->
    <div class="alt3d-title">
        <p class="at-eyebrow">ASOG-TBI · The ALTITUDE Program</p>
        <h1>The Journey to Summit</h1>
        <p class="at-sub">Click a flag to explore each stage</p>
    </div>

    <!-- Flag labels container -->
    <div id="alt3dLabels" class="alt3d-labels"></div>

    <!-- Info card -->
    <div id="alt3dInfo" class="alt3d-info">
        <div class="ci-num"  id="ciNum"></div>
        <div class="ci-name" id="ciName"></div>
        <div class="ci-phase" id="ciPhase"></div>
        <div class="ci-dur"  id="ciDur"></div>
        <div class="ci-desc" id="ciDesc"></div>
        <div class="ci-nav">
            <button class="ci-btn-main" id="ciBtnPrev">&larr; Prev</button>
            <button class="ci-btn-main" id="ciBtnNext">Next &rarr;</button>
            <button class="ci-btn-close" id="ciBtnOverview">&times; Overview</button>
        </div>
    </div>

    <!-- Progress dots -->
    <div id="alt3dDots" class="alt3d-dots">
        <button class="alt3d-dot" data-i="0"></button>
        <button class="alt3d-dot" data-i="1"></button>
        <button class="alt3d-dot" data-i="2"></button>
        <button class="alt3d-dot" data-i="3"></button>
    </div>

    <!-- Hint -->
    <p id="alt3dHint" class="alt3d-hint">Click a flag to explore · Drag to orbit</p>
</div>

<!-- Three.js + Altitude 3D Module -->
<script type="importmap">{"imports":{"three":"https://cdn.jsdelivr.net/npm/three@0.170.0/build/three.module.js","three/addons/":"https://cdn.jsdelivr.net/npm/three@0.170.0/examples/jsm/"}}</script>
<script type="module" src="<?= base_url('assets/js/altitude3d.js') ?>"></script>