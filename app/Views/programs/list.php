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
                        ]],
                        ['id' => 'faculty-partners', 'label' => 'Faculty & Industry Partners', 'children' => [
                            ['id' => 'faculty-mentors', 'label' => 'Faculty Mentors'],
                            ['id' => 'industry-partners', 'label' => 'Industry Partners'],
                        ]],
                    ];
                ?>
                <?= view('templates/toc', compact('tocTitle', 'tocItems')) ?>
            </div>

            <!-- ── Main Content Column ── -->
            <div class="min-w-0">

                <!-- ╔════════════════════════════════════════════════════════════════════╗
     ║  SECTION 1: ALTITUDE PROGRAM                                      ║
     ╚════════════════════════════════════════════════════════════════════╝ -->
                <section class="relative py-20 md:py-25">

                    <div id="altitude-program" class="scroll-mt-28"></div>

                    <div class="max-w-[760px] mx-auto relative z-[2]">
                        <!-- Hero text -->
                        <div class="text-center mb-14">
                            <div class="flex items-center justify-center gap-2 mb-4">
                                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                                <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-gold">Six-Month
                                    Incubation</span>
                                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                            </div>
                            <h1 class="font-display text-[2rem] md:text-[2.8rem] leading-[1.12] text-dark mb-6">ALTITUDE
                                Program</h1>
                            <p class="text-[.95rem] font-light leading-[1.8] text-dark/50 italic">Advancing Local
                                Technology and Innovation through Transformative Upskilling, Development, and
                                Entrepreneurship</p>
                        </div>

                        <!-- ── 3D Explore Card (horizontal) ── -->
                        <div id="altitude-3d" class="scroll-mt-28 mb-14">
                            <div id="altitudeExploreCard" class="alt3d-card" role="button" tabindex="0"
                                aria-label="Open interactive 3D view">
                                <div class="alt3d-card-preview">
                                    <svg class="alt3d-card-svg" viewBox="0 0 220 180" fill="none">
                                        <rect width="220" height="180" fill="#87ceeb" rx="6" />
                                        <!-- Clouds -->
                                        <ellipse cx="40" cy="28" rx="18" ry="8" fill="#fff" opacity=".8" />
                                        <ellipse cx="50" cy="26" rx="12" ry="7" fill="#fff" opacity=".8" />
                                        <ellipse cx="185" cy="22" rx="15" ry="7" fill="#fff" opacity=".8" />
                                        <ellipse cx="175" cy="20" rx="10" ry="6" fill="#fff" opacity=".8" />
                                        <!-- Dirt rim / base plate -->
                                        <ellipse cx="110" cy="155" rx="95" ry="18" fill="#c4a46c" />
                                        <ellipse cx="110" cy="153" rx="92" ry="16" fill="#3d7a28" />
                                        <!-- Green rolling hills -->
                                        <ellipse cx="108" cy="132" rx="78" ry="38" fill="#5a9e3e" />
                                        <ellipse cx="85" cy="135" rx="40" ry="22" fill="#4a8c2a" opacity=".5" />
                                        <!-- Pointed grassy peaks -->
                                        <path d="M102 40 L85 128 Q110 132 135 128 Z" fill="#5a9e3e" />
                                        <path d="M55 68 L42 132 Q55 136 72 132 Z" fill="#3d7a28" />
                                        <path d="M160 76 L148 134 Q160 138 175 134 Z" fill="#3d7a28" />
                                        <path d="M72 80 L62 130 Q72 134 82 130 Z" fill="#4a8c2a" />
                                        <!-- Rocky highlights near peaks -->
                                        <circle cx="100" cy="52" r="3" fill="#8a8070" opacity=".6" />
                                        <circle cx="56" cy="75" r="2.5" fill="#6e655a" opacity=".6" />
                                        <circle cx="158" cy="82" r="2" fill="#8a8070" opacity=".5" />
                                        <!-- Dirt trail winding up -->
                                        <path
                                            d="M155 145 C140 135, 130 125, 120 118 S95 108, 80 100 S60 88, 58 80 S85 60, 102 42"
                                            stroke="#c4a46c" stroke-width="2.5" fill="none" stroke-linecap="round"
                                            opacity=".7" />
                                        <!-- Trees -->
                                        <g transform="translate(78,116) scale(.6)">
                                            <rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1" />
                                            <polygon points="0,-8 5,1 -5,1" fill="#2d6b1a" />
                                            <polygon points="0,-5 4,0 -4,0" fill="#4a8c2a" />
                                            <polygon points="0,-3 3,1 -3,1" fill="#60a836" />
                                        </g>
                                        <g transform="translate(128,114) scale(.55)">
                                            <rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1" />
                                            <polygon points="0,-8 5,1 -5,1" fill="#2d6b1a" />
                                            <polygon points="0,-5 4,0 -4,0" fill="#4a8c2a" />
                                        </g>
                                        <g transform="translate(95,108) scale(.5)">
                                            <rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1" />
                                            <polygon points="0,-8 5,1 -5,1" fill="#4a8c2a" />
                                            <polygon points="0,-5 4,0 -4,0" fill="#60a836" />
                                        </g>
                                        <g transform="translate(145,122) scale(.45)">
                                            <rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1" />
                                            <polygon points="0,-8 5,1 -5,1" fill="#2d6b1a" />
                                            <polygon points="0,-5 4,0 -4,0" fill="#4a8c2a" />
                                        </g>
                                        <g transform="translate(65,120) scale(.5)">
                                            <rect x="-1.5" y="0" width="3" height="6" fill="#6b4226" rx="1" />
                                            <polygon points="0,-8 5,1 -5,1" fill="#2d6b1a" />
                                            <polygon points="0,-5 4,0 -4,0" fill="#60a836" />
                                        </g>
                                        <!-- Flowers -->
                                        <circle cx="88" cy="125" r="1.5" fill="#f7d75a" />
                                        <circle cx="118" cy="122" r="1.5" fill="#e86040" />
                                        <circle cx="135" cy="128" r="1.5" fill="#d05aba" />
                                        <!-- Red flags along trail -->
                                        <line x1="82" y1="102" x2="82" y2="92" stroke="#6b4226" stroke-width="1.2"
                                            stroke-linecap="round" />
                                        <polygon points="82,92 90,94 82,97" fill="#e85040" />
                                        <line x1="118" y1="118" x2="118" y2="108" stroke="#6b4226" stroke-width="1.2"
                                            stroke-linecap="round" />
                                        <polygon points="118,108 126,110 118,113" fill="#e85040" />
                                        <!-- Gold flag on summit -->
                                        <line x1="102" y1="42" x2="102" y2="26" stroke="#6b4226" stroke-width="1.5"
                                            stroke-linecap="round" />
                                        <polygon points="102,26 113,29 102,33" fill="#F8AF21" />
                                        <!-- Hero hiker near trailhead -->
                                        <g transform="translate(148,138) scale(.7)">
                                            <rect x="-3" y="-12" width="6" height="10" fill="#2a7a4a" rx="2" />
                                            <circle cx="0" cy="-15" r="3" fill="#f0c8a0" />
                                            <ellipse cx="0" cy="-18" rx="5" ry="2" fill="#5a3a1a" />
                                            <rect x="-1.5" y="-2" width="3" height="5" fill="#4a4035" />
                                            <rect x="1" y="-10" width="4" height="6" fill="#b85530" rx="1" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="alt3d-card-body">
                                    <span class="alt3d-card-tag">Interactive 3D</span>
                                    <h3 class="alt3d-card-title">The Journey to Summit</h3>
                                    <p class="alt3d-card-sub">Follow a hiker through each stage of the ALTITUDE program
                                        on an interactive grassland mountain.</p>
                                    <span class="alt3d-card-cta">
                                        Explore
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M7 17 17 7" />
                                            <path d="M7 7h10v10" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Main content -->
                        <div class="prose-content text-[.9rem] font-normal leading-[1.7] space-y-6"
                            style="color:#020d18">

                            <!-- Intro -->
                            <div>
                                <h2 class="font-display text-[1.8rem] leading-[1.18] text-dark mb-6">The Official
                                    Incubation Program of ASOG TBI</h2>
                                <p class="mb-4">ALTITUDE — <strong class="text-dark/75">Advancing Local Technology and
                                        Innovation through Transformative Upskilling, Development, and
                                        Entrepreneurship</strong> — is the official incubation program of the ASOG
                                    Technology Business Incubator.</p>
                                <p class="mb-4">The program supports early-stage startups by providing structured
                                    guidance, mentorship, and resources that help transform innovative ideas into viable
                                    ventures.</p>
                                <p class="mb-4">ALTITUDE follows a staged incubation approach designed to guide startups
                                    from idea development to scaling. Each stage focuses on specific milestones that
                                    help founders refine their technology, validate market demand, and prepare for
                                    sustainable growth.</p>
                                <p>The program begins with an <strong class="text-dark/75">Awareness Caravan</strong>,
                                    which identifies potential startups and introduces innovators to the opportunities
                                    within ASOG TBI. Selected teams then proceed to the formal incubation stages.</p>
                            </div>

                            <!-- Trailhead -->
                            <div class="pt-2 border-t" style="border-color:rgba(2,13,24,.06)">
                                <h3 id="trailhead" class="font-display text-[1.2rem] text-dark mb-2 scroll-mt-28">
                                    <strong>Trailhead</strong><span class="text-[.78rem] font-normal ml-2"
                                        style="color:rgba(2,13,24,.45)">Pre-Incubation &middot; Month 1</span>
                                </h3>
                                <p class="text-[.62rem] font-bold tracking-[.12em] uppercase mb-3"
                                    style="color:#e8a900">Problem-Solution Fit and Ideation</p>
                                <p class="mb-4">The Trailhead stage focuses on refining the startup concept and
                                    validating whether the identified problem is worth solving. Founders work closely
                                    with mentors and industry validators to ensure that their proposed solution
                                    addresses real market needs within the food and agri-tech value chain.</p>
                                <ul class="space-y-1 list-none pl-0">
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Clarifying the
                                            target problem and user segment</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Validating the
                                            startup's problem-solution fit</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Refining the
                                            initial concept through expert feedback</span></li>
                                </ul>
                            </div>

                            <!-- Basecamp -->
                            <div class="pt-2 border-t" style="border-color:rgba(2,13,24,.06)">
                                <h3 id="basecamp" class="font-display text-[1.2rem] text-dark mb-2 scroll-mt-28">
                                    <strong>Basecamp</strong><span class="text-[.78rem] font-normal ml-2"
                                        style="color:rgba(2,13,24,.45)">Incubation &middot; Months 2&ndash;4</span>
                                </h3>
                                <p class="text-[.62rem] font-bold tracking-[.12em] uppercase mb-3"
                                    style="color:#e8a900">Product Development, Business Modeling, and Market Readiness
                                </p>
                                <p class="mb-4">During the Basecamp stage, startups begin building and testing their
                                    solutions. Founders develop minimum viable products (MVPs), validate product
                                    features with early adopters, and shape both the technical and business foundations
                                    of the venture.</p>
                                <ul class="space-y-1 list-none pl-0">
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Building and
                                            testing MVP prototypes</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Developing the
                                            startup's business model</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Preparing for
                                            market entry and early partnerships</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Planning
                                            customer acquisition strategies within the agri and food ecosystem</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Ascent -->
                            <div class="pt-2 border-t" style="border-color:rgba(2,13,24,.06)">
                                <h3 id="ascent" class="font-display text-[1.2rem] text-dark mb-2 scroll-mt-28">
                                    <strong>Ascent</strong><span class="text-[.78rem] font-normal ml-2"
                                        style="color:rgba(2,13,24,.45)">Post-Validation &middot; Months 5&ndash;6</span>
                                </h3>
                                <p class="text-[.62rem] font-bold tracking-[.12em] uppercase mb-3"
                                    style="color:#e8a900">Fundraising and Investor Readiness</p>
                                <p class="mb-4">At this stage, startups prepare for investment and funding
                                    opportunities. Teams develop the documentation and presentation materials necessary
                                    to approach investors, grant providers, and funding institutions.</p>
                                <ul class="space-y-1 list-none pl-0">
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Developing
                                            investor-ready pitch decks</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Preparing
                                            funding proposals and business documentation</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Connecting with
                                            potential agri investors and angel networks</span></li>
                                </ul>
                            </div>

                            <!-- Summit Launch -->
                            <div class="pt-2 border-t" style="border-color:rgba(2,13,24,.06)">
                                <h3 id="summit-launch" class="font-display text-[1.2rem] text-dark mb-2 scroll-mt-28">
                                    <strong>Summit Launch</strong><span class="text-[.78rem] font-normal ml-2"
                                        style="color:rgba(2,13,24,.45)">Post-Incubation</span>
                                </h3>
                                <p class="text-[.62rem] font-bold tracking-[.12em] uppercase mb-3"
                                    style="color:#e8a900">Scaling Strategy and Post-Program Support</p>
                                <p class="mb-4">The Summit Launch stage supports startups as they transition from early
                                    validation to long-term growth. Startups receive continued strategic support as they
                                    scale operations and expand partnerships.</p>
                                <ul class="space-y-1 list-none pl-0 mb-5">
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Developing
                                            long-term scaling strategies</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Strengthening
                                            partnerships and market networks</span></li>
                                    <li class="flex gap-3"><span
                                            style="color:#F8AF21;margin-top:.15rem">&mdash;</span><span>Connecting with
                                            venture builders and ecosystem partners</span></li>
                                </ul>
                                <blockquote class="border-l-[3px] border-gold pl-4 mt-2">
                                    <p class="text-[.88rem] italic leading-[1.7]" style="color:#020d18">Through the
                                        ALTITUDE Program, ASOG TBI gives startups a clear pathway from idea to impact.
                                    </p>
                                </blockquote>
                            </div>

                        </div>
                    </div>

                </section>

                <!-- ╔════════════════════════════════════════════════════════════════════╗
     ║  SECTION 2: FACULTY & INDUSTRY PARTNERS                          ║
     ╚════════════════════════════════════════════════════════════════════╝ -->
                <section class="relative pt-2 pb-14 md:pt-10 md:pb-16 border-t" style="border-color:rgba(2,13,24,.07)">

                    <div id="faculty-partners" class="scroll-mt-28"></div>

                    <div class="max-w-[760px] mx-auto">

                        <!-- Section header -->
                        <div class="mb-10">
                            <h2 class="font-display text-[1.8rem] md:text-[2.2rem] leading-[1.12] text-dark mb-5">
                                Faculty &amp; Industry Partners</h2>
                            <blockquote class="border-l-[3px] border-gold pl-5">
                                <p class="text-[.88rem] italic leading-[1.7]" style="color:#020d18">The ALTITUDE Program
                                    is strengthened by a network of academic mentors and industry partners who bring
                                    domain expertise, industry connections, and ecosystem access to every incubation
                                    journey.</p>
                            </blockquote>
                        </div>

                        <div class="grid grid-cols-1 gap-y-8">

                            <!-- Faculty Mentors -->
                            <div>
                                <div id="faculty-mentors" class="scroll-mt-28"></div>
                                <p class="text-[.5rem] font-bold tracking-[.2em] uppercase mb-6"
                                    style="color:rgba(2,13,24,.3)">Faculty Mentors</p>
                                <ul class="list-none pl-0 space-y-3">
                                    <li class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 text-[.6rem] font-bold tracking-wide"
                                            style="background:#03355a;color:#fff">MS</div>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">Dr. Maria Santos</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Technology Innovation</span>
                                        </div>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 text-[.6rem] font-bold tracking-wide"
                                            style="background:#03355a;color:#fff">JC</div>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">Prof. Juan dela Cruz</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Business Strategy</span>
                                        </div>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 text-[.6rem] font-bold tracking-wide"
                                            style="background:#03355a;color:#fff">AR</div>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">Engr. Anna Reyes</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Product Development</span>
                                        </div>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 text-[.6rem] font-bold tracking-wide"
                                            style="background:#03355a;color:#fff">CM</div>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">Dr. Carlos Mendoza</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Agri-Tech Research</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Industry Partners -->
                            <div>
                                <div id="industry-partners" class="scroll-mt-28"></div>
                                <p class="text-[.5rem] font-bold tracking-[.2em] uppercase mb-6"
                                    style="color:rgba(2,13,24,.3)">Industry Partners</p>
                                <ul class="list-none pl-0 divide-y" style="border-color:rgba(2,13,24,.07)">
                                    <li class="flex items-start gap-3 py-2.5">
                                        <span class="w-[5px] h-[5px] rounded-full mt-[.45rem] shrink-0 block"
                                            style="background:#F8AF21"></span>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">Agrilink Philippines</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Agri Supply Chain</span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3 py-2.5">
                                        <span class="w-[5px] h-[5px] rounded-full mt-[.45rem] shrink-0 block"
                                            style="background:#F8AF21"></span>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">FoodTech Asia</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Food Innovation</span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3 py-2.5">
                                        <span class="w-[5px] h-[5px] rounded-full mt-[.45rem] shrink-0 block"
                                            style="background:#F8AF21"></span>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">InnoHub PH</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Startup Ecosystem</span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3 py-2.5">
                                        <span class="w-[5px] h-[5px] rounded-full mt-[.45rem] shrink-0 block"
                                            style="background:#F8AF21"></span>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">DOST-TAPI</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Technology Commercialization</span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3 py-2.5">
                                        <span class="w-[5px] h-[5px] rounded-full mt-[.45rem] shrink-0 block"
                                            style="background:#F8AF21"></span>
                                        <div>
                                            <span class="block text-[.88rem] font-semibold leading-none"
                                                style="color:#020d18">GoNegosyo Network</span>
                                            <span class="block text-[.5rem] tracking-[.1em] uppercase mt-1"
                                                style="color:rgba(2,13,24,.35)">Entrepreneurship Support</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </section>

            </div><!-- end main content column -->
        </div><!-- end grid -->
    </div><!-- end max-w container -->
