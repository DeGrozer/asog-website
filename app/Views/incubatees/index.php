<!-- ╔══════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — All Cohorts, One Page                           ║
     ║  Horizontal cohort tabs · Card grid · Panel detail            ║
     ╚══════════════════════════════════════════════════════════════╝ -->
<?php
$cohorts        = $cohorts ?? [];
$allIncubatees  = $allIncubatees ?? [];
$hasIncubatees  = ! empty($allIncubatees);
$hasCohorts     = ! empty($cohorts);
$sealUrl        = base_url('assets/img/ASOG%20TBI/PNG/Logo-white.png');
$firstCohort    = $hasCohorts ? $cohorts[0]['name'] : '';
?>

<link rel="stylesheet" href="<?= base_url('assets/css/incubatees.css') ?>">

<section class="ib-s relative min-h-screen py-20 pb-16">
    <div class="ib-w mx-auto px-6 md:px-10 lg:px-14">

        <?php if ($hasCohorts): ?>
        <!-- ═══════ COHORT TABS ═══════ -->
        <div class="ib-tabs reveal" id="ibTabs">
            <?php foreach ($cohorts as $i => $ch): ?>
            <button class="ib-tab<?= $i === 0 ? ' is-active' : '' ?>"
                    data-cohort="<?= esc($ch['name']) ?>">
                <?= esc($ch['name']) ?>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ($hasIncubatees): ?>
        <!-- ═══════ CARD GRID (all cohorts, filtered by tab) ═══════ -->
        <div id="ibStack" class="ib-stack flex flex-wrap gap-5 justify-center relative">
            <?php foreach ($allIncubatees as $i => $inc): ?>
            <div class="ib-card cursor-pointer relative"
                 data-ix="<?= $i ?>"
                 data-cohort="<?= esc($inc['cohort'] ?? '') ?>"
                 <?php if (($inc['cohort'] ?? '') !== $firstCohort): ?>style="display:none"<?php endif; ?>>
                <div class="ib-inner relative w-full h-full rounded-xl">

                    <!-- Front -->
                    <div class="ib-front absolute inset-0 overflow-hidden rounded-xl flex flex-col items-center">
                        <div class="ib-frame absolute pointer-events-none"></div>
                        <div class="ib-diamond absolute pointer-events-none tl"></div>
                        <div class="ib-diamond absolute pointer-events-none tr"></div>
                        <div class="ib-diamond absolute pointer-events-none bl"></div>
                        <div class="ib-diamond absolute pointer-events-none br"></div>
                        <div class="ib-portrait w-full flex-1 flex items-center justify-center relative">
                            <div class="ib-logo-box">
                                <?php if (! empty($inc['logoPath'])): ?>
                                    <img src="<?= base_url(esc($inc['logoPath'])) ?>" alt="<?= esc($inc['companyName']) ?>">
                                <?php else: ?>
                                    <span class="ib-init"><?= strtoupper(substr($inc['companyName'], 0, 1)) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Back -->
                    <div class="ib-back absolute inset-0 overflow-hidden rounded-xl flex flex-col items-center">
                        <div class="ib-frame absolute pointer-events-none"></div>
                        <div class="ib-frame-inner absolute pointer-events-none"></div>
                        <div class="ib-diamond absolute pointer-events-none tl"></div>
                        <div class="ib-diamond absolute pointer-events-none tr"></div>
                        <div class="ib-diamond absolute pointer-events-none bl"></div>
                        <div class="ib-diamond absolute pointer-events-none br"></div>
                        <div class="ib-dots absolute inset-0 pointer-events-none"></div>
                        <img class="ib-seal relative" src="<?= $sealUrl ?>" alt="ASOG TBI">
                        <div class="ib-back-divider relative shrink-0"></div>
                        <p class="ib-back-name relative shrink-0"><?= esc($inc['companyName']) ?></p>
                        <span class="ib-back-cohort relative shrink-0"><?= esc(preg_replace('/\s*[·•|\-–—]\s*\d{4}/', '', $inc['cohort'] ?? '')) ?></span>
                        <button class="ib-see-more relative shrink-0" data-ix="<?= $i ?>">
                            See More
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Coming Soon — visible when selected cohort has zero incubatees -->
        <div id="ibComingSoon" class="text-center py-16"
             style="display:<?= ($hasCohorts && $cohorts[0]['_count'] === 0) ? 'block' : 'none' ?>">
            <div class="mb-6">
                <svg class="w-16 h-16 mx-auto" style="color:rgba(2,13,24,.1)" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-6.914 0"/>
                </svg>
            </div>
            <h3 class="font-display text-2xl text-dark mb-3">
                <span id="ibCSLabel"><?= esc($firstCohort) ?></span> — Coming Soon
            </h3>
            <p class="text-dark/55 text-[.88rem] max-w-lg mx-auto leading-relaxed mb-2">
                Incubatees for this cohort will be announced soon.
            </p>
            <a href="<?= site_url('incubatees/apply') ?>"
               class="inline-block mt-6 text-[.7rem] font-bold tracking-[.14em] uppercase text-white bg-navy px-8 py-3.5 rounded-sm no-underline transition-colors hover:bg-navy/85">
                Apply Now
            </a>
        </div>

        <?php if (! $hasCohorts): ?>
        <div class="text-center py-12 reveal">
            <p class="text-dark/35 text-[.88rem] mb-6">No cohorts have been announced yet.</p>
            <a href="<?= site_url('incubatees/apply') ?>"
               class="inline-block text-[.7rem] font-bold tracking-[.14em] uppercase text-white bg-navy px-8 py-3.5 rounded-sm no-underline transition-colors hover:bg-navy/85">
                Apply Now
            </a>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="flex flex-col gap-2.5 items-start mt-10 sm:flex-row sm:items-center sm:justify-between">
            <p class="ib-count" id="ibCountLabel">
                <?php
                    $fCount = $hasCohorts ? $cohorts[0]['_count'] : 0;
                    echo $fCount > 0
                        ? $fCount . ' incubatee' . ($fCount !== 1 ? 's' : '') . ' in ' . esc($firstCohort)
                        : 'Interested in joining ASOG-TBI?';
                ?>
            </p>
            <a href="<?= site_url('incubatees/apply') ?>" class="ib-apply">Become an Incubatee</a>
        </div>

    </div>
