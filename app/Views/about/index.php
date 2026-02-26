<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  ABOUT PAGE — TOC sidebar + Our Story · Why Choose Us · Our Impact  ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->

<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-8 lg:gap-12">

            <!-- ── TOC Sidebar ── -->
            <?php
                $tocTitle = 'About Us';
                $tocItems = [
                    ['id' => 'our-story', 'label' => 'Our Story', 'children' => [
                        ['id' => 'who-we-are', 'label' => 'Who We Are'],
                        ['id' => 'what-we-do', 'label' => 'What We Do'],
                    ]],
                    ['id' => 'why-choose-us', 'label' => 'Why Choose Us?', 'children' => [
                        ['id' => 'why-asog', 'label' => 'Why ASOG?'],
                        ['id' => 'who-can-join', 'label' => 'Who Can Join?'],
                    ]],
                    ['id' => 'our-impact', 'label' => 'Our Impact'],
                    ['id' => 'organization', 'label' => 'Organization', 'children' => [
                        ['id' => 'core-team', 'label' => 'The Core Team'],
                        ['id' => 'tbi-staff', 'label' => 'TBI Staff'],
                        ['id' => 'faculty-mentors', 'label' => 'Faculty Mentors'],
                        ['id' => 'industry-mentors', 'label' => 'Industry Mentors'],
                    ]],
                ];
            ?>
            <?= view('partials/toc', compact('tocTitle', 'tocItems')) ?>

            <!-- ── Main Content ── -->
            <div class="min-w-0">
                <div class="max-w-[760px] text-[.95rem] font-normal leading-[1.95] text-dark/60 text-justify">

                    <!-- ── OUR STORY ── -->
                    <h2 id="our-story" class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.18] text-dark mb-6 scroll-mt-28">Our Story</h2>

                    <p id="who-we-are" class="mb-4 text-[.78rem] font-semibold tracking-wide uppercase text-gold/80 scroll-mt-28">Who We Are</p>
                    <p class="mb-5">
                        The ASOG Technology Business Incubator (TBI) is an initiative of Camarines Sur Polytechnic Colleges (CSPC) aimed at fostering Engineering and AI-based innovations for food value chain management. Our mission is to empower startups and Micro, Small, and Medium Enterprises (MSMEs) with the resources, mentorship, and support they need to develop cutting-edge solutions that enhance efficiency, productivity, and sustainability in the food industry.
                    </p>
                    <p class="mb-5">
                        It is funded by the Department of Science and Technology – Philippine Council for Industry, Energy and Emerging Technology Research and Development (DOST-PCIEERD) and co-monitored by DOST Region V.
                    </p>

                    <p id="what-we-do" class="mb-4 text-[.78rem] font-semibold tracking-wide uppercase text-gold/80 scroll-mt-28">What We Do</p>
                    <p class="mb-5">At ASOG TBI, we incubate and accelerate startups by providing them with:</p>
                    <ul class="space-y-3 list-none pl-0 mb-5">
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Access to state-of-the-art facilities</strong> like the AI Research Center for Community Development (AIRCoDe), Fabrication Laboratory (FabLab), Rinconada Food Processing Hub – Shared Service Facility (SSF), and Business Incubation Center</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Mentorship and training</strong> from industry experts, engineers, AI specialists, and business leaders</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Support in prototyping, market validation, and technology transfer</strong></span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Networking opportunities</strong> with investors, venture capitalists, and government agencies</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Intellectual property assistance</strong> to secure patents and trademarks</span></li>
                    </ul>

                    <div class="h-px bg-dark/[.08] my-14"></div>

                    <!-- ── WHY CHOOSE US? ── -->
                    <h2 id="why-choose-us" class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.18] text-dark mb-6 scroll-mt-28">Why Choose Us?</h2>

                    <p id="why-asog" class="mb-4 text-[.78rem] font-semibold tracking-wide uppercase text-gold/80 scroll-mt-28">Why ASOG?</p>
                    <p class="mb-5">
                        ASOG TBI stands out because we integrate expertise from <strong class="text-dark/75">Academe, Society, Organizations, and Government</strong> (ASOG) to build a robust innovation ecosystem. We work closely with DOST-PCIEERD, other national government agencies, and local industries to bridge the gap between research and commercialization, ensuring that AI-driven solutions are practical, market-ready, and impactful.
                    </p>

                    <p id="who-can-join" class="mb-4 text-[.78rem] font-semibold tracking-wide uppercase text-gold/80 scroll-mt-28">Who Can Join?</p>
                    <p class="mb-5">We support a diverse group of innovators, researchers, and entrepreneurs, including:</p>
                    <ul class="space-y-3 list-none pl-0">
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Startups &amp; MSMEs</strong> in food value chain management</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Students &amp; Faculty Researchers</strong> from CSPC and partner institutions</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Tech enthusiasts &amp; AI innovators</strong> exploring AI applications in the food industry</span></li>
                    </ul>

                    <div class="h-px bg-dark/[.08] my-14"></div>

                    <!-- ── OUR IMPACT ── -->
                    <h2 id="our-impact" class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.18] text-dark mb-6 scroll-mt-28">Our Impact</h2>
                    <p class="mb-6">We aim to revolutionize the food industry in Camarines Sur and beyond by:</p>
                    <ul class="space-y-3 list-none pl-0">
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span>Improving food production, processing, and distribution using AI-driven solutions</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span>Increasing profitability and efficiency for MSMEs</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span>Strengthening the regional startup ecosystem through strategic partnerships</span></li>
                        <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span>Creating employment opportunities and promoting inclusive economic growth</span></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  ORGANIZATION                                                      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-white py-20 md:py-32 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[960px] mx-auto relative z-[2]">

        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Our People</span>
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
            </div>
            <h2 id="organization" class="font-display text-[2rem] md:text-[2.6rem] leading-[1.15] text-dark scroll-mt-28">Organization</h2>
            <p class="text-[.95rem] font-normal leading-[1.8] text-dark/50 mt-4 max-w-[560px] mx-auto">The people behind ASOG TBI — our core team, staff, faculty mentors, and industry mentors driving innovation in the Bicol Region.</p>
        </div>

        <!-- THE CORE TEAM -->
        <div class="mb-16">
            <h3 id="core-team" class="font-display text-[1.4rem] md:text-[1.7rem] leading-[1.2] text-dark mb-8 scroll-mt-28">The Core Team</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="group text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.04] border border-dark/[.06] mb-4 flex items-center justify-center overflow-hidden">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Photo</span>
                    </div>
                    <h4 class="font-display text-[.95rem] text-dark leading-tight mb-0.5">Lorem Ipsum</h4>
                    <p class="text-[.72rem] font-medium text-gold tracking-wide uppercase">Position Title</p>
                </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="h-px bg-dark/[.06] my-14"></div>

        <!-- TBI STAFF -->
        <div class="mb-16">
            <h3 id="tbi-staff" class="font-display text-[1.4rem] md:text-[1.7rem] leading-[1.2] text-dark mb-8 scroll-mt-28">TBI Staff</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="group text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.04] border border-dark/[.06] mb-4 flex items-center justify-center overflow-hidden">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Photo</span>
                    </div>
                    <h4 class="font-display text-[.95rem] text-dark leading-tight mb-0.5">Lorem Ipsum</h4>
                    <p class="text-[.72rem] font-medium text-gold tracking-wide uppercase">Staff Role</p>
                </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="h-px bg-dark/[.06] my-14"></div>

        <!-- MENTORS -->
        <div class="mb-16">
            <h3 id="mentors" class="font-display text-[1.4rem] md:text-[1.7rem] leading-[1.2] text-dark mb-8 scroll-mt-28">Mentors</h3>

            <!-- Faculty Mentors -->
            <h4 id="faculty-mentors" class="text-[.65rem] font-semibold tracking-[.18em] uppercase text-navy/50 mb-6 scroll-mt-28">Faculty Mentors</h4>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 mb-12">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="group text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.04] border border-dark/[.06] mb-4 flex items-center justify-center overflow-hidden">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Photo</span>
                    </div>
                    <h4 class="font-display text-[.95rem] text-dark leading-tight mb-0.5">Lorem Ipsum</h4>
                    <p class="text-[.72rem] font-medium text-sky tracking-wide uppercase">Faculty Mentor</p>
                </div>
                <?php endfor; ?>
            </div>

            <!-- Industry Mentors -->
            <h4 id="industry-mentors" class="text-[.65rem] font-semibold tracking-[.18em] uppercase text-navy/50 mb-6 scroll-mt-28">Industry Mentors</h4>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="group text-center">
                    <div class="w-full aspect-square rounded-lg bg-dark/[.04] border border-dark/[.06] mb-4 flex items-center justify-center overflow-hidden">
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Photo</span>
                    </div>
                    <h4 class="font-display text-[.95rem] text-dark leading-tight mb-0.5">Lorem Ipsum</h4>
                    <p class="text-[.72rem] font-medium text-sky tracking-wide uppercase">Industry Mentor</p>
                </div>
                <?php endfor; ?>
            </div>
        </div>

    </div>
</section>
