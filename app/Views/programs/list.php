<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  PROGRAMS & SERVICES — TOC + ALTITUDE, Services, Facilities         ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->

<!-- TOC wrapper for programs page -->
<div class="relative bg-off">
    <div class="max-w-[1200px] mx-auto px-6 md:px-10 lg:px-14">
        <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-8 lg:gap-12">

            <!-- ── TOC Sidebar ── -->
            <div class="pt-16 md:pt-24 lg:pt-24 self-stretch">
                <?php
                    $tocTitle = 'Programs & Services';
                    $tocItems = [
                        ['id' => 'altitude-program', 'label' => 'ALTITUDE Program', 'children' => [
                            ['id' => 'trailhead', 'label' => 'Trailhead'],
                            ['id' => 'basecamp', 'label' => 'Basecamp'],
                            ['id' => 'ascent', 'label' => 'Ascent'],
                            ['id' => 'summit-launch', 'label' => 'Summit Launch'],
                            ['id' => 'founder-story', 'label' => 'Founder Story'],
                        ]],
                        ['id' => 'services-offered', 'label' => 'Services Offered'],
                        ['id' => 'facilities-section', 'label' => 'Facilities', 'children' => [
                            ['id' => 'co-lab', 'label' => 'The Co-Lab'],
                            ['id' => 'innovators-suite', 'label' => 'Innovators\' Suite'],
                            ['id' => 'aircode', 'label' => 'AIRCoDe Lab'],
                            ['id' => 'fablab', 'label' => 'FabLab'],
                            ['id' => 'ssf', 'label' => 'Shared Service Facility'],
                            ['id' => 'ip-unit', 'label' => 'IP Management'],
                            ['id' => 'usage-policy', 'label' => 'Usage Policy'],
                        ]],
                    ];
                ?>
                <?= view('partials/toc', compact('tocTitle', 'tocItems')) ?>
            </div>

            <!-- ── Main Content Column ── -->
            <div class="min-w-0">

<!-- ╔════════════════════════════════════════════════════════════════════╗
     ║  SECTION 1: ALTITUDE PROGRAM                                      ║
     ╚════════════════════════════════════════════════════════════════════╝ -->
