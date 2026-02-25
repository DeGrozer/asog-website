<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: NEWS & INSIGHTS                                          ║
     ║  Light bg · Dynamic 3-column news cards from database              ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section id="news" class="relative overflow-hidden bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>
    <div class="ai-cross hidden lg:block" style="top:24%;left:34%"></div>
    <div class="ai-cross hidden lg:block" style="bottom:16%;right:20%"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">
        <!-- Header row -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-4 mb-10 md:mb-12 reveal">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy">Latest Updates</span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-dark">News &amp; <em
                        class="italic text-gold">Insights</em></h2>
            </div>
            <a href="<?= site_url('news') ?>"
                class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-dark/30 no-underline border-b border-dark/[.15] pb-0.5 transition-colors duration-200 hover:text-gold hover:border-gold shrink-0">View
                All News</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-group">
            <?php if (! empty($latestPosts)): ?>
                <?php foreach ($latestPosts as $post): ?>
                    <a href="<?= site_url('news/' . $post['slug']) ?>"
                        class="rc group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                        <div class="h-[180px] bg-[#e9e6e1] flex items-center justify-center overflow-hidden">
                            <?php if (! empty($post['imagePath'])): ?>
                                <img src="<?= site_url($post['imagePath']) ?>" alt="<?= esc($post['title']) ?>"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
                            <?php else: ?>
                                <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-5 md:p-6">
                            <span class="text-[.5rem] font-semibold tracking-[.16em] uppercase text-gold mb-2 block">
                                <?= $post['publishedAt'] ? date('F Y', strtotime($post['publishedAt'])) : esc(ucfirst($post['category'])) ?>
                            </span>
                            <h3 class="font-display text-[1.05rem] text-dark mb-2 leading-snug"><?= esc($post['title']) ?></h3>
                            <?php if (! empty($post['shortDescription'])): ?>
                                <p class="text-[.78rem] font-light leading-[1.7] text-dark/40"><?= esc(character_limiter($post['shortDescription'], 100)) ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback static cards when no posts exist -->
                <a href="#"
                    class="rc group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                    <div class="h-[180px] bg-[#e9e6e1] flex items-center justify-center">
                        <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                    </div>
                    <div class="p-5 md:p-6">
                        <span class="text-[.5rem] font-semibold tracking-[.16em] uppercase text-gold mb-2 block">Coming Soon</span>
                        <h3 class="font-display text-[1.05rem] text-dark mb-2 leading-snug">Stay Tuned for Updates</h3>
                        <p class="text-[.78rem] font-light leading-[1.7] text-dark/40">News articles and insights will appear here once published through the admin panel.</p>
                    </div>
                </a>
                <a href="#"
                    class="rc group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                    <div class="h-[180px] bg-[#e9e6e1] flex items-center justify-center">
                        <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                    </div>
                    <div class="p-5 md:p-6">
                        <span class="text-[.5rem] font-semibold tracking-[.16em] uppercase text-gold mb-2 block">Events</span>
                        <h3 class="font-display text-[1.05rem] text-dark mb-2 leading-snug">Upcoming Events</h3>
                        <p class="text-[.78rem] font-light leading-[1.7] text-dark/40">Watch this space for upcoming workshops, seminars, and incubation program updates.</p>
                    </div>
                </a>
                <a href="#"
                    class="rc group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                    <div class="h-[180px] bg-[#e9e6e1] flex items-center justify-center">
                        <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                    </div>
                    <div class="p-5 md:p-6">
                        <span class="text-[.5rem] font-semibold tracking-[.16em] uppercase text-gold mb-2 block">Features</span>
                        <h3 class="font-display text-[1.05rem] text-dark mb-2 leading-snug">Feature Stories</h3>
                        <p class="text-[.78rem] font-light leading-[1.7] text-dark/40">In-depth stories about our incubatees, partners, and the innovation ecosystem in Bicol.</p>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
