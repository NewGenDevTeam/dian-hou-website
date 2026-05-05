// Custom cursor
const cur  = document.getElementById('cursor');
const ring = document.getElementById('cursor-ring');
if (cur && ring) {
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
}

// Navbar scroll
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () =>
        navbar.classList.toggle('scrolled', window.scrollY > 50)
    );
}

// Active nav highlight based on current URL path
(function() {
    const path = window.location.pathname.replace(/\/$/, '') || '/';
    document.querySelectorAll('.nav-pill[href]').forEach(a => {
        const href = a.getAttribute('href').replace(/\/$/, '') || '/';
        if (path === href || (href !== '/' && path.startsWith(href))) {
            a.classList.add('active');
        }
    });
})();

// Scroll reveals (.reveal)
const revObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('vis'); revObs.unobserve(e.target); }
    });
}, { threshold: 0.08, rootMargin: '0px 0px -44px 0px' });
document.querySelectorAll('.reveal').forEach(el => revObs.observe(el));
