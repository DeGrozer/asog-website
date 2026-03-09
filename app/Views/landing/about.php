<!--

     ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: ABOUT US                                                   ║
     ║  Light bg (#F8F6F2) · Who We Are · Description ng ASOG-TBI           ║
     ╚══════════════════════════════════════════════════════════════════════╝ 
     
-->
<section id="about" class="relative overflow-hidden bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>
    <div class="ai-cross hidden lg:block" style="top:18%;left:22%"></div>
    <div class="ai-cross hidden lg:block" style="top:72%;right:14%"></div>

    <div class="grid grid-cols-1 lg:grid-cols-[280px_1px_1fr] gap-8 lg:gap-14 items-start relative z-[1]">

        <!-- Left heading -->

        <div class="reveal">
            <div class="flex items-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy">Who We Are</span>
            </div>
            <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-navy">
                Built for <em class="italic text-gold">Bicol's</em> Future
            </h2>
        </div>

        <!-- Divider (desktop only) -->

        <div class="hidden lg:block bg-navy/15 reveal reveal-d1"></div>

        <!-- Right body -->

        <div class="reveal reveal-d2">
            <div class="text-sm md:text-base font-light leading-[2.0] mb-5 text-justify" style="color:#020d18;">
                <p>The ASOG Technology Business Incubator (TBI) is an initiative of Camarines Sur Polytechnic
                    Colleges (CSPC), by DOST-PCIEERD, aimed at fostering Engineering and AI-based innovations for
                    food value chain management.
                </p>
                <p>
                    Our mission is to empower startups and Micro, Small, and Medium Enterprises (MSMEs) with the
                    resources, mentorship, and the support they need to develop cutting-edge solutions that enhance
                    efficiency, productivity, and sustainability in the food industry.</p>
            </div>
            <a href="<?= site_url('about') ?>"
                class="group inline-flex items-center gap-1.5 mt-5 text-[.65rem] font-bold tracking-[.13em] uppercase text-navy no-underline transition-all duration-200 hover:text-gold hover:gap-3">
                Read More <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
            </a>
        </div>
    </div>
</section>