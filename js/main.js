// Custom cursor
const cur  = document.getElementById('cursor');
const ring = document.getElementById('cursor-ring');
let mx = 0, my = 0, rx = 0, ry = 0;

document.addEventListener('mousemove', e => {
    mx = e.clientX; my = e.clientY;
    cur.style.left = mx + 'px'; cur.style.top = my + 'px';
});
(function trackRing() {
    rx += (mx - rx) * .12; ry += (my - ry) * .12;
    ring.style.left = rx + 'px'; ring.style.top = ry + 'px';
    requestAnimationFrame(trackRing);
})();
document.querySelectorAll('a, button, [data-hover]').forEach(el => {
    el.addEventListener('mouseenter', () => {
        cur.style.width  = '14px'; cur.style.height = '14px';
        ring.style.width = '48px'; ring.style.height = '48px';
    });
    el.addEventListener('mouseleave', () => {
        cur.style.width  = '8px';  cur.style.height = '8px';
        ring.style.width = '30px'; ring.style.height = '30px';
    });
});

// Navbar scroll
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () =>
    navbar.classList.toggle('scrolled', window.scrollY > 50)
);

// Active nav link highlight
const page = window.location.pathname.split('/').pop() || 'index.html';
document.querySelectorAll('.nav-pill[href]').forEach(a => {
    if (a.getAttribute('href') === page) a.classList.add('active');
});

// Scroll reveals
const revObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('vis'); revObs.unobserve(e.target); }
    });
}, { threshold: 0.08, rootMargin: '0px 0px -44px 0px' });
document.querySelectorAll('.reveal').forEach(el => revObs.observe(el));

// Reserve page — WhatsApp submission
const rForm = document.getElementById('rForm');
if (rForm) {
    rForm.addEventListener('submit', e => {
        e.preventDefault();
        if (!rForm.reportValidity()) return;
        const d = new FormData(rForm);
        const val = k => d.get(k)?.trim() || '-';
        const msg = [
            '*New Reservation — Dian Huo Hotpot*',
            'Name: '     + val('name'),
            'Phone: '    + val('phone'),
            'Email: '    + val('email'),
            'Date: '     + val('date'),
            'Time: '     + val('time'),
            'Guests: '   + val('guests'),
            'Occasion: ' + val('occasion'),
            'Broth: '    + val('broth'),
            'Requests: ' + val('requests')
        ].join('\n');
        window.open('https://wa.me/60178787652?text=' + encodeURIComponent(msg), '_blank');
        rForm.style.display = 'none';
        document.getElementById('successMsg').classList.add('show');
        window.scrollTo({ top: document.getElementById('successMsg').offsetTop - 120, behavior: 'smooth' });
    });

    const dateInput = rForm.querySelector('input[type="date"]');
    if (dateInput) {
        dateInput.min = new Date().toISOString().split('T')[0];
        dateInput.addEventListener('click', function () {
            if (typeof this.showPicker === 'function') {
                try { this.showPicker(); } catch (_) {}
            }
        });
    }
}
