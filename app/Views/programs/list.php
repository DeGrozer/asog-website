<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  PROGRAMS & SERVICES — TOC + ALTITUDE, Services, Facilities         ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->

<!-- Programs page wrapper -->
<div class="relative bg-off">
    <div class="max-w-[1320px] mx-auto px-6 md:px-10 lg:px-14">
        <div class="min-w-0">
            <!-- ╔════════════════════════════════════════════════════════════════════╗
 ║  SECTION 1: ALTITUDE PROGRAM                                      ║
 ╚════════════════════════════════════════════════════════════════════╝ -->
            <section class="relative py-20 md:py-25">

                <div id="altitude-program" class="scroll-mt-28"></div>

                <div class="max-w-[1120px] mx-auto relative z-[2]">
                    <div id="altitudeExperienceRoot" class="altitude-exp-root">
                        <div id="altitudeLandingPage" class="altitude-exp-page altitude-exp-landing is-active">
                            <div class="altitude-exp-hero">
                                <div class="altitude-exp-mtn" aria-hidden="true">
                                    <svg viewBox="0 0 720 360" fill="none" preserveAspectRatio="none">
                                        <path d="M0 360L88 228L158 274L260 136L352 232L442 92L556 210L652 126L720 192V360H0Z" fill="rgba(255,255,255,.15)"/>
                                        <path d="M0 360L64 252L146 292L236 176L330 248L436 122L530 214L630 152L720 206V360H0Z" fill="rgba(255,255,255,.28)"/>
                                        <path d="M0 360L46 286L120 314L210 228L306 286L400 176L496 256L600 202L720 248V360H0Z" fill="rgba(255,255,255,.42)"/>
                                    </svg>
                                </div>
                                <div class="altitude-exp-hero-content">
                                    <p class="altitude-exp-kicker">ASOG TBI Incubation Program</p>
                                    <h1 class="altitude-exp-title">ALTITUDE</h1>
                                    <p class="altitude-exp-subtitle">Advancing Local Technology and Innovation through Transformative Upskilling, Development, and Entrepreneurship</p>
                                    <button id="altitudeEnterProgram" type="button" class="altitude-exp-enter-btn">Go to ALTITUDE Experience</button>
                                </div>
                            </div>
                        </div>

                        <div id="altitudeProgramPage" class="altitude-exp-page altitude-exp-program" hidden>
                            <!-- Ghost trigger keeps the 3D module's click handler alive -->
                            <div id="altitudeExploreCard" role="button" tabindex="-1" aria-label="Open ALTITUDE interactive view" style="display:none"></div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  ALTITUDE 3D — Wilderness Zoom Overlay + Fullscreen 3D Scene      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<link rel="stylesheet" href="<?= base_url('assets/css/altitude3d.css') ?>">

