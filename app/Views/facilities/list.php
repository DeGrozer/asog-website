<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  FACILITIES — Full-Page Showcase                                    ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->

<!-- ── Intro ── -->
<section class="relative bg-off py-20 md:py-28">
    <div class="max-w-[900px] mx-auto px-6 md:px-10 text-center">
        <div class="flex items-center justify-center gap-2 mb-4">
            <span class="block w-[18px] h-[1.5px] bg-navy"></span>
            <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy">Infrastructure</span>
            <span class="block w-[18px] h-[1.5px] bg-navy"></span>
        </div>
        <h2 class="font-display text-[2rem] md:text-[2.8rem] leading-[1.12] text-dark mb-6">State-of-the-Art <em
                class="italic text-gold">Facilities</em></h2>
        <p class="text-[.95rem] font-normal leading-[1.85] text-dark max-w-[680px] mx-auto">ASOG TBI incubatees have
            access to CSPC's extensive 8-hectare campus facilities, featuring cutting-edge labs and equipment designed
            to support engineering and AI-driven innovation.</p>
    </div>
</section>

<!-- ── Facility Showcase Blocks ── -->

<!-- 1 · The Co-Lab -->
<section id="co-lab" class="scroll-mt-28 bg-white">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-2 min-h-[480px]">
        <div class="bg-[#e9e6e1] flex items-center justify-center min-h-[320px] lg:min-h-full">
            <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Co-Lab Photo</span>
        </div>
        <div class="flex flex-col justify-center px-8 md:px-14 lg:px-20 py-14 lg:py-20">
            <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold mb-3">Incubation Center</span>
            <h3 class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.15] text-dark mb-5">The Co-Lab</h3>
            <p class="text-[.92rem] font-normal leading-[1.85] text-dark mb-6">Modern coworking space where teams
                collaborate, ideate, and build startups. Features hot-desking, meeting rooms, and a vibrant community of
                innovators.</p>
            <ul class="space-y-2.5 text-[.82rem] text-dark font-light">
                <li class="flex gap-2 items-start"><span class="text-gold mt-0.5">✦</span> Flexible workspace access
                </li>
                <li class="flex gap-2 items-start"><span class="text-gold mt-0.5">✦</span> High-speed internet</li>
                <li class="flex gap-2 items-start"><span class="text-gold mt-0.5">✦</span> Collaboration areas</li>
            </ul>
        </div>
    </div>
</section>

<!-- 2 · The Innovators' Suite -->
<section id="innovators-suite" class="scroll-mt-28 bg-off">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-2 min-h-[480px]">
        <div class="flex flex-col justify-center px-8 md:px-14 lg:px-20 py-14 lg:py-20 order-2 lg:order-1">
            <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold mb-3">Incubation Center</span>
            <h3 class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.15] text-dark mb-5">The Innovators' Suite
            </h3>
            <p class="text-[.92rem] font-normal leading-[1.85] text-dark mb-6">Dedicated offices for early-stage
                startups with secure storage, dedicated desks, and priority access to mentoring and networking events.
            </p>
            <ul class="space-y-2.5 text-[.82rem] text-dark font-light">
                <li class="flex gap-2 items-start"><span class="text-gold mt-0.5">✦</span> Private office spaces</li>
                <li class="flex gap-2 items-start"><span class="text-gold mt-0.5">✦</span> Secure equipment storage</li>
                <li class="flex gap-2 items-start"><span class="text-gold mt-0.5">✦</span> Meeting facilities</li>
            </ul>
        </div>
        <div class="bg-[#e9e6e1] flex items-center justify-center min-h-[320px] lg:min-h-full order-1 lg:order-2">
            <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Innovators' Suite
                Photo</span>
        </div>
    </div>
</section>

