<!-- ╔══════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — Collectible Card Showcase                      ║
     ╚══════════════════════════════════════════════════════════════╝ -->
<?php
$incubatees    = $incubatees ?? [];
$hasIncubatees = ! empty($incubatees);
$count         = count($incubatees);
$sealUrl       = base_url('asset/js/img/ASOG%20TBI/PNG/ASOG-TBI_seal_white.png');
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
   CARD STACK
   ═══════════════════════════════════════════════════════ */
.ib-stack{
    display:flex;flex-wrap:wrap;gap:20px;
    justify-content:center;padding:10px 0 20px;
    position:relative;min-height:320px
}

/* ═══════════════════════════════════════════════════════
   SINGLE CARD — collectible card proportions
   ═══════════════════════════════════════════════════════ */
.ib-card{
    width:230px;height:335px;
    perspective:900px;
    cursor:pointer;
    position:relative;z-index:1;
    transition:filter .3s
}
@media(min-width:768px){.ib-card{width:250px;height:360px}}

.ib-stack.has-active .ib-card:not(.is-picked){
    filter:brightness(.82) saturate(.5);pointer-events:none
}
.ib-inner{
    position:relative;width:100%;height:100%;
    transform-style:preserve-3d;
    border-radius:12px;
    will-change:transform
}
.ib-front,.ib-back{
    position:absolute;inset:0;
    backface-visibility:hidden;
    -webkit-backface-visibility:hidden;
    border-radius:12px;overflow:hidden
}

/* ═══════════════════════════════════════════════════════
   FRONT — collectible card face
   ═══════════════════════════════════════════════════════ */
