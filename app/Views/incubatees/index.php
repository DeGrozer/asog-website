<!-- ╔══════════════════════════════════════════════════════════════╗
     ║  INCUBATEES — Collectible Card Showcase                      ║
     ╚══════════════════════════════════════════════════════════════╝ -->
<?php
$incubatees    = $incubatees ?? [];
$hasIncubatees = ! empty($incubatees);
$count         = count($incubatees);
$sealUrl       = base_url('assets/img/ASOG%20TBI/PNG/Logo-white.png');
?>

<link rel="stylesheet" href="<?= base_url('assets/css/incubatees.css') ?>">

<!-- Section -->
<section class="ib-s relative min-h-screen py-20 pb-16">
    <div class="ib-w mx-auto px-6 md:px-10 lg:px-14">

        <!-- Header -->
        <div class="flex items-center gap-2 mb-3">
            <span class="ib-rule block"></span>
            <span class="ib-tag">Portfolio</span>
        </div>
        <div class="mb-12">
            <h2 class="ib-title m-0 mb-2">Our <em>Incubatees</em></h2>
            <p class="ib-sub m-0">Startups and MSMEs in the ASOG-TBI program — building solutions across the food value chain through engineering and AI.</p>
        </div>

        <?php if ($hasIncubatees): ?>
            <?= view('incubatees/partials/_cards', ['incubatees' => $incubatees, 'sealUrl' => $sealUrl]) ?>
        <?php else: ?>
            <?= view('incubatees/partials/_empty') ?>
        <?php endif; ?>

        <!-- Footer -->
        <div class="flex flex-col gap-2.5 items-start mt-10 sm:flex-row sm:items-center sm:justify-between">
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
    <?= view('incubatees/partials/_overlay', ['sealUrl' => $sealUrl]) ?>
    <?= view('incubatees/partials/_panel') ?>

    <!-- Data + Scripts -->
    <script>
    window.__ibData = <?= json_encode(array_map(function($inc){
        return [
            'companyName'      => html_entity_decode($inc['companyName'] ?? '', ENT_QUOTES, 'UTF-8'),
            'founderName'      => html_entity_decode($inc['founderName'] ?? '', ENT_QUOTES, 'UTF-8'),
            'shortDescription' => html_entity_decode($inc['shortDescription'] ?? '', ENT_QUOTES, 'UTF-8'),
            'content'          => $inc['content'] ?? '',
            'logoPath'         => ! empty($inc['logoPath']) ? base_url($inc['logoPath']) : '',
            'logoWhitePath'    => ! empty($inc['logoWhitePath']) ? base_url($inc['logoWhitePath']) : '',
            'websiteUrl'       => html_entity_decode($inc['websiteUrl'] ?? '', ENT_QUOTES, 'UTF-8'),
            'facebookUrl'      => html_entity_decode($inc['facebookUrl'] ?? '', ENT_QUOTES, 'UTF-8'),
            'cohort'           => html_entity_decode($inc['cohort'] ?? '', ENT_QUOTES, 'UTF-8'),
            'teamMembers'      => ! empty($inc['teamMembers']) ? json_decode($inc['teamMembers'], true) : [],
        ];
    }, $incubatees), JSON_HEX_TAG | JSON_HEX_APOS) ?>;
    </script>
    <script src="<?= base_url('assets/js/incubatees.js') ?>"></script>
<?php endif; ?>