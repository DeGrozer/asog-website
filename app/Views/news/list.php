<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  NEWS LIST — Editorial layout                                      ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1100px] mx-auto relative z-[2]">

        <!-- Category Filter — funnel + select -->
        <div class="flex items-center gap-4 mb-10">
            <label class="relative flex items-center gap-2 bg-white border rounded-sm pl-3 pr-8 py-2 cursor-pointer transition-colors duration-200 hover:border-dark/25 focus-within:border-dark/30" style="border-color:rgba(2,13,24,.12)">
                <!-- Funnel -->
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:rgba(2,13,24,.28);flex-shrink:0" aria-hidden="true">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <span class="text-[.5rem] font-bold tracking-[.18em] uppercase select-none" style="color:rgba(2,13,24,.28);white-space:nowrap">Filter</span>
                <div class="w-px h-3 shrink-0" style="background:rgba(2,13,24,.08)"></div>
                <select
                    id="newsFilter"
                    onchange="window.location=this.value"
                    class="appearance-none bg-transparent text-[.58rem] font-semibold tracking-[.1em] uppercase focus:outline-none cursor-pointer border-0 min-w-[80px]"
                    style="color:rgba(2,13,24,.7)">
                    <option value="<?= site_url('news') ?>" <?= empty($activeCategory ?? '') ? 'selected' : '' ?>>All Posts</option>
                    <option value="<?= site_url('news?category=news') ?>" <?= ($activeCategory ?? '') === 'news' ? 'selected' : '' ?>>News</option>
                    <option value="<?= site_url('news?category=features') ?>" <?= ($activeCategory ?? '') === 'features' ? 'selected' : '' ?>>Features</option>
                    <option value="<?= site_url('news?category=opinions') ?>" <?= ($activeCategory ?? '') === 'opinions' ? 'selected' : '' ?>>Opinions</option>
                </select>
                <!-- Caret -->
                <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:rgba(2,13,24,.3);pointer-events:none" aria-hidden="true">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </label>
            <?php if (!empty($activeCategory ?? '')): ?>
            <div class="flex items-center gap-2 px-3 py-2 rounded-sm" style="background:rgba(3,53,90,.06)">
                <span class="text-[.56rem] font-semibold tracking-[.1em] uppercase" style="color:#03355a"><?= esc(ucfirst($activeCategory)) ?></span>
                <a href="<?= site_url('news') ?>" class="no-underline transition-colors" style="color:rgba(2,13,24,.3)" title="Clear filter">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </a>
            </div>
            <?php endif; ?>
        </div>

        <?php if (! empty($latestPost)): ?>
        <!-- ─── LATEST RELEASE ─── -->
        <div class="mb-14 md:mb-18">
            <div class="flex items-center gap-2 mb-6">
                <span class="block w-[18px] h-[1.5px] bg-gold"></span>
                <span id="latest-release"
                    class="text-[.55rem] font-semibold tracking-[.18em] uppercase text-gold scroll-mt-28">Latest
                    Release</span>
            </div>

            <a href="<?= site_url('news/' . $latestPost['slug']) ?>"
                class="group no-underline block">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Image -->
                    <div class="aspect-[16/11] lg:aspect-auto lg:h-full bg-[#e5e2dc] overflow-hidden">
                        <?php if (! empty($latestPost['imagePath'])): ?>
                        <img src="<?= site_url($latestPost['imagePath']) ?>" alt="<?= esc($latestPost['title']) ?>"
                            class="w-full h-full object-cover" />
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center min-h-[280px]">
                            <span class="text-[.55rem] font-semibold tracking-[.2em] uppercase text-dark/12">Cover
                                Image</span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="bg-white border-b-2 border-dark/[.06] group-hover:border-dark/20 transition-colors duration-300 p-7 md:p-10 lg:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="text-[.5rem] font-bold tracking-[.18em] uppercase text-navy/40"><?= esc(ucfirst($latestPost['category'])) ?></span>
                            <?php if ($latestPost['publishedAt']): ?>
                            <span class="text-dark/12">·</span>
                            <span
                                class="text-[.5rem] font-medium tracking-[.06em] text-dark/40"><?= date('F j, Y', strtotime($latestPost['publishedAt'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <h2
                            class="font-display text-[1.3rem] md:text-[1.6rem] lg:text-[1.8rem] leading-[1.18] text-dark mb-4">
                            <?= esc($latestPost['title']) ?></h2>
                        <?php if (! empty($latestPost['shortDescription'])): ?>
                        <p class="text-[.9rem] font-light leading-[1.6] mb-3 transition-colors duration-200" style="color:#1a1a1a;">
                            <?= html_entity_decode(esc(character_limiter($latestPost['shortDescription'], 180))) ?></p>
                        <?php endif; ?>
                        <?php if (! empty($latestPost['authorName'])): ?>
                        <span class="text-[.68rem] font-medium text-dark/35 mb-4">By
                            <?= esc($latestPost['authorName']) ?></span>
                        <?php endif; ?>
                        <span
                            class="text-[.56rem] font-bold tracking-[.14em] uppercase text-dark/30 border-b border-dark/10 self-start pb-0.5 group-hover:text-dark/50 group-hover:border-dark/25 transition-colors duration-200">
                            Read Article →
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>

        <?php if (! empty($posts)): ?>
        <!-- ─── MORE ARTICLES ─── -->
        <div>
            <div class="flex items-center gap-2 mb-8">
                <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                <span id="more-articles"
                    class="text-[.55rem] font-semibold tracking-[.18em] uppercase text-navy scroll-mt-28">More
                    Articles</span>
            </div>

            <div class="space-y-0">
                <?php foreach ($posts as $post): ?>
                <a href="<?= site_url('news/' . $post['slug']) ?>"
                    class="group no-underline flex gap-6 py-6 border-t border-dark/[.06] last:border-b last:border-dark/[.06]">
                    <!-- Thumbnail -->
                    <div class="w-[140px] md:w-[180px] h-[100px] md:h-[120px] shrink-0 bg-[#e5e2dc] overflow-hidden hidden sm:block">
                        <?php if (! empty($post['imagePath'])): ?>
                        <img src="<?= site_url($post['imagePath']) ?>" alt="<?= esc($post['title']) ?>"
                            class="w-full h-full object-cover" />
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-[.45rem] font-semibold tracking-[.18em] uppercase text-dark/10">IMG</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Body -->
                    <div class="flex-1 min-w-0 flex flex-col justify-center">
                        <div class="flex items-center gap-2.5 mb-2">
                            <span
                                class="text-[.46rem] font-bold tracking-[.16em] uppercase text-navy/40"><?= esc(ucfirst($post['category'])) ?></span>
                            <?php if ($post['publishedAt']): ?>
                            <span class="text-dark/10">·</span>
                            <span
                                class="text-[.46rem] font-medium text-dark/35"><?= date('M j, Y', strtotime($post['publishedAt'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <h3
                            class="font-display text-[1rem] md:text-[1.08rem] text-dark leading-snug mb-1.5">
                            <?= esc($post['title']) ?></h3>
                        <?php if (! empty($post['shortDescription'])): ?>
                        <p class="text-[.88rem] font-light leading-[1.7] transition-colors duration-200 line-clamp-2" style="color:#1a1a1a;">
                            <?= html_entity_decode(esc(character_limiter($post['shortDescription'], 120))) ?></p>
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
                <svg class="w-6 h-6 text-dark/15" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
            </div>
            <h3 class="font-display text-lg text-dark/40 mb-2">No Articles Yet</h3>
            <p class="text-[.82rem] text-dark/25 font-light">News and insights will appear here once published through
                the admin panel.</p>
        </div>
        <?php endif; ?>

    </div><!-- end max-w -->
</section>