.ib-front{
    background:linear-gradient(178deg,#ffffff 0%,#f6f4ef 100%);
    border:2px solid rgba(248,175,33,.2);
    display:flex;flex-direction:column;align-items:center;
    padding:0;z-index:2;
    box-shadow:0 2px 14px rgba(2,13,24,.05)
}

/* Gold inner frame */
.ib-frame{
    position:absolute;
    border:1px solid rgba(248,175,33,.1);
    border-radius:8px;pointer-events:none;z-index:3
}
.ib-front .ib-frame{inset:5px}

/* Corner diamond ornaments */
.ib-diamond{
    position:absolute;width:5px;height:5px;
    background:rgba(248,175,33,.2);
    transform:rotate(45deg);
    z-index:4;pointer-events:none
}
.ib-front .ib-diamond.tl{top:10px;left:10px}
.ib-front .ib-diamond.tr{top:10px;right:10px}
.ib-front .ib-diamond.bl{bottom:10px;left:10px}
.ib-front .ib-diamond.br{bottom:10px;right:10px}

.ib-card:hover .ib-front{
    border-color:rgba(248,175,33,.35);
    box-shadow:0 8px 36px rgba(248,175,33,.07),0 4px 18px rgba(2,13,24,.07)
}

/* Card number */
.ib-num{
    position:absolute;top:14px;left:16px;z-index:6;
    font-family:'DM Serif Display',serif;
    font-size:.56rem;color:rgba(248,175,33,.5)
}

/* Tiny ASOG watermark on front */
.ib-front-seal{
    position:absolute;top:11px;right:11px;z-index:6;
    width:13px;height:13px;opacity:.1
}

/* Portrait area */
.ib-portrait{
    width:100%;flex:1;
    display:flex;align-items:center;justify-content:center;
    padding:2rem 1rem .4rem;position:relative;z-index:2
}
.ib-logo-sm{
    width:72px;height:72px;border-radius:50%;
    background:#fff;
    border:2px solid rgba(248,175,33,.14);
    display:flex;align-items:center;justify-content:center;
    overflow:hidden
}
.ib-logo-sm img{max-width:78%;max-height:78%;object-fit:contain}
.ib-init{
    font-family:'DM Serif Display',serif;font-size:1.2rem;
    color:rgba(248,175,33,.55);line-height:1
}

/* Name plate */
.ib-nameplate{
    width:calc(100% - 22px);margin:0 11px;
    background:linear-gradient(180deg,rgba(3,85,140,.035),rgba(3,85,140,.065));
    border-radius:5px;
    border:1px solid rgba(3,85,140,.04);
    padding:.4rem .6rem .3rem;text-align:center;
    position:relative;z-index:2
}
.ib-name{
    font-family:'DM Serif Display',serif;
    font-size:.92rem;line-height:1.18;color:#020d18;margin-bottom:.1rem
}
.ib-cohort{
    font-size:.32rem;font-weight:700;letter-spacing:.22em;
    text-transform:uppercase;color:rgba(248,175,33,.75);display:block
}

/* Flavor text */
.ib-flavor{
    padding:.35rem 1rem .55rem;text-align:center;
    position:relative;z-index:2
}
.ib-desc-sm{
    font-size:.58rem;font-weight:400;
    line-height:1.6;color:rgba(2,13,24,.45);
    display:-webkit-box;-webkit-line-clamp:2;
    -webkit-box-orient:vertical;overflow:hidden
}

/* Bottom ornament */
.ib-ornament{
    width:18px;height:1px;
    background:rgba(248,175,33,.12);
    margin:0 auto .45rem;position:relative;z-index:2
}

/* ═══════════════════════════════════════════════════════
   BACK — ASOG TBI branded card back
   ═══════════════════════════════════════════════════════ */
.ib-back{
    background:#03355a;
    border:2px solid rgba(248,175,33,.22);
    transform:rotateY(180deg);
    display:flex;flex-direction:column;
    align-items:center;justify-content:flex-start;
    padding:0
}
.ib-card:hover .ib-back{
    border-color:rgba(248,175,33,.35)
}

/* Gold frames on back */
.ib-back .ib-frame{inset:5px;border-color:rgba(248,175,33,.12)}
.ib-frame-inner{
    position:absolute;inset:13px;
    border:1px solid rgba(248,175,33,.05);
    border-radius:4px;pointer-events:none;z-index:2
}

/* Corner diamonds on back */
.ib-back .ib-diamond{background:rgba(248,175,33,.22)}
.ib-back .ib-diamond.tl{top:10px;left:10px}
.ib-back .ib-diamond.tr{top:10px;right:10px}
.ib-back .ib-diamond.bl{bottom:10px;left:10px}
.ib-back .ib-diamond.br{bottom:10px;right:10px}

/* Fine grid pattern */
.ib-dots{
    position:absolute;inset:0;z-index:1;pointer-events:none;
    background-image:
        linear-gradient(rgba(248,175,33,.03) 1px,transparent 1px),
        linear-gradient(90deg,rgba(248,175,33,.03) 1px,transparent 1px);
    background-size:18px 18px
}

/* ASOG TBI seal — upper portion */
.ib-seal{
    width:55%;max-width:85px;height:auto;
    opacity:.5;
    position:relative;z-index:2;
    margin-top:auto;
    padding-top:.8rem;
    transition:opacity .3s
}
.ib-card:hover .ib-seal{opacity:.6}

/* Divider */
.ib-back-divider{
    width:28px;height:1px;
    background:rgba(248,175,33,.2);
    margin:.5rem 0 .4rem;
    position:relative;z-index:3;flex-shrink:0
}

/* Company text — lower portion */
.ib-back-name{
    font-family:'DM Serif Display',serif;
    font-size:.62rem;line-height:1.2;color:rgba(255,255,255,.9);
    position:relative;z-index:3;
    text-align:center;width:80%;flex-shrink:0
}
.ib-back-cohort{
    font-size:.26rem;font-weight:700;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(248,175,33,.65);
    position:relative;z-index:3;
    margin-bottom:auto;padding-bottom:.6rem;flex-shrink:0
}

/* ═══════════════════════════════════════════════════════
   OVERLAY
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
    background:rgba(2,13,24,.4);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
    opacity:0;transition:opacity .35s
}
.ib-overlay.is-open .ib-backdrop{opacity:1}

.ib-modal{
    position:relative;z-index:2;
    display:flex;align-items:center;justify-content:center;
    width:100%;height:100%;
    padding-right:480px;
    pointer-events:none
}
@media(max-width:900px){.ib-modal{padding-right:0}}
.ib-overlay.is-open .ib-modal{pointer-events:auto}

/* ═══════════════════════════════════════════════════════
   BIG CARD — enlarged in overlay
   ═══════════════════════════════════════════════════════ */
.ib-big-card{
    width:300px;height:430px;
    perspective:1200px;
    position:relative;opacity:0;
    transform:scale(.7) translateY(30px)
}
@media(min-width:768px){.ib-big-card{width:330px;height:470px}}

.ib-big-inner{
    width:100%;height:100%;
    transform-style:preserve-3d;
    border-radius:16px;
    cursor:pointer;position:relative;
    box-shadow:0 30px 90px rgba(2,13,24,.2)
}
.ib-big-front,.ib-big-back{
    position:absolute;inset:0;
    backface-visibility:hidden;
    -webkit-backface-visibility:hidden;
    border-radius:16px;overflow:hidden
}

/* ── Big front ── */
.ib-big-front{
    background:linear-gradient(178deg,#ffffff 0%,#f6f4ef 100%);
    border:2.5px solid rgba(248,175,33,.22);
    display:flex;flex-direction:column;align-items:center;
    padding:0;z-index:2;
    box-shadow:inset 0 1px 0 rgba(255,255,255,.8)
}
.ib-big-front .ib-frame{inset:7px;border-radius:10px}
.ib-big-front .ib-diamond{width:7px;height:7px;background:rgba(248,175,33,.22)}
.ib-big-front .ib-diamond.tl{top:14px;left:14px}
.ib-big-front .ib-diamond.tr{top:14px;right:14px}
.ib-big-front .ib-diamond.bl{bottom:14px;left:14px}
.ib-big-front .ib-diamond.br{bottom:14px;right:14px}

.ib-bf-num{
    position:absolute;top:18px;left:20px;z-index:6;
    font-family:'DM Serif Display',serif;
    font-size:.65rem;color:rgba(248,175,33,.5)
}
.ib-bf-seal{
    position:absolute;top:16px;right:17px;z-index:6;
    width:20px;height:20px;opacity:.07
}

.ib-bf-portrait{
    width:100%;flex:1;
    display:flex;align-items:center;justify-content:center;
    padding:2.5rem 1.2rem .6rem;position:relative;z-index:2
}
.ib-bf-logo{
    width:80px;height:80px;border-radius:50%;
    background:#fff;
    border:2.5px solid rgba(248,175,33,.16);
    display:flex;align-items:center;justify-content:center;
    overflow:hidden
}
.ib-bf-logo img{max-width:72%;max-height:72%;object-fit:contain}

.ib-bf-nameplate{
    width:calc(100% - 36px);margin:0 18px;
    background:linear-gradient(180deg,rgba(3,85,140,.04),rgba(3,85,140,.075));
    border-radius:7px;
    border:1px solid rgba(3,85,140,.05);
    padding:.55rem .9rem .4rem;text-align:center;
    position:relative;z-index:2
}
.ib-bf-name{
    font-family:'DM Serif Display',serif;
    font-size:1.2rem;line-height:1.18;color:#020d18;margin-bottom:.12rem
}
.ib-bf-cohort{
    font-size:.36rem;font-weight:700;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(248,175,33,.72);display:block
}

.ib-bf-flavor{
    padding:.5rem 1.4rem .5rem;text-align:center;
    position:relative;z-index:2
}
.ib-bf-desc{
    font-size:.68rem;font-weight:400;
    line-height:1.7;color:rgba(2,13,24,.48);
    display:-webkit-box;-webkit-line-clamp:3;
    -webkit-box-orient:vertical;overflow:hidden
}
.ib-bf-ornament{
    width:24px;height:1px;
    background:rgba(248,175,33,.15);
    margin:0 auto .3rem;position:relative;z-index:2
}

.ib-bf-hint{
    font-size:.38rem;font-weight:600;letter-spacing:.15em;
    text-transform:uppercase;color:rgba(2,13,24,.22);
    text-align:center;margin-top:auto;padding-bottom:.7rem;
    display:flex;align-items:center;justify-content:center;gap:5px;
    position:relative;z-index:2
}
.ib-bf-hint svg{opacity:.25}

/* ── Big back — ASOG TBI seal top, company info bottom ── */
.ib-big-back{
    background:#03355a;
    border:2.5px solid rgba(248,175,33,.24);
    transform:rotateY(180deg);
    display:flex;flex-direction:column;
    align-items:center;justify-content:flex-start;
    text-align:center;padding:0
}
.ib-big-back .ib-frame{inset:7px;border-radius:10px;border-color:rgba(248,175,33,.14)}
.ib-big-back .ib-frame-inner{
    position:absolute;inset:17px;
    border:1px solid rgba(248,175,33,.055);
    border-radius:6px;pointer-events:none;z-index:2
}
.ib-big-back .ib-diamond{width:7px;height:7px;background:rgba(248,175,33,.25)}
.ib-big-back .ib-diamond.tl{top:14px;left:14px}
.ib-big-back .ib-diamond.tr{top:14px;right:14px}
.ib-big-back .ib-diamond.bl{bottom:14px;left:14px}
.ib-big-back .ib-diamond.br{bottom:14px;right:14px}

.ib-big-back .ib-dots{
    background-image:
        linear-gradient(rgba(248,175,33,.028) 1px,transparent 1px),
        linear-gradient(90deg,rgba(248,175,33,.028) 1px,transparent 1px);
    background-size:22px 22px
}
/* Big back seal — upper area */
.ib-bb-seal{
    width:120px;height:auto;
    opacity:.5;
    z-index:2;pointer-events:none;
    position:relative;
    margin-top:auto;
    padding-top:1rem
}

.ib-bb-divider{
    width:36px;height:1.5px;border-radius:1px;
    background:rgba(248,175,33,.22);
    margin:.7rem 0 .6rem;
    position:relative;z-index:3;flex-shrink:0
}

.ib-bb-name{
    font-family:'DM Serif Display',serif;
    font-size:1.15rem;line-height:1.2;color:#fff;
    margin-bottom:.25rem;position:relative;z-index:3
}
.ib-bb-founder{
    font-size:.65rem;font-weight:300;color:rgba(255,255,255,.55);
    margin-bottom:.15rem;position:relative;z-index:3
}
.ib-bb-cohort{
    font-size:.4rem;font-weight:600;letter-spacing:.18em;
    text-transform:uppercase;color:rgba(248,175,33,.65);
    position:relative;z-index:3;
    margin-bottom:auto;padding-bottom:.8rem
}
.ib-bb-hint{
    font-size:.34rem;font-weight:600;letter-spacing:.12em;
    text-transform:uppercase;color:rgba(255,255,255,.28);
    position:absolute;bottom:22px;z-index:3
}

/* ═══════════════════════════════════════════════════════
   DETAIL PANEL — right side
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

.ib-close{
    position:absolute;top:16px;right:16px;z-index:5;
    width:36px;height:36px;border-radius:50%;
    border:1px solid rgba(2,13,24,.06);
    background:rgba(248,246,242,.92);
    backdrop-filter:blur(6px);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;color:rgba(2,13,24,.3);
    transition:all .15s
}
.ib-close:hover{color:#020d18;border-color:rgba(2,13,24,.18)}

.ib-p-head{
    display:flex;align-items:flex-start;gap:14px;
    padding:2rem 2rem 1.3rem;
    padding-right:3.5rem;
    border-bottom:1px solid rgba(2,13,24,.04)
}
.ib-p-logo{
    width:48px;height:48px;flex-shrink:0;
    border-radius:12px;
    border:1px solid rgba(2,13,24,.05);
    background:#F8F6F2;
    display:flex;align-items:center;justify-content:center;
    overflow:hidden
}
.ib-p-logo img{width:100%;height:100%;object-fit:contain;padding:5px}
.ib-p-meta{min-width:0;flex:1}
.ib-p-cohort{
    font-size:.44rem;font-weight:700;letter-spacing:.2em;
    text-transform:uppercase;color:rgba(248,175,33,.55);
    margin-bottom:3px;display:block
}
.ib-p-name{
    font-family:'DM Serif Display',serif;
    font-size:1.3rem;line-height:1.15;color:#020d18;margin-bottom:3px
}
.ib-p-founder{font-size:.7rem;font-weight:400;color:rgba(2,13,24,.28)}

.ib-p-body{padding:1.4rem 2rem;flex:1;overflow-y:auto}
.ib-p-short{
    font-size:.82rem;font-weight:300;line-height:1.85;
    color:rgba(2,13,24,.5);margin-bottom:1.2rem
}
.ib-p-content{
    font-size:.78rem;font-weight:300;line-height:1.9;color:rgba(2,13,24,.38)
}
.ib-p-content p{margin-bottom:.8rem}
.ib-p-content p:last-child{margin-bottom:0}

.ib-p-foot{
    padding:1rem 2rem 1.4rem;
    border-top:1px solid rgba(2,13,24,.04);
    display:flex;align-items:center;gap:1rem;flex-wrap:wrap
}
.ib-p-link{
    display:inline-flex;align-items:center;gap:6px;
    font-size:.52rem;font-weight:700;letter-spacing:.14em;
    text-transform:uppercase;color:#e8a900;
    text-decoration:none;transition:gap .2s,color .2s
}
.ib-p-link:hover{gap:12px;color:#F8AF21}
.ib-p-web{
    font-size:.5rem;font-weight:500;
    color:rgba(2,13,24,.3);text-decoration:none;transition:color .2s
}
.ib-p-web:hover{color:rgba(2,13,24,.55)}

/* ═══════════════════════════════════════════════════════
   FOOTER
   ═══════════════════════════════════════════════════════ */
.ib-foot{
    display:flex;flex-direction:column;gap:.6rem;
    align-items:flex-start;margin-top:2.5rem
}
@media(min-width:640px){.ib-foot{flex-direction:row;align-items:center;justify-content:space-between}}
.ib-count{font-size:.76rem;font-weight:300;color:rgba(2,13,24,.28)}
.ib-apply{
    font-size:.52rem;font-weight:600;letter-spacing:.14em;
    text-transform:uppercase;color:rgba(248,175,33,.5);
    text-decoration:none;border-bottom:1px solid rgba(248,175,33,.15);
    padding-bottom:2px;transition:color .2s,border-color .2s
}
.ib-apply:hover{color:#F8AF21;border-color:rgba(248,175,33,.35)}

/* ═══════════════════════════════════════════════════════
   EMPTY STATE
   ═══════════════════════════════════════════════════════ */
.ib-empty{
    border:1px solid rgba(2,13,24,.06);border-radius:16px;
    background:#fff;padding:3.5rem 2rem;text-align:center;margin-bottom:2rem
}
.ib-empty-icon{
    width:56px;height:56px;margin:0 auto 1.2rem;border-radius:50%;
    border:1px solid rgba(2,13,24,.06);background:#F8F6F2;
    display:flex;align-items:center;justify-content:center
}
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

                <!-- ▸ Front — collectible card face -->
                <div class="ib-front">
                    <div class="ib-frame"></div>
                    <div class="ib-diamond tl"></div>
                    <div class="ib-diamond tr"></div>
                    <div class="ib-diamond bl"></div>
                    <div class="ib-diamond br"></div>
                    <span class="ib-num"><?= $num ?></span>
                    <img class="ib-front-seal" src="<?= $sealUrl ?>" alt="">
                    <div class="ib-portrait">
                        <div class="ib-logo-sm">
                            <?php if (! empty($inc['logoPath'])): ?>
                                <img src="<?= base_url(esc($inc['logoPath'])) ?>" alt="<?= esc($inc['companyName']) ?>">
                            <?php else: ?>
                                <span class="ib-init"><?= strtoupper(substr($inc['companyName'], 0, 1)) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ib-nameplate">
                        <h3 class="ib-name"><?= esc($inc['companyName']) ?></h3>
                        <?php if (! empty($inc['cohort'])): ?>
                            <span class="ib-cohort"><?= esc($inc['cohort']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="ib-flavor">
                        <?php if (! empty($inc['shortDescription'])): ?>
                            <p class="ib-desc-sm"><?= esc($inc['shortDescription']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="ib-ornament"></div>
                </div>

                <!-- ▸ Back — ASOG TBI seal top, company info bottom -->
                <div class="ib-back">
                    <div class="ib-frame"></div>
                    <div class="ib-frame-inner"></div>
                    <div class="ib-diamond tl"></div>
                    <div class="ib-diamond tr"></div>
                    <div class="ib-diamond bl"></div>
                    <div class="ib-diamond br"></div>
                    <div class="ib-dots"></div>
                    <img class="ib-seal" src="<?= $sealUrl ?>" alt="ASOG TBI">
                    <div class="ib-back-divider"></div>
                    <p class="ib-back-name"><?= esc($inc['companyName']) ?></p>
                    <span class="ib-back-cohort"><?= esc($inc['cohort'] ?? '') ?></span>
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

                <!-- ▸ Big Front -->
                <div class="ib-big-front" id="ibBigFront">
                    <div class="ib-frame"></div>
                    <div class="ib-diamond tl"></div>
                    <div class="ib-diamond tr"></div>
                    <div class="ib-diamond bl"></div>
                    <div class="ib-diamond br"></div>
                    <span id="bfNum" class="ib-bf-num"></span>
                    <img class="ib-bf-seal" src="<?= $sealUrl ?>" alt="">
                    <div class="ib-bf-portrait">
                        <div id="bfLogo" class="ib-bf-logo"></div>
                    </div>
                    <div class="ib-bf-nameplate">
                        <h3 id="bfName" class="ib-bf-name"></h3>
                        <span id="bfCohort" class="ib-bf-cohort"></span>
                    </div>
                    <div class="ib-bf-flavor">
                        <p id="bfDesc" class="ib-bf-desc"></p>
                    </div>
                    <div class="ib-bf-ornament"></div>
                    <span class="ib-bf-hint">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/></svg>
                        Click to flip
                    </span>
                </div>

                <!-- ▸ Big Back — ASOG TBI seal top, company info bottom -->
                <div class="ib-big-back" id="ibBigBack">
                    <div class="ib-frame"></div>
                    <div class="ib-frame-inner"></div>
                    <div class="ib-diamond tl"></div>
                    <div class="ib-diamond tr"></div>
                    <div class="ib-diamond bl"></div>
                    <div class="ib-diamond br"></div>
                    <div class="ib-dots"></div>
                    <img class="ib-bb-seal" src="<?= $sealUrl ?>" alt="ASOG TBI">
                    <div class="ib-bb-divider"></div>
                    <p id="bbName" class="ib-bb-name"></p>
                    <p id="bbFounder" class="ib-bb-founder"></p>
                    <span id="bbCohort" class="ib-bb-cohort"></span>
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

    /* ══ Entrance animation — deal cards in ══ */
    gsap.from('.ib-card', {
        opacity:0, y:35, scale:.92,
        duration:.45, stagger:.07,
        ease:'power2.out', delay:.15
    });

    /* ══ Card hover — 3D tilt + shimmer ══ */
    cards.forEach(function(card){
        var inner = card.querySelector('.ib-inner');

        card.addEventListener('mousemove', function(e){
            if(isOpen) return;
            var rect = card.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            var cx = rect.width / 2;
            var cy = rect.height / 2;
            var ry = ((x - cx) / cx) * 8;
            var rx = ((cy - y) / cy) * 6;
            gsap.to(inner,{
                rotateX:rx, rotateY:ry, y:-6,
                boxShadow:'0 16px 40px rgba(2,13,24,.1)',
                duration:.3, ease:'power2.out'
            });
        });

        card.addEventListener('mouseleave', function(){
            gsap.to(inner,{
                rotateX:0, rotateY:0, y:0,
                boxShadow:'0 2px 8px rgba(2,13,24,.03)',
                duration:.35, ease:'power2.in'
            });
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

        /* Dim the stack */
        stack.classList.add('has-active');
        card.classList.add('is-picked');

        /* Reset card tilt */
        var inner = card.querySelector('.ib-inner');
        gsap.set(inner, { rotateX:0, rotateY:0 });

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
        gsap.to(panel, {
            x:'100%',
            duration:.3, ease:'power2.in'
        });
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
