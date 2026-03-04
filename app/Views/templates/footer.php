<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  FOOTER                                                            ║
     ║  Dark bg · stacked layout: top row, link columns, bottom strip     ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<footer class="relative bg-dark">
    <!-- Subtle grid texture -->
    <div class="absolute inset-0 pointer-events-none opacity-[.03]"
        style="background-image:linear-gradient(rgba(255,255,255,.5) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.5) 1px,transparent 1px);background-size:60px 60px">
    </div>

    <div class="relative z-[1] max-w-[1200px] mx-auto px-6 md:px-10 lg:px-14">

        <!-- ── TOP: Logo + email + socials in one row ──────────── -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pt-12 md:pt-16 pb-8 md:pb-10 border-b border-white/[.06]">
            <img src="<?= base_url('asset/js/img/ASOG TBI/PNG/asog logo variations_full-colored_landscape-light.png') ?>" alt="ASOG TBI"
                class="h-[40px] md:h-[48px] object-contain" />
            <div class="flex items-center gap-6">
                <a href="mailto:asog.tbi@cspc.edu.ph" class="text-[.74rem] font-light text-white/35 no-underline transition-colors hover:text-gold">asog.tbi@cspc.edu.ph</a>
                <span class="hidden sm:block w-px h-4 bg-white/[.08]"></span>
                <div class="flex gap-2">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/asogtbi" target="_blank" rel="noopener" title="Facebook" class="w-7 h-7 rounded-full bg-white/[.05] flex items-center justify-center no-underline transition-all duration-200 hover:bg-gold/15 group">
                        <svg class="w-3 h-3 text-white/25 group-hover:text-gold transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/asogtbi" target="_blank" rel="noopener" title="Instagram" class="w-7 h-7 rounded-full bg-white/[.05] flex items-center justify-center no-underline transition-all duration-200 hover:bg-gold/15 group">
                        <svg class="w-3 h-3 text-white/25 group-hover:text-gold transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <!-- X -->
                    <a href="https://x.com/asogtbi" target="_blank" rel="noopener" title="X" class="w-7 h-7 rounded-full bg-white/[.05] flex items-center justify-center no-underline transition-all duration-200 hover:bg-gold/15 group">
                        <svg class="w-3 h-3 text-white/25 group-hover:text-gold transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <!-- Threads -->
                    <a href="https://www.threads.com/@asogtbi" target="_blank" rel="noopener" title="Threads" class="w-7 h-7 rounded-full bg-white/[.05] flex items-center justify-center no-underline transition-all duration-200 hover:bg-gold/15 group">
                        <svg class="w-3 h-3 text-white/25 group-hover:text-gold transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.59 12c.025 3.086.718 5.496 2.057 7.164 1.43 1.783 3.631 2.698 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.09-4.798-.31-.71-.873-1.3-1.634-1.75-.192 1.352-.622 2.446-1.29 3.276-.776.965-1.872 1.599-3.263 1.885-1.254.258-2.47.148-3.43-.312-1.09-.522-1.815-1.396-2.04-2.46-.346-1.636.307-3.217 1.743-4.227 1.108-.78 2.558-1.168 4.312-1.156.888.006 1.739.096 2.547.27-.062-.784-.225-1.44-.493-1.96-.384-.743-1.009-1.189-1.857-1.327-1.237-.2-2.646.152-3.322.95l-1.54-1.317c1.046-1.232 2.97-1.793 4.746-1.505 1.34.217 2.412.914 3.1 2.015.53.85.838 1.89.935 3.117.516.17.993.394 1.424.674 1.206.783 2.073 1.933 2.51 3.332.587 1.885.382 4.532-1.694 6.565-1.842 1.804-4.15 2.619-7.268 2.643zM11.29 12.666c-1.16-.007-2.136.244-2.833.73-.787.55-1.066 1.29-.93 1.932.122.575.558 1.025 1.194 1.33.72.345 1.62.413 2.544.222 1.017-.21 1.8-.654 2.327-1.31.42-.524.725-1.203.893-2.03-.7-.267-1.497-.423-2.385-.475-.266-.02-.537-.025-.81-.025v-.374z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- ── MIDDLE: 3-col link groups + description ─────────── -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-[1fr_1fr_1fr_1.3fr] gap-8 lg:gap-10 py-8 md:py-12">

            <!-- Navigate -->
            <nav>
                <h4 class="text-[.56rem] font-bold tracking-[.2em] uppercase text-white/20 mb-4">Navigate</h4>
                <div class="flex flex-col gap-2">
                    <a href="<?= site_url('about') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">About Us</a>
                    <a href="<?= site_url('programs') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">Programs &amp; Services</a>
                    <a href="<?= site_url('facilities') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">Facilities</a>
                    <a href="<?= site_url('incubatees') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">Incubatees</a>
                    <a href="<?= site_url('news') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">News &amp; Insights</a>
                </div>
            </nav>

            <!-- Programs -->
            <nav>
                <h4 class="text-[.56rem] font-bold tracking-[.2em] uppercase text-white/20 mb-4">Programs</h4>
                <div class="flex flex-col gap-2">
                    <a href="<?= site_url('programs') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">The ALTITUDE Program</a>
                    <a href="<?= site_url('programs') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">Services Offered</a>
                    <a href="<?= site_url('programs') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">Mentorship &amp; Training</a>
                    <a href="<?= site_url('programs') ?>" class="text-[.76rem] font-light text-white/35 no-underline transition-colors duration-200 hover:text-gold">IP Support</a>
                </div>
            </nav>

            <!-- Get in Touch -->
            <div>
                <h4 class="text-[.56rem] font-bold tracking-[.2em] uppercase text-white/20 mb-4">Get in Touch</h4>
                <div class="flex flex-col gap-2">
                    <span class="text-[.76rem] font-light text-white/35 leading-relaxed">CSPC, San Miguel, Nabua,<br />Camarines Sur 4434</span>
                    <span class="text-[.76rem] font-light text-white/35">+63 (054) 123-4567</span>
                    <a href="<?= site_url('incubatees/apply') ?>" class="inline-flex items-center gap-1 text-[.68rem] font-semibold tracking-[.08em] uppercase text-gold/60 no-underline mt-2 transition-colors hover:text-gold">Apply Now <span class="text-[.6rem]">→</span></a>
                </div>
            </div>

            <!-- Blurb -->
            <div class="lg:pl-6 lg:border-l lg:border-white/[.06]">
                <p class="text-[.74rem] font-light leading-[1.85] text-white/25 mb-0">The technology business incubator of Camarines Sur Polytechnic Colleges, backed by DOST-PCIEERD. We work with startups and MSMEs across Bicol on food value chain, engineering, and AI.</p>
            </div>
        </div>

        <!-- ── BOTTOM: copyright strip ─────────────────────────── -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 py-5 border-t border-white/[.06]">
            <span class="text-[.52rem] font-medium tracking-[.1em] uppercase text-white/15">© 2026 ASOG Technology Business Incubator · Camarines Sur Polytechnic Colleges</span>
            <span class="text-[.48rem] font-semibold tracking-[.14em] uppercase text-gold/30">Funded by DOST-PCIEERD</span>
        </div>
    </div>
</footer>

<!-- Toast notifications -->
<?= function_exists('renderToast') ? renderToast() : '' ?>

<!-- Hero slideshow (landing page only) -->
<?php if (! empty($isLanding)): ?>
<script src="<?= base_url('js/hero.js') ?>" defer></script>
<?php endif; ?>

<!-- Scroll-reveal animation observer -->
<script src="<?= base_url('js/scroll-reveal.js') ?>" defer></script>

<!-- TOC scroll-spy (loaded only if sidebar exists on page) -->
<script src="<?= base_url('js/toc.js') ?>" defer></script>

</body>
</html>