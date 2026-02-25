<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  FACILITY DETAIL — Single facility view                            ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-20 md:py-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[780px] mx-auto relative z-[2]">
        <!-- Back link -->
        <a href="<?= site_url('facilities') ?>"
           class="inline-flex items-center gap-1.5 text-[.65rem] font-semibold tracking-[.1em] uppercase text-dark/30 no-underline mb-8 transition-colors hover:text-gold">
            ← Back to Facilities
        </a>

        <!-- Title -->
        <h1 class="font-display text-[clamp(1.6rem,3vw,2.6rem)] leading-[1.14] text-dark mb-5"><?= esc($facility['name']) ?></h1>

        <!-- Short description -->
        <?php if (! empty($facility['shortDescription'])): ?>
            <p class="text-[1rem] font-light leading-[1.8] text-dark/50 mb-8"><?= esc($facility['shortDescription']) ?></p>
        <?php endif; ?>

        <!-- Cover image -->
        <?php if (! empty($facility['imagePath'])): ?>
            <div class="rounded-lg overflow-hidden mb-10 border border-dark/[.06]">
                <img src="<?= base_url($facility['imagePath']) ?>"
                     alt="<?= esc($facility['name']) ?>"
                     class="w-full max-h-[440px] object-cover"/>
            </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="prose-content text-[.92rem] font-light leading-[2] text-dark/55">
            <?= $facility['content'] ?? '' ?>
        </div>

        <!-- Divider -->
        <div class="h-px bg-dark/[.08] my-12"></div>

        <!-- Other facilities -->
        <?php if (! empty($facilities)): ?>
            <div>
                <h3 class="font-display text-lg text-dark mb-5">Other <em class="italic text-gold">Facilities</em></h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php foreach ($facilities as $other): ?>
                        <?php if ($other['id'] === $facility['id']) continue; ?>
                        <a href="<?= site_url('facilities/' . $other['slug']) ?>"
                           class="group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                            <div class="h-[140px] bg-[#e9e6e1] flex items-center justify-center overflow-hidden">
                                <?php if (! empty($other['imagePath'])): ?>
                                    <img src="<?= base_url($other['imagePath']) ?>" alt=""
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
                                <?php else: ?>
                                    <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h4 class="font-display text-[.88rem] text-dark leading-snug transition-colors duration-200 group-hover:text-gold"><?= esc($other['name']) ?></h4>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
