document.addEventListener('DOMContentLoaded', function () {
    const carousels = Array.from(document.querySelectorAll('[data-carousel]'));
    if (!carousels.length) return;

    carousels.forEach(function (root) {
        const track = root.querySelector('[data-carousel-track]');
        if (!track) return;

        const slides = Array.from(track.children);
        if (slides.length <= 1) return;

        const dots = Array.from(root.querySelectorAll('[data-carousel-dot]'));

        let index = 0;
        let timer = null;
        let isVisible = true;

        function render() {
            track.style.transform = 'translateX(-' + (index * 100) + '%)';
            dots.forEach(function (dot, i) {
                dot.classList.toggle('is-active', i === index);
            });
        }

        function next() {
            index = (index + 1) % slides.length;
            render();
        }

        function startAuto() {
            if (!isVisible) return;
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            stopAuto();
            timer = window.setInterval(next, 4500);
        }

        function stopAuto() {
            if (timer !== null) {
                window.clearInterval(timer);
                timer = null;
            }
        }

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                index = i;
                render();
                startAuto();
            });
        });

        root.addEventListener('mouseenter', stopAuto);
        root.addEventListener('mouseleave', startAuto);
        root.addEventListener('focusin', stopAuto);
        root.addEventListener('focusout', startAuto);

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    isVisible = entry.isIntersecting;
                    if (isVisible) {
                        startAuto();
                    } else {
                        stopAuto();
                    }
                });
            }, { threshold: 0.2 });
            observer.observe(root);
        }

        render();
        startAuto();
    });
});
