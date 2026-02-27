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