</div><!-- end TOC wrapper -->

<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  ALTITUDE 3D — Wilderness Zoom Overlay + Fullscreen 3D Scene      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<link rel="stylesheet" href="<?= base_url('assets/css/altitude3d.css') ?>">

<!-- Phase 1: Wilderness Zoom Transition Overlay -->
<div id="alt3dZoomOverlay" class="alt3d-zoom-overlay">
    <div class="alt3d-zoom-mountains">
        <svg viewBox="0 0 1440 800" preserveAspectRatio="none">
            <path id="alt3dMtnFar" class="alt3d-mtn-far"
                d="M0 800 L200 400 L360 520 L540 280 L720 450 L900 200 L1100 380 L1300 180 L1440 350 L1440 800Z" />
            <path id="alt3dMtnMid" class="alt3d-mtn-mid"
                d="M0 800 L140 480 L300 560 L480 320 L660 500 L840 260 L1020 420 L1200 220 L1380 380 L1440 440 L1440 800Z" />
            <path id="alt3dMtnNear" class="alt3d-mtn-near"
                d="M0 800 L100 560 L260 620 L400 440 L560 580 L720 380 L880 520 L1060 340 L1240 480 L1440 520 L1440 800Z" />
        </svg>
    </div>
    <div id="alt3dZoomText" class="alt3d-zoom-text" style="opacity:0; transform:translateY(20px);">
        <p class="zt-eyebrow">ASOG-TBI · The ALTITUDE Program</p>
        <h2 class="zt-title">The Journey to Summit</h2>
    </div>
