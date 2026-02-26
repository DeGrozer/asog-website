<!-- ╔══════════════════════════════════════════════════════════════════════╗
     ║  REUSABLE TABLE OF CONTENTS — Wikipedia-style sticky sidebar       ║
     ║  Pass $tocTitle (string) and $tocItems (array) to this partial     ║
     ║  Each $tocItems entry: ['id'=>'anchor','label'=>'Text',            ║
     ║    'children'=>[['id'=>..,'label'=>..]] ]                          ║
     ╚══════════════════════════════════════════════════════════════════════╝ -->
<?php
    $tocTitle = $tocTitle ?? 'Contents';
    $tocItems = $tocItems ?? [];
?>
<nav class="toc-sidebar h-full" aria-label="Table of Contents">
    <!-- Mobile TOC toggle -->
    <button id="tocToggle" class="lg:hidden flex items-center justify-between w-full bg-white border border-dark/[.08] rounded-lg px-4 py-3 mb-4 text-[.72rem] font-semibold tracking-[.1em] uppercase text-dark/50 transition-colors hover:text-gold" aria-expanded="false" aria-controls="tocList">
        <span class="flex items-center gap-2">
            <svg class="w-3.5 h-3.5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10"/></svg>
            <?= esc($tocTitle) ?>
        </span>
        <svg id="tocChevron" class="w-3.5 h-3.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
    </button>

    <!-- TOC list -->
    <div id="tocList" class="hidden lg:block lg:sticky lg:top-28">
        <div class="bg-white border border-dark/[.08] rounded-lg p-5 lg:p-6">
            <!-- Title bar -->
            <div class="flex items-center gap-2 mb-4 pb-3 border-b border-dark/[.06]">
                <span class="block w-3 h-[2px] bg-gold rounded"></span>
                <span class="text-[.6rem] font-bold tracking-[.18em] uppercase text-dark/40"><?= esc($tocTitle) ?></span>
            </div>

            <ol class="toc-list space-y-0.5 list-none pl-0 m-0">
                <?php foreach ($tocItems as $i => $item): ?>
                    <li>
                        <a href="#<?= esc($item['id']) ?>"
                           class="toc-link flex items-baseline gap-2 py-1.5 text-[.78rem] font-normal text-dark/45 no-underline rounded-sm px-2 -mx-2 transition-all duration-200 hover:text-gold hover:bg-gold/[.04]"
                           data-toc-target="<?= esc($item['id']) ?>">
                            <span class="text-[.6rem] font-semibold text-dark/20 tabular-nums shrink-0"><?= $i + 1 ?></span>
                            <span><?= esc($item['label']) ?></span>
                        </a>
                        <?php if (! empty($item['children'])): ?>
                            <ol class="toc-children space-y-0.5 list-none pl-5 m-0">
                                <?php foreach ($item['children'] as $j => $child): ?>
                                    <li>
                                        <a href="#<?= esc($child['id']) ?>"
                                           class="toc-link flex items-baseline gap-2 py-1 text-[.72rem] font-normal text-dark/35 no-underline rounded-sm px-2 -mx-2 transition-all duration-200 hover:text-gold hover:bg-gold/[.04]"
                                           data-toc-target="<?= esc($child['id']) ?>">
                                            <span class="text-[.55rem] font-medium text-dark/15 tabular-nums shrink-0"><?= ($i + 1) ?>.<?= ($j + 1) ?></span>
                                            <span><?= esc($child['label']) ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</nav>