<!-- Phase 1: Wilderness Zoom Transition Overlay -->
<div id="alt3dZoomOverlay" class="alt3d-zoom-overlay">
    <div class="alt3d-zoom-mountains">
        <svg viewBox="0 0 1440 800" preserveAspectRatio="none">
            <path id="alt3dMtnFar" class="alt3d-mtn-far"
                d="M0 800 L200 400 L360 520 L540 280 L720 450 L900 200 L1100 380 L1300 180 L1440 350 L1440 800Z" />
            <path id="alt3dMtnMid" class="alt3d-mtn-mid"
                d="M0 800 L140 480 L300 560 L480 320 L660 500 L840 260 L1020 420 L1200 220 L1380 380 L1440 440 L1440 800Z" />
            <path id="alt3dMtnNear" class="alt3d-mtn-near"
                d="M0 800 L100 560 L260 620 L400 440 L560 580 L720 380 L880 520 L1060 340 L1240 480 L1440 520 L1440 800Z" />
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
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
        </svg>
    </button>

    <!-- Small info toggle (replaces top title) -->
    <div class="alt3d-mini-info-wrap">
        <button id="alt3dInfoBtn" class="alt3d-mini-info-btn" aria-label="About this experience" aria-expanded="false">
            <span aria-hidden="true">i</span>
        </button>
    </div>

    <div id="alt3dInfoModal" class="alt3d-info-modal" hidden>
        <div class="alt3d-info-modal-card">
            <button id="alt3dInfoModalClose" class="alt3d-info-modal-close" aria-label="Close program information">&times;</button>
            <h3>ALTITUDE Program</h3>
            <p>ALTITUDE - Advancing Local Technology and Innovation through Transformative Upskilling, Development, and Entrepreneurship - is the official incubation program of the ASOG Technology Business Incubator.</p>
            <p>The program supports early-stage startups by providing structured guidance, mentorship, and resources that help transform innovative ideas into viable ventures.</p>
            <p>ALTITUDE follows a staged incubation approach designed to guide startups from idea development to scaling. Each stage focuses on specific milestones that help founders refine their technology, validate market demand, and prepare for sustainable growth.</p>
        </div>
    </div>

    <!-- Flag labels container -->
    <div id="alt3dLabels" class="alt3d-labels"></div>

    <!-- Info card -->
    <div id="alt3dInfo" class="alt3d-info">
        <div class="ci-num" id="ciNum"></div>
        <div class="ci-name" id="ciName"></div>
        <div class="ci-phase" id="ciPhase"></div>
        <div class="ci-dur" id="ciDur"></div>
        <button id="ciBtnAboutStep" class="ci-btn-about" type="button">Read More</button>
        <div class="ci-desc" id="ciDesc"></div>
        <div class="ci-nav">
            <button class="ci-btn-main" id="ciBtnPrev">&larr; Prev</button>
            <button class="ci-btn-main" id="ciBtnNext">Next &rarr;</button>
            <button class="ci-btn-close" id="ciBtnOverview">&times; Overview</button>
        </div>
    </div>

    <div id="alt3dStepModal" class="alt3d-step-modal" hidden>
        <div class="alt3d-step-modal-card">
            <button id="alt3dStepModalClose" class="alt3d-step-modal-close" aria-label="Close step details">&times;</button>
            <div class="ci-num" id="ciStepNum"></div>
            <div class="ci-name" id="ciStepName"></div>
            <div class="ci-phase" id="ciStepPhase"></div>
            <div class="ci-dur" id="ciStepDur"></div>
            <div class="ci-desc" id="ciStepDesc"></div>
        </div>
    </div>

    <!-- Progress dots -->
    <div id="alt3dDots" class="alt3d-dots">
        <button class="alt3d-dot" data-i="0"></button>
        <button class="alt3d-dot" data-i="1"></button>
        <button class="alt3d-dot" data-i="2"></button>
        <button class="alt3d-dot" data-i="3"></button>
        <button class="alt3d-dot" data-i="4"></button>
    </div>

    <!-- Hint -->
    <p id="alt3dHint" class="alt3d-hint">Click a checkpoint to explore the journey · Press ESC to exit</p>

    <button id="alt3dShowPartners" class="alt3d-mentors-btn" type="button" aria-controls="alt3dPartnersPanel" aria-expanded="false">
        Faculty &amp; Industry Partners <span class="alt3d-mentors-btn-arrow" aria-hidden="true">↓</span>
    </button>

    <section id="alt3dPartnersPanel" class="alt3d-mentors-overlay" aria-label="Faculty and industry partners">
        <div class="alt3d-mentors-inner">
            <button id="alt3dPartnersUp" class="alt3d-mentors-close" type="button">↑ Back to Interactive</button>
            <p class="alt3d-mentors-kicker">ALTITUDE Partner Network</p>
            <h2>Faculty &amp; Industry Partners</h2>
            <p>The ALTITUDE Program is strengthened by a network of academic mentors and industry partners who bring domain expertise, industry connections, and ecosystem access to every incubation journey.</p>

            <div class="alt3d-mentors-block">
                <h3>Faculty Mentors</h3>
                <div class="alt3d-mentor-grid">
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">Dr. Maria Santos</h4>
                        <p class="alt3d-mentor-role">Technology Innovation</p>
                    </article>
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">Prof. Juan dela Cruz</h4>
                        <p class="alt3d-mentor-role">Business Strategy</p>
                    </article>
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">Engr. Anna Reyes</h4>
                        <p class="alt3d-mentor-role">Product Development</p>
                    </article>
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">Dr. Carlos Mendoza</h4>
                        <p class="alt3d-mentor-role">Agri-Tech Research</p>
                    </article>
                </div>
            </div>

            <div class="alt3d-mentors-block">
                <h3>Industry Partners</h3>
                <div class="alt3d-industry-list">
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">Agrilink Philippines</h4>
                        <p class="alt3d-mentor-role">Agri Supply Chain</p>
                    </article>
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">FoodTech Asia</h4>
                        <p class="alt3d-mentor-role">Food Innovation</p>
                    </article>
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">InnoHub PH</h4>
                        <p class="alt3d-mentor-role">Startup Ecosystem</p>
                    </article>
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">DOST-TAPI</h4>
                        <p class="alt3d-mentor-role">Technology Commercialization</p>
                    </article>
                    <article class="alt3d-mentor-card">
                        <h4 class="alt3d-mentor-name">GoNegosyo Network</h4>
                        <p class="alt3d-mentor-role">Entrepreneurship Support</p>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="altitudeProgramModal" class="alt3d-info-modal" hidden>
    <div class="alt3d-info-modal-card">
        <button id="altitudeProgramModalClose" class="alt3d-info-modal-close" aria-label="Close ALTITUDE program details">&times;</button>
        <h3>ALTITUDE Program</h3>
        <p>ALTITUDE - Advancing Local Technology and Innovation through Transformative Upskilling, Development, and Entrepreneurship - is the official incubation program of the ASOG Technology Business Incubator.</p>
        <p>The program supports early-stage startups by providing structured guidance, mentorship, and resources that help transform innovative ideas into viable ventures.</p>
        <p>ALTITUDE follows a staged incubation approach designed to guide startups from idea development to scaling. Each stage focuses on specific milestones that help founders refine their technology, validate market demand, and prepare for sustainable growth.</p>
    </div>
