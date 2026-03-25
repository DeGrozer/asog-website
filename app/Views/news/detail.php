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
            <span
                class="text-[.55rem] font-semibold tracking-[.18em] uppercase text-gold"><?= esc(ucfirst($post['category'])) ?></span>
            <?php if ($post['publishedAt']): ?>
            <span class="text-[.55rem] text-dark/25">·</span>
            <span
                class="text-[.55rem] font-medium tracking-[.08em] text-dark/30"><?= date('F j, Y', strtotime($post['publishedAt'])) ?></span>
            <?php endif; ?>
        </div>
        <div data-sdg-numbers="<?= esc($post['sdgNumbers'] ?? '') ?>" style="margin-bottom:1rem"></div>

        <!-- Title -->
        <h1 class="font-display text-[clamp(1.6rem,3vw,2.6rem)] leading-[1.14] text-dark mb-5">
            <?= esc($post['title']) ?></h1>

        <!-- Author -->
        <?php if (! empty($post['authorName'])): ?>
        <div class="text-[.75rem] font-medium text-dark/35 mb-8">By <?= esc($post['authorName']) ?></div>
        <?php endif; ?>

        <!-- Cover image -->
        <?php if (! empty($post['imagePath'])): ?>
        <div class="rounded-lg overflow-hidden mb-10 border border-dark/[.06]">
            <img src="<?= site_url($post['imagePath']) ?>" alt="<?= esc($post['title']) ?>"
                class="w-full max-h-[440px] object-cover" />
        </div>
        <?php endif; ?>

        <!-- Content (rendered as HTML from Quill) -->
        <div class="prose-content text-[1.05rem] font-normal leading-[1.4] text-justify">
            <?= $post['content'] ?? '' ?>
        </div>

        <?php
            $postCategory = strtolower((string) ($post['category'] ?? ''));
            $showStoryShare = $postCategory !== 'features';
            $shareUrl = current_url();
            $shareTitle = trim((string) ($post['title'] ?? '')) . ' | ASOG-TBI';
            $encodedUrl = rawurlencode($shareUrl);
            $encodedTitle = rawurlencode($shareTitle);
        ?>
        <?php if ($showStoryShare): ?>
        <div class="mt-10 rounded-lg border border-dark/[.08] bg-white p-4 md:p-5">
            <div class="text-[.56rem] font-semibold tracking-[.16em] uppercase text-dark/45 mb-3">Share This Story</div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $encodedUrl ?>" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center rounded-sm border border-dark/[.16] px-3 py-2 text-[.58rem] font-semibold tracking-[.08em] uppercase no-underline text-dark/70 transition-colors hover:text-dark hover:border-dark/35">
                    Facebook
                </a>
                <a href="https://wa.me/?text=<?= $encodedTitle . '%20' . $encodedUrl ?>" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center rounded-sm border border-dark/[.16] px-3 py-2 text-[.58rem] font-semibold tracking-[.08em] uppercase no-underline text-dark/70 transition-colors hover:text-dark hover:border-dark/35">
                    WhatsApp
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $encodedUrl ?>" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center rounded-sm border border-dark/[.16] px-3 py-2 text-[.58rem] font-semibold tracking-[.08em] uppercase no-underline text-dark/70 transition-colors hover:text-dark hover:border-dark/35">
                    LinkedIn
                </a>
                <a href="https://x.com/intent/tweet?url=<?= $encodedUrl ?>&text=<?= $encodedTitle ?>" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center rounded-sm border border-dark/[.16] px-3 py-2 text-[.58rem] font-semibold tracking-[.08em] uppercase no-underline text-dark/70 transition-colors hover:text-dark hover:border-dark/35">
                    X
                </a>
                <button type="button" id="copyStoryLink"
                    class="inline-flex items-center rounded-sm border border-dark/[.16] px-3 py-2 text-[.58rem] font-semibold tracking-[.08em] uppercase text-dark/70 transition-colors hover:text-dark hover:border-dark/35">
                    Copy Link
                </button>
                <button type="button" id="nativeStoryShare"
                    class="inline-flex items-center rounded-sm border border-dark/[.16] px-3 py-2 text-[.58rem] font-semibold tracking-[.08em] uppercase text-dark/70 transition-colors hover:text-dark hover:border-dark/35 hidden">
                    Share
                </button>
            </div>
        </div>
        <?php endif; ?>

        <!-- Divider -->
        <div class="h-px bg-dark/[.08] my-12"></div>

        <!-- Related posts -->
        <?php
            $relatedPosts = array_values(array_filter($latestPosts ?? [], static function ($related) use ($post) {
                return (int) ($related['id'] ?? 0) !== (int) ($post['id'] ?? 0);
            }));
            $relatedPosts = array_slice($relatedPosts, 0, 3);
        ?>
        <?php if (! empty($relatedPosts)): ?>
        <div>
            <h3 class="font-display text-lg text-dark mb-5">More from <em class="italic text-gold">News &amp;
                    Insights</em></h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php foreach ($relatedPosts as $related): ?>
                <a href="<?= site_url('news/' . $related['slug']) ?>"
                    class="group rounded-lg border border-dark/[.06] overflow-hidden no-underline block bg-white shadow-sm shadow-dark/[.04] transition-all duration-300 hover:shadow-md hover:shadow-dark/[.08]">
                    <div class="aspect-square bg-[#e9e6e1] flex items-center justify-center overflow-hidden">
                        <?php if (! empty($related['imagePath'])): ?>
                        <img src="<?= site_url($related['imagePath']) ?>" alt=""
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <?php else: ?>
                        <span class="text-[.5rem] font-semibold tracking-[.2em] uppercase text-dark/15">Image</span>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <span
                            class="text-[.48rem] font-semibold tracking-[.14em] uppercase text-gold block mb-1"><?= esc(ucfirst($related['category'])) ?></span>
                        <h4 class="font-display text-[.88rem] text-dark leading-snug">
                            <?= esc(character_limiter($related['title'], 70)) ?></h4>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php if ($showStoryShare): ?>
<script>
(() => {
    const copyBtn = document.getElementById('copyStoryLink');
    const nativeBtn = document.getElementById('nativeStoryShare');
    const shareUrl = <?= json_encode($shareUrl) ?>;
    const shareTitle = <?= json_encode($shareTitle) ?>;

    if (nativeBtn && navigator.share) {
        nativeBtn.classList.remove('hidden');
        nativeBtn.addEventListener('click', async () => {
            try {
                await navigator.share({ title: shareTitle, url: shareUrl });
            } catch (err) {
                // Ignore cancellation errors from native share sheets.
            }
        });
    }

    if (copyBtn) {
        copyBtn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(shareUrl);
                copyBtn.textContent = 'Copied';
                setTimeout(() => { copyBtn.textContent = 'Copy Link'; }, 1400);
            } catch (err) {
                const temp = document.createElement('textarea');
                temp.value = shareUrl;
                temp.setAttribute('readonly', '');
                temp.style.position = 'absolute';
                temp.style.left = '-9999px';
                document.body.appendChild(temp);
                temp.select();
                document.execCommand('copy');
                document.body.removeChild(temp);
                copyBtn.textContent = 'Copied';
                setTimeout(() => { copyBtn.textContent = 'Copy Link'; }, 1400);
            }
        });
    }
})();
</script>
<?php endif; ?>

<script src="<?= base_url('assets/js/sdgBadges.js') ?>"></script>