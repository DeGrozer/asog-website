/* ═══ NAVBAR SCROLL TOGGLE (desktop) ═══ */
const navbar = document.getElementById('navbar');

// Detect if the section behind the navbar has a light background
function isLightBackground() {
    const navBottom = navbar.getBoundingClientRect().bottom;
    // Sample a point just below the navbar center
    const x = window.innerWidth / 2;
    const y = navBottom - 1;
    // Temporarily hide navbar so elementFromPoint sees through it
    navbar.style.pointerEvents = 'none';
    navbar.style.visibility = 'hidden';
    let el = document.elementFromPoint(x, y);
    navbar.style.pointerEvents = '';
    navbar.style.visibility = '';
    // Walk up until we find an element with an actual background color
    while (el && el !== document.documentElement) {
        const bg = window.getComputedStyle(el).backgroundColor;
        const rgb = bg.match(/\d+/g);
        if (rgb && parseFloat(rgb[3] ?? 1) > 0) {
            const lum = (0.299 * rgb[0] + 0.587 * rgb[1] + 0.114 * rgb[2]) / 255;
            return lum > 0.55;
        }
        el = el.parentElement;
    }
    return false;
}

function updateNavbar() {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
    navbar.classList.toggle('on-light', isLightBackground());
}

window.addEventListener('scroll', updateNavbar, { passive: true });
updateNavbar();

/* ═══ MOBILE MENU TOGGLE ═══ */
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const bar1 = document.getElementById('bar1');
const bar2 = document.getElementById('bar2');
const bar3 = document.getElementById('bar3');
let menuOpen = false;

function toggleMenu(open) {
    menuOpen = open;
    mobileMenu.classList.toggle('open', menuOpen);
    if (menuOpen) {
        bar1.style.transform = 'rotate(45deg) translateY(10px)';
        bar2.style.opacity = '0';
        bar3.style.transform = 'rotate(-45deg) translateY(-10px)';
        document.body.style.overflow = 'hidden';
    } else {
        bar1.style.transform = 'none';
        bar2.style.opacity = '1';
        bar3.style.transform = 'none';
        document.body.style.overflow = 'auto';
    }
}

menuBtn.addEventListener('click', () => toggleMenu(!menuOpen));

document.getElementById('closeMenuBtn').addEventListener('click', () => toggleMenu(false));

mobileMenu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => toggleMenu(false));
});

document.getElementById('navLogo').addEventListener('click', () => {
    if (menuOpen) toggleMenu(false);
});
