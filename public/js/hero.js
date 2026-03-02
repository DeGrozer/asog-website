/* ═══ HERO SLIDESHOW ═══ */
(function () {
    var slides = document.querySelectorAll('#hero .slide');
    var hls    = document.querySelectorAll('#hero .hl');
    var descs  = document.querySelectorAll('#hero .hl-desc');
    var links  = document.querySelectorAll('#hero .hl-link');
    var dots   = document.querySelectorAll('#hero .ind');
    if (slides.length < 2) return;

    var cur   = 0;
    var DELAY = 5500;
    var timer;

    function go(n) {
        /* Deactivate old */
        [slides, hls, descs, links, dots].forEach(function (list) {
            if (list[cur]) list[cur].classList.remove('active');
        });

        cur = n;

        /* Activate new */
        [slides, hls, descs, links, dots].forEach(function (list) {
            if (list[cur]) list[cur].classList.add('active');
        });
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
    startTimer();
})();
