/* ═══ HERO SLIDESHOW ═══ */
(function () {
    function toArray(list) {
        return Array.isArray(list) ? list : Array.from(list || []);
    }

    var slides = toArray(document.querySelectorAll('#hero .slide'));
    var hls    = toArray(document.querySelectorAll('#hero .hl'));
    var descs  = toArray(document.querySelectorAll('#hero .hl-desc'));
    var links  = toArray(document.querySelectorAll('#hero .hl-link'));
    var dots   = toArray(document.querySelectorAll('#hero .ind'));
    var titleWrap = document.getElementById('heroTitleWrap');
    var descWrap  = document.getElementById('heroDescWrap');
    var hero      = document.getElementById('hero');
    if (slides.length < 2) return;

    var mobileRectQuery = window.matchMedia('(max-width: 767px)');
    var cur   = 0;
    var DELAY = 5500;
    var timer;

    function setActiveFor(list, idx) {
        list.forEach(function (el, i) {
            if (!el) return;
            el.classList.toggle('active', i === idx);
        });
    }

    function syncStackHeights() {
        if (titleWrap && hls.length) {
            var titleMax = 0;
            hls.forEach(function (el) {
                titleMax = Math.max(titleMax, el.scrollHeight || 0);
            });
            if (titleMax > 0) titleWrap.style.minHeight = Math.ceil(titleMax) + 'px';
        }

        if (descWrap && descs.length) {
            var hasDescText = descs.some(function (el) {
                return !!(el.textContent && el.textContent.trim());
            });

            if (!hasDescText) {
                descWrap.classList.add('is-empty');
                descWrap.style.minHeight = '0px';
                return;
            }

            descWrap.classList.remove('is-empty');
            var descMax = 0;
            descs.forEach(function (el) {
                descMax = Math.max(descMax, el.scrollHeight || 0);
            });
            if (descMax > 0) descWrap.style.minHeight = Math.ceil(descMax) + 'px';
            else descWrap.style.minHeight = '0px';
        } else if (descWrap) {
            descWrap.classList.add('is-empty');
            descWrap.style.minHeight = '0px';
        }
    }

    function syncHeroViewportHeight() {
        if (!hero) return;
        var isMobileRect = hero.classList.contains('hero-rect-mobile') && mobileRectQuery.matches;
        if (isMobileRect) {
            hero.style.removeProperty('--hero-vh');
            return;
        }
        var vv = window.visualViewport;
        var viewportHeight =
            (vv && vv.height) ||
            document.documentElement.clientHeight ||
            window.innerHeight;

        // Desktop Safari can briefly report a smaller visual viewport while UI animates.
        if (!mobileRectQuery.matches) {
            viewportHeight = Math.max(viewportHeight || 0, window.innerHeight || 0);
        }

        if (!viewportHeight) return;
        hero.style.setProperty('--hero-vh', Math.round(viewportHeight) + 'px');
    }

    function go(n) {
        var max = slides.length;
        if (!max) return;

        var target = Number(n);
        if (!Number.isFinite(target)) target = 0;
        target = ((target % max) + max) % max;
        cur = target;

        setActiveFor(slides, cur);
        setActiveFor(hls, cur);
        setActiveFor(descs, cur);
        setActiveFor(links, cur);
        setActiveFor(dots, cur);

        syncStackHeights();
    }

    function next() { go((cur + 1) % slides.length); }
    function startTimer() { timer = setInterval(next, DELAY); }
    function resetTimer() { clearInterval(timer); startTimer(); }

    /* Expose goTo globally for inline onclick handlers in hero.php */
    window.goTo = function (n) {
        go(n);
        resetTimer();
    };

    /* Boot */
    go(0);
    syncHeroViewportHeight();
    syncStackHeights();
    startTimer();

    window.addEventListener('resize', syncHeroViewportHeight);
    window.addEventListener('resize', syncStackHeights);
    window.addEventListener('orientationchange', syncHeroViewportHeight);
    window.addEventListener('pageshow', syncHeroViewportHeight);

    if (mobileRectQuery.addEventListener) {
        mobileRectQuery.addEventListener('change', syncHeroViewportHeight);
    } else if (mobileRectQuery.addListener) {
        mobileRectQuery.addListener(syncHeroViewportHeight);
    }

    if (window.visualViewport) {
        window.visualViewport.addEventListener('resize', syncHeroViewportHeight);
    }

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(syncStackHeights).catch(function () {});
    }
})();
