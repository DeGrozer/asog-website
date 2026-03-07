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

    var pCohort      = $('pCohort'),
        pName        = $('pName'),
        pFounder     = $('pFounder'),
        pShort       = $('pShort'),
        pContent     = $('pContent'),
        pContentWrap = $('pContentWrap'),
        pReveal      = $('pReveal'),
        pWebsite     = $('pWebsite'),
        pFacebook    = $('pFacebook');

    var cards      = document.querySelectorAll('.ib-card');
    var isOpen     = false;
    var isFlipped  = false;
    var activeCard = null;

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
            openCard(card, parseInt(card.dataset.ix));
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
        bfFounder.textContent = d.founderName ? 'by ' + d.founderName : '';
        bfCohort.textContent  = d.cohort;
        bfLogo.innerHTML = d.logoWhitePath
            ? '<img src="' + d.logoWhitePath + '" alt="' + d.companyName + '" class="is-white">'
            : d.logoPath
            ? '<img src="' + d.logoPath + '" alt="' + d.companyName + '">'
            : '<span class="ib-init" style="font-size:2.4rem;color:rgba(255,255,255,.5)">'
              + d.companyName.charAt(0).toUpperCase() + '</span>';

        /* Big back */
        bbName.textContent = d.companyName;
        var html = '';
        if (d.teamMembers && d.teamMembers.length) {
            html += '<span class="ib-bb-team-label">Members</span>';
            d.teamMembers.forEach(function (m) {
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
        pCohort.textContent  = d.cohort;
        pName.textContent    = d.companyName;
        pFounder.textContent = d.founderName ? 'by ' + d.founderName : '';
        pShort.textContent   = d.shortDescription;
        pContent.innerHTML   = d.content || '';

        /* Reset click-to-reveal */
        pContentWrap.classList.remove('is-open');
        if (d.content && d.content.trim()) {
            pReveal.style.display = '';
            pReveal.textContent = 'Read more ↓';
        } else {
            pReveal.style.display = 'none';
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

        gsap.set(bigInner, { rotateY: 0 });
        gsap.set(bigCard,  { opacity: 0, scale: .7, y: 30 });
        gsap.to(bigCard,   { opacity: 1, scale: 1, y: 0, duration: .5, delay: .1, ease: 'back.out(1.4)' });
        gsap.to(panel,     { x: 0, duration: .45, delay: .2, ease: 'power3.out' });
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
        if (e.key === 'Escape' && isOpen) closeOverlay();
    });

    /* ── Click-to-reveal content ── */
    pReveal.addEventListener('click', function () {
        var isExpanded = pContentWrap.classList.toggle('is-open');
        pReveal.textContent = isExpanded ? 'Show less ↑' : 'Read more ↓';
    });
})();
