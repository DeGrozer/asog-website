<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  APPLICATION THANK YOU PAGE                                         ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-20 md:py-32 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[600px] mx-auto relative z-[2] text-center">
        <div class="w-14 h-14 mx-auto rounded-full bg-gold/10 flex items-center justify-center mb-6">
            <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>

        <h2 class="font-display text-2xl md:text-[2rem] text-dark mb-4">Thank You!</h2>
        <p class="text-[.88rem] font-light leading-[1.85] text-dark/50 mb-10">
            Your application has been received. We'll review it and get back to you within 5–7 business days.
        </p>

        <a href="<?= site_url('/') ?>"
           class="inline-block font-body text-[.62rem] font-bold tracking-[.14em] uppercase text-white bg-navy px-8 py-3.5 rounded-sm no-underline transition-colors duration-200 hover:bg-dark">
            Back to Home
        </a>
    </div>
</section>
