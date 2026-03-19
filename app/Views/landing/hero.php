<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  SECTION: HERO                                                       ║
     ║  Full-screen slideshow — slides built from published posts with      ║
     ║  a cover image. Shows title, description & "Read Article" per slide. ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<?php
$heroSlides = $heroSlides ?? [];
$hasSlides  = ! empty($heroSlides);
$dotCount   = $hasSlides ? count($heroSlides) : 3;
?>
<section id="hero" class="relative w-full h-screen min-h-[680px] overflow-hidden" data-navhint="dark">

    <!-- ── Background Slides ──────────────────────────────────── -->
    <?php if ($hasSlides): ?>
    <?php foreach ($heroSlides as $i => $s): ?>
    <div class="slide slide-post slide-idx-<?= $i ?> <?= $i === 0 ? 'active' : '' ?>"
        style="background-image:url('<?= base_url(esc($s['imagePath'])) ?>');">
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="slide sl1 active"></div>
    <div class="slide sl2"></div>
    <div class="slide sl3"></div>
    <?php endif; ?>

    <!-- ── Overlay: heavy bottom + left fade so text is always readable ── -->
    <div class="absolute inset-0 z-[2]"
        style="background:
            linear-gradient(to bottom, rgba(2,13,24,.99) 0%, rgba(2,13,24,.90) 10%, rgba(2,13,24,.74) 18%, rgba(2,13,24,.48) 30%, rgba(2,13,24,.22) 42%, rgba(2,13,24,0) 58%),
            linear-gradient(to top, rgba(2,13,24,.96) 0%, rgba(2,13,24,.76) 19%, rgba(2,13,24,.50) 42%, rgba(2,13,24,.14) 72%, transparent 100%),
            linear-gradient(to top, rgba(2,13,24,.92) 0%, rgba(2,13,24,0) 45%)">
    </div>

    <!-- ── Content: pinned to bottom-left ────────────────────── -->
    <div class="absolute bottom-0 left-0 z-[3] px-8 md:px-14 lg:px-20 pb-8 md:pb-12 w-full max-w-[960px]">

        <!-- Gold accent rule -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-[2px] bg-gold shrink-0"></div>
            <span class="text-[.56rem] font-bold tracking-[.28em] uppercase text-gold/80">
                <?= $hasSlides ? 'Featured Story' : 'Bicol Region\'s Premier Incubator' ?>
            </span>
        </div>

        <!-- ── Headline stack ── -->
        <div id="heroTitleWrap" class="relative min-h-[10px] md:min-h-[50px] mb-4">
            <?php if ($hasSlides): ?>
            <?php foreach ($heroSlides as $i => $s): ?>
            <h1
                class="hl <?= $i === 0 ? 'active' : '' ?> font-display text-[clamp(1.6rem,2.8vw,2.8rem)] leading-[1.18] text-off max-w-[720px]">
                <?= esc($s['title']) ?>
            </h1>
            <?php endforeach; ?>
            <?php else: ?>
            <h1 class="hl active font-display text-[clamp(1.6rem,2.8vw,2.8rem)] leading-[1.18] text-off max-w-[720px]">
                Empowering Startups Through <em class="italic text-gold">Cutting-Edge</em> Technology</h1>
            <h1 class="hl font-display text-[clamp(1.6rem,2.8vw,2.8rem)] leading-[1.18] text-off max-w-[720px]">
                Engineering &amp; <em class="italic text-gold">AI-Driven Innovations</em> for the Food Value Chain</h1>
            <h1 class="hl font-display text-[clamp(1.6rem,2.8vw,2.8rem)] leading-[1.18] text-off max-w-[720px]">
                From <em class="italic text-gold">Concept</em> to Market-Ready Solutions</h1>
            <?php endif; ?>
        </div>

        <!-- ── CTA + Dots (stacked vertically) ── -->
        <div class="flex flex-col gap-4 mt-3">
            <!-- Read Article links (one per slide, stack-animated) -->
            <?php if ($hasSlides): ?>
            <div class="relative h-7 w-40">
                <?php foreach ($heroSlides as $i => $s): ?>
                <a href="<?= site_url('news/' . esc($s['slug'])) ?>"
                    class="hl-link <?= $i === 0 ? 'active' : '' ?> flex items-center gap-2 text-[.62rem] font-bold tracking-[.2em] uppercase text-gold no-underline whitespace-nowrap hover:gap-3 transition-all">
                    Read Article <span aria-hidden="true">→</span>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Dots — below the CTA -->
            <div class="flex items-center gap-2.5">
                <?php for ($d = 0; $d < $dotCount; $d++): ?>
                <button class="ind <?= $d === 0 ? 'active' : '' ?> border-none p-0 cursor-pointer"
                    onclick="goTo(<?= $d ?>)"></button>
                <?php endfor; ?>
            </div>
        </div>

    </div><!-- /content -->
</section>

