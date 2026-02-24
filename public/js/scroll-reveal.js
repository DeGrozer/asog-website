/* ═══ SCROLL REVEAL (IntersectionObserver) ═══ */
const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('visible');
    });
}, {
    threshold: 0.12,
    rootMargin: '0px 0px -50px 0px'
});

document.querySelectorAll('.reveal, .reveal-group').forEach(el => io.observe(el));
