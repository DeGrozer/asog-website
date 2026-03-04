<!--
     ╔══════════════════════════════════════════════════════════════════════╗
     ║  ORGANIZATION — Full-page team listing with grouped sections         ║
     ╚══════════════════════════════════════════════════════════════════════╝ 
-->

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
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">The leadership
                guiding ASOG TBI's mission of empowering startups through AI and engineering innovation.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 reveal-group">
            <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="rc text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e2dfd9] mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-dark/20" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <h4 class="font-display text-[1.1rem] font-semibold text-dark leading-tight">Team Member</h4>
                <span class="text-[.68rem] font-semibold tracking-[.08em] uppercase text-gold mt-1.5 block">Position
                    Title</span>
            </div>
            <?php endfor; ?>
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
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">The dedicated
                staff running the day-to-day operations and supporting our incubatees.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 md:gap-8 reveal-group">
            <?php for ($i = 0; $i < 5; $i++): ?>
            <div class="rc text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e2dfd9] mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-dark/20" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <h4 class="font-display text-[1.05rem] font-semibold text-dark leading-tight">Staff Member</h4>
                <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-navy mt-1.5 block">Staff
                    Role</span>
            </div>
            <?php endfor; ?>
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
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">CSPC faculty
                members providing academic guidance and research expertise to our incubatees.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 reveal-group">
            <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="rc text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e2dfd9] mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-dark/20" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <h4 class="font-display text-[1.05rem] font-semibold text-dark leading-tight">Faculty Mentor</h4>
                <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-sky mt-1.5 block">Faculty
                    Mentor</span>
            </div>
            <?php endfor; ?>
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
            <p class="text-[.88rem] font-light leading-[1.8] text-dark/40 mt-3 max-w-[520px] mx-auto">Experts from the
                private sector bringing real-world business and technical mentorship to our startups.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 reveal-group">
            <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="rc text-center">
                <div class="w-full aspect-square rounded-lg bg-[#e2dfd9] mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-dark/20" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <h4 class="font-display text-[1.05rem] font-semibold text-dark leading-tight">Industry Mentor</h4>
                <span class="text-[.64rem] font-semibold tracking-[.08em] uppercase text-sky mt-1.5 block">Industry
                    Mentor</span>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>