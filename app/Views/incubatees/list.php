<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — Full listing page                                    ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <?php if (! empty($incubatees)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <?php foreach ($incubatees as $incubatee): ?>
            <a href="<?= site_url('incubatees/' . $incubatee['slug']) ?>"
               class="group no-underline block rounded-lg border border-dark/[.06] bg-white shadow-sm shadow-dark/[.04] overflow-hidden transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08] hover:-translate-y-1">
                <!-- Logo area -->
                <div class="h-[180px] bg-[#f0ede8] flex items-center justify-center overflow-hidden border-b border-dark/[.04]">
                    <?php if (! empty($incubatee['logoPath'])): ?>
                        <img src="<?= base_url($incubatee['logoPath']) ?>" alt="<?= esc($incubatee['companyName']) ?>"
                             class="max-w-[120px] max-h-[120px] object-contain transition-transform duration-500 group-hover:scale-110">
                    <?php else: ?>
                        <span class="font-display text-[2.4rem] text-dark/[.08]"><?= strtoupper(substr($incubatee['companyName'], 0, 2)) ?></span>
                    <?php endif; ?>
                </div>
                <!-- Content -->
                <div class="p-5 md:p-6">
                    <?php if (! empty($incubatee['cohort'])): ?>
                        <span class="text-[.5rem] font-semibold tracking-[.14em] uppercase text-gold block mb-2"><?= esc($incubatee['cohort']) ?></span>
                    <?php endif; ?>
                    <h3 class="font-display text-[1.05rem] md:text-[1.15rem] text-dark leading-tight mb-1 transition-colors duration-200 group-hover:text-gold"><?= esc($incubatee['companyName']) ?></h3>
                    <?php if (! empty($incubatee['founderName'])): ?>
                        <span class="text-[.72rem] text-dark/35 font-light block mb-2">by <?= esc($incubatee['founderName']) ?></span>
                    <?php endif; ?>
                    <p class="text-[.8rem] font-light leading-[1.7] text-dark/40"><?= esc(character_limiter($incubatee['shortDescription'] ?? '', 90)) ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <p class="text-dark/30 text-sm">No incubatees listed at this time.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
