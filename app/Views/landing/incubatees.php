<!--
     ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: FEATURED INCUBATEE — Flippable Card + Description        ║
     ║  Off-white bg · daily rotation · card on left, text on right       ║
     ╚══════════════════════════════════════════════════════════════════════╝
-->
<?php
$fi  = $featuredIncubatee ?? null;
$all = $incubatees ?? [];
if (empty($all)) return;
if (! $fi) $fi = $all[0];

$sealUrl  = base_url('assets/img/ASOG%20TBI/PNG/Logo-white.png');
$logoSrc  = ! empty($fi['logoPath']) ? base_url(esc($fi['logoPath'])) : '';
$whiteSrc = ! empty($fi['logoWhitePath']) ? base_url(esc($fi['logoWhitePath'])) : '';
$hasWhite = ! empty($whiteSrc);
$team     = [];
if (! empty($fi['teamMembers'])) {
    $decoded = is_string($fi['teamMembers']) ? json_decode($fi['teamMembers'], true) : $fi['teamMembers'];
    if (is_array($decoded)) $team = array_filter($decoded, fn($m) => !empty($m['name']));
}
?>
<style>
/* ── Featured Incubatee section ──────────────────────────── */
.fic { background: #F8F6F2; position: relative; overflow: hidden }

.fic-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2.5rem;
    align-items: center
}
@media(min-width:900px) {
    .fic-grid { grid-template-columns: auto 1fr; gap: 4rem }
}

/* ── Card container ──────────────────────────────────────── */
.fic-card {
    width: 260px; height: 380px;
    perspective: 1000px;
    margin: 0 auto;
    cursor: pointer
}
@media(min-width:768px) {
    .fic-card { width: 290px; height: 420px }
}

.fic-inner {
    position: relative; width: 100%; height: 100%;
    transform-style: preserve-3d;
    will-change: transform
}

.fic-face {
    position: absolute; inset: 0;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    border-radius: 14px;
    overflow: hidden;
    border: 2px solid rgba(248,175,33,.22)
}

