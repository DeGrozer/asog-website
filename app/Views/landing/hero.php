<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: HERO                                                     ║
     ║  Full-screen slideshow with rotating headlines & indicator dots     ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="hero" class="relative w-full h-screen min-h-[640px] overflow-hidden flex items-end">
    <!-- Slides -->
    <div class="slide sl1 active">
        <div
            class="absolute right-[4%] bottom-[16%] font-display text-[18vw] leading-none text-white/[.022] pointer-events-none select-none whitespace-nowrap hidden md:block">
            AIRCoDe</div>
    </div>
    <div class="slide sl2">
        <div
            class="absolute right-[4%] bottom-[16%] font-display text-[18vw] leading-none text-white/[.022] pointer-events-none select-none whitespace-nowrap hidden md:block">
            FabLab</div>
    </div>
    <div class="slide sl3">
        <div
            class="absolute right-[4%] bottom-[16%] font-display text-[18vw] leading-none text-white/[.022] pointer-events-none select-none whitespace-nowrap hidden md:block">
            Innovate</div>
    </div>

    <!-- Accent lines (desktop only) -->
    <div class="absolute inset-0 z-[1] pointer-events-none opacity-[.015] hidden lg:block">
        <div class="absolute top-[15%] left-0 right-0 h-px bg-gradient-to-r from-transparent via-white to-transparent">
        </div>
        <div
            class="absolute top-[45%] left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/50 to-transparent">
        </div>
        <div
            class="absolute top-[75%] left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/30 to-transparent">
        </div>
        <div
            class="absolute top-0 bottom-0 left-[20%] w-px bg-gradient-to-b from-transparent via-white/40 to-transparent">
        </div>
        <div
            class="absolute top-0 bottom-0 left-[60%] w-px bg-gradient-to-b from-transparent via-white/40 to-transparent">
        </div>
    </div>

    <!-- Gradient overlay -->
    <div class="absolute inset-0 z-[2]"
        style="background:linear-gradient(to top,rgba(2,13,24,1) 0%,rgba(2,13,24,.85) 22%,rgba(2,13,24,.40) 52%,rgba(2,13,24,.05) 80%,transparent 100%),linear-gradient(to right,rgba(2,13,24,.75) 0%,rgba(2,13,24,.30) 50%,transparent 100%)">
    </div>

    <!-- Hero content -->
    <div class="relative z-[3] px-6 md:px-10 lg:px-14 pb-12 md:pb-[4.5rem] max-w-[900px]">
        <div class="inline-flex items-center gap-2.5 mb-4 md:mb-6">
            <div class="w-8 md:w-10 h-0.5 bg-gold"></div>
            <span class="text-[.5rem] md:text-[.58rem] font-semibold tracking-[.22em] uppercase text-gold">Bicol
                Region's Premier AI &amp; Engineering Incubator</span>
        </div>
        <div class="relative min-h-[120px] md:min-h-[160px] mb-5">
            <h1 class="hl active font-display text-[clamp(1.4rem,2.6vw,2.6rem)] leading-[1.18] text-off">Engineering
                &amp;<br /><em class="italic text-gold">AI-Driven Innovations</em><br />for the Food Value Chain</h1>
            <h1 class="hl font-display text-[clamp(1.4rem,2.6vw,2.6rem)] leading-[1.18] text-off">Empowering
                Startups<br />Through <em class="italic text-gold">Cutting-Edge</em><br />Technology</h1>
            <h1 class="hl font-display text-[clamp(1.4rem,2.6vw,2.6rem)] leading-[1.18] text-off">From <em
                    class="italic text-gold">Concept</em><br />to Market-Ready<br />Solutions</h1>
        </div>
        <div class="flex items-center gap-2 mt-8 md:mt-10">
            <button class="ind active border-none p-0 cursor-pointer" onclick="goTo(0)"></button>
            <button class="ind border-none p-0 cursor-pointer" onclick="goTo(1)"></button>
            <button class="ind border-none p-0 cursor-pointer" onclick="goTo(2)"></button>
        </div>
    </div>
</section>

<!-- Hero & scroll-reveal scripts -->
<script src="<?= base_url('js/hero.js') ?>" defer></script>
<script src="<?= base_url('js/scroll-reveal.js') ?>" defer></script>