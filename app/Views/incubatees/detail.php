<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  INCUBATEE DETAIL — Single incubatee view                          ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-20 md:py-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[780px] mx-auto relative z-[2]">
        <!-- Back link -->
        <a href="<?= site_url('incubatees') ?>"
           class="inline-flex items-center gap-1.5 text-[.65rem] font-semibold tracking-[.1em] uppercase text-dark/30 no-underline mb-8 transition-colors hover:text-gold">
            ← Back to Incubatees
        </a>

        <!-- Logo + Meta row -->
        <div class="flex items-start gap-5 mb-6">
            <?php if (! empty($incubatee['logoPath'])): ?>
                <div class="w-16 h-16 md:w-20 md:h-20 rounded-lg border border-dark/[.06] bg-white flex items-center justify-center overflow-hidden shrink-0">
                    <img src="<?= base_url($incubatee['logoPath']) ?>" alt="" class="max-w-[56px] max-h-[56px] object-contain">
                </div>
            <?php endif; ?>
            <div>
                <?php if (! empty($incubatee['cohort'])): ?>
                    <span class="text-[.52rem] font-semibold tracking-[.16em] uppercase text-gold block mb-1"><?= esc($incubatee['cohort']) ?></span>
                <?php endif; ?>
                <h1 class="font-display text-[clamp(1.6rem,3vw,2.6rem)] leading-[1.14] text-dark"><?= esc($incubatee['companyName']) ?></h1>
                <?php if (! empty($incubatee['founderName'])): ?>
                    <span class="text-[.8rem] text-dark/40 font-light mt-1 block">Founded by <?= esc($incubatee['founderName']) ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Website link -->
        <?php if (! empty($incubatee['websiteUrl'])): ?>
            <a href="<?= esc($incubatee['websiteUrl']) ?>" target="_blank" rel="noopener"
               class="inline-flex items-center gap-1.5 text-[.65rem] font-semibold tracking-[.1em] uppercase text-sky no-underline mb-8 transition-colors hover:text-gold">
                Visit Website →
            </a>
        <?php endif; ?>

        <!-- Short description -->
        <?php if (! empty($incubatee['shortDescription'])): ?>
            <p class="text-[1rem] font-light leading-[1.8] text-dark/50 mb-8"><?= esc($incubatee['shortDescription']) ?></p>
        <?php endif; ?>

        <!-- Content -->
        <div class="prose-content text-[.92rem] font-light leading-[2] text-dark/55">
            <?= $incubatee['content'] ?? '' ?>
        </div>

        <!-- Divider -->
        <div class="h-px bg-dark/[.08] my-12"></div>

        <!-- Other incubatees -->
        <?php if (! empty($incubatees)): ?>
            <div>
                <h3 class="font-display text-lg text-dark mb-5">Other <em class="italic text-gold">Incubatees</em></h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <?php foreach ($incubatees as $other): ?>
                        <?php if ($other['id'] === $incubatee['id']) continue; ?>
                        <a href="<?= site_url('incubatees/' . $other['slug']) ?>"
                           class="group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                            <div class="h-[100px] bg-[#f0ede8] flex items-center justify-center overflow-hidden">
                                <?php if (! empty($other['logoPath'])): ?>
                                    <img src="<?= base_url($other['logoPath']) ?>" alt="" class="max-w-[60px] max-h-[60px] object-contain"/>
                                <?php else: ?>
                                    <span class="font-display text-[1.4rem] text-dark/[.08]"><?= strtoupper(substr($other['companyName'], 0, 2)) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h4 class="font-display text-[.85rem] text-dark leading-snug transition-colors duration-200 group-hover:text-gold"><?= esc($other['companyName']) ?></h4>
                                <?php if (! empty($other['founderName'])): ?>
                                    <span class="text-[.65rem] text-dark/30 font-light"><?= esc($other['founderName']) ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
