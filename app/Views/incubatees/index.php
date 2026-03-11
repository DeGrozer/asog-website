<!-- ╔══════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — Cohort Landing (Dictionary-style)               ║
     ║  Definition of "Cohort" + sleek navigation bars per cohort    ║
     ╚══════════════════════════════════════════════════════════════╝ -->
<?php
$cohorts = $cohorts ?? [];
?>

<style>
/* ── Cohort Landing Styles ──────────────────────────── */
.ch-landing { background: #F8F6F2; }

/* Dictionary definition block */
.ch-dict {
    max-width: 620px;
    margin: 0 auto 3.5rem;
    padding: 2.5rem 0;
}
.ch-word {
    font-family: 'DM Serif Display', serif;
    font-size: clamp(2.2rem, 4vw, 3.2rem);
    line-height: 1.1;
    color: #020d18;
    margin-bottom: .3rem;
}
.ch-phonetic {
    font-size: .88rem;
    font-weight: 300;
    color: rgba(2,13,24,.35);
    font-style: italic;
    margin-bottom: 1.2rem;
    letter-spacing: .02em;
}
.ch-pos {
    display: inline-block;
    font-size: .6rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: #03558C;
    background: rgba(3,85,140,.06);
    padding: .25rem .65rem;
    border-radius: 2px;
    margin-bottom: 1.1rem;
}
.ch-def-num {
    font-family: 'DM Serif Display', serif;
    font-size: .85rem;
    color: rgba(248,175,33,.7);
    margin-right: .5rem;
    flex-shrink: 0;
}
.ch-def-text {
    font-size: .92rem;
    font-weight: 300;
    line-height: 1.8;
    color: rgba(2,13,24,.6);
}
.ch-def-example {
    font-size: .82rem;
    font-weight: 300;
    font-style: italic;
    color: rgba(2,13,24,.35);
    padding-left: 1.5rem;
    margin-top: .3rem;
    border-left: 2px solid rgba(248,175,33,.15);
}
.ch-divider {
    width: 40px;
    height: 1.5px;
    background: rgba(248,175,33,.3);
    margin: 2rem 0;
    border-radius: 1px;
}
.ch-context {
    font-size: .82rem;
    font-weight: 300;
    line-height: 1.9;
    color: rgba(2,13,24,.45);
    max-width: 520px;
}

/* Cohort navigation bars */
.ch-bars {
    max-width: 680px;
    margin: 0 auto;
}
.ch-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.1rem 1.5rem;
    border-top: 1px solid rgba(2,13,24,.06);
    text-decoration: none;
    transition: all .25s ease;
    position: relative;
    overflow: hidden;
}
.ch-bar:last-child {
    border-bottom: 1px solid rgba(2,13,24,.06);
}
.ch-bar::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 0;
    background: rgba(3,85,140,.03);
    transition: width .35s ease;
}
.ch-bar:hover::before {
    width: 100%;
}
.ch-bar:hover {
    border-color: rgba(248,175,33,.2);
}
.ch-bar:hover + .ch-bar {
    border-top-color: rgba(248,175,33,.2);
}

.ch-bar-left {
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
    z-index: 1;
}
.ch-bar-num {
    font-family: 'DM Serif Display', serif;
    font-size: .82rem;
    color: rgba(3,85,140,.55);
    width: 1.4rem;
    flex-shrink: 0;
}
.ch-bar-title {
    font-family: 'DM Serif Display', serif;
    font-size: 1.15rem;
    color: #020d18;
    transition: color .25s;
}
.ch-bar:hover .ch-bar-title {
    color: #03558C;
}
.ch-bar-count {
    font-size: .62rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: rgba(2,13,24,.45);
    margin-left: .5rem;
    transition: color .25s;
}
.ch-bar:hover .ch-bar-count {
    color: rgba(3,85,140,.6);
}