/* ── Card Front — navy + logo ────────────────────────────── */
.fic-front {
    background: linear-gradient(168deg, #03558C 0%, #022e4e 60%, #020d18 100%);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    z-index: 2
}
.fic-card:hover .fic-face {
    border-color: rgba(248,175,33,.4);
    box-shadow: 0 12px 44px rgba(248,175,33,.08), 0 4px 18px rgba(2,13,24,.12)
}

.fic-frame {
    position: absolute; inset: 6px;
    border: 1px solid rgba(248,175,33,.1);
    border-radius: 10px; pointer-events: none; z-index: 3
}

.fic-dm {
    position: absolute; width: 5px; height: 5px;
    background: rgba(248,175,33,.22);
    transform: rotate(45deg); pointer-events: none; z-index: 4
}
.fic-dm.tl { top: 11px; left: 11px }
.fic-dm.tr { top: 11px; right: 11px }
.fic-dm.bl { bottom: 11px; left: 11px }
.fic-dm.br { bottom: 11px; right: 11px }

.fic-dots {
    position: absolute; inset: 0; pointer-events: none; z-index: 1;
    background-image:
        linear-gradient(rgba(248,175,33,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(248,175,33,.03) 1px, transparent 1px);
    background-size: 18px 18px
}

.fic-logo {
    position: relative; z-index: 5;
    max-width: 160px; max-height: 160px;
    object-fit: contain; opacity: .6;
    transition: opacity .3s
}
.fic-logo.is-filtered {
    filter: brightness(0) invert(1)
}
.fic-card:hover .fic-logo { opacity: .75 }

.fic-init {
    font-family: 'DM Serif Display', serif;
    font-size: 3.2rem; color: rgba(248,175,33,.35);
    position: relative; z-index: 5
}

.fic-flip-hint {
    position: absolute; bottom: 16px; left: 50%;
    transform: translateX(-50%); z-index: 6;
    font-size: .42rem; font-weight: 600;
    letter-spacing: .18em; text-transform: uppercase;
    color: rgba(248,175,33,.28);
    transition: color .3s
}
.fic-card:hover .fic-flip-hint { color: rgba(248,175,33,.5) }

/* ── Card Back — navy + info ─────────────────────────────── */
.fic-back {
    background: #03355a;
    transform: rotateY(180deg);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    padding: 1.5rem
}

.fic-seal {
    width: 55%; max-width: 90px;
    opacity: .45; margin-bottom: .5rem
}
.fic-back-divider {
    width: 28px; height: 1px;
    background: rgba(248,175,33,.2);
    margin: .5rem 0 .5rem
}
.fic-back-name {
    font-family: 'DM Serif Display', serif;
    font-size: .72rem; line-height: 1.25;
    color: rgba(255,255,255,.9);
    text-align: center; width: 82%;
    margin-bottom: .4rem
}
.fic-back-cohort {
    font-size: .3rem; font-weight: 700;
    letter-spacing: .2em; text-transform: uppercase;
    color: rgba(248,175,33,.65)
}
.fic-back-team {
    margin-top: 1.2rem; text-align: center;
    padding: 0 .5rem
}
.fic-back-team-label {
    font-size: .32rem; font-weight: 700;
    letter-spacing: .18em; text-transform: uppercase;
    color: rgba(248,175,33,.7);
    margin-bottom: .4rem
}
.fic-back-member {
    font-size: .48rem; line-height: 1.6;
    color: rgba(255,255,255,.75)
}
.fic-back-member span {
    display: block; font-size: .32rem;
    color: rgba(255,255,255,.4);
    letter-spacing: .06em
}

/* ── Description side ────────────────────────────────────── */
.fic-desc { max-width: 520px }

.fic-label {
    display: inline-flex; align-items: center; gap: 8px;
    margin-bottom: 1.4rem
}
.fic-rule {
    width: 22px; height: 1.5px;
    background: #F8AF21; border-radius: 1px
}
.fic-tag {
    font-size: .48rem; font-weight: 700;
    letter-spacing: .2em; text-transform: uppercase;
    color: #e8a900
}

.fic-name {
    font-family: 'DM Serif Display', serif;
    font-size: 1.6rem; line-height: 1.15;
    color: #020d18; margin-bottom: .4rem
}
@media(min-width:768px) { .fic-name { font-size: 1.9rem } }

.fic-meta {
    font-size: .72rem; color: rgba(2,13,24,.45);
    margin-bottom: 1.5rem
}
.fic-meta span { color: rgba(248,175,33,.5); margin: 0 .4rem }

.fic-text {
    font-size: .84rem; font-weight: 400;
    line-height: 1.9; color: rgba(2,13,24,.5);
    margin-bottom: 2rem; max-width: 440px
}

.fic-links {
    display: flex; align-items: center;
    gap: 1.2rem; flex-wrap: wrap
}
.fic-links a { text-decoration: none; transition: gap .2s, color .2s }

.fic-link-primary {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: .56rem; font-weight: 700;
    letter-spacing: .14em; text-transform: uppercase;
    color: #e8a900
}
.fic-link-primary:hover { gap: 12px; color: #F8AF21 }

.fic-link-secondary {
    font-size: .52rem; font-weight: 500;
    color: rgba(2,13,24,.35)
}
.fic-link-secondary:hover { color: rgba(2,13,24,.6) }

/* ── Mobile center the text ──────────────────────────────── */
@media(max-width:899px) {
    .fic-desc { text-align: center; margin: 0 auto }
    .fic-text { margin-left: auto; margin-right: auto }
    .fic-links { justify-content: center }
}
</style>

<section id="incubatees" class="fic py-16 md:py-24 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1200px] mx-auto">

        <!-- Section header — aligned with Programs & Services pattern -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-4 mb-10 md:mb-14 reveal">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="block w-[18px] h-[1.5px] bg-navy"></span>
                    <span class="text-[.58rem] font-semibold tracking-[.2em] uppercase text-navy">Incubatees</span>
                </div>
                <h2 class="font-display text-3xl md:text-[2.1rem] leading-[1.12] text-dark">Featured <em
                        class="italic text-gold">Incubatee</em></h2>
            </div>
            <a href="<?= site_url('incubatees') ?>"
                class="text-[.6rem] font-semibold tracking-[.13em] uppercase text-dark/[.28] no-underline border-b border-dark/[.12] pb-0.5 transition-colors duration-200 hover:text-gold hover:border-gold shrink-0">View
                All Incubatees →</a>
        </div>

        <!-- Grid: card + description -->
        <div class="fic-grid reveal reveal-d1">

            <!-- Left: Flippable card -->
            <div class="fic-card" id="ficCard">
                <div class="fic-inner" id="ficInner">

                    <!-- Front -->
                    <div class="fic-face fic-front">
                        <div class="fic-frame"></div>
                        <div class="fic-dm tl"></div><div class="fic-dm tr"></div>
                        <div class="fic-dm bl"></div><div class="fic-dm br"></div>
                        <div class="fic-dots"></div>

                        <?php if ($logoSrc): ?>
                            <img class="fic-logo<?= $hasWhite ? '' : ' is-filtered' ?>"
                                 src="<?= $hasWhite ? $whiteSrc : $logoSrc ?>"
                                 alt="<?= esc(html_entity_decode($fi['companyName'], ENT_QUOTES, 'UTF-8')) ?>">
                        <?php else: ?>
                            <span class="fic-init"><?= strtoupper(substr(html_entity_decode($fi['companyName'], ENT_QUOTES, 'UTF-8'), 0, 1)) ?></span>
                        <?php endif; ?>

                        <span class="fic-flip-hint">Click to flip</span>
                    </div>

                    <!-- Back -->
                    <div class="fic-face fic-back">
                        <div class="fic-frame"></div>
                        <div class="fic-dm tl"></div><div class="fic-dm tr"></div>
                        <div class="fic-dm bl"></div><div class="fic-dm br"></div>
                        <div class="fic-dots"></div>

                        <img class="fic-seal" src="<?= $sealUrl ?>" alt="ASOG TBI">
                        <div class="fic-back-divider"></div>
                        <p class="fic-back-name"><?= esc(html_entity_decode($fi['companyName'], ENT_QUOTES, 'UTF-8')) ?></p>
                        <span class="fic-back-cohort"><?= esc($fi['cohort'] ?? '') ?></span>

                        <?php if (! empty($team)): ?>
                        <div class="fic-back-team">
                            <div class="fic-back-team-label">Team</div>
                            <?php foreach (array_slice($team, 0, 4) as $m): ?>
                            <div class="fic-back-member">
                                <?= esc(html_entity_decode($m['name'], ENT_QUOTES, 'UTF-8')) ?>
                                <?php if (! empty($m['role'])): ?><span><?= esc(html_entity_decode($m['role'], ENT_QUOTES, 'UTF-8')) ?></span><?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right: Description -->
            <div class="fic-desc">
                <div class="fic-label">
                    <span class="fic-rule"></span>
                    <span class="fic-tag">Today's Feature</span>
                </div>

                <h3 class="fic-name"><?= esc(html_entity_decode($fi['companyName'], ENT_QUOTES, 'UTF-8')) ?></h3>

                <p class="fic-meta">
                    <?php if (! empty($fi['founderName'])): ?>
                        by <?= esc(html_entity_decode($fi['founderName'], ENT_QUOTES, 'UTF-8')) ?>
                    <?php endif; ?>
                    <?php if (! empty($fi['founderName']) && ! empty($fi['cohort'])): ?>
                        <span>·</span>
                    <?php endif; ?>
                    <?php if (! empty($fi['cohort'])): ?>
                        <?= esc($fi['cohort']) ?>
                    <?php endif; ?>
                </p>

                <p class="fic-text"><?= esc(html_entity_decode($fi['shortDescription'], ENT_QUOTES, 'UTF-8')) ?></p>

                <div class="fic-links">
                    <?php if (! empty($fi['websiteUrl'])): ?>
                    <a href="<?= html_entity_decode($fi['websiteUrl'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener" class="fic-link-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:-2px;margin-right:4px"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10A15.3 15.3 0 0 1 12 2z"/></svg>
                        Website <span>↗</span>
                    </a>
                    <?php endif; ?>
                    <?php if (! empty($fi['facebookUrl'])): ?>
                    <a href="<?= html_entity_decode($fi['facebookUrl'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener" class="fic-link-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="display:inline;vertical-align:-2px;margin-right:3px"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook <span>↗</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('assets/js/featuredIncubatee.js') ?>" defer></script>