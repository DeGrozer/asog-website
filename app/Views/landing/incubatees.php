<!--
     ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: FEATURED INCUBATEES — Scrolling Logo Carousel            ║
     ║  Off-white bg · auto-scroll logos · brand-partner style            ║
     ╚══════════════════════════════════════════════════════════════════════╝
-->
<?php
$all = $incubatees ?? [];
if (empty($all)) return;
?>
<style>
/* ── Incubatee Logo Carousel ─────────────────────────────── */
@keyframes logo-scroll {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

.inc-carousel {
    position: relative;
    overflow: hidden;
    -webkit-mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
    mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
    padding: 1rem 0;
}

.inc-track {
    display: flex;
    width: max-content;
    animation: logo-scroll 30s linear infinite;
}

.inc-track:hover {
    animation-play-state: paused;
}

.inc-logo-item {
    flex-shrink: 0;
    width: clamp(132px, 42vw, 220px);
    height: clamp(82px, 24vw, 130px);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 clamp(.65rem, 4vw, 3rem);
    opacity: .45;
    filter: grayscale(1);
    transition: all .4s ease;
    cursor: default;
}

.inc-logo-item:hover {
    opacity: 1;
    filter: grayscale(0);
    transform: scale(1.08);
}

.inc-logo-item img {
    max-width: clamp(112px, 35vw, 190px);
    max-height: clamp(68px, 20vw, 110px);
    object-fit: contain;
}

.inc-logo-item .inc-initials {
    font-family: 'DM Serif Display', serif;
    font-size: 1.6rem;
    color: rgba(3, 85, 140, .25);
    letter-spacing: .04em;
    transition: color .4s;
}

.inc-logo-item:hover .inc-initials {
    color: rgba(3, 85, 140, .7);
}

@media(max-width: 640px) {
    .inc-carousel {
        -webkit-mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
        mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
    }
}
</style>

<section id="incubatees" class="relative overflow-hidden py-14 md:py-20 px-6 md:px-10 lg:px-14 bg-off">
    <div class="max-w-[1200px] mx-auto">

        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-4 mb-10 md:mb-12 reveal">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy">Incubatees</span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-dark">
                    Cohort <em class=" text-gold">1</em>
                </h2>
            </div>
            <a href="<?= site_url('incubatees') ?>"
                class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-dark no-underline border-b border-dark/40 pb-0.5 transition-colors duration-200 hover:text-gold hover:border-gold shrink-0">View
                All Incubatees →</a>
        </div>

        <!-- Scrolling Logo Carousel -->
        <div class="reveal reveal-d1">
            <div class="inc-carousel">
                <div class="inc-track">
                    <?php for ($loop = 0; $loop < 2; $loop++): ?>
                    <?php foreach ($all as $inc): ?>
                    <div class="inc-logo-item"
                        title="<?= esc(html_entity_decode($inc['companyName'], ENT_QUOTES, 'UTF-8')) ?>">
                        <?php if (! empty($inc['logoPath'])): ?>
                        <img src="<?= base_url(esc($inc['logoPath'])) ?>"
                            alt="<?= esc(html_entity_decode($inc['companyName'], ENT_QUOTES, 'UTF-8')) ?>">
                        <?php else: ?>
                        <span
                            class="inc-initials"><?= strtoupper(substr(html_entity_decode($inc['companyName'], ENT_QUOTES, 'UTF-8'), 0, 2)) ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>