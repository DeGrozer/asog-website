<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — Showcase Page                                          ║
     ║  Grid of incubatee cards + detail modal on click                     ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<?php
$incubatees     = $incubatees ?? [];
$hasIncubatees  = ! empty($incubatees);
?>

<!-- ── Grid Section ── -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14 overflow-hidden">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1100px] mx-auto relative z-[2]">
        <!-- Intro -->
        <div class="max-w-[620px] mb-14 md:mb-18">
            <div class="flex items-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy">Portfolio</span>
            </div>
            <h2 class="font-display text-[1.8rem] md:text-[2.4rem] leading-[1.12] text-dark mb-4">
                Our Incubatees
            </h2>
            <p class="text-[.88rem] font-light leading-[1.85] text-dark/50">
                Startups and MSMEs currently part of the ASOG-TBI incubation program — building solutions across the food value chain through engineering and AI.
            </p>
        </div>

        <?php if ($hasIncubatees): ?>
        <!-- Incubatee Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[1px] bg-dark/[.06] border border-dark/[.06] rounded-md overflow-hidden mb-10">
            <?php foreach ($incubatees as $i => $inc): ?>
            <button type="button"
                class="inc-card bg-white hover:bg-off/60 text-left p-7 md:p-8 transition-colors duration-200 group cursor-pointer"
                data-idx="<?= $i ?>"
                onclick="openIncubateeModal(<?= $i ?>)">
                <!-- Logo / Initial -->
                <div class="w-14 h-14 rounded-lg border border-dark/[.06] bg-off flex items-center justify-center mb-5 overflow-hidden">
                    <?php if (! empty($inc['logoPath'])): ?>
                        <img src="<?= base_url(esc($inc['logoPath'])) ?>" alt="<?= esc($inc['companyName']) ?>" class="w-full h-full object-contain p-1.5">
                    <?php else: ?>
                        <span class="font-display text-[1.4rem] leading-none text-gold/60 select-none">
                            <?= strtoupper(substr($inc['companyName'], 0, 1)) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Company Name -->
                <h3 class="font-display text-[1.05rem] text-dark leading-[1.25] mb-1.5 group-hover:text-navy transition-colors">
                    <?= esc($inc['companyName']) ?>
                </h3>

                <!-- Cohort -->
                <?php if (! empty($inc['cohort'])): ?>
                <span class="text-[.52rem] font-bold tracking-[.18em] uppercase text-gold/60 mb-3 block">
                    <?= esc($inc['cohort']) ?>
                </span>
                <?php endif; ?>

                <!-- Short Desc -->
                <?php if (! empty($inc['shortDescription'])): ?>
                <p class="text-[.78rem] font-light leading-[1.75] text-dark/40 line-clamp-3">
                    <?= esc($inc['shortDescription']) ?>
                </p>
                <?php endif; ?>

                <!-- Arrow hint -->
                <span class="inline-flex items-center gap-1.5 text-[.58rem] font-semibold tracking-[.13em] uppercase text-navy/30 mt-4 group-hover:text-gold transition-colors duration-200">
                    Details <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                </span>
            </button>
            <?php endforeach; ?>
        </div>

        <?php else: ?>
        <!-- Empty State -->
        <div class="border border-dark/[.06] rounded-md bg-white p-12 md:p-20 text-center mb-10">
            <div class="w-16 h-16 mx-auto rounded-lg border border-dark/[.06] bg-off flex items-center justify-center mb-5">
                <svg class="w-7 h-7 text-dark/15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </div>
            <h3 class="font-display text-[1.3rem] text-dark mb-2">Incubatees Coming Soon</h3>
            <p class="text-[.85rem] font-light leading-[1.75] text-dark/40 max-w-[400px] mx-auto mb-6">
                Our first cohort of incubatees will be featured here once the program kicks off.
            </p>
            <a href="<?= site_url('incubatees/apply') ?>"
                class="inline-flex items-center gap-2 text-[.62rem] font-bold tracking-[.16em] uppercase text-gold no-underline hover:gap-3 transition-all">
                Apply to the Program <span>→</span>
            </a>
        </div>
        <?php endif; ?>

        <!-- Bottom CTA -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4">
            <p class="text-[.78rem] font-light text-dark/35">
                <?php if ($hasIncubatees): ?>
                    <?= count($incubatees) ?> incubatee<?= count($incubatees) !== 1 ? 's' : '' ?> in the program
                <?php else: ?>
                    Interested in joining ASOG-TBI?
                <?php endif; ?>
            </p>
            <a href="<?= site_url('incubatees/apply') ?>"
                class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-navy/40 no-underline border-b border-navy/10 pb-0.5 hover:text-gold hover:border-gold transition-colors">
                Be an Incubatee
            </a>
        </div>
    </div>
</section>

<?php if ($hasIncubatees): ?>
<!-- ══════════════════════════════════════════════════════════════════════
     DETAIL MODAL — Slides in from right, shows full info
     ══════════════════════════════════════════════════════════════════════ -->
