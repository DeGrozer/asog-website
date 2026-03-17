<!-- Detail Panel — slides in from right -->
<div id="ibPanel" class="ib-panel fixed top-0 right-0 bottom-0 w-full flex flex-col overflow-hidden">
    <button class="ib-close absolute flex items-center justify-center cursor-pointer" id="ibClose" aria-label="Close">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <div class="ib-p-body flex-1 overflow-y-auto">
        <h3 id="pAboutTitle" class="ib-p-about-title"></h3>
        <div id="pContent" class="ib-p-content"></div>

        <div class="ib-p-divider" aria-hidden="true"></div>

        <div id="pTeamSection" class="ib-p-team-wrap" style="display:none">
            <span class="ib-p-team-label">Founders</span>
            <div id="pTeamList" class="ib-p-team-grid"></div>
        </div>

        <div id="pContactSection" class="ib-p-contact-wrap" style="display:none">
            <span class="ib-p-contact-label">Contact Details</span>
            <div id="pContactList" class="ib-p-contact-grid"></div>
        </div>
    </div>

    <div class="ib-p-foot flex items-center flex-wrap" style="gap:.8rem">
        <a id="pWebsite" href="#" target="_blank" rel="noopener" class="ib-p-social" style="display:none">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10A15.3 15.3 0 0 1 12 2z"/></svg>
            <span>Website</span>
        </a>
        <a id="pFacebook" href="#" target="_blank" rel="noopener" class="ib-p-social" style="display:none">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            <span>Facebook</span>
        </a>
    </div>
</div>
