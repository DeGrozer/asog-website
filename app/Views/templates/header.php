<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ASOG Technology Business Incubator">
    <title>
        <?= isset($title) ? $title : 'ASOG Technology Business Incubator' ?>
    </title>
    <!-- ================== CSS/JS  ===================== -->
    <link href="<?= base_url('style.css') ?>" rel="stylesheet">
    <script src="<?= base_url('asset/js/header.js') ?>" defer></script>

    <!-- ================== GOOGLE FONTS  ===================== -->
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap"
        rel="stylesheet" />
    <!-- ================== FAVICON  ========================== -->
    <link rel="icon" href="<?= base_url('icon.png') ?>">
</head>

<body class="font-body bg-dark text-off overflow-x-hidden">
    <?php
    $nav = get_nav_urls();
    $navAbout      = $nav['about'];
    $navPrograms   = $nav['programs'];
    $navFacilities = $nav['facilities'];
    $navIncubatees = $nav['incubatees'];
    $navNews       = $nav['news'];
    $navContact    = $nav['contact'];
    $navCta        = $nav['cta'];
    ?>
    <a class="sr-only focus:not-sr-only" href="#main">Skip to content</a>

    <!--
         ╔══════════════════════════════════════════════════════════════╗
         ║  NAVBAR                                                      ║
         ║  Desktop: left / center-logo / right with dropdowns          ║
         ║  Mobile (<lg): logo-left + hamburger menu,                   ║
         ║  slide-out overlay                                           ║
         ╚══════════════════════════════════════════════════════════════╝ 
    -->


    <nav id="navbar" class="fixed top-0 left-0 right-0 z-[500]">
        <div id="navIn" class="flex items-center px-4 lg:px-10 h-20 ">

            <!-- desktop left links -->
            <div class="nav-left absolute left-10 flex items-center gap-1 lg:flex hidden">
                <!-- About Us -->
                <div class="nav-dd group">
                    <a href="<?= $navAbout ?>"
                        class="nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline px-4 border-b-2 border-transparent -mb-0.5 whitespace-nowrap transition-all duration-200 hover:text-off hover:border-gold">About
                        Us</a>
                    <div class="dd-menu" style="min-width:240px">
                        <a href="<?= $navAbout ?>#our-story" class="dd-item">Our Story</a>
                        <a href="<?= $navAbout ?>#why-choose-us" class="dd-item">Why Choose Us?</a>
                        <a href="<?= $navAbout ?>#our-impact" class="dd-item">Our Impact</a>
                        <span class="dd-label">Organization</span>
                        <a href="<?= site_url('organization') ?>#core-team" class="dd-item dd-indent">The Core Team</a>
                        <a href="<?= site_url('organization') ?>#tbi-staff" class="dd-item dd-indent">TBI Staff</a>
                        <span class="dd-label dd-indent">Mentors</span>
                        <a href="<?= site_url('organization') ?>#faculty-mentors" class="dd-item dd-indent">Faculty Mentors</a>
                        <a href="<?= site_url('organization') ?>#industry-mentors" class="dd-item dd-indent">Industry Mentors</a>
                    </div>
                </div>
                <!-- Programs & Services -->
                <div class="nav-dd group">
                    <a href="<?= $navPrograms ?>"
                        class="nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline px-4 border-b-2 border-transparent -mb-0.5 whitespace-nowrap transition-all duration-200 hover:text-off hover:border-gold">Programs
                        &amp; Services</a>
                    <div class="dd-menu" style="min-width:280px">
                        <a href="<?= $navPrograms ?>#altitude-program" class="dd-item">The ALTITUDE Program</a>
                        <a href="<?= $navPrograms ?>#services-offered" class="dd-item">Services Offered</a>
                        <div class="dd-sub">
                            <div class="dd-item dd-sub-trigger">Facilities <span
                                    class="ml-auto text-[.5rem] opacity-40">▸</span></div>
                            <div class="dd-sub-menu">
                                <span class="dd-label">Incubation Center</span>
                                <a href="<?= $navPrograms ?>#co-lab" class="dd-item dd-indent">The Co-Lab (Coworking Space)</a>
                                <a href="<?= $navPrograms ?>#innovators-suite" class="dd-item dd-indent">The Innovators' Suite</a>
                                <span class="dd-label">Partner Facilities</span>
                                <a href="<?= $navPrograms ?>#aircode" class="dd-item dd-indent">AI Research Center for Community Development</a>
                                <a href="<?= $navPrograms ?>#fablab" class="dd-item dd-indent">Fabrication Laboratory</a>
                                <a href="<?= $navPrograms ?>#ssf" class="dd-item dd-indent">Shared Service Facility</a>
                                <a href="<?= $navPrograms ?>#ip-unit" class="dd-item dd-indent">Intellectual Property Management Unit</a>
                                <a href="<?= $navPrograms ?>#usage-policy" class="dd-item">Usage Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Incubatees -->
                <div class="nav-dd group" data-order="3">
                    <a href="<?= $navIncubatees ?>"
                        class="nl nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline px-4 border-b-2 border-transparent -mb-0.5 whitespace-nowrap transition-all duration-200 hover:text-off hover:border-gold">Incubatees</a>
                    <div class="dd-menu dd-right">
                        <a href="<?= $navIncubatees ?>#cohort-1" class="dd-item">Cohort 1</a>
                        <a href="<?= $navContact ?>" class="dd-item">Apply for Cohort 2</a>
                    </div>
                </div>
            </div>

            <!-- CENTER LOGO -->
            <a href="<?= base_url() ?>" id="navLogo" class="flex no-underline">
                <img src="<?= base_url('asset/js/img/ASOG TBI/PNG/ASOG-TBI_seal_white.png') ?>" alt="ASOG TBI"
                    id="navImg" class="w-[80px] h-[80px]" />
                <img src="<?= base_url('asset/js/img/ASOG TBI/PNG/ASOG-TBI_full-colored_landscape.png') ?>"
                    alt="ASOG TBI" id="navImgLandscape" class="object-contain" />
            </a>

            <!-- desktop right links -->
            <div id="navR" class="absolute right-10 lg:flex hidden items-center">
                <!-- News & Insights -->
                <div class="nav-dd group" data-order="4">
                    <a href="<?= $navNews ?>"
                        class="nl nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline px-4 border-b-2 border-transparent -mb-0.5 whitespace-nowrap transition-all duration-200 hover:text-off hover:border-gold">News
                        &amp; Insights</a>
                    <div class="dd-menu dd-right">
                        <a href="<?= $navNews ?>#events" class="dd-item">Events</a>
                        <a href="<?= $navNews ?>#features" class="dd-item">Features &amp; Opinion</a>
                    </div>
                </div>
                <!-- Contact Us -->
                <div class="nav-dd group" data-order="5">
                    <a href="<?= $navContact ?>"
                        class="nl nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline px-4 border-b-2 border-transparent -mb-0.5 whitespace-nowrap transition-all duration-200 hover:text-off hover:border-gold">Contact
                        Us</a>
                    <div class="dd-menu dd-right">
                        <a href="<?= $navContact ?>#contact-details" class="dd-item">Contact Details</a>
                        <a href="<?= $navContact ?>#map" class="dd-item">Map</a>
                    </div>
                </div>
                <!-- CTA Button -->
                <a href="<?= $navCta ?>" data-order="6"
                    class="nav-btn ml-4 font-body text-[.63rem] font-bold tracking-[.13em] uppercase text-dark bg-gold border border-gold px-5 py-2 rounded-sm no-underline whitespace-nowrap shrink-0 transition-colors duration-200 hover:bg-gold-dk">Be
                    an Incubatee</a>

                <!-- COLLAPSED DUPLICATES (appear on scroll via .lo) -->
                <div class="nav-dd group lo" data-order="1">
                    <a href="<?= $navAbout ?>"
                        class="nl nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline items-center border-b-2 border-transparent -mb-0.5 whitespace-nowrap hover:text-off hover:border-gold">About
                        Us</a>
                    <div class="dd-menu dd-right" style="min-width:240px">
                        <a href="<?= $navAbout ?>#our-story" class="dd-item">Our Story</a>
                        <a href="<?= $navAbout ?>#why-choose-us" class="dd-item">Why Choose Us?</a>
                        <a href="<?= $navAbout ?>#our-impact" class="dd-item">Our Impact</a>
                        <span class="dd-label">Organization</span>
                        <a href="<?= site_url('organization') ?>#core-team" class="dd-item dd-indent">The Core Team</a>
                        <a href="<?= site_url('organization') ?>#tbi-staff" class="dd-item dd-indent">TBI Staff</a>
                        <span class="dd-label dd-indent">Mentors</span>
                        <a href="<?= site_url('organization') ?>#faculty-mentors" class="dd-item dd-indent">Faculty Mentors</a>
                        <a href="<?= site_url('organization') ?>#industry-mentors" class="dd-item dd-indent">Industry Mentors</a>
                    </div>
                </div>
                <div class="nav-dd group lo" data-order="2">
                    <a href="<?= $navPrograms ?>"
                        class="nl nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline items-center border-b-2 border-transparent -mb-0.5 whitespace-nowrap hover:text-off hover:border-gold">Programs
                        &amp; Services</a>
                    <div class="dd-menu dd-right" style="min-width:280px">
                        <a href="<?= $navPrograms ?>#altitude-program" class="dd-item">The ALTITUDE Program</a>
                        <a href="<?= $navPrograms ?>#services-offered" class="dd-item">Services Offered</a>
                        <div class="dd-sub">
                            <div class="dd-item dd-sub-trigger">Facilities <span
                                    class="ml-auto text-[.5rem] opacity-40">▸</span></div>
                            <div class="dd-sub-menu">
                                <span class="dd-label">Incubation Center</span>
                                <a href="<?= $navPrograms ?>#co-lab" class="dd-item dd-indent">The Co-Lab (Coworking Space)</a>
                                <a href="<?= $navPrograms ?>#innovators-suite" class="dd-item dd-indent">The Innovators' Suite</a>
                                <span class="dd-label">Partner Facilities</span>
                                <a href="<?= $navPrograms ?>#aircode" class="dd-item dd-indent">AI Research Center for Community Development</a>
                                <a href="<?= $navPrograms ?>#fablab" class="dd-item dd-indent">Fabrication Laboratory</a>
                                <a href="<?= $navPrograms ?>#ssf" class="dd-item dd-indent">Shared Service Facility</a>
                                <a href="<?= $navPrograms ?>#ip-unit" class="dd-item dd-indent">Intellectual Property Management Unit</a>
                                <a href="<?= $navPrograms ?>#usage-policy" class="dd-item">Usage Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-dd group lo" data-order="3">
                    <a href="<?= $navIncubatees ?>"
                        class="nl nav-link text-[.68rem] font-medium tracking-[.09em] uppercase text-white/60 no-underline items-center border-b-2 border-transparent -mb-0.5 whitespace-nowrap hover:text-off hover:border-gold">Incubatees</a>
                    <div class="dd-menu dd-right">
                        <a href="<?= $navIncubatees ?>#cohort-1" class="dd-item">Cohort 1</a>
                        <a href="<?= $navContact ?>" class="dd-item">Apply for Cohort 2</a>
                    </div>
                </div>
            </div>

            <!-- MOBILE HAMBURGER (visible only on <lg) -->
            <button id="menuBtn"
                class="lg:hidden ml-auto relative z-[600] flex flex-col justify-center items-center w-10 h-10 gap-1.5"
                aria-label="Menu">
                <span id="bar1"
                    class="block w-6 h-[2px] bg-white rounded transition-all duration-300 origin-center"></span>
                <span id="bar2" class="block w-6 h-[2px] bg-white rounded transition-all duration-300"></span>
                <span id="bar3"
                    class="block w-6 h-[2px] bg-white rounded transition-all duration-300 origin-center"></span>
            </button>
        </div>
    </nav>

    <!-- MOBILE SLIDE-OUT MENU (visible only on <lg) -->
    <div id="mobileMenu"
        class="fixed inset-0 z-[550] bg-dark/[.97] backdrop-blur-xl flex flex-col pt-24 px-8 pb-10 overflow-y-auto lg:hidden"
        style="transform:translateX(100%);opacity:0;">
        <!-- Close X button -->
        <button id="closeMenuBtn" class="absolute top-6 right-5 z-[600] w-10 h-10 flex items-center justify-center"
            aria-label="Close menu">
            <svg class="w-6 h-6 text-white/60 transition-colors hover:text-gold" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <nav class="flex flex-col gap-0">
            <!-- About Us -->
            <a href="<?= $navAbout ?>"
                class="text-[.8rem] font-medium tracking-[.1em] uppercase text-white/60 no-underline py-3 border-b border-white/[.06] transition-colors hover:text-gold">About Us</a>
            <div class="flex flex-col pl-4 border-b border-white/[.06]">
                <a href="<?= $navAbout ?>#our-story" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Our Story</a>
                <a href="<?= $navAbout ?>#why-choose-us" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Why Choose Us?</a>
                <a href="<?= $navAbout ?>#our-impact" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Our Impact</a>
                <a href="<?= site_url('organization') ?>" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Organization</a>
            </div>
            <!-- Programs & Services -->
            <a href="<?= $navPrograms ?>"
                class="text-[.8rem] font-medium tracking-[.1em] uppercase text-white/60 no-underline py-3 border-b border-white/[.06] transition-colors hover:text-gold">Programs &amp; Services</a>
            <div class="flex flex-col pl-4 border-b border-white/[.06]">
                <a href="<?= $navPrograms ?>#altitude-program" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">The ALTITUDE Program</a>
                <a href="<?= $navPrograms ?>#services-offered" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Services Offered</a>
                <a href="<?= $navPrograms ?>#co-lab" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Facilities</a>
            </div>
            <!-- Incubatees -->
            <a href="<?= $navIncubatees ?>"
                class="text-[.8rem] font-medium tracking-[.1em] uppercase text-white/60 no-underline py-3 border-b border-white/[.06] transition-colors hover:text-gold">Incubatees</a>
            <div class="flex flex-col pl-4 border-b border-white/[.06]">
                <a href="<?= $navIncubatees ?>#cohort-1" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Cohort 1</a>
                <a href="<?= $navContact ?>" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Apply for Cohort 2</a>
            </div>
            <!-- News & Insights -->
            <a href="<?= $navNews ?>"
                class="text-[.8rem] font-medium tracking-[.1em] uppercase text-white/60 no-underline py-3 border-b border-white/[.06] transition-colors hover:text-gold">News &amp; Insights</a>
            <div class="flex flex-col pl-4 border-b border-white/[.06]">
                <a href="<?= $navNews ?>#events" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Events</a>
                <a href="<?= $navNews ?>#features" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Features &amp; Opinion</a>
            </div>
            <!-- Contact Us -->
            <a href="<?= $navContact ?>"
                class="text-[.8rem] font-medium tracking-[.1em] uppercase text-white/60 no-underline py-3 border-b border-white/[.06] transition-colors hover:text-gold">Contact Us</a>
            <div class="flex flex-col pl-4 border-b border-white/[.06]">
                <a href="<?= $navContact ?>#contact-details" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Contact Details</a>
                <a href="<?= $navContact ?>#map" class="text-[.68rem] tracking-[.08em] uppercase text-white/35 no-underline py-2 transition-colors hover:text-gold">Map</a>
            </div>
        </nav>
        <a href="<?= $navCta ?>"
            class="mt-8 text-center font-body text-[.72rem] font-bold tracking-[.14em] uppercase text-dark bg-gold px-8 py-4 rounded-sm no-underline transition-colors hover:bg-gold-dk">Be
            an Incubatee</a>
    </div>