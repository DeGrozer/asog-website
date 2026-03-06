<!-- Detail Panel — slides in from right -->
<div id="ibPanel" class="ib-panel fixed top-0 right-0 bottom-0 w-full flex flex-col overflow-hidden">
    <button class="ib-close absolute rounded-full flex items-center justify-center cursor-pointer" id="ibClose">
        <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <div class="ib-p-head flex flex-col">
        <span class="ib-p-about-label block">About</span>
        <div class="ib-p-meta min-w-0 flex-1">
            <span id="pCohort" class="ib-p-cohort block"></span>
            <h2 id="pName" class="ib-p-name"></h2>
            <p id="pFounder" class="ib-p-founder"></p>
        </div>
    </div>

    <div class="ib-p-body flex-1 overflow-y-auto">
        <p id="pShort" class="ib-p-short"></p>
        <div id="pContent" class="ib-p-content"></div>
    </div>

    <div class="ib-p-foot flex items-center flex-wrap">
        <a href="<?= site_url('incubatees') ?>" class="ib-p-link inline-flex items-center">View all incubatees <span>→</span></a>
        <a id="pWeb" href="#" target="_blank" rel="noopener" class="ib-p-web hidden">Website ↗</a>
    </div>
</div>
