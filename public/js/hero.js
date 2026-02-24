/* ═══ HERO SLIDESHOW ═══ */
let cur = 0;
const slides = document.querySelectorAll('.slide');
const hls = document.querySelectorAll('.hl');
const inds = document.querySelectorAll('.ind');

function goTo(n) {
    slides[cur].classList.remove('active');
    hls[cur].classList.remove('active');
    inds[cur].classList.remove('active');
    cur = n;
    slides[cur].classList.add('active');
    hls[cur].classList.add('active');
    inds[cur].classList.add('active');
}

setInterval(() => goTo((cur + 1) % slides.length), 5000);