.ch-bar-arrow {
    position: relative;
    z-index: 1;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(2,13,24,.08);
    color: rgba(2,13,24,.2);
    flex-shrink: 0;
    transition: all .25s ease;
    clip-path: polygon(0% 0%, 88% 0%, 100% 12%, 100% 100%, 0% 100%);
}
.ch-bar:hover .ch-bar-arrow {
    border-color: rgba(248,175,33,.35);
    color: #e8a900;
    background: rgba(248,175,33,.06);
}

/* Footer link */
.ch-foot {
    max-width: 680px;
    margin: 2.5rem auto 0;
    text-align: center;
}
</style>

<section class="ch-landing relative py-16 md:py-20 px-6 md:px-10 lg:px-14">
    <div class="max-w-[1200px] mx-auto">

        <!-- Dictionary Definition -->
        <div class="ch-dict reveal">
            <h2 class="ch-word">co·hort</h2>
            <p class="ch-phonetic">/ˈkōˌhôrt/</p>
            <span class="ch-pos">noun</span>

            <div class="flex items-start mb-3">
                <span class="ch-def-num">1.</span>
                <div>
                    <p class="ch-def-text">a group of people with a shared characteristic.</p>
                    <p class="ch-def-example">"a cohort of innovators building solutions for the food value chain"</p>
                </div>
            </div>

            <div class="flex items-start">
                <span class="ch-def-num">2.</span>
                <p class="ch-def-text">a batch of startups accepted into an incubation program during the same intake period.</p>
            </div>

            <div class="ch-divider"></div>

            <p class="ch-context">
                At ASOG-TBI, each cohort represents a group of startups and MSMEs selected to undergo our
                incubation program — receiving mentorship, facilities access, and support to bring their
                innovations from concept to market.
            </p>
        </div>

        <!-- Cohort Navigation Bars -->
        <?php if (! empty($cohorts)): ?>
        <div class="ch-bars reveal reveal-d1">
            <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.6rem;padding:0 .5rem">
                <span style="font-size:.55rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#03558C"><?= count($cohorts) ?> Cohort<?= count($cohorts) !== 1 ? 's' : '' ?></span>
                <span style="flex:1;height:1px;background:rgba(2,13,24,.06)"></span>
            </div>
            <?php foreach ($cohorts as $i => $cohortName): ?>
            <?php
                $cNum  = (int) filter_var($cohortName, FILTER_SANITIZE_NUMBER_INT);
                $count = count(model('IncubateeModel')->getPublishedByCohort($cohortName));
                $label = $count > 0
                    ? $count . ' incubatee' . ($count !== 1 ? 's' : '')
                    : 'Coming Soon';
            ?>
            <a href="<?= site_url('incubatees/cohort-' . $cNum) ?>" class="ch-bar group">
                <div class="ch-bar-left">
                    <span class="ch-bar-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    <span class="ch-bar-title"><?= esc($cohortName) ?></span>
                    <span class="ch-bar-count"><?= $label ?></span>
                </div>
                <span class="ch-bar-arrow">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7v10"/>
                    </svg>
                </span>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="ch-foot reveal reveal-d2">
            <a href="<?= site_url('incubatees/apply') ?>"
               class="inline-flex items-center gap-2 text-[.6rem] font-bold tracking-[.14em] uppercase text-gold no-underline border-b border-gold/30 pb-0.5 transition-all duration-200 hover:gap-3 hover:border-gold/60">
                Become an Incubatee <span>→</span>
            </a>
        </div>
        <?php else: ?>
        <!-- No cohorts yet -->
        <div class="text-center py-12 reveal reveal-d1">
            <p class="text-dark/35 text-[.88rem] mb-6">No cohorts have been announced yet.</p>
            <a href="<?= site_url('incubatees/apply') ?>"
               class="inline-block text-[.7rem] font-bold tracking-[.14em] uppercase text-white bg-navy px-8 py-3.5 rounded-sm no-underline transition-colors hover:bg-navy/85">
                Apply Now
            </a>
        </div>
        <?php endif; ?>

    </div>
</section>