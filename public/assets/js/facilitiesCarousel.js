document.addEventListener('DOMContentLoaded', function () {
    const carousels = Array.from(document.querySelectorAll('[data-carousel]'));
    if (!carousels.length) return;

    carousels.forEach(function (root) {
        const track = root.querySelector('[data-carousel-track]');
        if (!track) return;

        const slides = Array.from(track.children);
        if (slides.length <= 1) return;

        const prevBtn = root.querySelector('[data-carousel-prev]');
        const nextBtn = root.querySelector('[data-carousel-next]');
        const dots = Array.from(root.querySelectorAll('[data-carousel-dot]'));

        let index = 0;
        let timer = null;

        function render() {
            track.style.transform = 'translateX(-' + (index * 100) + '%)';
            dots.forEach(function (dot, i) {
                dot.style.width = '10px';
                dot.style.height = '10px';
                dot.style.borderRadius = '999px';
                dot.style.border = '1px solid rgba(255,255,255,.9)';
                dot.style.backgroundColor = 'rgba(255,255,255,' + (i === index ? '0.98' : '0.42') + ')';
                dot.style.boxShadow = i === index ? '0 0 0 2px rgba(3,53,90,.22)' : 'none';
            });
        }

        function next() {
            index = (index + 1) % slides.length;
            render();
        }

        function prev() {
            index = (index - 1 + slides.length) % slides.length;
            render();
        }

        function startAuto() {
            stopAuto();
            timer = window.setInterval(next, 4500);
        }

        function stopAuto() {
            if (timer !== null) {
                window.clearInterval(timer);
                timer = null;
            }
        }

        if (prevBtn) prevBtn.addEventListener('click', prev);
        if (nextBtn) nextBtn.addEventListener('click', next);

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                index = i;
                render();
            });
        });

        root.addEventListener('mouseenter', stopAuto);
        root.addEventListener('mouseleave', startAuto);
        root.addEventListener('focusin', stopAuto);
        root.addEventListener('focusout', startAuto);

        render();
        startAuto();
    });
});
