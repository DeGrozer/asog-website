<!--
     ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: INCUBATEES — Expanding Flexbox Panels                      ║
     ║  Dark bg · featured panel starts expanded · click to switch          ║
     ╚══════════════════════════════════════════════════════════════════════╝
-->
<?php
$fi   = $featuredIncubatee ?? null;
$all  = $incubatees ?? [];
if (empty($all)) return;
$fid  = $fi['id'] ?? $all[0]['id'];
?>
<style>
/* ── Section ─────────────────────────────────────────────── */
.fi {
    background: #ffffff;
    padding: 4.5rem 0 0;
    position: relative;
    overflow: hidden
}

.fi-head {
    max-width: 1100px;
    margin: 0 auto 2.5rem;
    padding: 0 1.5rem
}

@media(min-width:768px) {
    .fi-head {
        padding: 0 2.5rem;
        margin-bottom: 3rem
    }
}

@media(min-width:1024px) {
    .fi-head {
        padding: 0 3.5rem
    }
}

/* ── Panels container ────────────────────────────────────── */
.fi-panels {
    display: flex;
    height: 460px;
    border-top: 1px solid rgba(0, 0, 0, .06);
    border-bottom: 1px solid rgba(0, 0, 0, .06)
}

/* ── Single panel ────────────────────────────────────────── */
.fi-p {
    flex: 1;
    min-width: 0;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    border-right: 1px solid rgba(0, 0, 0, .06);
    transition: flex .65s cubic-bezier(.4, 0, .2, 1), background .4s;
    background: transparent
}

.fi-p:last-child {
    border-right: none
}

.fi-p:hover:not(.is-act) {
    background: rgba(248, 175, 33, .04)
}

.fi-p.is-act {
    flex: 5;
    cursor: default;
    background: rgba(248, 175, 33, .04)
}

/* Gold top-accent on active */
.fi-p::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2.5px;
    background: #F8AF21;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .5s cubic-bezier(.4, 0, .2, 1)
}

.fi-p.is-act::after {
    transform: scaleX(1)
}

/* ── Collapsed content ───────────────────────────────────── */
.fi-c {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 0 .5rem 2.2rem;
    gap: 1.2rem;
    transition: opacity .25s
}

.fi-p.is-act .fi-c {
    opacity: 0;
    pointer-events: none
}

.fi-c-num {
    font-family: 'DM Serif Display', serif;
    font-size: .75rem;
    color: rgba(248, 175, 33, .4);
    letter-spacing: .04em
}

.fi-c-name {
    writing-mode: vertical-rl;
    text-orientation: mixed;
    font-size: .52rem;
    font-weight: 600;
    letter-spacing: .15em;
    text-transform: uppercase;
    color: rgba(2, 13, 24, .3);
    white-space: nowrap;
    max-height: 220px;
    overflow: hidden
}

/* ── Expanded content ────────────────────────────────────── */
.fi-e {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity .4s .2s
}

.fi-p.is-act .fi-e {
    opacity: 1;
    pointer-events: auto;
    position: relative
}

.fi-e-in {
    padding: 2.8rem 2.2rem;
    max-width: 540px
}

@media(min-width:768px) {
    .fi-e-in {
        padding: 3rem 3.5rem
    }
}

.fi-e-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 1.4rem
}

.fi-e-rule {
    width: 22px;
    height: 1.5px;
    background: #F8AF21;
    border-radius: 1px
}

.fi-e-tag {
    font-size: .48rem;
    font-weight: 700;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: #e8a900
}

.fi-e-name {
    font-family: 'DM Serif Display', serif;
    font-size: 1.55rem;
    line-height: 1.15;
    color: #020d18;
    margin-bottom: .4rem
}

@media(min-width:768px) {
    .fi-e-name {
        font-size: 1.75rem
    }
}

.fi-e-meta {
    font-size: .68rem;
    color: rgba(2, 13, 24, .5);
    margin-bottom: 1.5rem
}

.fi-e-meta span {
    color: rgba(248, 175, 33, .5);
    margin: 0 .4rem
}

.fi-e-desc {
    font-size: .82rem;
    font-weight: 400;
    line-height: 1.9;
    color: rgba(2, 13, 24, .55);
    margin-bottom: 1.8rem;
    max-width: 440px
}

.fi-e-links {
    display: flex;
    align-items: center;
    gap: 1.2rem;
    flex-wrap: wrap
}

.fi-e-links a {
    text-decoration: none;
    transition: gap .2s, color .2s
}