<!-- 3 · AIRCoDe Lab -->
<section id="aircode" class="scroll-mt-28 bg-white">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-2 min-h-[480px]">
        <div class="bg-[#e9e6e1] min-h-[320px] lg:min-h-full relative overflow-hidden" data-carousel>
            <div class="flex h-full transition-transform duration-500 ease-out" data-carousel-track>
                <img src="<?= base_url('assets/img/facilities/aircode/IMG_0728 (1).JPG') ?>"
                    alt="AIRCoDe laboratory facility view 1" class="w-full h-[320px] lg:h-full object-cover shrink-0"
                    loading="lazy" />
                <img src="<?= base_url('assets/img/facilities/aircode/IMG_0727.JPG') ?>"
                    alt="AIRCoDe laboratory facility view 2" class="w-full h-[320px] lg:h-full object-cover shrink-0"
                    loading="lazy" />
                <img src="<?= base_url('assets/img/facilities/aircode/IMG_0723.JPG') ?>"
                    alt="AIRCoDe laboratory facility view 3" class="w-full h-[320px] lg:h-full object-cover shrink-0"
                    loading="lazy" />
            </div>

            <button type="button"
                class="absolute left-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Previous AIRCoDe photo" data-carousel-prev>‹</button>
            <button type="button"
                class="absolute right-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Next AIRCoDe photo" data-carousel-next>›</button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2" style="z-index:45;display:flex;align-items:center;gap:8px;" data-carousel-dots>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/95" aria-label="AIRCoDe photo 1"
                    data-carousel-dot="0"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/55" aria-label="AIRCoDe photo 2"
                    data-carousel-dot="1"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/55" aria-label="AIRCoDe photo 3"
                    data-carousel-dot="2"></button>
            </div>
        </div>
        <div class="flex flex-col justify-center px-8 md:px-14 lg:px-20 py-14 lg:py-20">
            <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy mb-3">Partner Facility</span>
            <h3 class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.15] text-dark mb-5">AIRCoDe Lab</h3>
            <p class="text-[.95rem] font-normal leading-[1.8] text-dark mb-4">AIRCoDe is a research center intended
                for research studies implementing Artificial Intelligence Technology. The establishment of AIRCoDe is
                funded by the Department of Science and Technology – Philippine Council for Industry, Energy, and
                Emerging Technology Research and Development (DOST-PCIEERD) under the Infrastructure Development
                Program in 2021.</p>
            <p class="text-[.95rem] font-normal leading-[1.8] text-dark mb-6">Aligned with the research thrust of
                the Camarines Sur Polytechnic Colleges, it shall promote and explore scholarly works responsive to the
                needs of the community using Artificial Intelligence.</p>
            <ul class="space-y-2.5 text-[.82rem] text-dark font-light">
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> GPU servers and workstations
                </li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> AI software suites</li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Dataset repositories</li>
            </ul>
        </div>
    </div>
</section>

<!-- 4 · Fabrication Laboratory -->
<section id="fablab" class="scroll-mt-28 bg-off">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-2 min-h-[480px]">
        <div class="flex flex-col justify-center px-8 md:px-14 lg:px-20 py-14 lg:py-20 order-2 lg:order-1">
            <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy mb-3">Partner Facility</span>
            <h3 class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.15] text-dark mb-5">Fabrication Laboratory
            </h3>
            <p class="text-[.92rem] font-normal leading-[1.85] text-dark mb-6">Equipped with digital fabrication tools
                including 3D printers, CNC machines, laser cutters, and electronics workbenches for rapid prototyping.
            </p>
            <ul class="space-y-2.5 text-[.82rem] text-dark font-light">
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> 3D printers and CNC machines
                </li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Laser cutting equipment</li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Electronics workstations</li>
            </ul>
        </div>
        <div class="bg-[#e9e6e1] min-h-[320px] lg:min-h-full relative overflow-hidden order-1 lg:order-2" data-carousel>
            <div class="flex h-full transition-transform duration-500 ease-out" data-carousel-track>
                <img src="<?= base_url('assets/img/facilities/fablab/IMG_0968.JPG') ?>" alt="FabLab facility view 1"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
                <img src="<?= base_url('assets/img/facilities/fablab/IMG_0970.JPG') ?>" alt="FabLab facility view 2"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
                <img src="<?= base_url('assets/img/facilities/fablab/IMG_0973.JPG') ?>" alt="FabLab facility view 3"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
            </div>

            <button type="button"
                class="absolute left-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Previous FabLab photo" data-carousel-prev>‹</button>
            <button type="button"
                class="absolute right-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Next FabLab photo" data-carousel-next>›</button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2" style="z-index:45;display:flex;align-items:center;gap:8px;" data-carousel-dots>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/95" aria-label="FabLab photo 1"
                    data-carousel-dot="0"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/55" aria-label="FabLab photo 2"
                    data-carousel-dot="1"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/55" aria-label="FabLab photo 3"
                    data-carousel-dot="2"></button>
            </div>
        </div>
    </div>
</section>

