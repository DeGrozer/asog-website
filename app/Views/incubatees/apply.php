<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  BE AN INCUBATEE — TOC sidebar + Apply Page                       ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr] gap-8 lg:gap-12">

            <!-- ── TOC Sidebar ── -->
            <?php
                $tocTitle = 'Be an Incubatee';
                $tocItems = [
                    ['id' => 'who-can-apply', 'label' => 'Who Can Apply'],
                    ['id' => 'application-guidelines', 'label' => 'Application Guidelines'],
                    ['id' => 'application-form', 'label' => 'Application Form'],
                    ['id' => 'faqs', 'label' => 'FAQs'],
                ];
            ?>
            <?= view('partials/toc', compact('tocTitle', 'tocItems')) ?>

            <!-- ── Main Content ── -->
            <div class="min-w-0">
                <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_.9fr] gap-10 lg:gap-14">
                    <!-- Left column: details -->
                    <div class="space-y-12">
                        <!-- Who Can Apply -->
                        <div>
                            <h3 id="who-can-apply" class="font-display text-[1.5rem] text-dark mb-4 scroll-mt-28">Who Can Apply</h3>
                            <p class="text-[.9rem] font-light leading-[1.85] text-dark/55 mb-4">We welcome innovators working on engineering and AI-based solutions for food value chain management, including:</p>
                            <ul class="space-y-2 list-none pl-0 text-[.85rem] text-dark/50">
                                <li class="flex gap-2 items-start"><span class="text-gold text-lg leading-none mt-0.5">•</span><span>Startups and MSMEs building scalable solutions</span></li>
                                <li class="flex gap-2 items-start"><span class="text-gold text-lg leading-none mt-0.5">•</span><span>Student and faculty-led innovation teams</span></li>
                                <li class="flex gap-2 items-start"><span class="text-gold text-lg leading-none mt-0.5">•</span><span>Researchers with prototypes ready for validation</span></li>
                                <li class="flex gap-2 items-start"><span class="text-gold text-lg leading-none mt-0.5">•</span><span>Early-stage founders seeking mentorship and market access</span></li>
                            </ul>
                        </div>

                        <!-- Application Guidelines -->
                        <div>
                            <h3 id="application-guidelines" class="font-display text-[1.5rem] text-dark mb-4 scroll-mt-28">Application Guidelines</h3>
                            <ol class="space-y-3 list-decimal pl-5 text-[.85rem] text-dark/55">
                                <li>Prepare a short overview of your solution, target users, and problem statement.</li>
                                <li>Provide proof of concept or prototype (if available), and your development roadmap.</li>
                                <li>Include your team profile, roles, and relevant expertise.</li>
                                <li>Describe your current traction, partnerships, or early validation.</li>
                                <li>Submit the application form and wait for confirmation from the ASOG TBI team.</li>
                            </ol>
                            <p class="text-[.8rem] text-dark/45 mt-4">Shortlisted teams will be invited for a screening interview and pitch session.</p>
                        </div>

                        <!-- FAQs -->
                        <div>
                            <h3 id="faqs" class="font-display text-[1.5rem] text-dark mb-4 scroll-mt-28">FAQs</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-[.85rem] font-semibold text-dark/70">How long is the incubation program?</h4>
                                    <p class="text-[.82rem] text-dark/55 mt-1">ALTITUDE runs for six months, with continued post-incubation support.</p>
                                </div>
                                <div>
                                    <h4 class="text-[.85rem] font-semibold text-dark/70">Is there a fee to join?</h4>
                                    <p class="text-[.82rem] text-dark/55 mt-1">No application fee. Facility usage may have scheduled access policies depending on needs.</p>
                                </div>
                                <div>
                                    <h4 class="text-[.85rem] font-semibold text-dark/70">Can teams apply without a prototype?</h4>
                                    <p class="text-[.82rem] text-dark/55 mt-1">Yes. Early-stage ideas are welcome if the problem and market need are clearly defined.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right column: form -->
                    <div class="rounded-lg border border-dark/[.08] bg-white p-6 md:p-8 h-fit lg:sticky lg:top-28">
                        <h3 id="application-form" class="font-display text-[1.4rem] text-dark mb-4 scroll-mt-28">Application Form</h3>
                        <p class="text-[.8rem] text-dark/50 mb-6">Complete the form below and we will contact you with next steps.</p>
                        <form class="space-y-4" action="#" method="post">
                            <div>
                                <label class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/60 block mb-2">Team/Startup Name</label>
                                <input type="text" name="team_name" class="w-full bg-off border border-dark/[.2] rounded-sm px-4 py-3 text-[.85rem] text-dark font-light outline-none transition-colors duration-200 focus:border-gold/50" placeholder="Your team or startup name" required>
                            </div>
                            <div>
                                <label class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/60 block mb-2">Primary Contact Email</label>
                                <input type="email" name="email" class="w-full bg-off border border-dark/[.2] rounded-sm px-4 py-3 text-[.85rem] text-dark font-light outline-none transition-colors duration-200 focus:border-gold/50" placeholder="you@email.com" required>
                            </div>
                            <div>
                                <label class="text-[.54rem] font-bold tracking-[.16em] uppercase text-dark/60 block mb-2">Brief Description</label>
                                <textarea rows="4" name="description" class="w-full bg-off border border-dark/[.2] rounded-sm px-4 py-3 text-[.85rem] text-dark font-light outline-none resize-none transition-colors duration-200 focus:border-gold/50" placeholder="Describe your solution and target users" required></textarea>
                            </div>
                            <button type="submit" class="font-body text-[.65rem] font-bold tracking-[.14em] uppercase text-dark bg-gold px-6 py-3 rounded-sm border-none cursor-pointer transition-all duration-200 hover:bg-gold-dk">Submit Application</button>
                            <p class="text-[.7rem] text-dark/40">After submitting, the ASOG TBI team will reach out to schedule screening and next steps.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
