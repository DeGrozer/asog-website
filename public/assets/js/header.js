/* ═══ NAVBAR SCROLL TOGGLE (desktop) ═══ */
const navbar = document.getElementById('navbar');
let lastScrollY = window.scrollY;
let ticking = false;
const SCROLL_THRESHOLD = 60;
const isMobile = () => window.innerWidth < 1024;

// Detect if the section behind the navbar has a light background
function isLightBackground() {
    const navBottom = navbar.getBoundingClientRect().bottom;

    // 1. Prefer explicit data-navhint="dark" or "light" on the element behind the navbar
    const hinted = document.querySelectorAll('[data-navhint]');
    for (const el of hinted) {
        const r = el.getBoundingClientRect();
        if (r.top <= navBottom && r.bottom >= navBottom) {
            return el.dataset.navhint === 'light';
        }
    }

    // 2. Fallback: compute from background color of sections/divs
    const candidates = document.querySelectorAll('section, main, div[class*="bg-"]');
    let best = null;
    let bestZ = -Infinity;
    for (const el of candidates) {
        const r = el.getBoundingClientRect();
        if (r.top <= navBottom && r.bottom >= navBottom) {
            const bg  = window.getComputedStyle(el).backgroundColor;
            const m   = bg.match(/rgba?\(([\d.]+),\s*([\d.]+),\s*([\d.]+)(?:,\s*([\d.]+))?\)/);
            if (m) {
                const alpha = m[4] !== undefined ? parseFloat(m[4]) : 1;
                if (alpha < 0.15) continue;
                const depth = getDepth(el);
                if (depth > bestZ) {
                    bestZ = depth;
                    const lum = (0.299 * m[1] + 0.587 * m[2] + 0.114 * m[3]) / 255;
                    best = lum > 0.55;
                }
            }
        }
    }
    return best ?? false;
}

function getDepth(el) {
    let d = 0;
    while (el.parentElement) { d++; el = el.parentElement; }
    return d;
}

function updateNavbar() {
    const currentY = window.scrollY;
    const delta = currentY - lastScrollY;

    if (currentY <= SCROLL_THRESHOLD) {
        // At the very top — centered logo, full navbar
        navbar.classList.remove('scrolled', 'nav-hidden');
    } else if (delta < -3) {
        // Scrolling UP — show compact horizontal navbar
        navbar.classList.add('scrolled');
        navbar.classList.remove('nav-hidden');
    } else if (delta > 3) {
        // Scrolling DOWN — hide the navbar
        navbar.classList.add('nav-hidden');
    }

    navbar.classList.toggle('on-light', isLightBackground());
    lastScrollY = currentY;
}

window.addEventListener('scroll', function () {
    if (!ticking) {
        requestAnimationFrame(function () {
            updateNavbar();
            ticking = false;
        });
        ticking = true;
    }
}, { passive: true });
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

/* ═══ MOBILE PROGRAMS & SERVICES COLLAPSIBLE ═══ */
const psToggle = document.getElementById('mobPsToggle');
const psSub = document.getElementById('mobPsSub');
const psChevron = document.getElementById('mobPsChevron');
let psOpen = false;

if (psToggle && psSub) {
    psToggle.addEventListener('click', () => {
        psOpen = !psOpen;
        if (psOpen) {
            psSub.style.maxHeight = psSub.scrollHeight + 'px';
            if (psChevron) psChevron.style.transform = 'rotate(180deg)';
        } else {
            psSub.style.maxHeight = '0';
            if (psChevron) psChevron.style.transform = 'rotate(0)';
        }
    });
}