<section class="relative py-20 md:py-32">

    <div id="altitude-program" class="scroll-mt-28"></div>

    <div class="max-w-[760px] mx-auto relative z-[2]">
        <!-- Hero text -->
        <div class="text-center mb-14">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Six-Month Incubation</span>
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
            </div>
            <h1 class="font-display text-[2rem] md:text-[2.8rem] leading-[1.12] text-dark mb-6">ALTITUDE Program</h1>
            <p class="text-[.95rem] font-light leading-[1.8] text-dark/50 italic">Advancing Local Technology and Innovation through Transformative Upskilling, Development, and Entrepreneurship</p>
        </div>

        <!-- Main content -->
        <div class="prose-content text-[.95rem] font-normal leading-[1.95] text-dark/60 space-y-8">

            <!-- Intro -->
            <div>
                <h2 class="font-display text-[1.8rem] leading-[1.18] text-dark mb-6">Climbing with Purpose</h2>
                <p class="mb-4">A closer look at ASOG TBI's ALTITUDE framework</p>
                <p class="mb-4"><strong class="text-dark/75">Every startup dreams of reaching the top. Few are prepared for the climb.</strong></p>
                <p class="mb-4">In conversations about innovation, success is often framed as a moment: a product launch, a funding round, a demo day applause. What gets less attention is the stretch before all that: the uncertain terrain where ideas are still fragile, assumptions remain untested, and founders are unsure whether they are moving forward or simply in circles.</p>
                <p class="mb-4">This is where most startups fail, not because the summit is unreachable, but because the climb itself is poorly mapped.</p>
                <p>At the ASOG Technology Business Incubator, the response to this problem is not speed, but structure. The incubator's official program, ALTITUDE, short for <strong class="text-dark/75">Advancing Local Technology and Innovation through Transformative Upskilling, Development, and Entrepreneurship</strong>, is designed around a simple belief: founders do not just need ambition. They also need orientation.</p>
            </div>

            <p>ALTITUDE runs over six months, but its real contribution is not the timeline. It is the way the journey is broken down, deliberately and patiently, into stages that force founders to confront the hardest questions early, before momentum disguises weak foundations.</p>

            <!-- Trailhead -->
            <div>
                <h3 id="trailhead" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28"><strong>Trailhead</strong><br><span class="text-[.85rem] font-normal text-dark/50">Pre-Incubation Phase (Month 1)</span></h3>
                <p class="mb-3">Each climb begins with a pause.</p>
                <p class="mb-3">The Trailhead is where startups are asked to slow down before they move forward. In the first month of ALTITUDE, founders focus on clarifying the problem they want to solve and testing whether it truly exists in the way they imagine. Ideas are subjected to scrutiny, not encouragement for their own sake.</p>
                <p className="mb-3">With industry mentors acting as validators, teams examine their assumptions against real market pain points. Many concepts shift here. Some are reworked. Others are abandoned altogether. The aim is not to discourage risk, but to prevent founders from investing deeply in solutions that have not yet earned the right to exist.</p>
            </div>

            <!-- Basecamp -->
            <div>
                <h3 id="basecamp" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28"><strong>Basecamp</strong><br><span class="text-[.85rem] font-normal text-dark/50">Incubation Phase (Months 2–4)</span></h3>
                <p class="mb-3">Basecamp is where effort becomes visible.</p>
                <p class="mb-3">During the incubation phase, startups begin building. Minimum viable products take form. Features are tested with early adopters. Business models are refined alongside technical development. What once lived on whiteboards and pitch slides is forced into contact with reality.</p>
                <p>Market access enters the picture here, as founders prepare for initial customer engagement and partnerships. Basecamp rewards learning that happens fast enough to evolve and carefully enough to endure.</p>
            </div>

            <!-- Ascent -->
            <div>
                <h3 id="ascent" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28"><strong>Ascent</strong><br><span class="text-[.85rem] font-normal text-dark/50">Post-Incubation Phase (Months 5–6)</span></h3>
                <p class="mb-3">The higher the climb, the more preparation matters.</p>
                <p class="mb-3">The Ascent phase shifts the focus from building to positioning. With early validation in place, founders are introduced to the expectations of funders, grant institutions, and strategic partners. They work on the tools required for serious conversations: pitch decks, financial projections, and long-term viability plans.</p>
                <p>This is where confidence is tested. Not through applause, but through questions that force clarity about scale, sustainability, and impact.</p>
            </div>

            <!-- Summit Launch -->
            <div>
                <h3 id="summit-launch" class="font-display text-[1.35rem] text-dark mb-4 scroll-mt-28"><strong>Summit Launch</strong></h3>
                <p class="mb-3">Reaching the summit does not mean standing still.</p>
                <p class="mb-3">Summit Launch marks the transition beyond formal incubation, where startups continue to receive strategic support as they navigate growth. Access to networks, mentorship, and partnerships remains part of the relationship because scaling presents challenges that are just as complex as early development.</p>
                <p class="mb-6">Throughout ALTITUDE, mentorship is treated not as a single intervention but as a continuous presence. Founders engage through one-on-one sessions, expert clinics, immersion activities, technical reviews, and pitch rehearsals. Learning happens in rooms and in the field, shaped by feedback that mirrors the pressures of the real world.</p>
                <p class="text-[.88rem] text-dark/50 italic">In an ecosystem often driven by urgency and acceleration, ALTITUDE makes a quieter argument. That preparation matters. That clarity is earned. That progress is intentional.</p>
                <p class="text-[.88rem] text-dark/50 italic">By combining structure, mentorship, and timing, ASOG TBI bridges the gap between dreaming of the summit and being ready for the climb.</p>
            </div>

            <div class="h-px bg-dark/[.08] my-12"></div>

            <!-- Founder Story -->
            <div>
                <h2 id="founder-story" class="font-display text-[1.8rem] leading-[1.18] text-dark mb-6 scroll-mt-28">An Absolute Turning Point</h2>
                <p class="text-[.88rem] text-dark/50 italic mb-6">One engineering student entered ASOG TBI with a simple idea. What followed was a founder story shaped by purpose, science, and the right ecosystem.</p>

                <p class="mb-4">Before he became a startup founder, Abbe Gerald Rivero was focused on the goals most third-year engineering students quietly carry: keep the grades up, stay active in leadership roles, and work toward licensure.</p>

                <p class="mb-4">He describes himself simply as "Ab," a BS Electronics Engineering student with a deep curiosity for technology and a habit of chasing opportunities wherever they appear. He joined skill-building programs, attended networking events, and kept looking for ways to grow. In many ways, he was already building a founder's mindset long before he ever called himself one.</p>

                <p class="mb-4"><strong class="text-dark/75">Then came a problem that refused to stay small.</strong></p>

                <p class="mb-4">For Abbe, it started with a detail most consumers never think about: how meat quality is measured, and what gets compromised in the process.</p>

                <p class="mb-4">Traditional pH testing often requires physically piercing the product. The inspection itself can damage the meat, raise contamination risk, and weaken food safety safeguards. "The current process requires physically compromising the product," he said. "That inefficiency and risk were things I felt we had the technology to fix."</p>

                <p class="mb-4">His team's answer is a tool that does something deceptively simple. It measures meat pH without touching the meat at all.</p>

                <p class="mb-4">The concept uses spectroscopy, which reads spectral signatures and links them to chemical conditions inside the product. Abbe's startup aims to detect pH levels through light-based scanning, helping processors and inspectors assess quality while keeping the product intact.</p>

                <p class="mb-4">Abbe explains the mission in a way that brings the technology back to its most human purpose. "Ultimately, this is for all the consumers out there," he said. "Most people can't see the chemical changes happening in their food." Spoilage signs can be subtle, and inspection lapses can be invisible. But the consequences can be serious, from unsafe products entering the market to food-borne illnesses that could have been prevented.</p>

                <p class="mb-4">Even before incubation, Abbe was already drawn to innovation-centered competitions. He joined hackathons and pitching events that trained him to think beyond grades and requirements. "It shifted my mindset to that of a real-world problem solver," he said. "Creating solutions for problems that people didn't even realize could be fixed."</p>

                <p class="mb-4">That mindset eventually led him to apply to the ASOG Technology Business Incubator, where he found something he did not expect: a real startup ecosystem.</p>

                <p class="mb-4">He applied because he believed the incubator could bring his team's concept closer to reality. ASOG TBI gave the idea structure through mentorship, guidance, and access to the right networks. "It is a dream for any founder to see their concepts come to reality," Abbe said. "ASOG TBI provides the support, resources, and networks to make that happen."</p>

                <p class="mb-4">The experience rewrote his sense of what could happen next.</p>

                <p class="mb-4">"Everything changed," he said. Before the program, his plan was straightforward: graduate, become a licensed engineer, and work in the industry. Entering the incubator introduced him to a different kind of future, one he never expected to explore as a student. "I honestly never expected to be part of a startup ecosystem," he shared.</p>

                <p class="mb-4">The program also demanded a different kind of growth. Abbe describes himself now as a more holistic founder, shaped by constant feedback from mentors, experts, and fellow innovators. "It has taught me to value criticism and use it as a tool to refine our product further."</p>

                <p class="mb-4">For the year ahead, his definition of success is grounded and specific. The goal is to complete their prototype with mentor guidance and build a proof of concept strong enough to scale.</p>

                <p class="mb-4">If the startup succeeds, Abbe believes its impact will be quiet but essential, strengthening public health in ways most people may never notice. Beyond the technology, he hopes his journey can encourage other aspiring founders who are still unsure whether their ideas deserve a chance. "I want to share my story as a 'template' for success; one that others can take, customize, and use to build their own path."</p>

                <p class="mb-4">For him, the biggest change has not been a single win or milestone, but the new direction that opened once he stepped into the ecosystem. "Entering this program created a completely new timeline for my life." ■</p>
            </div>

        </div>
    </div>