</div>

<!-- Phase 2: Fullscreen 3D Scene Overlay -->
<div id="alt3dOverlay" class="alt3d-overlay">
    <canvas id="alt3dCanvas"></canvas>

    <!-- Close button -->
    <button id="alt3dClose" class="alt3d-close" aria-label="Close 3D view">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
        </svg>
    </button>

    <!-- Title -->
    <div class="alt3d-title">
        <p class="at-eyebrow">ASOG-TBI · The ALTITUDE Program</p>
        <h1>The Journey to Summit</h1>
        <p class="at-sub">Click a flag to explore each stage</p>
    </div>

    <!-- Flag labels container -->
    <div id="alt3dLabels" class="alt3d-labels"></div>

    <!-- Info card -->
    <div id="alt3dInfo" class="alt3d-info">
        <div class="ci-num" id="ciNum"></div>
        <div class="ci-name" id="ciName"></div>
        <div class="ci-phase" id="ciPhase"></div>
        <div class="ci-dur" id="ciDur"></div>
        <div class="ci-desc" id="ciDesc"></div>
        <div class="ci-nav">
            <button class="ci-btn-main" id="ciBtnPrev">&larr; Prev</button>
            <button class="ci-btn-main" id="ciBtnNext">Next &rarr;</button>
            <button class="ci-btn-close" id="ciBtnOverview">&times; Overview</button>
        </div>
    </div>

    <!-- Progress dots -->
    <div id="alt3dDots" class="alt3d-dots">
        <button class="alt3d-dot" data-i="0"></button>
        <button class="alt3d-dot" data-i="1"></button>
        <button class="alt3d-dot" data-i="2"></button>
        <button class="alt3d-dot" data-i="3"></button>
    </div>

    <!-- Hint -->
    <p id="alt3dHint" class="alt3d-hint">Click a flag to explore · Drag to orbit</p>
</div>

<!-- Three.js + Altitude 3D Module -->
<script type="importmap">
    {"imports":{"three":"https://cdn.jsdelivr.net/npm/three@0.170.0/build/three.module.js","three/addons/":"https://cdn.jsdelivr.net/npm/three@0.170.0/examples/jsm/"}}
</script>
<script type="module" src="<?= base_url('assets/js/altitude3d.js') ?>"></script>