<div id="incModal" class="fixed inset-0 z-[999] pointer-events-none opacity-0 transition-opacity duration-300" role="dialog" aria-hidden="true">
    <!-- Backdrop -->
    <div id="incBackdrop" class="absolute inset-0 bg-dark/60 backdrop-blur-sm" onclick="closeIncubateeModal()"></div>

    <!-- Panel -->
    <div id="incPanel" class="absolute right-0 top-0 bottom-0 w-full max-w-[580px] bg-white shadow-2xl translate-x-full transition-transform duration-300 ease-[cubic-bezier(.22,1,.36,1)] overflow-y-auto">
        <!-- Close -->
        <button onclick="closeIncubateeModal()"
            class="sticky top-0 right-0 z-10 float-right m-5 w-9 h-9 rounded-full border border-dark/[.08] bg-off flex items-center justify-center text-dark/40 hover:text-dark hover:border-dark/20 transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <div class="clear-both px-8 md:px-11 pb-12 pt-2">
            <!-- Logo -->
            <div id="incLogo" class="w-20 h-20 rounded-lg border border-dark/[.06] bg-off flex items-center justify-center mb-6 overflow-hidden"></div>

            <!-- Cohort badge -->
            <span id="incCohort" class="text-[.52rem] font-bold tracking-[.18em] uppercase text-gold/70 mb-2 block"></span>

            <!-- Company Name -->
            <h2 id="incName" class="font-display text-[1.6rem] md:text-[2rem] leading-[1.15] text-dark mb-2"></h2>

            <!-- Founder -->
            <p id="incFounder" class="text-[.78rem] font-medium text-dark/40 mb-6"></p>

            <div class="h-px bg-dark/[.06] mb-6"></div>

            <!-- Short desc -->
            <p id="incShort" class="text-[.88rem] font-light leading-[1.85] text-dark/55 mb-6"></p>

            <!-- Full content -->
            <div id="incContent" class="prose-sm text-[.85rem] font-light leading-[1.9] text-dark/50 mb-8"></div>

            <!-- Website link -->
            <a id="incWebsite" href="#" target="_blank" rel="noopener"
                class="hidden items-center gap-2 text-[.62rem] font-bold tracking-[.16em] uppercase text-gold no-underline hover:gap-3 transition-all">
                Visit Website <span>→</span>
            </a>
        </div>
    </div>
</div>

<!-- ── Modal Script ── -->
<script>
(function(){
    var data = <?= json_encode(array_map(function($inc){
        return [
            'companyName'      => $inc['companyName'] ?? '',
            'founderName'      => $inc['founderName'] ?? '',
            'shortDescription' => $inc['shortDescription'] ?? '',
            'content'          => $inc['content'] ?? '',
            'logoPath'         => ! empty($inc['logoPath']) ? base_url($inc['logoPath']) : '',
            'websiteUrl'       => $inc['websiteUrl'] ?? '',
            'cohort'           => $inc['cohort'] ?? '',
        ];
    }, $incubatees), JSON_HEX_TAG | JSON_HEX_APOS) ?>;

    var modal   = document.getElementById('incModal');
    var panel   = document.getElementById('incPanel');
    var elName  = document.getElementById('incName');
    var elLogo  = document.getElementById('incLogo');
    var elCohort  = document.getElementById('incCohort');
    var elFounder = document.getElementById('incFounder');
    var elShort   = document.getElementById('incShort');
    var elContent = document.getElementById('incContent');
    var elWebsite = document.getElementById('incWebsite');

    window.openIncubateeModal = function(idx){
        var d = data[idx];
        if(!d) return;

        // Logo
        if(d.logoPath){
            elLogo.innerHTML = '<img src="'+d.logoPath+'" alt="'+d.companyName+'" class="w-full h-full object-contain p-2">';
        } else {
            elLogo.innerHTML = '<span class="font-display text-[1.8rem] leading-none text-gold/60 select-none">'+d.companyName.charAt(0).toUpperCase()+'</span>';
        }

        elName.textContent    = d.companyName;
        elCohort.textContent  = d.cohort;
        elFounder.textContent = d.founderName ? 'Founded by ' + d.founderName : '';
        elShort.textContent   = d.shortDescription;
        elContent.innerHTML   = d.content || '';

        if(d.websiteUrl){
            elWebsite.href = d.websiteUrl;
            elWebsite.classList.remove('hidden');
            elWebsite.classList.add('inline-flex');
        } else {
            elWebsite.classList.add('hidden');
            elWebsite.classList.remove('inline-flex');
        }

        // Show
        modal.classList.remove('pointer-events-none','opacity-0');
        modal.setAttribute('aria-hidden','false');
        panel.scrollTop = 0;
        requestAnimationFrame(function(){
            panel.classList.remove('translate-x-full');
        });
        document.body.style.overflow = 'hidden';
    };

    window.closeIncubateeModal = function(){
        panel.classList.add('translate-x-full');
        modal.classList.add('opacity-0');
        setTimeout(function(){
            modal.classList.add('pointer-events-none');
            modal.setAttribute('aria-hidden','true');
            document.body.style.overflow = '';
        }, 300);
    };

    // Close on Escape
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && !modal.classList.contains('pointer-events-none')){
            closeIncubateeModal();
        }
    });
})();
</script>
<?php endif; ?>
