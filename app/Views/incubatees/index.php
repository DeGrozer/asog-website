<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — Showcase Page                                          ║
     ║  Polished card grid + slide-in detail panel                          ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<?php
$incubatees     = $incubatees ?? [];
$hasIncubatees  = ! empty($incubatees);
?>
<style>
    /* ── Incubatee card grid ── */
    .inc-grid{display:grid;grid-template-columns:1fr;gap:16px;margin-bottom:3rem}
    @media(min-width:640px){.inc-grid{grid-template-columns:repeat(2,1fr)}}
    @media(min-width:1024px){.inc-grid{grid-template-columns:repeat(3,1fr)}}

    .inc-card{background:#fff;border:1px solid rgba(2,13,24,.06);border-radius:.55rem;padding:1.6rem 1.5rem;text-align:left;cursor:pointer;transition:all .2s;position:relative}
    .inc-card:hover{border-color:rgba(2,13,24,.12);box-shadow:0 6px 28px rgba(2,13,24,.06)}
    .inc-card:hover .ic-name{color:#03558C}
    .inc-card:hover .ic-arrow{color:#F8AF21}
    .inc-card:hover .ic-arrow span{transform:translateX(3px)}

    .ic-logo{width:48px;height:48px;border-radius:.5rem;border:1px solid rgba(2,13,24,.06);background:#F8F6F2;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;overflow:hidden}
    .ic-logo img{width:100%;height:100%;object-fit:contain;padding:6px}
    .ic-initial{font-family:'DM Serif Display',serif;font-size:1.2rem;line-height:1;color:rgba(248,175,33,.55);user-select:none}
    .ic-name{font-family:'DM Serif Display',serif;font-size:1rem;color:#020d18;line-height:1.2;margin-bottom:4px;transition:color .2s}
    .ic-cohort{font-size:.5rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(248,175,33,.5);margin-bottom:.75rem;display:block}
    .ic-desc{font-size:.76rem;font-weight:300;line-height:1.75;color:rgba(2,13,24,.35);display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
    .ic-arrow{display:inline-flex;align-items:center;gap:4px;font-size:.56rem;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:rgba(3,85,140,.2);margin-top:1rem;transition:color .2s}
    .ic-arrow span{transition:transform .2s;display:inline-block}

    /* ── Modal overlay ── */
    .inc-overlay{position:fixed;inset:0;z-index:999;visibility:hidden;opacity:0;transition:opacity .3s,visibility 0s .3s}
    .inc-overlay.is-open{visibility:visible;opacity:1;transition:opacity .3s,visibility 0s 0s}
    .inc-backdrop{position:absolute;inset:0;background:rgba(2,13,24,.45);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
    .inc-panel{position:absolute;top:0;right:0;bottom:0;width:100%;max-width:560px;background:#fff;box-shadow:-8px 0 40px rgba(0,0,0,.1);transform:translateX(100%);transition:transform .35s cubic-bezier(.22,1,.36,1);overflow-y:auto}
    .inc-overlay.is-open .inc-panel{transform:translateX(0)}
    @media(max-width:600px){.inc-panel{max-width:100%}}

    .inc-panel-close{position:sticky;top:0;z-index:10;float:right;margin:16px 16px 0 0;width:36px;height:36px;border-radius:50%;border:1px solid rgba(2,13,24,.08);background:rgba(248,246,242,.9);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;cursor:pointer;color:rgba(2,13,24,.35);transition:all .15s}
    .inc-panel-close:hover{color:#020d18;border-color:rgba(2,13,24,.2)}

    .inc-panel-head{display:flex;align-items:flex-start;gap:16px;padding:2rem 2.2rem 1.5rem;border-bottom:1px solid rgba(2,13,24,.05);clear:both}
    .inc-panel-logo{width:52px;height:52px;flex-shrink:0;border-radius:.5rem;border:1px solid rgba(2,13,24,.06);background:#F8F6F2;display:flex;align-items:center;justify-content:center;overflow:hidden}
    .inc-panel-logo img{width:100%;height:100%;object-fit:contain;padding:6px}
    .inc-panel-meta{min-width:0}
    .inc-panel-cohort{font-size:.5rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(248,175,33,.6);margin-bottom:4px;display:block}
    .inc-panel-name{font-family:'DM Serif Display',serif;font-size:1.45rem;line-height:1.15;color:#020d18;margin-bottom:4px}
    .inc-panel-founder{font-size:.74rem;font-weight:500;color:rgba(2,13,24,.3)}

    .inc-panel-body{padding:1.8rem 2.2rem}
    .inc-panel-short{font-size:.85rem;font-weight:300;line-height:1.85;color:rgba(2,13,24,.5);margin-bottom:1.5rem}
    .inc-panel-content{font-size:.82rem;font-weight:300;line-height:1.9;color:rgba(2,13,24,.4)}
    .inc-panel-content p{margin-bottom:1rem}
    .inc-panel-content p:last-child{margin-bottom:0}

    .inc-panel-foot{padding:0 2.2rem 2rem}
    .inc-panel-link{display:none;align-items:center;gap:8px;font-size:.6rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:#F8AF21;text-decoration:none;border-top:1px solid rgba(2,13,24,.05);padding-top:1.2rem;transition:gap .2s}
    .inc-panel-link:hover{gap:14px}
    .inc-panel-link.show{display:inline-flex}
</style>

<!-- ── Grid Section ── -->
<section class="relative bg-off py-20 md:py-28 px-6 md:px-10 lg:px-14 overflow-hidden">
    <div class="ai-grid"></div>
    <div class="ai-grid-fade"></div>

    <div class="max-w-[1100px] mx-auto relative z-[2]">
        <!-- Intro -->
        <div style="max-width:560px" class="mb-14 md:mb-16">
            <div class="flex items-center gap-2 mb-4">
                <span class="block w-5 h-[1.5px] bg-navy"></span>
                <span class="text-[.56rem] font-semibold tracking-[.22em] uppercase text-navy">Portfolio</span>
            </div>
            <h2 class="font-display text-[1.8rem] md:text-[2.3rem] leading-[1.1] text-dark mb-4">
                Our Incubatees
            </h2>
            <p style="font-size:.85rem;font-weight:300;line-height:1.9;color:rgba(2,13,24,.45)">
                Startups and MSMEs in the ASOG-TBI program — building solutions across the food value chain through engineering and AI.
            </p>
        </div>

        <?php if ($hasIncubatees): ?>
        <!-- Cards -->
        <div class="inc-grid">
            <?php foreach ($incubatees as $i => $inc): ?>
            <button type="button" class="inc-card" onclick="openIncPanel(<?= $i ?>)">
                <div class="ic-logo">
                    <?php if (! empty($inc['logoPath'])): ?>
                        <img src="<?= base_url(esc($inc['logoPath'])) ?>" alt="<?= esc($inc['companyName']) ?>">
                    <?php else: ?>
                        <span class="ic-initial"><?= strtoupper(substr($inc['companyName'], 0, 1)) ?></span>
                    <?php endif; ?>
                </div>
                <h3 class="ic-name"><?= esc($inc['companyName']) ?></h3>
                <?php if (! empty($inc['cohort'])): ?>
                    <span class="ic-cohort"><?= esc($inc['cohort']) ?></span>
                <?php else: ?>
                    <span style="margin-bottom:.75rem;display:block"></span>
                <?php endif; ?>
                <?php if (! empty($inc['shortDescription'])): ?>
                    <p class="ic-desc"><?= esc($inc['shortDescription']) ?></p>
                <?php endif; ?>
                <span class="ic-arrow">Learn more <span>→</span></span>
            </button>
            <?php endforeach; ?>
        </div>

        <?php else: ?>
        <!-- Empty State -->
        <div style="border:1px solid rgba(2,13,24,.06);border-radius:.55rem;background:#fff;padding:3.5rem 2rem;text-align:center;margin-bottom:3rem">
            <div style="width:56px;height:56px;margin:0 auto 1.2rem;border-radius:.5rem;border:1px solid rgba(2,13,24,.06);background:#F8F6F2;display:flex;align-items:center;justify-content:center">
                <svg style="width:24px;height:24px;color:rgba(2,13,24,.15)" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </div>
            <h3 class="font-display" style="font-size:1.2rem;color:#020d18;margin-bottom:.5rem">Incubatees Coming Soon</h3>
            <p style="font-size:.82rem;font-weight:300;line-height:1.8;color:rgba(2,13,24,.4);max-width:380px;margin:0 auto 1.5rem">
                Our first cohort of incubatees will be featured here once the program kicks off.
            </p>
            <a href="<?= site_url('incubatees/apply') ?>"
               style="display:inline-flex;align-items:center;gap:8px;font-size:.6rem;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:#F8AF21;text-decoration:none">
                Apply to the Program <span>→</span>
            </a>
        </div>
        <?php endif; ?>

        <!-- Bottom CTA -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <p style="font-size:.76rem;font-weight:300;color:rgba(2,13,24,.3)">
                <?php if ($hasIncubatees): ?>
                    <?= count($incubatees) ?> incubatee<?= count($incubatees) !== 1 ? 's' : '' ?> in the program
                <?php else: ?>
                    Interested in joining ASOG-TBI?
                <?php endif; ?>
            </p>
            <a href="<?= site_url('incubatees/apply') ?>"
               style="font-size:.58rem;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:rgba(3,85,140,.35);text-decoration:none;border-bottom:1px solid rgba(3,85,140,.1);padding-bottom:2px;transition:all .2s">
                Become an Incubatee
            </a>
        </div>
    </div>
</section>

<?php if ($hasIncubatees): ?>
<!-- ══════════════════════════════════════════════════════════════════════
     DETAIL PANEL — Slides in from right
     ══════════════════════════════════════════════════════════════════════ -->
<div id="incOverlay" class="inc-overlay" role="dialog" aria-hidden="true">
    <div class="inc-backdrop" onclick="closeIncPanel()"></div>
    <div id="incPanel" class="inc-panel">
        <!-- Close -->
        <button class="inc-panel-close" onclick="closeIncPanel()">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Header -->
        <div class="inc-panel-head">
            <div id="pLogo" class="inc-panel-logo"></div>
            <div class="inc-panel-meta">
                <span id="pCohort" class="inc-panel-cohort"></span>
                <h2 id="pName" class="inc-panel-name"></h2>
                <p id="pFounder" class="inc-panel-founder"></p>
            </div>
        </div>

        <!-- Body -->
        <div class="inc-panel-body">
            <p id="pShort" class="inc-panel-short"></p>
            <div id="pContent" class="inc-panel-content"></div>
        </div>

        <!-- Footer -->
        <div class="inc-panel-foot">
            <a id="pWebsite" href="#" target="_blank" rel="noopener" class="inc-panel-link">
                Visit Website <span>→</span>
            </a>
        </div>
    </div>
</div>

<script>
(function(){
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

    var overlay = document.getElementById('incOverlay');
    var panel   = document.getElementById('incPanel');
    var eName   = document.getElementById('pName');
    var eLogo   = document.getElementById('pLogo');
    var eCohort = document.getElementById('pCohort');
    var eFounder= document.getElementById('pFounder');
    var eShort  = document.getElementById('pShort');
    var eContent= document.getElementById('pContent');
    var eWebsite= document.getElementById('pWebsite');

    window.openIncPanel = function(idx){
        var d = data[idx];
        if(!d) return;

        if(d.logoPath){
            eLogo.innerHTML = '<img src="'+d.logoPath+'" alt="'+d.companyName+'">';
        } else {
            eLogo.innerHTML = '<span class="ic-initial" style="font-size:1.4rem">'+d.companyName.charAt(0).toUpperCase()+'</span>';
        }

        eName.textContent    = d.companyName;
        eCohort.textContent  = d.cohort;
        eFounder.textContent = d.founderName ? 'by ' + d.founderName : '';
        eShort.textContent   = d.shortDescription;
        eContent.innerHTML   = d.content || '';

        if(d.websiteUrl){
            eWebsite.href = d.websiteUrl;
            eWebsite.className = 'inc-panel-link show';
        } else {
            eWebsite.className = 'inc-panel-link';
        }

        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden','false');
        panel.scrollTop = 0;
        document.body.style.overflow = 'hidden';
    };

    window.closeIncPanel = function(){
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden','true');
        document.body.style.overflow = '';
    };

    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && overlay.classList.contains('is-open')) closeIncPanel();
    });
})();
</script>
<?php endif; ?>
