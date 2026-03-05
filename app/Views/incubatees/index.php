<!-- ╔══════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — Stacked Cards + Enlarge + Flip + Panel         ║
     ╚══════════════════════════════════════════════════════════════╝ -->
<?php
$incubatees    = $incubatees ?? [];
$hasIncubatees = ! empty($incubatees);
$count         = count($incubatees);
?>

<style>
/* ═══════════════════════════════════════════════════════
   SECTION
   ═══════════════════════════════════════════════════════ */
.ib-s{background:#F8F6F2;padding:5rem 0 4rem;position:relative;min-height:100vh}
.ib-w{max-width:1200px;margin:0 auto;padding:0 1.5rem}
@media(min-width:768px){.ib-w{padding:0 2.5rem}}
@media(min-width:1024px){.ib-w{padding:0 3.5rem}}

/* Header */
.ib-label{display:flex;align-items:center;gap:8px;margin-bottom:12px}
.ib-rule{width:18px;height:1.5px;background:#F8AF21;border-radius:1px;display:block}
.ib-tag{font-size:.52rem;font-weight:600;letter-spacing:.22em;text-transform:uppercase;color:#e8a900}
.ib-hrow{margin-bottom:3rem}
.ib-title{font-family:'DM Serif Display',serif;font-size:1.55rem;line-height:1.1;color:#020d18;margin:0 0 .5rem}
@media(min-width:768px){.ib-title{font-size:2rem}}
.ib-title em{color:#F8AF21;font-style:italic}
.ib-sub{font-size:.8rem;font-weight:300;line-height:1.8;color:rgba(2,13,24,.4);max-width:460px;margin:0}

/* ═══════════════════════════════════════════════════════
   CARD STACK — fanned out, all visible
   ═══════════════════════════════════════════════════════ */
.ib-stack{
    display:flex;
    flex-wrap:wrap;
    gap:18px;
    justify-content:center;
    padding:10px 0 20px;
    position:relative;
    min-height:320px
}

/* ═══════════════════════════════════════════════════════
   SINGLE CARD — game-card proportions
   ═══════════════════════════════════════════════════════ */
.ib-card{
    width:175px;height:255px;
    perspective:1000px;
    cursor:pointer;
    position:relative;
    z-index:1;
    transition:filter .3s
}
@media(min-width:768px){.ib-card{width:185px;height:270px}}

/* Dim siblings when one is active */
.ib-stack.has-active .ib-card:not(.is-picked){
    filter:brightness(.92);
    pointer-events:none
}

/* Inner — this flips */
.ib-inner{
    position:relative;width:100%;height:100%;
    transform-style:preserve-3d;
    border-radius:14px
}

/* Faces */
.ib-front,.ib-back{
    position:absolute;inset:0;
    backface-visibility:hidden;
    -webkit-backface-visibility:hidden;
    border-radius:14px;
    overflow:hidden
}

/* ── FRONT ── */
.ib-front{
    background:#fff;
    border:1px solid rgba(2,13,24,.06);
    display:flex;flex-direction:column;
    padding:1.2rem 1.1rem 1.1rem;
    z-index:2
}

/* Corner accents */
.ib-front::before,.ib-front::after{
    content:'';position:absolute;width:4px;height:4px;border-radius:50%;
    background:rgba(248,175,33,.22)}
.ib-front::before{top:9px;left:9px}
.ib-front::after{bottom:9px;right:9px}

.ib-num{
    font-family:'DM Serif Display',serif;
    font-size:.58rem;color:rgba(248,175,33,.32);
    letter-spacing:.02em;margin-bottom:auto}

.ib-logo-sm{
    width:44px;height:44px;border-radius:11px;
    background:#F8F6F2;border:1px solid rgba(2,13,24,.04);
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;margin:0 auto .9rem;flex-shrink:0}
.ib-logo-sm img{width:100%;height:100%;object-fit:contain;padding:4px}
.ib-init{
    font-family:'DM Serif Display',serif;font-size:1rem;
    color:rgba(248,175,33,.3);line-height:1}

.ib-name{
    font-family:'DM Serif Display',serif;
    font-size:.84rem;line-height:1.2;color:#020d18;
    text-align:center;margin-bottom:.25rem}

.ib-cohort{
    font-size:.36rem;font-weight:700;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(248,175,33,.42);
    text-align:center;display:block;margin-bottom:.6rem}

.ib-desc-sm{
    font-size:.56rem;font-weight:300;line-height:1.65;
    color:rgba(2,13,24,.32);text-align:center;
    display:-webkit-box;-webkit-line-clamp:2;
    -webkit-box-orient:vertical;overflow:hidden}

/* ── BACK — shows logo large ── */
.ib-back{
    background:linear-gradient(160deg,#03558C 0%,#01304d 100%);
    border:1px solid rgba(255,255,255,.07);
    transform:rotateY(180deg);
    display:flex;flex-direction:column;
    align-items:center;justify-content:center;
    text-align:center;padding:1.5rem 1rem;
    gap:.6rem
}

/* Subtle stripe pattern */
.ib-back::before{
    content:'';position:absolute;inset:0;
    background:repeating-linear-gradient(
        -45deg,transparent,transparent 7px,
        rgba(255,255,255,.012) 7px,rgba(255,255,255,.012) 8px);
    pointer-events:none}

.ib-logo-big{
    width:80px;height:80px;border-radius:18px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.06);
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;position:relative}
.ib-logo-big img{width:100%;height:100%;object-fit:contain;padding:10px}
.ib-logo-big .ib-init{font-size:2.2rem;color:rgba(248,175,33,.25)}

.ib-back-name{
    font-family:'DM Serif Display',serif;
    font-size:.9rem;line-height:1.2;color:#fff;
    position:relative}
.ib-back-cohort{
    font-size:.4rem;font-weight:600;letter-spacing:.18em;
    text-transform:uppercase;color:rgba(248,175,33,.5);
    position:relative}
.ib-back-line{
    width:24px;height:1.5px;border-radius:1px;
    background:rgba(248,175,33,.35);margin-top:.3rem;
    position:relative}

/* Flip hint — tiny text at bottom of front */
.ib-flip-hint{
    display:none;margin-top:auto;
    font-size:.4rem;font-weight:600;letter-spacing:.15em;
    text-transform:uppercase;color:rgba(2,13,24,.15);
    text-align:center;padding-top:.5rem}

/* ═══════════════════════════════════════════════════════
   OVERLAY — backdrop + enlarged card + detail panel
   ═══════════════════════════════════════════════════════ */
.ib-overlay{
    position:fixed;inset:0;z-index:999;
    visibility:hidden;opacity:0;
    display:flex;align-items:center;justify-content:center;
    transition:visibility 0s .4s,opacity 0s .4s
}
.ib-overlay.is-open{
    visibility:visible;opacity:1;
    transition:visibility 0s 0s,opacity 0s 0s
}
.ib-backdrop{
    position:absolute;inset:0;
    background:rgba(2,13,24,.35);
    backdrop-filter:blur(10px);
    -webkit-backdrop-filter:blur(10px);
    opacity:0;transition:opacity .35s}
.ib-overlay.is-open .ib-backdrop{opacity:1}

/* Inner — centers the card in the area left of the panel */
.ib-modal{
    position:relative;z-index:2;
    display:flex;align-items:center;justify-content:center;
    width:100%;height:100%;
    padding-right:480px;
    pointer-events:none
}
@media(max-width:900px){.ib-modal{padding-right:0}}
.ib-overlay.is-open .ib-modal{pointer-events:auto}

/* ── Enlarged card container — centered ── */
.ib-big-card{
    width:300px;height:430px;
    perspective:1200px;
    position:relative;
    opacity:0;
    transform:scale(.7) translateY(30px)
}
@media(min-width:768px){.ib-big-card{width:330px;height:470px}}

.ib-big-inner{
    width:100%;height:100%;
    transform-style:preserve-3d;
    border-radius:18px;
    cursor:pointer;
    position:relative;
    box-shadow:0 25px 70px rgba(2,13,24,.15)}

.ib-big-front,.ib-big-back{
    position:absolute;inset:0;
    backface-visibility:hidden;
    -webkit-backface-visibility:hidden;
    border-radius:18px;
    overflow:hidden}

/* Big front */
.ib-big-front{
    background:#fff;
    border:1px solid rgba(2,13,24,.07);
    display:flex;flex-direction:column;
    padding:2.2rem 1.8rem 1.8rem;
    z-index:2}

.ib-big-front::before,.ib-big-front::after{
    content:'';position:absolute;width:5px;height:5px;border-radius:50%;
    background:rgba(248,175,33,.28)}
.ib-big-front::before{top:14px;left:14px}
.ib-big-front::after{bottom:14px;right:14px}

.ib-bf-num{
    font-family:'DM Serif Display',serif;
    font-size:.72rem;color:rgba(248,175,33,.35);
    margin-bottom:auto}

.ib-bf-logo{
    width:72px;height:72px;border-radius:16px;
    background:#F8F6F2;border:1px solid rgba(2,13,24,.04);
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;margin:0 auto 1.4rem}
.ib-bf-logo img{width:100%;height:100%;object-fit:contain;padding:6px}

.ib-bf-name{
    font-family:'DM Serif Display',serif;
    font-size:1.4rem;line-height:1.2;color:#020d18;
    text-align:center;margin-bottom:.4rem}

.ib-bf-cohort{
    font-size:.42rem;font-weight:700;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(248,175,33,.45);
    text-align:center;display:block;margin-bottom:.8rem}

.ib-bf-desc{
    font-size:.72rem;font-weight:300;line-height:1.75;
    color:rgba(2,13,24,.38);text-align:center;
    display:-webkit-box;-webkit-line-clamp:3;
    -webkit-box-orient:vertical;overflow:hidden;
    margin-bottom:1rem}

.ib-bf-hint{
    font-size:.42rem;font-weight:600;letter-spacing:.15em;
    text-transform:uppercase;color:rgba(2,13,24,.15);
    text-align:center;margin-top:auto;
    display:flex;align-items:center;justify-content:center;gap:5px}
.ib-bf-hint svg{opacity:.3}

/* Big back */
.ib-big-back{
    background:linear-gradient(160deg,#03558C 0%,#01304d 100%);
    border:1px solid rgba(255,255,255,.08);
    transform:rotateY(180deg);
    display:flex;flex-direction:column;
    align-items:center;justify-content:center;
    text-align:center;padding:2rem 1.4rem}

.ib-big-back::before{
    content:'';position:absolute;inset:0;
    background:repeating-linear-gradient(
        -45deg,transparent,transparent 10px,
        rgba(255,255,255,.012) 10px,rgba(255,255,255,.012) 11px);
    pointer-events:none}

.ib-bb-logo{
    width:110px;height:110px;border-radius:22px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.06);
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;margin-bottom:1.2rem;position:relative}
.ib-bb-logo img{width:100%;height:100%;object-fit:contain;padding:14px}
.ib-bb-logo .ib-init{font-size:3rem;color:rgba(248,175,33,.2)}

.ib-bb-name{
    font-family:'DM Serif Display',serif;
    font-size:1.15rem;line-height:1.2;color:#fff;
    margin-bottom:.5rem;position:relative}
.ib-bb-founder{
    font-size:.7rem;font-weight:300;color:rgba(255,255,255,.35);
    margin-bottom:.3rem;position:relative}
.ib-bb-cohort{
    font-size:.44rem;font-weight:600;letter-spacing:.18em;
    text-transform:uppercase;color:rgba(248,175,33,.5);
    position:relative}
.ib-bb-line{
    width:28px;height:2px;border-radius:1px;
    background:rgba(248,175,33,.35);
    margin-top:1rem;position:relative}
.ib-bb-hint{
    font-size:.38rem;font-weight:600;letter-spacing:.12em;
    text-transform:uppercase;color:rgba(255,255,255,.18);
    margin-top:1rem;position:relative}

/* ═══════════════════════════════════════════════════════
   DETAIL PANEL — right side, slides in from right
   ═══════════════════════════════════════════════════════ */
.ib-panel{
    position:fixed;top:0;right:0;bottom:0;z-index:1001;
    width:100%;max-width:480px;
    background:#fff;
    border-radius:0;
    display:flex;flex-direction:column;
    overflow:hidden;
    transform:translateX(100%);
    box-shadow:-8px 0 40px rgba(0,0,0,.1)
}

/* Close */
.ib-close{
    position:absolute;top:16px;right:16px;z-index:5;
    width:36px;height:36px;border-radius:50%;
    border:1px solid rgba(2,13,24,.06);
    background:rgba(248,246,242,.92);
    backdrop-filter:blur(6px);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;color:rgba(2,13,24,.3);
    transition:all .15s}
.ib-close:hover{color:#020d18;border-color:rgba(2,13,24,.18)}

/* Panel content */
.ib-p-head{
    display:flex;align-items:flex-start;gap:14px;
    padding:2rem 2rem 1.3rem;
    padding-right:3.5rem;
    border-bottom:1px solid rgba(2,13,24,.04)}
.ib-p-logo{
    width:48px;height:48px;flex-shrink:0;
    border-radius:12px;
    border:1px solid rgba(2,13,24,.05);
    background:#F8F6F2;
    display:flex;align-items:center;justify-content:center;
    overflow:hidden}
.ib-p-logo img{width:100%;height:100%;object-fit:contain;padding:5px}
.ib-p-meta{min-width:0;flex:1}
.ib-p-cohort{
    font-size:.44rem;font-weight:700;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(248,175,33,.55);
    margin-bottom:3px;display:block}
.ib-p-name{
    font-family:'DM Serif Display',serif;
    font-size:1.3rem;line-height:1.15;color:#020d18;margin-bottom:3px}
.ib-p-founder{font-size:.7rem;font-weight:400;color:rgba(2,13,24,.28)}

.ib-p-body{padding:1.4rem 2rem;flex:1;overflow-y:auto}
.ib-p-short{
    font-size:.82rem;font-weight:300;line-height:1.85;
    color:rgba(2,13,24,.5);margin-bottom:1.2rem}
.ib-p-content{
    font-size:.78rem;font-weight:300;line-height:1.9;color:rgba(2,13,24,.38)}
.ib-p-content p{margin-bottom:.8rem}
.ib-p-content p:last-child{margin-bottom:0}

.ib-p-foot{
    padding:1rem 2rem 1.4rem;
    border-top:1px solid rgba(2,13,24,.04);
    display:flex;align-items:center;gap:1rem;flex-wrap:wrap}
.ib-p-link{
    display:inline-flex;align-items:center;gap:6px;
    font-size:.52rem;font-weight:700;letter-spacing:.14em;
    text-transform:uppercase;color:#e8a900;
    text-decoration:none;transition:gap .2s,color .2s}
.ib-p-link:hover{gap:12px;color:#F8AF21}
.ib-p-web{
    font-size:.5rem;font-weight:500;
    color:rgba(2,13,24,.3);text-decoration:none;transition:color .2s}
.ib-p-web:hover{color:rgba(2,13,24,.55)}

/* ═══════════════════════════════════════════════════════
   FOOTER
   ═══════════════════════════════════════════════════════ */
.ib-foot{
    display:flex;flex-direction:column;gap:.6rem;
    align-items:flex-start;margin-top:2.5rem}
@media(min-width:640px){.ib-foot{flex-direction:row;align-items:center;justify-content:space-between}}
.ib-count{font-size:.76rem;font-weight:300;color:rgba(2,13,24,.28)}
.ib-apply{
    font-size:.52rem;font-weight:600;letter-spacing:.14em;
    text-transform:uppercase;color:rgba(248,175,33,.5);
    text-decoration:none;border-bottom:1px solid rgba(248,175,33,.15);
    padding-bottom:2px;transition:color .2s,border-color .2s}
.ib-apply:hover{color:#F8AF21;border-color:rgba(248,175,33,.35)}

/* ═══════════════════════════════════════════════════════
   EMPTY STATE
   ═══════════════════════════════════════════════════════ */
.ib-empty{
    border:1px solid rgba(2,13,24,.06);border-radius:16px;
    background:#fff;padding:3.5rem 2rem;text-align:center;margin-bottom:2rem}
.ib-empty-icon{
    width:56px;height:56px;margin:0 auto 1.2rem;border-radius:50%;
    border:1px solid rgba(2,13,24,.06);background:#F8F6F2;
    display:flex;align-items:center;justify-content:center}
.ib-empty h3{font-family:'DM Serif Display',serif;font-size:1.2rem;color:#020d18;margin-bottom:.5rem}
.ib-empty p{font-size:.82rem;font-weight:300;line-height:1.8;color:rgba(2,13,24,.4);max-width:380px;margin:0 auto 1.5rem}
</style>


<!-- ═══════════════════════════════════════════════════════
     SECTION
     ═══════════════════════════════════════════════════════ -->
<section class="ib-s">
<div class="ib-w">

    <!-- Header -->
    <div class="ib-label">
        <span class="ib-rule"></span>
        <span class="ib-tag">Portfolio</span>
    </div>
    <div class="ib-hrow">
        <h2 class="ib-title">Our <em>Incubatees</em></h2>
        <p class="ib-sub">Startups and MSMEs in the ASOG-TBI program — building solutions across the food value chain through engineering and AI.</p>
    </div>

    <?php if ($hasIncubatees): ?>

    <!-- ── Card Stack ── -->
    <div id="ibStack" class="ib-stack">
        <?php foreach ($incubatees as $i => $inc):
            $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
        ?>
        <div class="ib-card" data-ix="<?= $i ?>">
            <div class="ib-inner">
                <!-- Front -->
                <div class="ib-front">
                    <span class="ib-num"><?= $num ?></span>
                    <div class="ib-logo-sm">
                        <?php if (! empty($inc['logoPath'])): ?>
                            <img src="<?= base_url(esc($inc['logoPath'])) ?>" alt="<?= esc($inc['companyName']) ?>">
                        <?php else: ?>
                            <span class="ib-init"><?= strtoupper(substr($inc['companyName'], 0, 1)) ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="ib-name"><?= esc($inc['companyName']) ?></h3>
                    <?php if (! empty($inc['cohort'])): ?>
                        <span class="ib-cohort"><?= esc($inc['cohort']) ?></span>
                    <?php endif; ?>
                    <?php if (! empty($inc['shortDescription'])): ?>
                        <p class="ib-desc-sm"><?= esc($inc['shortDescription']) ?></p>
                    <?php endif; ?>
                </div>
                <!-- Back (not used in stack, only for consistency) -->
                <div class="ib-back">
                    <div class="ib-logo-big">
                        <?php if (! empty($inc['logoPath'])): ?>
                            <img src="<?= base_url(esc($inc['logoPath'])) ?>" alt="">
                        <?php else: ?>
                            <span class="ib-init"><?= strtoupper(substr($inc['companyName'], 0, 1)) ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="ib-back-name"><?= esc($inc['companyName']) ?></p>
                    <span class="ib-back-cohort"><?= esc($inc['cohort'] ?? '') ?></span>
                    <span class="ib-back-line"></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php else: ?>
    <div class="ib-empty">
        <div class="ib-empty-icon">
            <svg style="width:24px;height:24px;color:rgba(2,13,24,.15)" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
            </svg>
        </div>
        <h3>Incubatees Coming Soon</h3>
        <p>Our first cohort will be featured here once the program kicks off.</p>
        <a href="<?= site_url('incubatees/apply') ?>" class="ib-apply" style="border:none">Apply to the Program →</a>
    </div>
    <?php endif; ?>

    <!-- Footer -->
    <div class="ib-foot">
        <p class="ib-count">
            <?php if ($hasIncubatees): ?>
                <?= $count ?> incubatee<?= $count !== 1 ? 's' : '' ?> in the program
            <?php else: ?>
                Interested in joining ASOG-TBI?
            <?php endif; ?>
        </p>
        <a href="<?= site_url('incubatees/apply') ?>" class="ib-apply">Become an Incubatee</a>
    </div>

</div>
</section>


<?php if ($hasIncubatees): ?>
<!-- ═══════════════════════════════════════════════════════
     OVERLAY — enlarged card on left + detail panel on right
     ═══════════════════════════════════════════════════════ -->
<div id="ibOverlay" class="ib-overlay">
    <div class="ib-backdrop" id="ibBackdrop"></div>
    <div class="ib-modal">

        <!-- Enlarged flippable card (centered) -->
        <div id="ibBigCard" class="ib-big-card">
            <div id="ibBigInner" class="ib-big-inner">
                <!-- Front (enlarged) -->
                <div class="ib-big-front" id="ibBigFront">
                    <span id="bfNum" class="ib-bf-num"></span>
                    <div id="bfLogo" class="ib-bf-logo"></div>
                    <h3 id="bfName" class="ib-bf-name"></h3>
                    <span id="bfCohort" class="ib-bf-cohort"></span>
                    <p id="bfDesc" class="ib-bf-desc"></p>
                    <span class="ib-bf-hint">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                        Click to flip
                    </span>
                </div>
                <!-- Back (logo reveal) -->
                <div class="ib-big-back" id="ibBigBack">
                    <div id="bbLogo" class="ib-bb-logo"></div>
                    <p id="bbName" class="ib-bb-name"></p>
                    <p id="bbFounder" class="ib-bb-founder"></p>
                    <span id="bbCohort" class="ib-bb-cohort"></span>
                    <span class="ib-bb-line"></span>
                    <span class="ib-bb-hint">Click to flip back</span>
                </div>
            </div>
        </div>

    </div><!-- /ib-modal -->
</div><!-- /ib-overlay -->

<!-- Detail panel — slides in from right edge of screen -->
<div id="ibPanel" class="ib-panel">
    <button class="ib-close" id="ibClose">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <div class="ib-p-head">
        <div id="pLogo" class="ib-p-logo"></div>
        <div class="ib-p-meta">
            <span id="pCohort" class="ib-p-cohort"></span>
            <h2 id="pName" class="ib-p-name"></h2>
            <p id="pFounder" class="ib-p-founder"></p>
        </div>
    </div>
    <div class="ib-p-body">
        <p id="pShort" class="ib-p-short"></p>
        <div id="pContent" class="ib-p-content"></div>
    </div>
    <div class="ib-p-foot">
        <a href="<?= site_url('incubatees') ?>" class="ib-p-link">View all incubatees <span>→</span></a>
        <a id="pWeb" href="#" target="_blank" rel="noopener" class="ib-p-web" style="display:none">Website ↗</a>
    </div>
</div><!-- /ib-panel -->


<!-- GSAP -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script>
(function(){
    /* ══ Data ══ */
    var data = <?= json_encode(array_map(function($inc){
        return [
            'companyName'      => $inc['companyName'] ?? '',
            'founderName'      => $inc['founderName'] ?? '',
            'shortDescription' => $inc['shortDescription'] ?? '',
            'content'          => $inc['content'] ?? '',
            'logoPath'         => ! empty($inc['logoPath']) ? base_url($inc['logoPath']) : '',
            'websiteUrl'       => $inc['websiteUrl'] ?? '',
            'cohort'           => $inc['cohort'] ?? '',
        ];
    }, $incubatees), JSON_HEX_TAG | JSON_HEX_APOS) ?>;

    /* ══ DOM refs ══ */
    var stack    = document.getElementById('ibStack');
    var cards    = document.querySelectorAll('.ib-card');
    var overlay  = document.getElementById('ibOverlay');
    var backdrop = document.getElementById('ibBackdrop');
    var bigCard  = document.getElementById('ibBigCard');
    var bigInner = document.getElementById('ibBigInner');
    var panel    = document.getElementById('ibPanel');
    var closeBtn = document.getElementById('ibClose');

    /* Big card detail elements */
    var bfNum    = document.getElementById('bfNum');
    var bfLogo   = document.getElementById('bfLogo');
    var bfName   = document.getElementById('bfName');
    var bfCohort = document.getElementById('bfCohort');
    var bfDesc   = document.getElementById('bfDesc');
    var bbLogo   = document.getElementById('bbLogo');
    var bbName   = document.getElementById('bbName');
    var bbFounder= document.getElementById('bbFounder');
    var bbCohort = document.getElementById('bbCohort');

    /* Panel elements */
    var pLogo    = document.getElementById('pLogo');
    var pCohort  = document.getElementById('pCohort');
    var pName    = document.getElementById('pName');
    var pFounder = document.getElementById('pFounder');
    var pShort   = document.getElementById('pShort');
    var pContent = document.getElementById('pContent');
    var pWeb     = document.getElementById('pWeb');

    var isOpen   = false;
    var isFlipped= false;
    var activeCard = null;

    /* ══ Card hover in stack ══ */
    cards.forEach(function(card){
        var inner = card.querySelector('.ib-inner');
        card.addEventListener('mouseenter', function(){
            gsap.to(inner,{ y:-8, boxShadow:'0 14px 36px rgba(2,13,24,.1)', duration:.3, ease:'power2.out' });
        });
        card.addEventListener('mouseleave', function(){
            gsap.to(inner,{ y:0, boxShadow:'0 2px 8px rgba(2,13,24,.03)', duration:.25, ease:'power2.in' });
        });

        /* Click → open */
        card.addEventListener('click', function(){
            var idx = parseInt(card.getAttribute('data-ix'));
            openCard(card, idx);
        });
    });

    /* ══ OPEN — animate card from its position to overlay ══ */
    function openCard(card, idx){
        if(isOpen) return;
        isOpen = true;
        isFlipped = false;
        activeCard = card;

        var d = data[idx];
        var num = String(idx+1).padStart(2,'0');

        /* Fill enlarged front */
        bfNum.textContent = num;
        bfName.textContent = d.companyName;
        bfCohort.textContent = d.cohort;
        bfDesc.textContent = d.shortDescription;

        if(d.logoPath){
            bfLogo.innerHTML = '<img src="'+d.logoPath+'" alt="'+d.companyName+'">';
        } else {
            bfLogo.innerHTML = '<span class="ib-init" style="font-size:1.6rem">'+d.companyName.charAt(0).toUpperCase()+'</span>';
        }

        /* Fill enlarged back */
        if(d.logoPath){
            bbLogo.innerHTML = '<img src="'+d.logoPath+'" alt="">';
        } else {
            bbLogo.innerHTML = '<span class="ib-init" style="font-size:3rem">'+d.companyName.charAt(0).toUpperCase()+'</span>';
        }
        bbName.textContent = d.companyName;
        bbFounder.textContent = d.founderName ? 'by '+d.founderName : '';
        bbCohort.textContent = d.cohort;

        /* Fill panel */
        if(d.logoPath){
            pLogo.innerHTML = '<img src="'+d.logoPath+'" alt="'+d.companyName+'">';
        } else {
            pLogo.innerHTML = '<span class="ib-init" style="font-size:1.2rem">'+d.companyName.charAt(0).toUpperCase()+'</span>';
        }
        pCohort.textContent  = d.cohort;
        pName.textContent    = d.companyName;
        pFounder.textContent = d.founderName ? 'by '+d.founderName : '';
        pShort.textContent   = d.shortDescription;
        pContent.innerHTML   = d.content || '';
        if(d.websiteUrl){
            pWeb.href = d.websiteUrl;
            pWeb.style.display = 'inline-flex';
        } else {
            pWeb.style.display = 'none';
        }

        /* Get source card position for FLIP animation */
        var rect = card.getBoundingClientRect();

        /* Dim the stack */
        stack.classList.add('has-active');
        card.classList.add('is-picked');

        /* Show overlay */
        overlay.classList.add('is-open');
        document.body.style.overflow = 'hidden';

        /* Reset big card & panel */
        gsap.set(bigInner, { rotateY:0 });
        gsap.set(bigCard, { opacity:0, scale:.7, y:30 });

        /* Animate big card in (centered) */
        gsap.to(bigCard, {
            opacity:1, scale:1, y:0,
            duration:.5,
            delay:.1,
            ease:'back.out(1.4)'
        });

        /* Slide panel in from right edge */
        gsap.to(panel, {
            x:0,
            duration:.45,
            delay:.2,
            ease:'power3.out'
        });
    }

    /* ══ CLOSE ══ */
    function closeOverlay(){
        if(!isOpen) return;

        /* If flipped, unflip first then close */
        if(isFlipped){
            gsap.to(bigInner, {
                rotateY:0, duration:.35, ease:'power2.inOut',
                onComplete: doClose
            });
            isFlipped = false;
        } else {
            doClose();
        }
    }

    function doClose(){
        /* Slide panel out to the right */
        gsap.to(panel, {
            x:'100%',
            duration:.3, ease:'power2.in'
        });
        /* Shrink card back */
        gsap.to(bigCard, {
            opacity:0, scale:.8, y:20,
            duration:.3, ease:'power2.in',
            onComplete:function(){
                overlay.classList.remove('is-open');
                stack.classList.remove('has-active');
                if(activeCard) activeCard.classList.remove('is-picked');
                activeCard = null;
                isOpen = false;
                document.body.style.overflow = '';
                gsap.set(panel, { x:'100%' });
            }
        });
    }

    /* ══ FLIP the enlarged card ══ */
    bigInner.addEventListener('click', function(e){
        e.stopPropagation();
        isFlipped = !isFlipped;
        gsap.to(bigInner, {
            rotateY: isFlipped ? 180 : 0,
            duration:.55,
            ease:'power2.inOut'
        });
    });

    /* ══ Close triggers ══ */
    closeBtn.addEventListener('click', function(e){ e.stopPropagation(); closeOverlay(); });
    panel.addEventListener('click', function(e){ e.stopPropagation(); });
    backdrop.addEventListener('click', closeOverlay);
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && isOpen) closeOverlay();
    });

})();
</script>
<?php endif; ?>
