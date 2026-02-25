<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  TEAM MEMBER DETAIL — Single member view                           ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-20 md:py-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[780px] mx-auto relative z-[2]">
        <!-- Back link -->
        <a href="<?= site_url('organization') ?>"
           class="inline-flex items-center gap-1.5 text-[.65rem] font-semibold tracking-[.1em] uppercase text-dark/30 no-underline mb-8 transition-colors hover:text-gold">
            ← Back to Organization
        </a>

        <!-- Photo + Info row -->
        <div class="flex flex-col sm:flex-row items-start gap-6 mb-8">
            <?php if (! empty($member['photoPath'])): ?>
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-lg border border-dark/[.06] overflow-hidden shrink-0">
                    <img src="<?= base_url($member['photoPath']) ?>" alt="<?= esc($member['fullName']) ?>"
                         class="w-full h-full object-cover">
                </div>
            <?php endif; ?>
            <div class="flex-1">
                <h1 class="font-display text-[clamp(1.6rem,3vw,2.6rem)] leading-[1.14] text-dark mb-1"><?= esc($member['fullName']) ?></h1>
                <span class="text-[.6rem] font-semibold tracking-[.16em] uppercase text-gold block mb-4"><?= esc($member['position']) ?></span>

                <!-- Contact links -->
                <div class="flex flex-wrap gap-3">
                    <?php if (! empty($member['email'])): ?>
                        <a href="mailto:<?= esc($member['email']) ?>"
                           class="text-[.58rem] font-semibold tracking-[.1em] uppercase text-dark/35 no-underline border border-dark/[.1] px-3 py-1.5 rounded-sm transition-colors duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">
                            Email
                        </a>
                    <?php endif; ?>
                    <?php if (! empty($member['linkedinUrl'])): ?>
                        <a href="<?= esc($member['linkedinUrl']) ?>" target="_blank" rel="noopener"
                           class="text-[.58rem] font-semibold tracking-[.1em] uppercase text-dark/35 no-underline border border-dark/[.1] px-3 py-1.5 rounded-sm transition-colors duration-200 hover:text-gold hover:border-gold/40 hover:bg-gold/[.05]">
                            LinkedIn
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Short Bio -->
        <?php if (! empty($member['shortBio'])): ?>
            <p class="text-[1rem] font-light leading-[1.8] text-dark/50 mb-8"><?= esc($member['shortBio']) ?></p>
        <?php endif; ?>

        <!-- Full Content -->
        <div class="prose-content text-[.92rem] font-light leading-[2] text-dark/55">
            <?= $member['content'] ?? '' ?>
        </div>

        <!-- Divider -->
        <div class="h-px bg-dark/[.08] my-12"></div>

        <!-- Other team members -->
        <?php if (! empty($teamMembers)): ?>
            <div>
                <h3 class="font-display text-lg text-dark mb-5">Our <em class="italic text-gold">Team</em></h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <?php foreach ($teamMembers as $other): ?>
                        <?php if ($other['id'] === $member['id']) continue; ?>
                        <a href="<?= site_url('organization/' . $other['slug']) ?>"
                           class="group text-center no-underline block">
                            <div class="w-full aspect-square rounded-lg bg-[#e9e6e1] border border-dark/[.06] overflow-hidden mb-2 transition-all duration-300 group-hover:shadow-md">
                                <?php if (! empty($other['photoPath'])): ?>
                                    <img src="<?= base_url($other['photoPath']) ?>" alt=""
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="font-display text-[1.6rem] text-dark/[.08]"><?= strtoupper(substr($other['fullName'], 0, 1)) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h4 class="font-display text-[.8rem] text-dark leading-snug transition-colors duration-200 group-hover:text-gold"><?= esc($other['fullName']) ?></h4>
                            <span class="text-[.48rem] font-medium tracking-[.1em] uppercase text-dark/25"><?= esc($other['position']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
