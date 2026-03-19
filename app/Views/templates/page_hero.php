<!-- 
     ╔══════════════════════════════════════════════════════════════════════╗
     ║  REUSABLE PAGE HERO — pass $heroSubtitle, $heroTitle, $heroDesc      ║
     ╚══════════════════════════════════════════════════════════════════════╝ 
-->
<?php
    $heroBgClass = $heroBg ?? 'bg-dark';
    $defaultNavHint = str_contains($heroBgClass, 'bg-navy') ? 'blue' : 'dark';
    $navHint = $heroNavHint ?? $defaultNavHint;
?>
<section class="<?= esc($heroBgClass) ?> pt-[88px] pb-12 md:pt-32 md:pb-16" data-navhint="<?= esc($navHint) ?>">
    <div class="max-w-[1100px] mx-auto px-6 md:px-10 text-center">
        <h1 class="font-display text-3xl md:text-5xl text-off leading-tight"><?= esc($heroTitle ?? '') ?></h1>
    </div>
</section>