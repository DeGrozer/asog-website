    /* ═══ NAVBAR SCROLL TOGGLE (desktop) ═══ */
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 60);
    });

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
