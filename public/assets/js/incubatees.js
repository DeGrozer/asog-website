/**
 * Incubatees Showcase — Card Interactions
 * Requires: GSAP 3.12+, window.__ibData (injected by PHP view)
 */
(function () {
    'use strict';

    var data = window.__ibData;
    if (!data || !data.length) return;

    /* ── DOM refs ── */
    var $    = function (id) { return document.getElementById(id); };
    var stack    = $('ibStack'),
        overlay  = $('ibOverlay'),
        backdrop = $('ibBackdrop'),
        bigCard  = $('ibBigCard'),
        bigInner = $('ibBigInner'),
        panel    = $('ibPanel'),
        closeBtn = $('ibClose');

    var bfNum     = $('bfNum'),
        bfLogo    = $('bfLogo'),
        bfName    = $('bfName'),
        bfFounder = $('bfFounder'),
        bfCohort  = $('bfCohort');

    var bbName = $('bbName'),
        bbTeam = $('bbTeam');

    var pAboutTitle  = $('pAboutTitle'),
        pContent     = $('pContent'),
        pTeamSection = $('pTeamSection'),
        pTeamList    = $('pTeamList'),
        pWebsite     = $('pWebsite'),
        pFacebook    = $('pFacebook');

    var cards      = document.querySelectorAll('.ib-card');
    var seeMoreBtns = document.querySelectorAll('.ib-see-more');
    var isOpen     = false;
    var isFlipped  = false;
    var activeCard = null;
    var isMobileView = function () { return window.innerWidth <= 768; };
    var mobileFlippedCard = null;  // track which small card is flipped on mobile

    /* ── Mobile preview card refs ── */
    var mobPreview   = document.getElementById('ibMobilePreview');
    var mobBackdrop  = document.getElementById('ibMobPreviewBackdrop');
    var mobWrap      = document.getElementById('ibMobPreviewWrap');
    var mobClose     = document.getElementById('ibMobPreviewClose');
    var mpInner      = document.getElementById('mpInner');
    var mpLogo       = document.getElementById('mpLogo');
    var mpNum        = document.getElementById('mpNum');
    var mpName       = document.getElementById('mpName');
    var mpFounder    = document.getElementById('mpFounder');
    var mpCohort     = document.getElementById('mpCohort');
    var mpBackName   = document.getElementById('mpBackName');
    var mpBackTeam   = document.getElementById('mpBackTeam');
    var mpHint       = document.getElementById('mpHint');
    var mpReadMore   = document.getElementById('mpReadMore');
    var previewIdx   = null;
    var mpFlipped    = false;

    function buildDisplayTeam(d) {
        var members = [];
        if (d.founderName) {
            members.push({
                name: d.founderName,
                role: d.founderPosition || 'Founder',
                photo: d.founderPhoto || ''
            });
        }
        if (Array.isArray(d.teamMembers) && d.teamMembers.length) {
            d.teamMembers.forEach(function (m) {
                if (m && m.name) {
                    members.push({
                        name: m.name,
                        role: m.role || '',
                        photo: m.photo || ''
                    });
                }
            });
        }
        return members;
    }

    /* ── Entrance animation ── */
    gsap.from('.ib-card', {
        opacity: 0, y: 35, scale: .92,
        duration: .45, stagger: .07,
        ease: 'power2.out', delay: .15
    });

    /* ── Hover tilt ── */
    cards.forEach(function (card) {
        var inner = card.querySelector('.ib-inner');

        card.addEventListener('mousemove', function (e) {
            if (isOpen) return;
            var r  = card.getBoundingClientRect();
            var cx = r.width / 2, cy = r.height / 2;
            var ry = ((e.clientX - r.left - cx) / cx) * 8;
            var rx = ((cy - (e.clientY - r.top)) / cy) * 6;
            gsap.to(inner, {
                rotateX: rx, rotateY: ry, y: -6,
                boxShadow: '0 16px 40px rgba(2,13,24,.1)',
                duration: .3, ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', function () {
            gsap.to(inner, {
                rotateX: 0, rotateY: 0, y: 0,
                boxShadow: '0 2px 8px rgba(2,13,24,.03)',
                duration: .35, ease: 'power2.in'
            });
        });

        card.addEventListener('click', function () {
            if (isMobileView()) {
                showMobilePreview(card, parseInt(card.dataset.ix));
            } else {
                openCard(card, parseInt(card.dataset.ix));
            }
        });
    });

    /* ── Mobile: show preview popup (mini version of desktop big card) ── */
    function showMobilePreview(card, idx) {
        if (isOpen) return;
        if (!mobPreview) return;
        previewIdx = idx;
        activeCard = card;
        mpFlipped = false;
        var d   = data[idx];
        var num = String(idx + 1).padStart(2, '0');

        /* ── Populate FRONT (navy) — same as desktop bfXxx ── */
        mpNum.textContent     = num;
        mpName.textContent    = d.companyName;
        mpFounder.textContent = '';
        mpCohort.textContent  = d.cohort;
        mpLogo.innerHTML = d.logoWhitePath
            ? '<img src="' + d.logoWhitePath + '" alt="' + d.companyName + '" class="is-white">'
            : d.logoPath
            ? '<img src="' + d.logoPath + '" alt="' + d.companyName + '">'
            : '<span class="ib-init" style="font-size:1.8rem;color:rgba(255,255,255,.5)">' + d.companyName.charAt(0).toUpperCase() + '</span>';

        /* ── Populate BACK (team) — same as desktop bbXxx ── */
        mpBackName.textContent = d.companyName;
        var team = buildDisplayTeam(d);
        var html = '';
        if (team.length) {
            html += '<span class="ib-bb-team-label">Members</span>';
            team.forEach(function (m) {
                html += '<div class="ib-bb-member flex flex-col items-center">';
                html += '<span class="ib-bb-member-name">' + m.name + '</span>';
                if (m.role) html += '<span class="ib-bb-member-role">' + m.role + '</span>';
                html += '</div>';
            });
        } else {
            html = '<p class="ib-bb-no-team">Team info coming soon</p>';
        }
        mpBackTeam.innerHTML = html;

        /* Reset flip state */
        if (mpInner) mpInner.classList.remove('is-flipped');
        if (mpHint) { mpHint.textContent = 'Tap card to flip'; mpHint.classList.remove('hidden'); }

        /* Show */
        mobPreview.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeMobilePreview() {
        if (!mobPreview) return;
        mobPreview.classList.remove('is-open');
        document.body.style.overflow = '';
        previewIdx = null;
        activeCard = null;
        mpFlipped = false;
        if (mpInner) mpInner.classList.remove('is-flipped');
    }

    /* ── Tap the mini card to flip it ── */
    if (mpInner) {
        mpInner.addEventListener('click', function (e) {
            e.stopPropagation();
            mpFlipped = !mpFlipped;
            mpInner.classList.toggle('is-flipped', mpFlipped);
            if (mpHint) {
                mpHint.textContent = mpFlipped ? 'Tap card to flip back' : 'Tap card to flip';
            }
        });
    }

    /* ── Mobile preview: Read More → full detail panel ── */
    if (mpReadMore) {
        mpReadMore.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var idx  = previewIdx;
            var card = activeCard;
            if (idx === null || !card) return;
            closeMobilePreview();
            /* Delay so the preview closes visually first */
            setTimeout(function () {
                openCard(card, idx);
            }, 200);
        });
    }

    /* ── Mobile preview: close triggers ── */
    if (mobClose) {
        mobClose.addEventListener('click', function (e) { e.stopPropagation(); closeMobilePreview(); });
    }
    if (mobBackdrop) {
        mobBackdrop.addEventListener('click', function (e) { e.stopPropagation(); closeMobilePreview(); });
    }
    if (mobWrap) {
        mobWrap.addEventListener('click', function (e) { e.stopPropagation(); });
    }

    /* ── Mobile "See More" buttons on card back ── */
    seeMoreBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            var ix = parseInt(btn.dataset.ix);
            var card = document.querySelector('.ib-card[data-ix="' + ix + '"]');
            // Unflip the card first, then open modal
            if (card) card.classList.remove('mob-flipped');
            mobileFlippedCard = null;
            openCard(card, ix);
        });
    });

    /* ── Open card ── */
    function openCard(card, idx) {
        if (isOpen) return;
        isOpen = true;
        isFlipped = false;
        activeCard = card;

        var d   = data[idx];
        var num = String(idx + 1).padStart(2, '0');

        /* Big front */
        bfNum.textContent     = num;
        bfName.textContent    = d.companyName;
        bfFounder.textContent = '';
        bfCohort.textContent  = d.cohort;
        bfLogo.innerHTML = d.logoWhitePath
            ? '<img src="' + d.logoWhitePath + '" alt="' + d.companyName + '" class="is-white">'
            : d.logoPath
            ? '<img src="' + d.logoPath + '" alt="' + d.companyName + '">'
            : '<span class="ib-init" style="font-size:2.4rem;color:rgba(255,255,255,.5)">'
              + d.companyName.charAt(0).toUpperCase() + '</span>';

        /* Big back */
        bbName.textContent = d.companyName;
        var team = buildDisplayTeam(d);
        var html = '';
        if (team.length) {
            html += '<span class="ib-bb-team-label">Members</span>';
            team.forEach(function (m) {
                html += '<div class="ib-bb-member flex flex-col items-center">';
                html += '<span class="ib-bb-member-name">' + m.name + '</span>';
                if (m.role) html += '<span class="ib-bb-member-role">' + m.role + '</span>';
                html += '</div>';
            });
        } else {
            html = '<p class="ib-bb-no-team">Team info coming soon</p>';
        }
        bbTeam.innerHTML = html;

        /* Panel */
        if (pAboutTitle) {
            pAboutTitle.textContent = 'About ' + d.companyName;
        }
        pContent.innerHTML   = d.content || '';

        var team = buildDisplayTeam(d);

        if (pTeamList && pTeamSection) {
            if (team.length) {
                var teamHtml = '';
                team.forEach(function (m) {
                    var initial = (m.name || '?').trim().charAt(0).toUpperCase();
                    var photoMarkup = m.photo
                        ? '<img class="ib-p-member-photo" src="' + m.photo + '" alt="' + m.name + '">'
                        : '<div class="ib-p-member-photo-default"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg></div>';

                    teamHtml += '<div class="ib-p-member-card">';
                    teamHtml += photoMarkup;
                    teamHtml += '<span class="ib-p-member-name">' + m.name + '</span>';
                    if (m.role) {
                        teamHtml += '<span class="ib-p-member-role">' + m.role + '</span>';
                    }
                    teamHtml += '</div>';
                });
                pTeamList.innerHTML = teamHtml;
                pTeamSection.style.display = '';
            } else {
                pTeamList.innerHTML = '';
                pTeamSection.style.display = 'none';
            }
        }

        if (d.websiteUrl)  { pWebsite.href = d.websiteUrl;   pWebsite.style.display = 'inline-flex'; }
        else               { pWebsite.style.display = 'none'; }
        if (d.facebookUrl) { pFacebook.href = d.facebookUrl; pFacebook.style.display = 'inline-flex'; }
        else               { pFacebook.style.display = 'none'; }

        /* Animate in */
        stack.classList.add('has-active');
        card.classList.add('is-picked');
        gsap.set(card.querySelector('.ib-inner'), { rotateX: 0, rotateY: 0 });

        overlay.classList.add('is-open');
        document.body.style.overflow = 'hidden';

        if (isMobileView()) {
            /* Mobile: slide panel up from bottom, skip big card */
            gsap.set(panel, { x: 0, y: '100%' });
            gsap.to(panel, { y: 0, duration: .4, ease: 'power3.out' });
        } else {
            /* Desktop: big card + side panel */
            gsap.set(bigInner, { rotateY: 0 });
            gsap.set(bigCard,  { opacity: 0, scale: .7, y: 30 });
            gsap.to(bigCard,   { opacity: 1, scale: 1, y: 0, duration: .5, delay: .1, ease: 'back.out(1.4)' });
            gsap.to(panel,     { x: 0, duration: .45, delay: .2, ease: 'power3.out' });
        }
    }

    /* ── Close overlay ── */
    function closeOverlay() {
        if (!isOpen) return;
        if (isFlipped) {
            gsap.to(bigInner, { rotateY: 0, duration: .35, ease: 'power2.inOut', onComplete: doClose });
            isFlipped = false;
        } else {
            doClose();
        }
    }

    function doClose() {
        if (isMobileView()) {
            /* Mobile: slide panel down to bottom */
            gsap.to(panel, {
                x: 0, y: '100%', duration: .3, ease: 'power2.in',
                onComplete: function () {
                    overlay.classList.remove('is-open');
                    stack.classList.remove('has-active');
                    if (activeCard) activeCard.classList.remove('is-picked');
                    if (mobileFlippedCard) {
                        mobileFlippedCard.classList.remove('mob-flipped');
                        mobileFlippedCard = null;
                    }
                    activeCard = null;
                    isOpen = false;
                    document.body.style.overflow = '';
                    /* Reset to CSS default (offscreen right) */
                    panel.style.transform = '';
                }
            });
        } else {
            gsap.to(panel,   { x: '100%', duration: .3, ease: 'power2.in' });
            gsap.to(bigCard, {
                opacity: 0, scale: .8, y: 20, duration: .3, ease: 'power2.in',
                onComplete: function () {
                    overlay.classList.remove('is-open');
                    stack.classList.remove('has-active');
                    if (activeCard) activeCard.classList.remove('is-picked');
                    activeCard = null;
                    isOpen = false;
                    document.body.style.overflow = '';
                    gsap.set(panel, { x: '100%' });
                }
            });
        }
    }

    /* ── Flip (counter-clockwise) ── */
    bigInner.addEventListener('click', function (e) {
        e.stopPropagation();
        isFlipped = !isFlipped;
        gsap.to(bigInner, { rotateY: isFlipped ? -180 : 0, duration: .55, ease: 'power2.inOut' });
    });

    /* ── Close triggers ── */
    closeBtn.addEventListener('click', function (e) { e.stopPropagation(); closeOverlay(); });
    panel.addEventListener('click', function (e) { e.stopPropagation(); });
    backdrop.addEventListener('click', closeOverlay);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (mobPreview && mobPreview.classList.contains('is-open')) {
                closeMobilePreview();
            } else if (isOpen) {
                closeOverlay();
            }
        }
    });
})();
