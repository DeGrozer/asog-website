<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: ORGANIZATION                                             ║
     ║  Dark bg · 4-column team grid                                      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="organization" class="relative overflow-hidden bg-navy py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-4 mb-10 md:mb-14 reveal">
            <div class="text-center sm:text-left flex-1">
                <div class="flex items-center justify-center sm:justify-start gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">The Team</span>
                    <span class="block w-[18px] h-[1.5px] bg-gold sm:hidden"></span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-off">Our <em class="italic text-gold">Organization</em></h2>
            </div>
            <a href="<?= site_url('organization') ?>"
                class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-white/[.28] no-underline border-b border-white/[.12] pb-0.5 transition-colors duration-200 hover:text-gold hover:border-gold shrink-0 self-center sm:self-auto">View Full Team →</a>
        </div>

        <?php if (! empty($teamMembers)): ?>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 reveal-group">
            <?php foreach ($teamMembers as $member): ?>
            <a href="<?= site_url('organization/' . $member['slug']) ?>" class="rc text-center group no-underline block">
                <div class="w-full aspect-square rounded-lg bg-[#0a1628] border border-white/[.06] overflow-hidden mb-3 md:mb-4 transition-all duration-300 group-hover:border-gold/30">
                    <?php if (! empty($member['photoPath'])): ?>
                        <img src="<?= base_url($member['photoPath']) ?>" alt="<?= esc($member['fullName']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-display text-[2rem] text-gold/40 select-none"><?= strtoupper(substr($member['fullName'], 0, 1)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <h4 class="font-display text-[.9rem] md:text-[1rem] text-off leading-tight transition-colors duration-200 group-hover:text-gold"><?= esc($member['fullName']) ?></h4>
                <span class="text-[.5rem] md:text-[.55rem] font-medium tracking-[.12em] uppercase text-white/25 mt-1 block"><?= esc($member['position']) ?></span>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 reveal-group">
            <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="rc text-center">
                <div class="w-full aspect-square rounded-lg bg-[#0a1628] border border-white/[.06] flex items-center justify-center mb-3 md:mb-4">
                    <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-white/15">Photo</span>
                </div>
                <h4 class="font-display text-[.9rem] md:text-[1rem] text-off leading-tight">Team Member</h4>
                <span class="text-[.5rem] md:text-[.55rem] font-medium tracking-[.12em] uppercase text-white/25 mt-1 block">Position</span>
            </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>