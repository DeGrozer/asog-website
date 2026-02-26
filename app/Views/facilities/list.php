<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  FACILITIES — Full listing page                                    ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div id="co-lab" class="scroll-mt-28"></div>
    <div id="innovators-suite" class="scroll-mt-28"></div>
    <div id="aircode" class="scroll-mt-28"></div>
    <div id="fablab" class="scroll-mt-28"></div>
    <div id="ssf" class="scroll-mt-28"></div>
    <div id="ip-unit" class="scroll-mt-28"></div>
    <div id="usage-policy" class="scroll-mt-28"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <?php if (! empty($facilities)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <?php foreach ($facilities as $facility): ?>
            <a href="<?= site_url('facilities/' . $facility['slug']) ?>"
               class="group no-underline block rounded-lg border border-dark/[.06] bg-white shadow-sm shadow-dark/[.04] overflow-hidden transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08] hover:-translate-y-1">
                <div class="h-[240px] bg-[#e9e6e1] overflow-hidden">
                    <?php if (! empty($facility['imagePath'])): ?>
                        <img src="<?= base_url($facility['imagePath']) ?>" alt="<?= esc($facility['name']) ?>"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-5 md:p-6">
                    <h3 class="font-display text-[1.1rem] md:text-[1.2rem] text-dark leading-tight mb-2 transition-colors duration-200 group-hover:text-gold"><?= esc($facility['name']) ?></h3>
                    <p class="text-[.82rem] font-light leading-[1.75] text-dark/45"><?= esc($facility['shortDescription'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <p class="text-dark/30 text-sm">No facilities listed at this time.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
