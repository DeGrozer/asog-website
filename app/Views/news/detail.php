<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  NEWS DETAIL — Single post view                                    ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<section class="relative bg-off pt-32 md:pt-40 pb-20 md:pb-28 px-6 md:px-10 lg:px-14">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[720px] mx-auto relative z-[2]">
        <!-- Back link -->
        <a href="<?= site_url('news') ?>"
           class="inline-flex items-center gap-1.5 text-[.65rem] font-semibold tracking-[.1em] uppercase text-dark/30 no-underline mb-8 transition-colors hover:text-gold">
            ← Back to News
        </a>

        <!-- Category + Date -->
        <div class="flex items-center gap-3 mb-4">
            <span class="text-[.55rem] font-semibold tracking-[.18em] uppercase text-gold"><?= esc(ucfirst($post['category'])) ?></span>
            <?php if ($post['publishedAt']): ?>
                <span class="text-[.55rem] text-dark/25">·</span>
                <span class="text-[.55rem] font-medium tracking-[.08em] text-dark/30"><?= date('F j, Y', strtotime($post['publishedAt'])) ?></span>
            <?php endif; ?>
        </div>

        <!-- Title -->
        <h1 class="font-display text-[clamp(1.6rem,3vw,2.6rem)] leading-[1.14] text-dark mb-5"><?= esc($post['title']) ?></h1>

        <!-- Author -->
        <?php if (! empty($post['authorName'])): ?>
            <div class="text-[.75rem] font-medium text-dark/35 mb-8">By <?= esc($post['authorName']) ?></div>
        <?php endif; ?>

        <!-- Cover image -->
        <?php if (! empty($post['imagePath'])): ?>
            <div class="rounded-lg overflow-hidden mb-10 border border-dark/[.06]">
                <img src="<?= site_url($post['imagePath']) ?>"
                     alt="<?= esc($post['title']) ?>"
                     class="w-full max-h-[440px] object-cover"/>
            </div>
        <?php endif; ?>

        <!-- Content (rendered as HTML from Quill) -->
        <div class="prose-content text-[1.05rem] font-normal leading-[1.9] text-dark/70">
            <?= $post['content'] ?? '' ?>
        </div>

        <!-- Divider -->
        <div class="h-px bg-dark/[.08] my-12"></div>

        <!-- Related posts -->
        <?php if (! empty($latestPosts)): ?>
            <div>
                <h3 class="font-display text-lg text-dark mb-5">More from <em class="italic text-gold">News &amp; Insights</em></h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <?php foreach ($latestPosts as $related): ?>
                        <?php if ($related['id'] === $post['id']) continue; ?>
                        <a href="<?= site_url('news/' . $related['slug']) ?>"
                           class="group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                            <div class="h-[120px] bg-[#e9e6e1] flex items-center justify-center overflow-hidden">
                                <?php if (! empty($related['imagePath'])): ?>
                                    <img src="<?= site_url($related['imagePath']) ?>" alt=""
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
                                <?php else: ?>
                                    <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <span class="text-[.48rem] font-semibold tracking-[.14em] uppercase text-gold block mb-1"><?= esc(ucfirst($related['category'])) ?></span>
                                <h4 class="font-display text-[.88rem] text-dark leading-snug"><?= esc(character_limiter($related['title'], 60)) ?></h4>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
