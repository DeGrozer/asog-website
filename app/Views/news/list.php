<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  NEWS LIST — Hero latest + grid boxes                              ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1200px] mx-auto relative z-[2]">

    <div id="events" class="scroll-mt-28"></div>
    <div id="features" class="scroll-mt-28"></div>

        <?php if (! empty($latestPost)): ?>
        <!-- ─── LATEST RELEASE — big horizontal hero card ─── -->
        <div class="mb-10 md:mb-14">
            <div class="flex items-center gap-2 mb-5">
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                <span id="latest-release" class="text-[.55rem] font-semibold tracking-[.18em] uppercase text-gold scroll-mt-28">Latest Release</span>
            </div>

            <a href="<?= site_url('news/' . $latestPost['slug']) ?>"
               class="group no-underline block rounded-lg border border-dark/[.06] bg-white shadow-sm shadow-dark/[.04] overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-dark/[.10] hover:-translate-y-0.5">
                <div class="grid grid-cols-1 lg:grid-cols-[1.15fr_1fr]">
                    <!-- Image -->
                    <div class="h-[240px] lg:h-full min-h-[280px] bg-[#e9e6e1] overflow-hidden">
                        <?php if (! empty($latestPost['imagePath'])): ?>
                            <img src="<?= site_url($latestPost['imagePath']) ?>"
                                 alt="<?= esc($latestPost['title']) ?>"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"/>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="text-[.6rem] font-semibold tracking-[.2em] uppercase text-dark/15">Cover Image</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="p-7 md:p-10 lg:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-[.52rem] font-semibold tracking-[.16em] uppercase text-gold"><?= esc(ucfirst($latestPost['category'])) ?></span>
                            <?php if ($latestPost['publishedAt']): ?>
                                <span class="text-[.52rem] text-dark/20">·</span>
                                <span class="text-[.52rem] font-medium tracking-[.06em] text-dark/30"><?= date('F j, Y', strtotime($latestPost['publishedAt'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <h2 class="font-display text-[1.4rem] md:text-[1.7rem] lg:text-[2rem] leading-[1.15] text-dark mb-4 transition-colors duration-200 group-hover:text-navy"><?= esc($latestPost['title']) ?></h2>
                        <?php if (! empty($latestPost['shortDescription'])): ?>
                            <p class="text-[.88rem] font-light leading-[1.8] text-dark/45 mb-6 text-justify"><?= esc(character_limiter($latestPost['shortDescription'], 200)) ?></p>
                        <?php endif; ?>
                        <?php if (! empty($latestPost['authorName'])): ?>
                            <span class="text-[.7rem] font-medium text-dark/30 mb-5">By <?= esc($latestPost['authorName']) ?></span>
                        <?php endif; ?>
                        <span class="inline-flex items-center gap-1.5 text-[.62rem] font-bold tracking-[.12em] uppercase text-gold transition-all duration-200 group-hover:gap-3">
                            Read Article <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>

        <?php if (! empty($posts)): ?>
        <!-- ─── MORE NEWS — box grid ─── -->
        <div>
            <div class="flex items-center gap-2 mb-6">
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                <span id="more-articles" class="text-[.55rem] font-semibold tracking-[.18em] uppercase text-navy scroll-mt-28">More Articles</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                <?php foreach ($posts as $post): ?>
                <a href="<?= site_url('news/' . $post['slug']) ?>"
                   class="group no-underline block rounded-lg border border-dark/[.06] bg-white shadow-sm shadow-dark/[.04] overflow-hidden transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08] hover:-translate-y-1">
                    <!-- Thumbnail -->
                    <div class="h-[170px] bg-[#e9e6e1] overflow-hidden">
                        <?php if (! empty($post['imagePath'])): ?>
                            <img src="<?= site_url($post['imagePath']) ?>" alt="<?= esc($post['title']) ?>"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Body -->
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-[.48rem] font-semibold tracking-[.14em] uppercase text-gold"><?= esc(ucfirst($post['category'])) ?></span>
                            <?php if ($post['publishedAt']): ?>
                                <span class="text-[.48rem] text-dark/15">·</span>
                                <span class="text-[.48rem] font-medium text-dark/25"><?= date('M j, Y', strtotime($post['publishedAt'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-display text-[.98rem] md:text-[1.02rem] text-dark leading-snug mb-2 transition-colors duration-200 group-hover:text-gold"><?= esc($post['title']) ?></h3>
                        <?php if (! empty($post['shortDescription'])): ?>
                            <p class="text-[.76rem] font-light leading-[1.7] text-dark/40 text-justify"><?= esc(character_limiter($post['shortDescription'], 90)) ?></p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (empty($latestPost) && empty($posts)): ?>
        <!-- ─── EMPTY STATE ─── -->
        <div class="text-center py-20">
            <div class="w-16 h-16 mx-auto rounded-full border border-dark/[.08] flex items-center justify-center mb-5">
                <svg class="w-6 h-6 text-dark/15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                </svg>
            </div>
            <h3 class="font-display text-lg text-dark/40 mb-2">No Articles Yet</h3>
            <p class="text-[.82rem] text-dark/25 font-light">News and insights will appear here once published through the admin panel.</p>
        </div>
        <?php endif; ?>

    </div><!-- end max-w -->
</section>