</div>

<!-- Three.js + Altitude 3D Module -->
<script type="importmap">
    {"imports":{"three":"https://cdn.jsdelivr.net/npm/three@0.170.0/build/three.module.js","three/addons/":"https://cdn.jsdelivr.net/npm/three@0.170.0/examples/jsm/"}}
</script>
<script type="module" src="<?= base_url('assets/js/altitude3d.js') ?>"></script>
<script>
    (() => {
        const root = document.getElementById('altitudeExperienceRoot');
        if (!root) return;

        const landingPage = document.getElementById('altitudeLandingPage');
        const programPage = document.getElementById('altitudeProgramPage');
        const enterBtn = document.getElementById('altitudeEnterProgram');
        const backBtn = document.getElementById('altitudeBackToLanding');
        const readMoreBtn = document.getElementById('altitudeProgramReadMore');
        const programModal = document.getElementById('altitudeProgramModal');
        const programModalClose = document.getElementById('altitudeProgramModalClose');

        const showProgramPage = () => {
            /* Skip intermediate program page — fire the 3D experience directly */
            const c = document.getElementById('altitudeExploreCard');
            if (c) c.click();
        };

        const showLandingPage = () => {
            hideProgramModal();
            root.querySelectorAll('[data-stage-toggle]').forEach((btn) => {
                const panelId = btn.getAttribute('aria-controls');
                const panel = panelId ? document.getElementById(panelId) : null;
                const card = btn.closest('[data-stage-card]');
                btn.setAttribute('aria-expanded', 'false');
                if (panel) panel.hidden = true;
                if (card) card.classList.remove('is-open');
            });
            programPage.classList.remove('is-active');
            programPage.hidden = true;
            landingPage.classList.add('is-active');
        };

        if (enterBtn) enterBtn.addEventListener('click', showProgramPage);
        if (backBtn) backBtn.addEventListener('click', showLandingPage);

        root.querySelectorAll('[data-stage-toggle]').forEach((btn) => {
            const panelId = btn.getAttribute('aria-controls');
            const panel = panelId ? document.getElementById(panelId) : null;
            const card = btn.closest('[data-stage-card]');
            if (!panel || !card) return;

            btn.addEventListener('click', () => {
                const expanded = btn.getAttribute('aria-expanded') === 'true';
                btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
                panel.hidden = expanded;
                card.classList.toggle('is-open', !expanded);
            });
        });

        const stagePanelByHash = {
            trailhead: 'stage-panel-trailhead',
            basecamp: 'stage-panel-basecamp',
            ascent: 'stage-panel-ascent',
            'summit-launch': 'stage-panel-summit'
        };

        const revealFromHash = (hashValue, smooth) => {
            const targetHash = (hashValue || '').replace('#', '');
            if (!['altitude-program', 'altitude-3d', 'trailhead', 'basecamp', 'ascent', 'summit-launch'].includes(targetHash)) return;

            /* ALTITUDE TOC link should open landing first, then user enters interactive. */
            showLandingPage();

            const anchor = document.getElementById('altitude-program');
            if (anchor) anchor.scrollIntoView({ behavior: smooth ? 'smooth' : 'auto', block: 'start' });

            /* If altitude-3d hash, auto-enter the 3D experience after landing page shows */
            if (targetHash === 'altitude-3d') {
                setTimeout(() => {
                    showProgramPage();
                }, 300);
            }
        };

        const showProgramModal = () => {
            if (!programModal) return;
            programModal.hidden = false;
            document.body.style.overflow = 'hidden';
        };

        const hideProgramModal = () => {
            if (!programModal) return;
            programModal.hidden = true;
            document.body.style.overflow = '';
        };

        if (readMoreBtn) readMoreBtn.addEventListener('click', showProgramModal);
        if (programModalClose) programModalClose.addEventListener('click', hideProgramModal);
        if (programModal) {
            programModal.addEventListener('click', (event) => {
                if (event.target === programModal) hideProgramModal();
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && programModal && !programModal.hidden) {
                hideProgramModal();
            }
        });

        revealFromHash(window.location.hash, false);
        window.addEventListener('hashchange', () => revealFromHash(window.location.hash, true));

        const overlay3d = document.getElementById('alt3dOverlay');
        if (overlay3d && typeof MutationObserver !== 'undefined') {
            let wasActive = overlay3d.classList.contains('active');
            const observer = new MutationObserver(() => {
                const isActive = overlay3d.classList.contains('active');
                if (wasActive && !isActive) {
                    showLandingPage();
                }
                wasActive = isActive;
            });
            observer.observe(overlay3d, { attributes: true, attributeFilter: ['class'] });
        }
    })();
</script>