<div class="h-px bg-dark/[.08] my-4"></div>

<!-- ╔════════════════════════════════════════════════════════════════════╗
     ║  SECTION 2: SERVICES OFFERED                                       ║
     ╚════════════════════════════════════════════════════════════════════╝ -->
<div class="relative py-20 md:py-24">

    <div id="services-offered" class="scroll-mt-28"></div>

    <div class="relative z-[2]">
        <!-- Section heading -->
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Comprehensive Support</span>
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
            </div>
            <h2 class="font-display text-[2rem] md:text-[2.6rem] leading-[1.15] text-dark">Services Offered</h2>
            <p class="text-[.95rem] font-normal leading-[1.8] text-dark/50 mt-4 max-w-[560px] mx-auto">ASOG TBI provides a comprehensive range of capacity-building services designed to support startups and MSMEs at every stage of their innovation journey.</p>
        </div>

        <!-- 4 Main Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
            <!-- Service 1: Design Thinking -->
            <div class="rounded-lg border border-dark/[.08] bg-white p-8 md:p-10 transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                <div class="h-1 w-12 bg-gold rounded mb-6"></div>
                <h3 class="font-display text-[1.4rem] text-dark mb-3">Design Thinking</h3>
                <p class="text-[.82rem] font-light leading-[1.75] text-dark/55 mb-5 text-justify">Structured frameworks to help founders clarify problems, validate assumptions, and develop customer-centric solutions. Design thinking workshops guide teams through ideation, prototyping, and user feedback loops.</p>
                <ul class="space-y-2 list-none pl-0">
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Problem validation sessions</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Customer discovery workshops</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Market pain point analysis</span></li>
                </ul>
            </div>

            <!-- Service 2: Prototyping -->
            <div class="rounded-lg border border-dark/[.08] bg-white p-8 md:p-10 transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                <div class="h-1 w-12 bg-gold rounded mb-6"></div>
                <h3 class="font-display text-[1.4rem] text-dark mb-3">Prototyping &amp; Development</h3>
                <p class="text-[.82rem] font-light leading-[1.75] text-dark/55 mb-5 text-justify">Access to cutting-edge fabrication labs, AI workstations, and engineering expertise to transform concepts into tangible prototypes and minimum viable products (MVPs).</p>
                <ul class="space-y-2 list-none pl-0">
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">FabLab equipment and tools</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">AI research lab access (AIRCoDe)</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Technical mentorship and code review</span></li>
                </ul>
            </div>

            <!-- Service 3: Market Validation -->
            <div class="rounded-lg border border-dark/[.08] bg-white p-8 md:p-10 transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                <div class="h-1 w-12 bg-gold rounded mb-6"></div>
                <h3 class="font-display text-[1.4rem] text-dark mb-3">Market Validation &amp; Business Planning</h3>
                <p class="text-[.82rem] font-light leading-[1.75] text-dark/55 mb-5 text-justify">Structured guidance on testing product-market fit, refining business models, and preparing comprehensive business plans that attract investors and partners.</p>
                <ul class="space-y-2 list-none pl-0">
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Early adopter testing programs</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Financial projections and modeling</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Go-to-market strategy development</span></li>
                </ul>
            </div>

            <!-- Service 4: IP Protection -->
            <div class="rounded-lg border border-dark/[.08] bg-white p-8 md:p-10 transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                <div class="h-1 w-12 bg-gold rounded mb-6"></div>
                <h3 class="font-display text-[1.4rem] text-dark mb-3">IP Protection &amp; Legal Support</h3>
                <p class="text-[.82rem] font-light leading-[1.75] text-dark/55 mb-5 text-justify">Expert guidance on patent applications, trademark registration, and intellectual property management to protect innovations and facilitate technology transfer.</p>
                <ul class="space-y-2 list-none pl-0">
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Patent and trademark drafting</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">IP strategy consultation</span></li>
                    <li class="flex gap-2 items-start text-[.78rem]"><span class="text-navy font-bold leading-none mt-0.5">›</span><span class="text-dark/50">Technology commercialization guidance</span></li>
                </ul>
            </div>
        </div>

        <!-- Additional Support -->
        <div class="mt-16 p-8 md:p-12 rounded-lg border border-gold/[.2] bg-white">
            <h3 class="font-display text-[1.35rem] text-dark mb-6">Additional Support &amp; Resources</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-[.78rem] font-semibold tracking-[.12em] uppercase text-gold/80 mb-4">Mentorship &amp; Guidance</h4>
                    <ul class="space-y-2.5 text-[.82rem] text-dark/60 font-light">
                        <li>✦ One-on-one mentoring sessions</li>
                        <li>✦ Expert clinics and technical reviews</li>
                        <li>✦ Pitch rehearsal and presentation coaching</li>
                        <li>✦ Industry immersion activities</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[.78rem] font-semibold tracking-[.12em] uppercase text-gold/80 mb-4">Networking &amp; Partnerships</h4>
                    <ul class="space-y-2.5 text-[.82rem] text-dark/60 font-light">
                        <li>✦ Investor and venture capital connections</li>
                        <li>✦ Government agency linkages (DOST, DTI)</li>
                        <li>✦ Industry partnership facilitation</li>
                        <li>✦ Demo day and pitch event access</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[.78rem] font-semibold tracking-[.12em] uppercase text-gold/80 mb-4">Resources &amp; Tools</h4>
                    <ul class="space-y-2.5 text-[.82rem] text-dark/60 font-light">
                        <li>✦ Dataset repository and cloud storage</li>
                        <li>✦ AI software suites and licenses</li>
                        <li>✦ Co-working space access</li>
                        <li>✦ Conference room and meeting facilities</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[.78rem] font-semibold tracking-[.12em] uppercase text-gold/80 mb-4">Continuing Support</h4>
                    <ul class="space-y-2.5 text-[.82rem] text-dark/60 font-light">
                        <li>✦ Post-graduation mentorship</li>
                        <li>✦ Ongoing network access</li>
                        <li>✦ Grant and funding opportunities</li>
                        <li>✦ Strategic partnership support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="h-px bg-dark/[.08] my-4"></div>

