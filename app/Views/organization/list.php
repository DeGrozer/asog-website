<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  ORGANIZATION — Full-page team listing with grouped sections        ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->

<!-- ── THE CORE TEAM ── -->
<section id="core-team" class="relative bg-off py-20 md:py-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1100px] mx-auto relative z-[2]">
        <div class="text-center mb-14 reveal">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                <span class="text-[.55rem] font-semibold tracking-[.2em] uppercase text-gold">Leadership</span>
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
            </div>
            <h2 class="font-display text-[1.8rem] md:text-[2.4rem] leading-[1.15] text-dark">The Core Team</h2>
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">The leadership guiding ASOG TBI's mission of empowering startups through AI and engineering innovation.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 reveal-group">
            <?php
                $coreTeam = array_filter($teamMembers ?? [], fn($m) => stripos($m['position'] ?? '', 'Director') !== false || stripos($m['position'] ?? '', 'Manager') !== false || stripos($m['position'] ?? '', 'Lead') !== false || stripos($m['position'] ?? '', 'Head') !== false || stripos($m['position'] ?? '', 'Coordinator') !== false);
                if (empty($coreTeam)) $coreTeam = array_slice($teamMembers ?? [], 0, 4);
            ?>
            <?php foreach ($coreTeam as $member): ?>
            <a href="<?= site_url('organization/' . $member['slug']) ?>" class="rc group no-underline block text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e9e6e1] border border-dark/[.06] overflow-hidden mb-4 transition-all duration-300 group-hover:shadow-lg group-hover:shadow-dark/[.08] group-hover:-translate-y-1">
                    <?php if (! empty($member['photoPath'])): ?>
                        <img src="<?= base_url($member['photoPath']) ?>" alt="<?= esc($member['fullName']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-display text-[2.4rem] text-dark/[.08]"><?= strtoupper(substr($member['fullName'], 0, 1)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <h4 class="font-display text-[1.1rem] md:text-[1.2rem] font-semibold text-dark leading-tight transition-colors duration-200 group-hover:text-gold"><?= esc($member['fullName']) ?></h4>
                <span class="text-[.68rem] font-semibold tracking-[.08em] uppercase text-gold mt-1.5 block"><?= esc($member['position']) ?></span>
            </a>
            <?php endforeach; ?>

            <?php if (empty($teamMembers)): ?>
                <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="rc text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.08] border border-dark/[.10] mb-4 flex items-center justify-center">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/30">Photo</span>
                    </div>
                    <h4 class="font-display text-[1.1rem] font-semibold text-dark/50 leading-tight">Team Member</h4>
                    <span class="text-[.68rem] font-semibold tracking-[.08em] uppercase text-gold/70 mt-1.5 block">Position Title</span>
                </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ── TBI STAFF ── -->
<section id="tbi-staff" class="relative bg-white py-20 md:py-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1100px] mx-auto relative z-[2]">
        <div class="text-center mb-14 reveal">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                <span class="text-[.55rem] font-semibold tracking-[.2em] uppercase text-navy">Operations</span>
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
            </div>
            <h2 class="font-display text-[1.8rem] md:text-[2.4rem] leading-[1.15] text-dark">TBI Staff</h2>
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">The dedicated staff running the day-to-day operations and supporting our incubatees.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8 reveal-group">
            <?php
                $staff = array_filter($teamMembers ?? [], fn($m) => stripos($m['position'] ?? '', 'Staff') !== false || stripos($m['position'] ?? '', 'Assistant') !== false || stripos($m['position'] ?? '', 'Officer') !== false || stripos($m['position'] ?? '', 'Specialist') !== false || stripos($m['position'] ?? '', 'Analyst') !== false);
                if (empty($staff)) $staff = array_slice($teamMembers ?? [], 4, 8);
            ?>
            <?php foreach ($staff as $member): ?>
            <a href="<?= site_url('organization/' . $member['slug']) ?>" class="rc group no-underline block text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e9e6e1] border border-dark/[.06] overflow-hidden mb-4 transition-all duration-300 group-hover:shadow-lg group-hover:shadow-dark/[.08] group-hover:-translate-y-1">
                    <?php if (! empty($member['photoPath'])): ?>
                        <img src="<?= base_url($member['photoPath']) ?>" alt="<?= esc($member['fullName']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-display text-[2.4rem] text-dark/[.08]"><?= strtoupper(substr($member['fullName'], 0, 1)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <h4 class="font-display text-[1.05rem] font-semibold text-dark leading-tight transition-colors duration-200 group-hover:text-gold"><?= esc($member['fullName']) ?></h4>
                <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-navy mt-1.5 block"><?= esc($member['position']) ?></span>
            </a>
            <?php endforeach; ?>

            <?php if (empty($teamMembers)): ?>
                <?php for ($i = 0; $i < 5; $i++): ?>
                <div class="rc text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.08] border border-dark/[.10] mb-4 flex items-center justify-center">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/30">Photo</span>
                    </div>
                    <h4 class="font-display text-[1.05rem] font-semibold text-dark/50 leading-tight">Staff Member</h4>
                    <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-navy/60 mt-1.5 block">Staff Role</span>
                </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ── FACULTY MENTORS ── -->
<section id="faculty-mentors" class="relative bg-off py-20 md:py-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1100px] mx-auto relative z-[2]">
        <div class="text-center mb-14 reveal">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-sky"></span>
                <span class="text-[.55rem] font-semibold tracking-[.2em] uppercase text-sky">Academic Partners</span>
                <span class="block w-[18px] h-[1.5px] bg-sky"></span>
            </div>
            <h2 class="font-display text-[1.8rem] md:text-[2.4rem] leading-[1.15] text-dark">Faculty Mentors</h2>
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">CSPC faculty members providing academic guidance and research expertise to our incubatees.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 reveal-group">
            <?php
                $facultyMentors = array_filter($teamMembers ?? [], fn($m) => stripos($m['position'] ?? '', 'Faculty') !== false || stripos($m['position'] ?? '', 'Professor') !== false || stripos($m['position'] ?? '', 'Instructor') !== false);
                if (empty($facultyMentors)) $facultyMentors = array_slice($teamMembers ?? [], 12, 4);
            ?>
            <?php foreach ($facultyMentors as $member): ?>
            <a href="<?= site_url('organization/' . $member['slug']) ?>" class="rc group no-underline block text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e9e6e1] border border-dark/[.06] overflow-hidden mb-4 transition-all duration-300 group-hover:shadow-lg group-hover:shadow-dark/[.08] group-hover:-translate-y-1">
                    <?php if (! empty($member['photoPath'])): ?>
                        <img src="<?= base_url($member['photoPath']) ?>" alt="<?= esc($member['fullName']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-display text-[2.4rem] text-dark/[.08]"><?= strtoupper(substr($member['fullName'], 0, 1)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <h4 class="font-display text-[1.05rem] font-semibold text-dark leading-tight transition-colors duration-200 group-hover:text-gold"><?= esc($member['fullName']) ?></h4>
                <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-sky mt-1.5 block"><?= esc($member['position']) ?></span>
            </a>
            <?php endforeach; ?>

            <?php if (empty($teamMembers)): ?>
                <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="rc text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.08] border border-dark/[.10] mb-4 flex items-center justify-center">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/30">Photo</span>
                    </div>
                    <h4 class="font-display text-[1.05rem] font-semibold text-dark/50 leading-tight">Faculty Mentor</h4>
                    <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-sky/70 mt-1.5 block">Faculty Mentor</span>
                </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ── INDUSTRY MENTORS ── -->
<section id="industry-mentors" class="relative bg-white py-20 md:py-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1100px] mx-auto relative z-[2]">
        <div class="text-center mb-14 reveal">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-sky"></span>
                <span class="text-[.55rem] font-semibold tracking-[.2em] uppercase text-sky">Industry Partners</span>
                <span class="block w-[18px] h-[1.5px] bg-sky"></span>
            </div>
            <h2 class="font-display text-[1.8rem] md:text-[2.4rem] leading-[1.15] text-dark">Industry Mentors</h2>
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">Experts from the private sector bringing real-world business and technical mentorship to our startups.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 reveal-group">
            <?php
                $industryMentors = array_filter($teamMembers ?? [], fn($m) => stripos($m['position'] ?? '', 'Industry') !== false || stripos($m['position'] ?? '', 'Consultant') !== false || stripos($m['position'] ?? '', 'Adviser') !== false || stripos($m['position'] ?? '', 'Advisor') !== false);
                if (empty($industryMentors)) $industryMentors = array_slice($teamMembers ?? [], 16, 4);
            ?>
            <?php foreach ($industryMentors as $member): ?>
            <a href="<?= site_url('organization/' . $member['slug']) ?>" class="rc group no-underline block text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e9e6e1] border border-dark/[.06] overflow-hidden mb-4 transition-all duration-300 group-hover:shadow-lg group-hover:shadow-dark/[.08] group-hover:-translate-y-1">
                    <?php if (! empty($member['photoPath'])): ?>
                        <img src="<?= base_url($member['photoPath']) ?>" alt="<?= esc($member['fullName']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-display text-[2.4rem] text-dark/[.08]"><?= strtoupper(substr($member['fullName'], 0, 1)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <h4 class="font-display text-[1.05rem] font-semibold text-dark leading-tight transition-colors duration-200 group-hover:text-gold"><?= esc($member['fullName']) ?></h4>
                <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-sky mt-1.5 block"><?= esc($member['position']) ?></span>
            </a>
            <?php endforeach; ?>

            <?php if (empty($teamMembers)): ?>
                <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="rc text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.08] border border-dark/[.10] mb-4 flex items-center justify-center">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/30">Photo</span>
                    </div>
                    <h4 class="font-display text-[1.05rem] font-semibold text-dark/50 leading-tight">Industry Mentor</h4>
                    <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-sky/70 mt-1.5 block">Industry Mentor</span>
                </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
