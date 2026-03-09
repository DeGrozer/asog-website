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

    <div class="ib-p-foot flex items-center flex-wrap" style="gap:1rem">
        <a href="<?= site_url('incubatees') ?>" class="ib-p-link inline-flex items-center">View all incubatees <span>→</span></a>
        <a id="pWebsite" href="#" target="_blank" rel="noopener" class="ib-p-web" style="display:none">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:-2px;margin-right:3px"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10A15.3 15.3 0 0 1 12 2z"/></svg>
            Website ↗
        </a>
        <a id="pFacebook" href="#" target="_blank" rel="noopener" class="ib-p-web" style="display:none">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" style="display:inline;vertical-align:-2px;margin-right:3px"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            Facebook ↗
        </a>
    </div>
</div>
