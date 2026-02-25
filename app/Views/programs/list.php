<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  PROGRAMS — Full listing page                                      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <?php if (! empty($programs)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <?php foreach ($programs as $i => $program): ?>
            <a href="<?= site_url('programs/' . $program['slug']) ?>"
               class="group no-underline block rounded-lg border border-dark/[.06] bg-white shadow-sm shadow-dark/[.04] overflow-hidden transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08] hover:-translate-y-1">
                <!-- Image -->
                <div class="h-[200px] bg-[#e9e6e1] overflow-hidden">
                    <?php if (! empty($program['imagePath'])): ?>
                        <img src="<?= base_url($program['imagePath']) ?>" alt="<?= esc($program['title']) ?>"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-display text-[2.4rem] text-dark/[.08]"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Content -->
                <div class="p-5 md:p-6">
                    <?php if (! empty($program['iconSvg'])): ?>
                        <div class="text-gold mb-3 [&>svg]:w-5 [&>svg]:h-5"><?= $program['iconSvg'] ?></div>
                    <?php endif; ?>
                    <h3 class="font-display text-[1.05rem] md:text-[1.15rem] text-dark leading-tight mb-2 transition-colors duration-200 group-hover:text-gold"><?= esc($program['title']) ?></h3>
                    <p class="text-[.82rem] font-light leading-[1.75] text-dark/45"><?= esc($program['shortDescription'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <p class="text-dark/30 text-sm">No programs available at this time.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