<!-- 5 · Shared Service Facility -->
<section id="ssf" class="scroll-mt-28 bg-white">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-2 min-h-[480px]">
        <div class="bg-[#e9e6e1] min-h-[320px] lg:min-h-full relative overflow-hidden" data-carousel>
            <div class="flex h-full transition-transform duration-500 ease-out" data-carousel-track>
                <img src="<?= base_url('assets/img/facilities/ssf/IMG_0984.JPG') ?>" alt="Shared Service Facility view 1"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
                <img src="<?= base_url('assets/img/facilities/ssf/IMG_0987.JPG') ?>" alt="Shared Service Facility view 2"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
                <img src="<?= base_url('assets/img/facilities/ssf/IMG_0990.JPG') ?>" alt="Shared Service Facility view 3"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
            </div>

            <button type="button"
                class="absolute left-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Previous SSF photo" data-carousel-prev>‹</button>
            <button type="button"
                class="absolute right-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Next SSF photo" data-carousel-next>›</button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2" style="z-index:45;display:flex;align-items:center;gap:8px;" data-carousel-dots>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/95" aria-label="SSF photo 1"
                    data-carousel-dot="0"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/55" aria-label="SSF photo 2"
                    data-carousel-dot="1"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/55" aria-label="SSF photo 3"
                    data-carousel-dot="2"></button>
            </div>
        </div>
        <div class="flex flex-col justify-center px-8 md:px-14 lg:px-20 py-14 lg:py-20">
            <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy mb-3">Partner Facility</span>
            <h3 class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.15] text-dark mb-5">Shared Service
                Facility</h3>
            <p class="text-[.92rem] font-normal leading-[1.85] text-dark mb-6">Rinconada Food Processing Hub — a food
                processing laboratory for testing, scaling, and validating food-based innovations and products.</p>
            <ul class="space-y-2.5 text-[.82rem] text-dark font-light">
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Food processing equipment
                </li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Quality testing labs</li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Packaging facilities</li>
            </ul>
        </div>
    </div>
</section>

<!-- 6 · IPMD Division -->
<section id="ip-unit" class="scroll-mt-28 bg-off">
    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-2 min-h-[480px]">
        <div class="flex flex-col justify-center px-8 md:px-14 lg:px-20 py-14 lg:py-20 order-2 lg:order-1">
            <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy mb-3">Partner Facility</span>
            <h3 class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.15] text-dark mb-5">Intellectual Property
                Management
                Division
            </h3>
            <p class="text-[.92rem] font-normal leading-[1.85] text-dark mb-6">Specialized office for intellectual
                property management, patent filing, trademark registration, and technology licensing support.</p>
            <ul class="space-y-2.5 text-[.82rem] text-dark font-light">
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Patent and trademark
                    assistance</li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> IP strategy consultation</li>
                <li class="flex gap-2 items-start"><span class="text-navy mt-0.5">✦</span> Licensing facilitation</li>
            </ul>
        </div>
        <div class="bg-[#e9e6e1] min-h-[320px] lg:min-h-full relative overflow-hidden order-1 lg:order-2" data-carousel>
            <div class="flex h-full transition-transform duration-500 ease-out" data-carousel-track>
                <img src="<?= base_url('assets/img/facilities/ipmd/IMG_0975.JPG') ?>" alt="IPMD facility view 1"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
                <img src="<?= base_url('assets/img/facilities/ipmd/IMG_0977.JPG') ?>" alt="IPMD facility view 2"
                    class="w-full h-[320px] lg:h-full object-cover shrink-0" loading="lazy" />
            </div>

            <button type="button"
                class="absolute left-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Previous IPMD photo" data-carousel-prev>‹</button>
            <button type="button"
                class="absolute right-3 top-1/2 -translate-y-1/2"
                style="z-index:50;width:48px;height:48px;border-radius:999px;border:2px solid #F8AF21;background:rgba(3,53,90,.92);color:#fff;font-size:28px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 18px rgba(0,0,0,.28);"
                aria-label="Next IPMD photo" data-carousel-next>›</button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2" style="z-index:45;display:flex;align-items:center;gap:8px;" data-carousel-dots>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/95" aria-label="IPMD photo 1"
                    data-carousel-dot="0"></button>
                <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/55" aria-label="IPMD photo 2"
                    data-carousel-dot="1"></button>
            </div>
        </div>
    </div>
</section>

<!-- ── Usage Policy ── -->
<script src="<?= base_url('assets/js/facilitiesCarousel.js') ?>" defer></script>