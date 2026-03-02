/* ═══ HERO SLIDESHOW ═══ */
(function () {
    var slides = document.querySelectorAll('#hero .slide');
    var hls    = document.querySelectorAll('#hero .hl');
    var dots   = document.querySelectorAll('#hero .ind');
    if (slides.length < 2) return;

    var cur   = 0;
    var DELAY = 5000;
    var timer;

    function go(n) {
        /* Remove active from old */
        if (slides[cur]) slides[cur].classList.remove('active');
        if (hls[cur])    hls[cur].classList.remove('active');
        if (dots[cur])   dots[cur].classList.remove('active');

        cur = n;

        /* Activate new */
        if (slides[cur]) slides[cur].classList.add('active');
        if (hls[cur])    hls[cur].classList.add('active');
        if (dots[cur])   dots[cur].classList.add('active');
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
