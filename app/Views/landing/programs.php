<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: PROGRAMS & SERVICES                                      ║
     ║  Dark bg · 8-card paged GSAP slider                                ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="programs" class="relative bg-navy py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1200px] mx-auto relative z-[2]">

        <!-- Header row: heading left, "View All" right -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10 md:mb-14 reveal">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">What We Offer</span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-off">Programs &amp; <em
                        class="italic text-gold">Services</em></h2>
            </div>
            <a href="<?= site_url('programs') ?>"
                class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-white/[.28] no-underline border-b border-white/[.12] pb-0.5 transition-colors duration-200 hover:text-gold hover:border-gold shrink-0">View
                All Programs →</a>
        </div>

        <?php
        $programs = [
            ['Mentorship from experts in AI, engineering, &amp; business', 'End-to-end startup support &mdash; from co-working spaces and prototyping labs to seed funding guidance.'],
            ['Startup Bootcamps &amp; Training', 'Industry experts and academic mentors deliver hands-on workshops and tailored training for founders.'],
            ['Prototyping &amp; product development', 'Navigate patents, trademarks, and IP strategy with our dedicated Intellectual Property Management Unit.'],
            ['IP assistance (patents, trademarks, etc.)', 'Bridge the gap between academic research and market-ready innovations with our tech transfer partnerships.'],
            ['Market validation support', 'Connect with industry partners, pilot customers, and distribution channels to accelerate go-to-market strategies.'],
            ['Access to funding networks', 'Leverage prototyping labs and technical expertise to refine your MVP and iterate toward product-market fit.'],
            ['Free co-working space', 'Access seed capital opportunities, investor matchmaking, and grant writing support for early-stage ventures.'],
            ['Pitching opportunities &amp; networking', 'Join pitch nights, demo days, and founder meetups that build lasting connections across the startup ecosystem.'],
        ];
        $total = count($programs);
        ?>

        <!-- Card track -->
        <div class="overflow-hidden reveal-group">
            <div id="progSlider" class="flex" data-total="<?= $total ?>">
                <?php foreach ($programs as $i => $prog): ?>
                <div class="prog-card shrink-0 box-border py-2" data-ix="<?= $i ?>">
                    <div class="h-full px-6 md:px-7<?= $i > 0 ? ' border-l border-white/[.08]' : '' ?>">
                        <span class="block text-[.5rem] font-semibold tracking-[.22em] uppercase text-gold/70 mb-4"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                        <h3 class="font-display text-[1.05rem] text-off mb-3 leading-snug"><?= $prog[0] ?></h3>
                        <p class="text-[.78rem] font-light leading-[1.8] text-white/30"><?= $prog[1] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Bottom nav: arrows + page indicator, centered -->
        <div class="flex items-center justify-center gap-3 mt-8 reveal">
            <button id="progPrev" aria-label="Previous"
                class="w-9 h-9 rounded-full border border-white/[.12] bg-transparent flex items-center justify-center text-white/25 cursor-pointer opacity-30 pointer-events-none"
                style="transition:border-color .25s,color .25s,background .25s,opacity .25s">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <span id="progPage"
                class="text-[.52rem] font-semibold tracking-[.12em] text-white/25 min-w-[2.5rem] text-center"
                style="font-variant-numeric:tabular-nums">1 / 2</span>
            <button id="progNext" aria-label="Next"
                class="w-9 h-9 rounded-full border border-white/[.12] bg-transparent flex items-center justify-center text-white/25 cursor-pointer"
                style="transition:border-color .25s,color .25s,background .25s,opacity .25s">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>

    <script src="<?= base_url('assets/js/programSlider.js') ?>" defer></script>
</section>