</section>

<?php if ($hasIncubatees): ?>
    <?= view('incubatees/partials/_overlay', ['sealUrl' => $sealUrl]) ?>
    <?= view('incubatees/partials/_panel') ?>

    <!-- Mobile Preview Modal -->
    <div id="ibMobilePreview" class="ib-mob-preview">
        <div class="ib-mob-preview-backdrop" id="ibMobPreviewBackdrop"></div>
        <div class="ib-mob-preview-wrap" id="ibMobPreviewWrap">
            <button class="ib-mob-preview-close" id="ibMobPreviewClose">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="ib-mob-preview-card">
                <div class="ib-mob-preview-inner" id="mpInner">
                    <!-- Front — navy -->
                    <div class="ib-big-front absolute inset-0 rounded-2xl overflow-hidden flex flex-col items-center justify-center">
                        <div class="ib-frame absolute pointer-events-none"></div>
                        <div class="ib-frame-inner absolute pointer-events-none"></div>
                        <div class="ib-diamond absolute pointer-events-none tl"></div>
                        <div class="ib-diamond absolute pointer-events-none tr"></div>
                        <div class="ib-diamond absolute pointer-events-none bl"></div>
                        <div class="ib-diamond absolute pointer-events-none br"></div>
                        <div class="ib-dots absolute inset-0 pointer-events-none"></div>
                        <span id="mpNum" class="ib-bf-num absolute"></span>
                        <div class="ib-bf-portrait flex items-center justify-center relative">
                            <div id="mpLogo" class="ib-bf-logo flex items-center justify-center"></div>
                        </div>
                        <div class="ib-bf-divider shrink-0 relative"></div>
                        <div class="ib-bf-nameplate text-center relative">
                            <h3 id="mpName" class="ib-bf-name"></h3>
                            <p id="mpFounder" class="ib-bf-founder"></p>
                            <span id="mpCohort" class="ib-bf-cohort block"></span>
                        </div>
                        <span class="ib-mob-flip-cue">Tap to flip ↻</span>
                    </div>
                    <!-- Back — white / team -->
                    <div class="ib-big-back absolute inset-0 rounded-2xl overflow-hidden flex flex-col items-center justify-center text-center">
                        <div class="ib-frame absolute pointer-events-none"></div>
                        <div class="ib-frame-inner absolute pointer-events-none"></div>
                        <div class="ib-diamond absolute pointer-events-none tl"></div>
                        <div class="ib-diamond absolute pointer-events-none tr"></div>
                        <div class="ib-diamond absolute pointer-events-none bl"></div>
                        <div class="ib-diamond absolute pointer-events-none br"></div>
                        <div class="text-center relative z-10">
                            <span class="ib-bb-label block">The Team</span>
                            <p id="mpBackName" class="ib-bb-name"></p>
                        </div>
                        <div class="ib-bb-divider shrink-0 relative"></div>
                        <div id="mpBackTeam" class="ib-bb-team w-full flex flex-col items-center overflow-y-auto relative"></div>
                    </div>
                </div>
            </div>
            <span class="ib-mob-preview-hint" id="mpHint">Tap card to flip</span>
            <button class="ib-mob-preview-read" id="mpReadMore">
                Read More
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    <!-- Incubatee data (all cohorts combined) -->
    <script>
    window.__ibData = <?= json_encode(array_map(function($inc){
        return [
            'companyName'      => html_entity_decode($inc['companyName'] ?? '', ENT_QUOTES, 'UTF-8'),
            'founderName'      => html_entity_decode($inc['founderName'] ?? '', ENT_QUOTES, 'UTF-8'),
            'founderPosition'  => html_entity_decode($inc['founderPosition'] ?? '', ENT_QUOTES, 'UTF-8'),
            'founderPhoto'     => ! empty($inc['founderPhoto']) ? base_url($inc['founderPhoto']) : '',
            'shortDescription' => html_entity_decode($inc['shortDescription'] ?? '', ENT_QUOTES, 'UTF-8'),
            'content'          => $inc['content'] ?? '',
            'logoPath'         => ! empty($inc['logoPath']) ? base_url($inc['logoPath']) : '',
            'logoWhitePath'    => ! empty($inc['logoWhitePath']) ? base_url($inc['logoWhitePath']) : '',
            'websiteUrl'       => html_entity_decode($inc['websiteUrl'] ?? '', ENT_QUOTES, 'UTF-8'),
            'facebookUrl'      => html_entity_decode($inc['facebookUrl'] ?? '', ENT_QUOTES, 'UTF-8'),
            'cohort'           => html_entity_decode($inc['cohort'] ?? '', ENT_QUOTES, 'UTF-8'),
            'teamMembers'      => array_map(static function ($m) {
                return [
                    'name'  => html_entity_decode($m['name'] ?? '', ENT_QUOTES, 'UTF-8'),
                    'role'  => html_entity_decode($m['role'] ?? '', ENT_QUOTES, 'UTF-8'),
                    'photo' => ! empty($m['photo']) ? base_url($m['photo']) : '',
                ];
            }, ! empty($inc['teamMembers']) ? (json_decode($inc['teamMembers'], true) ?: []) : []),
        ];
    }, $allIncubatees), JSON_HEX_TAG | JSON_HEX_APOS) ?>;
    </script>
    <script src="<?= base_url('assets/js/incubatees.js') ?>"></script>

    <!-- Cohort Tab Switching -->
    <script>
    (function(){
        var tabs   = document.querySelectorAll('.ib-tab');
        var cards  = document.querySelectorAll('#ibStack .ib-card');
        var stack  = document.getElementById('ibStack');
        var coming = document.getElementById('ibComingSoon');
        var csLbl  = document.getElementById('ibCSLabel');
        var cntLbl = document.getElementById('ibCountLabel');

        if (!tabs.length) return;

        tabs.forEach(function(tab){
            tab.addEventListener('click', function(){
                tabs.forEach(function(t){ t.classList.remove('is-active'); });
                tab.classList.add('is-active');

                var cohort  = tab.dataset.cohort;
                var visible = 0;

                cards.forEach(function(card){
                    if (card.dataset.cohort === cohort) {
                        card.style.display = '';
                        visible++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (visible === 0) {
                    if (stack)  stack.style.display  = 'none';
                    if (coming) coming.style.display = '';
                    if (csLbl)  csLbl.textContent    = cohort;
                    if (cntLbl) cntLbl.textContent   = 'Interested in joining ASOG-TBI?';
                } else {
                    if (stack)  stack.style.display  = '';
                    if (coming) coming.style.display = 'none';
                    if (cntLbl) cntLbl.textContent   = visible + ' incubatee' + (visible !== 1 ? 's' : '') + ' in ' + cohort;

                    if (typeof gsap !== 'undefined') {
                        gsap.from('#ibStack .ib-card:not([style*="display: none"])', {
                            opacity: 0, y: 25, scale: .94,
                            duration: .35, stagger: .05,
                            ease: 'power2.out'
                        });
                    }
                }
            });
        });
    })();
    </script>
<?php endif; ?>
