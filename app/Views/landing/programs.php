<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: PROGRAMS & SERVICES                                      ║
     ║  Dark bg · 3-column cards                                          ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="programs" class="relative overflow-hidden bg-navy py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-4 mb-10 md:mb-14 reveal">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">What We Offer</span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-off">Programs &amp; <em class="italic text-gold">Services</em></h2>
            </div>
            <a href="<?= site_url('programs') ?>" class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-white/[.28] no-underline border-b border-white/[.12] pb-0.5 transition-colors duration-200 hover:text-gold hover:border-gold shrink-0">View All Programs →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-white/[.06] rounded-sm overflow-hidden reveal-group">
            <?php if (! empty($programs)): ?>
                <?php foreach ($programs as $i => $prog): ?>
                    <a href="<?= site_url('programs/' . $prog['slug']) ?>"
                        class="rc group block bg-navy p-8 md:p-10 no-underline transition-colors duration-300 hover:bg-white/[.04]">
                        <span class="block text-[.5rem] font-semibold tracking-[.22em] uppercase text-gold/70 mb-4"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                        <h3 class="font-display text-[1.15rem] text-off mb-3"><?= esc($prog['title']) ?></h3>
                        <p class="text-[.8rem] font-light leading-[1.8] text-white/30"><?= esc($prog['shortDescription'] ?? '') ?></p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback static cards -->
                <div class="rc group block bg-navy p-8 md:p-10">
                    <span class="block text-[.5rem] font-semibold tracking-[.22em] uppercase text-gold/70 mb-4">01</span>
                    <h3 class="font-display text-[1.15rem] text-off mb-3">Incubation Program</h3>
                    <p class="text-[.8rem] font-light leading-[1.8] text-white/30">End-to-end startup support — from co-working spaces and prototyping labs to seed funding guidance.</p>
                </div>
                <div class="rc group block bg-navy p-8 md:p-10">
                    <span class="block text-[.5rem] font-semibold tracking-[.22em] uppercase text-gold/70 mb-4">02</span>
                    <h3 class="font-display text-[1.15rem] text-off mb-3">Mentorship &amp; Training</h3>
                    <p class="text-[.8rem] font-light leading-[1.8] text-white/30">Industry experts and academic mentors deliver hands-on workshops and tailored training for founders.</p>
                </div>
                <div class="rc group block bg-navy p-8 md:p-10">
                    <span class="block text-[.5rem] font-semibold tracking-[.22em] uppercase text-gold/70 mb-4">03</span>
                    <h3 class="font-display text-[1.15rem] text-off mb-3">IP Support</h3>
                    <p class="text-[.8rem] font-light leading-[1.8] text-white/30">Navigate patents, trademarks, and IP strategy with our dedicated Intellectual Property Management Unit.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>