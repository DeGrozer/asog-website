<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: FEATURED INCUBATEE                                       ║
     ║  Dark bg · spotlight card with visual + content                    ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="incubatees" class="relative overflow-hidden bg-navy py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <!-- Header row -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-4 mb-10 md:mb-12 reveal">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Spotlight</span>
                </div>
                <h2 class="font-display text-2xl md:text-[2rem] text-off leading-none">Featured Incubatee</h2>
            </div>
            <a href="#"
                class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-white/[.28] no-underline border-b border-white/[.12] pb-0.5 transition-colors duration-200 hover:text-gold hover:border-gold shrink-0">View
                All Incubatees</a>
        </div>

        <!-- Card -->
        <div class="rounded-lg reveal reveal-d1 border border-sky/30 bg-sky/5 hover:bg-sky/10 overflow-hidden transition-colors duration-300">
            <div class="grid grid-cols-1 md:grid-cols-[1fr_1.2fr]">
                <!-- Left visual -->
                <div class="relative min-h-[280px] md:min-h-[400px] flex items-center justify-center bg-[#0a1628]">
                    <div class="absolute inset-0 opacity-[.025]"
                        style="background-image:linear-gradient(rgba(255,255,255,.6) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.6) 1px,transparent 1px);background-size:40px 40px">
                    </div>
                    <div class="relative z-[1] text-center">
                        <div
                            class="w-20 h-20 md:w-24 md:h-24 mx-auto rounded-lg border border-white/[.07] bg-white/[.02] flex items-center justify-center mb-4">
                            <span
                                class="font-display text-[1.8rem] md:text-[2.2rem] leading-none text-gold/70 select-none">S</span>
                        </div>
                        <span class="font-display text-lg md:text-[1.2rem] text-white/50">Startup Name</span>
                        <span class="block text-[.46rem] font-medium tracking-[.24em] uppercase text-white/15 mt-1">Platform</span>
                    </div>
                    <span
                        class="absolute top-4 left-4 md:top-5 md:left-5 text-[.5rem] font-bold tracking-[.13em] uppercase text-dark bg-gold px-2.5 py-1 rounded-sm">Featured</span>
                    <span
                        class="absolute bottom-4 left-4 md:bottom-5 md:left-5 text-[.5rem] font-semibold tracking-[.12em] uppercase text-white/20">Cohort
                        1 · 2024</span>
                </div>

                <!-- Right content -->
                <div
                    class="p-6 md:p-11 flex flex-col justify-center border-t md:border-t-0 md:border-l border-white/[.05]">
                    <span class="text-[.54rem] font-semibold tracking-[.16em] uppercase text-sky mb-3">Category · Focus
                        Area</span>
                    <h3 class="font-display text-xl md:text-[2rem] leading-[1.1] text-off mb-4">Startup Name</h3>
                    <p class="text-[.82rem] md:text-[.85rem] font-light leading-[1.85] text-white/40 mb-7">Lorem ipsum
                        dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                    <div class="flex flex-wrap gap-6 md:gap-8 mb-7 pb-7 border-b border-white/[.05]">
                        <div>
                            <span
                                class="font-display text-xl md:text-[1.4rem] text-gold leading-none block mb-1">00%</span>
                            <span class="text-[.52rem] font-medium tracking-[.12em] uppercase text-white/20">Metric
                                One</span>
                        </div>
                        <div>
                            <span
                                class="font-display text-xl md:text-[1.4rem] text-gold leading-none block mb-1">000+</span>
                            <span class="text-[.52rem] font-medium tracking-[.12em] uppercase text-white/20">Metric
                                Two</span>
                        </div>
                        <div>
                            <span
                                class="font-display text-xl md:text-[1.4rem] text-gold leading-none block mb-1">0</span>
                            <span class="text-[.52rem] font-medium tracking-[.12em] uppercase text-white/20">Metric
                                Three</span>
                        </div>
                    </div>
                    <a href="#"
                        class="group text-[.65rem] font-bold tracking-[.13em] uppercase text-gold no-underline inline-flex items-center gap-1.5 transition-all duration-200 hover:gap-3">
                        Read Full Story <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
