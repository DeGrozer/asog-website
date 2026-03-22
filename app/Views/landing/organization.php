<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: ORGANIZATION                                             ║
     ║  Dark bg · 4-column team grid                                      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="organization" data-navhint="blue"
    class="relative overflow-hidden bg-[#03558c] py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1400px] mx-auto relative z-[2]">
        <div class="text-center reveal mb-10 md:mb-14">
            <div class="flex items-center justify-center gap-2 mb-3">
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">The Team</span>
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
            </div>
                    <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-off">Our <em
                        class="italic text-gold">Organization</em></h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4 reveal-group">
            <div class="rc text-center">
                <div
                    class="mx-auto aspect-square rounded-lg mb-3 p-[2px]"
                    style="width:165px;max-width:100%;background:linear-gradient(160deg, rgba(150,208,255,.7), rgba(3,85,140,.5));">
                    <div class="w-full h-full rounded-[7px] overflow-hidden"
                        style="background:linear-gradient(160deg, rgba(150,208,255,.2), rgba(3,85,140,.25));">
                        <img src="<?= base_url('assets/img/team/Odsinada.png') ?>" alt="Ms. Cherry Lyn M. Odsinada"
                            class="w-full h-full object-contain object-center" />
                    </div>
                </div>
                <h4 class="font-display text-[.95rem] md:text-[1.05rem] text-off leading-tight">Ms. Cherry Lyn M.
                    Odsinada
                </h4>
                <span
                    class="text-[.5rem] md:text-[.55rem] font-medium tracking-[.12em] uppercase mt-1 block text-gold/90">
                    Project Leader</span>
            </div>
            <div class="rc text-center">
                <div
                    class="mx-auto aspect-square rounded-lg mb-3 p-[2px]"
                    style="width:165px;max-width:100%;background:linear-gradient(160deg, rgba(150,208,255,.7), rgba(3,85,140,.5));">
                    <div class="w-full h-full rounded-[7px] overflow-hidden"
                        style="background:linear-gradient(160deg, rgba(150,208,255,.2), rgba(3,85,140,.25));">
                        <img src="<?= base_url('assets/img/team/Onesa.png') ?>" alt="Ms. Rosel O. Onesa"
                            class="w-full h-full object-contain object-center" />
                    </div>
                </div>
                <h4 class="font-display text-[.95rem] md:text-[1.05rem] text-off leading-tight">Ms. Rosel O. Onesa</h4>
                <span
                    class="text-[.5rem] md:text-[.55rem] font-medium tracking-[.12em] uppercase mt-1 block text-gold/90">Marketing
                    &amp; Communications
                    Lead
                </span>
            </div>
            <div class="rc text-center">
                <div
                    class="mx-auto aspect-square rounded-lg mb-3 p-[2px]"
                    style="width:165px;max-width:100%;background:linear-gradient(160deg, rgba(150,208,255,.7), rgba(3,85,140,.5));">
                    <div class="w-full h-full rounded-[7px] flex items-center justify-center"
                        style="background:linear-gradient(160deg, rgba(150,208,255,.2), rgba(3,85,140,.25));">
                    <svg class="w-12 h-12 text-white/75" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                    </div>
                </div>
                <h4 class="font-display text-[.95rem] md:text-[1.05rem] text-off leading-tight">Ms. Kaela Marie N.
                    Fortuno</h4>
                <span
                    class="text-[.5rem] md:text-[.55rem] font-medium tracking-[.12em] uppercase mt-1 block text-gold/90">AI
                    Expert
                </span>
            </div>
            <div class="rc text-center">
                <div
                    class="mx-auto aspect-square rounded-lg mb-3 p-[2px]"
                    style="width:165px;max-width:100%;background:linear-gradient(160deg, rgba(150,208,255,.7), rgba(3,85,140,.5));">
                    <div class="w-full h-full rounded-[7px] flex items-center justify-center"
                        style="background:linear-gradient(160deg, rgba(150,208,255,.2), rgba(3,85,140,.25));">
                    <svg class="w-12 h-12 text-white/75" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                    </div>
                </div>
                <h4 class="font-display text-[.95rem] md:text-[1.05rem] text-off leading-tight">Eng. Wenceslao D. Gavino
                </h4>
                <span
                    class="text-[.5rem] md:text-[.55rem] font-medium tracking-[.12em] uppercase mt-1 block text-gold/90">ITSO
                    Manager</span>
            </div>
        </div>

        <!-- See More -->
        <div class="text-center mt-10 md:mt-14 reveal">
            <a href="<?= site_url('organization') ?>"
                class="inline-flex items-center gap-2 font-body text-[.62rem] font-bold tracking-[.2em] uppercase text-gold no-underline border border-gold/40 px-6 py-3 rounded-sm transition-all duration-200 hover:bg-gold/10 hover:border-gold">
                View ASOG Team <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</section>