.fi-e-a1 {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: .56rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: #e8a900
}

.fi-e-a1:hover {
    gap: 12px;
    color: #F8AF21
}

.fi-e-a2 {
    font-size: .52rem;
    font-weight: 500;
    color: rgba(2, 13, 24, .35)
}

.fi-e-a2:hover {
    color: rgba(2, 13, 24, .6)
}

/* ── Mobile: vertical accordion ──────────────────────────── */
@media(max-width:767px) {
    .fi-panels {
        flex-direction: column;
        height: auto
    }

    .fi-p {
        flex: none !important;
        height: 54px;
        border-right: none;
        border-bottom: 1px solid rgba(0, 0, 0, .06);
        transition: height .5s cubic-bezier(.4, 0, .2, 1), background .3s
    }

    .fi-p.is-act {
        height: 340px
    }

    .fi-c {
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        padding: 0 1.4rem;
        gap: .8rem
    }

    .fi-c-name {
        writing-mode: horizontal-tb;
        max-height: none;
        font-size: .58rem;
        color: rgba(2, 13, 24, .35)
    }

    .fi-c-num {
        font-size: .65rem
    }

    .fi-e-in {
        padding: 1.6rem 1.4rem
    }

    .fi-e-name {
        font-size: 1.3rem
    }
}
</style>

<section id="incubatees" class="fi">

    <!-- Section header -->
    <div class="fi-head reveal">
        <div class="flex items-center gap-2 mb-3">
            <span style="width:18px;height:1.5px;background:#F8AF21;border-radius:1px;display:block"></span>
            <span
                style="font-size:.52rem;font-weight:600;letter-spacing:.22em;text-transform:uppercase;color:#e8a900">Incubatees</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
            <h2 class="font-display" style="font-size:1.55rem;line-height:1.1;margin:0;color:#020d18">Featured <em
                    class="italic" style="color:#F8AF21">Incubatee</em></h2>
            <a href="<?= site_url('incubatees') ?>" class="no-underline transition-colors duration-200 hover:text-gold"
                style="font-size:.54rem;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:rgba(2,13,24,.4)">
                See all →</a>
        </div>
    </div>

    <!-- Expanding panels -->
    <div class="fi-panels reveal reveal-d1">
        <?php foreach ($all as $i => $inc):
            $isActive = ($inc['id'] == $fid);
            $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
        ?>
        <div class="fi-p<?= $isActive ? ' is-act' : '' ?>" data-fi-panel>

            <!-- Collapsed: number + vertical name -->
            <div class="fi-c">
                <span class="fi-c-name"><?= esc($inc['companyName']) ?></span>
                <span class="fi-c-num"><?= $num ?></span>
            </div>

            <!-- Expanded: full content -->
            <div class="fi-e">
                <div class="fi-e-in">
                    <div class="fi-e-label">
                        <span class="fi-e-rule"></span>
                        <span
                            class="fi-e-tag"><?= $isActive ? "Today's Feature" : esc($inc['cohort'] ?? 'Incubatee') ?></span>
                    </div>

                    <h3 class="fi-e-name"><?= esc($inc['companyName']) ?></h3>

                    <p class="fi-e-meta">
                        <?php if (! empty($inc['founderName'])): ?>
                        by <?= esc($inc['founderName']) ?>
                        <?php endif; ?>
                        <?php if (! empty($inc['founderName']) && ! empty($inc['cohort'])): ?>
                        <span>·</span>
                        <?php endif; ?>
                        <?php if (! empty($inc['cohort'])): ?>
                        <?= esc($inc['cohort']) ?>
                        <?php endif; ?>
                    </p>

                    <p class="fi-e-desc"><?= esc($inc['shortDescription']) ?></p>

                    <div class="fi-e-links">
                        <a href="<?= site_url('incubatees') ?>" class="fi-e-a1">
                            View all incubatees <span>→</span>
                        </a>
                        <?php if (! empty($inc['websiteUrl'])): ?>
                        <a href="<?= esc($inc['websiteUrl']) ?>" target="_blank" rel="noopener" class="fi-e-a2">
                            Website ↗</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
document.querySelectorAll('[data-fi-panel]').forEach(function(p) {
    p.addEventListener('click', function() {
        if (p.classList.contains('is-act')) return;
        document.querySelectorAll('[data-fi-panel]').forEach(function(x) {
            x.classList.remove('is-act')
        });
        p.classList.add('is-act');
    });
});
</script>