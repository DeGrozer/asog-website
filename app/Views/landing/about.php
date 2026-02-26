<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: ABOUT US                                                 ║
     ║  Light bg (#F8F6F2) · Who We Are                                   ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="about" class="relative overflow-hidden bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>
    <div class="ai-cross hidden lg:block" style="top:18%;left:22%"></div>
    <div class="ai-cross hidden lg:block" style="top:72%;right:14%"></div>

    <div class="grid grid-cols-1 lg:grid-cols-[280px_1px_1fr] gap-8 lg:gap-14 items-start relative z-[1]">
        <!-- Left heading -->
        <div class="reveal">
            <div class="flex items-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy"><?= esc($about['aboutSubtitle'] ?? 'Who We Are') ?></span>
            </div>
            <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-dark"><?= str_replace("Bicol's", '<em class="italic text-gold">Bicol\'s</em>', $about['aboutTitle'] ?? "Built for Bicol's Future") ?></h2>
        </div>

        <!-- Divider (desktop only) -->
        <div class="hidden lg:block bg-navy/15 reveal reveal-d1"></div>

        <!-- Right body -->
        <div class="reveal reveal-d2">
            <div class="text-sm md:text-base font-light leading-[2.0] text-dark/50 mb-5">
                <?= $about['aboutContent'] ?? '<p>The ASOG Technology Business Incubator (TBI) is an initiative of Camarines Sur Polytechnic Colleges, funded by DOST-PCIEERD, dedicated to fostering engineering and AI-based innovations for food value chain management across the Bicol Region.</p>' ?>
            </div>
            <?php
                $tags = ! empty($about['aboutTags']) ? explode(',', $about['aboutTags']) : ['AI Research', 'Food Value Chain', 'Startup Incubation', 'Engineering Innovation', 'MSME Support'];
            ?>
            <div class="flex flex-wrap gap-1.5 mt-7 reveal-group">
                <?php foreach ($tags as $tag): ?>
                    <span class="rc text-[.57rem] font-semibold tracking-[.1em] uppercase text-navy/50 border border-navy/[.12] bg-navy/[.04] px-3 py-1 rounded-sm transition-colors duration-200 cursor-default hover:border-gold hover:text-gold hover:bg-gold/[.06]"><?= esc(trim($tag)) ?></span>
                <?php endforeach; ?>
            </div>
            <a href="<?= site_url('about') ?>" class="group inline-flex items-center gap-1.5 mt-8 text-[.65rem] font-bold tracking-[.13em] uppercase text-navy no-underline transition-all duration-200 hover:text-gold hover:gap-3">
                Read More <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
            </a>
        </div>
    </div>
</section>