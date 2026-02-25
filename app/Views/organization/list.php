<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  ORGANIZATION — Full team listing page                             ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <?php if (! empty($teamMembers)): ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-7">
            <?php foreach ($teamMembers as $member): ?>
            <a href="<?= site_url('organization/' . $member['slug']) ?>"
               class="group no-underline block text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e9e6e1] border border-dark/[.06] overflow-hidden mb-3 md:mb-4 transition-all duration-300 group-hover:shadow-md group-hover:shadow-dark/[.08]">
                    <?php if (! empty($member['photoPath'])): ?>
                        <img src="<?= base_url($member['photoPath']) ?>" alt="<?= esc($member['fullName']) ?>"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-display text-[2.4rem] text-dark/[.08]"><?= strtoupper(substr($member['fullName'], 0, 1)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <h4 class="font-display text-[.95rem] md:text-[1.05rem] text-dark leading-tight transition-colors duration-200 group-hover:text-gold"><?= esc($member['fullName']) ?></h4>
                <span class="text-[.52rem] md:text-[.56rem] font-medium tracking-[.12em] uppercase text-dark/30 mt-1 block"><?= esc($member['position']) ?></span>
                <?php if (! empty($member['shortBio'])): ?>
                    <p class="text-[.75rem] font-light text-dark/35 mt-2 leading-relaxed"><?= esc(character_limiter($member['shortBio'], 80)) ?></p>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <p class="text-dark/30 text-sm">Team members will be listed here soon.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