<!-- ╔════════════════════════════════════════════════════════════════════╗
     ║  SECTION 3: FACILITIES                                             ║
     ╚════════════════════════════════════════════════════════════════════╝ -->
<div class="relative py-20 md:py-24">

    <div id="facilities-section" class="scroll-mt-28"></div>

    <div class="relative z-[2]">
        <!-- Section heading -->
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-2 mb-4">
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy">Infrastructure</span>
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
            </div>
            <h2 class="font-display text-[2rem] md:text-[2.6rem] leading-[1.15] text-dark mb-4">State-of-the-Art <em class="italic text-gold">Facilities</em></h2>
            <p class="text-[.95rem] font-normal leading-[1.8] text-dark/50 max-w-[640px] mx-auto">ASOG TBI incubatees have access to CSPC's extensive 8-hectare campus facilities, featuring cutting-edge labs and equipment designed to support engineering and AI-driven innovation.</p>
        </div>

        <!-- 3-column facility cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-16">
            <!-- Co-Lab -->
            <div id="co-lab" class="scroll-mt-28 rounded-lg border border-dark/[.08] bg-white shadow-sm shadow-dark/[.04] overflow-hidden">
                <div class="h-[200px] bg-[#e9e6e1] flex items-center justify-center">
                    <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Co-Lab</span>
                </div>
                <div class="p-6">
                    <h3 class="font-display text-[1.15rem] text-dark mb-3">The Co-Lab</h3>
                    <p class="text-[.8rem] font-light leading-[1.75] text-dark/50 mb-4">Modern coworking space where teams collaborate, ideate, and build startups. Features hot-desking, meeting rooms, and a vibrant community of innovators.</p>
                    <ul class="space-y-2 text-[.75rem] text-dark/40 font-light">
                        <li>• Flexible workspace access</li>
                        <li>• High-speed internet</li>
                        <li>• Collaboration areas</li>
                    </ul>
                </div>
            </div>

            <!-- Innovators' Suite -->
            <div id="innovators-suite" class="scroll-mt-28 rounded-lg border border-dark/[.08] bg-white shadow-sm shadow-dark/[.04] overflow-hidden">
                <div class="h-[200px] bg-[#e9e6e1] flex items-center justify-center">
                    <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Innovators Suite</span>
                </div>
                <div class="p-6">
                    <h3 class="font-display text-[1.15rem] text-dark mb-3">The Innovators' Suite</h3>
                    <p class="text-[.8rem] font-light leading-[1.75] text-dark/50 mb-4">Dedicated offices for early-stage startups with secure storage, dedicated desks, and priority access to mentoring and networking events.</p>
                    <ul class="space-y-2 text-[.75rem] text-dark/40 font-light">
                        <li>• Private office spaces</li>
                        <li>• Secure equipment storage</li>
                        <li>• Meeting facilities</li>
                    </ul>
                </div>
            </div>

            <!-- AIRCoDe -->
            <div id="aircode" class="scroll-mt-28 rounded-lg border border-dark/[.08] bg-white shadow-sm shadow-dark/[.04] overflow-hidden">
                <div class="h-[200px] bg-[#e9e6e1] flex items-center justify-center">
                    <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">AIRCoDe</span>
                </div>
                <div class="p-6">
                    <h3 class="font-display text-[1.15rem] text-dark mb-3">AIRCoDe Lab</h3>
                    <p class="text-[.8rem] font-light leading-[1.75] text-dark/50 mb-4">DOST-PCIEERD funded AI Research Center for Community Development. The first and only AI research laboratory in the Bicol Region with state-of-the-art computing infrastructure.</p>
                    <ul class="space-y-2 text-[.75rem] text-dark/40 font-light">
                        <li>• GPU servers and workstations</li>
                        <li>• AI software suites</li>
                        <li>• Dataset repositories</li>
                    </ul>
                </div>
            </div>

            <!-- FabLab -->
            <div id="fablab" class="scroll-mt-28 rounded-lg border border-dark/[.08] bg-white shadow-sm shadow-dark/[.04] overflow-hidden">
                <div class="h-[200px] bg-[#e9e6e1] flex items-center justify-center">
                    <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">FabLab</span>
                </div>
                <div class="p-6">
                    <h3 class="font-display text-[1.15rem] text-dark mb-3">Fabrication Laboratory</h3>
                    <p class="text-[.8rem] font-light leading-[1.75] text-dark/50 mb-4">Equipped with digital fabrication tools including 3D printers, CNC machines, laser cutters, and electronics workbenches for rapid prototyping.</p>
                    <ul class="space-y-2 text-[.75rem] text-dark/40 font-light">
                        <li>• 3D printers and CNC machines</li>
                        <li>• Laser cutting equipment</li>
                        <li>• Electronics workstations</li>
                    </ul>
                </div>
            </div>

            <!-- SSF -->
            <div id="ssf" class="scroll-mt-28 rounded-lg border border-dark/[.08] bg-white shadow-sm shadow-dark/[.04] overflow-hidden">
                <div class="h-[200px] bg-[#e9e6e1] flex items-center justify-center">
                    <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">SSF</span>
                </div>
                <div class="p-6">
                    <h3 class="font-display text-[1.15rem] text-dark mb-3">Shared Service Facility</h3>
                    <p class="text-[.8rem] font-light leading-[1.75] text-dark/50 mb-4">Rinconada Food Processing Hub — a food processing laboratory for testing, scaling, and validating food-based innovations and products.</p>
                    <ul class="space-y-2 text-[.75rem] text-dark/40 font-light">
                        <li>• Food processing equipment</li>
                        <li>• Quality testing labs</li>
                        <li>• Packaging facilities</li>
                    </ul>
                </div>
            </div>

            <!-- IP Unit -->
            <div id="ip-unit" class="scroll-mt-28 rounded-lg border border-dark/[.08] bg-white shadow-sm shadow-dark/[.04] overflow-hidden">
                <div class="h-[200px] bg-[#e9e6e1] flex items-center justify-center">
                    <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">IP Unit</span>
                </div>
                <div class="p-6">
                    <h3 class="font-display text-[1.15rem] text-dark mb-3">IP Management Office</h3>
                    <p class="text-[.8rem] font-light leading-[1.75] text-dark/50 mb-4">Specialized office for intellectual property management, patent filing, trademark registration, and technology licensing support.</p>
                    <ul class="space-y-2 text-[.75rem] text-dark/40 font-light">
                        <li>• Patent and trademark assistance</li>
                        <li>• IP strategy consultation</li>
                        <li>• Licensing facilitation</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Usage Policy -->
        <div class="rounded-lg border border-gold/[.2] bg-white p-10">
            <h3 id="usage-policy" class="font-display text-[1.35rem] text-dark mb-6 scroll-mt-28">Facility Usage Policy</h3>
            <div class="prose-content text-[.9rem] font-normal leading-[1.85] text-dark/60 space-y-4">
                <p><strong class="text-dark/75">ASOG TBI incubatees receive priority access to these facilities as part of their incubation support package.</strong> Usage terms include:</p>
                <ul class="space-y-3 list-none pl-0">
                    <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">Co-Lab & Innovators' Suite:</strong> Flexible workspace access during business hours, with extended hours available for active teams. Access levels depend on stage of incubation.</span></li>
                    <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">AIRCoDe Lab:</strong> Scheduled access for AI and data science projects. Technical training and consultation provided by lab staff.</span></li>
                    <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">FabLab:</strong> Equipment training required before use. Priority booking for incubatees. Technical support available during operating hours.</span></li>
                    <li class="flex gap-3 items-start"><span class="text-gold text-lg leading-none mt-1">•</span><span><strong class="text-dark/75">SSF & Processing Labs:</strong> Scheduled access for food product development. Safety compliance and training required.</span></li>
                </ul>
                <p class="pt-4 border-t border-dark/[.08] text-[.82rem] text-dark/50"><em>For detailed facility booking, equipment specifications, and usage terms, contact the ASOG TBI Management Office.</em></p>
            </div>
        </div>
    </div>
</div>

            </div><!-- end main content column -->
        </div><!-- end grid -->
    </div><!-- end max-w container -->
</div><!-- end TOC wrapper -->
