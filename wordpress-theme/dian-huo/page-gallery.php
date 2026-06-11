<?php
/*
 * Template Name: Gallery Page
 */
get_header();

$uri = get_template_directory_uri();

// Image order matches gallery.json
$static_images = [
    'DSC04894.jpg','DSC04903.jpg','DSC04929.jpg','DSC04930.jpg',
    'DSC04977.jpg','DSC04986.jpg','DSC05099.jpg','DSC05121.jpg',
    'DSC05156.jpg','DSC05229.jpg','DSC05294.jpg','DSC05393.jpg',
    'DSC05468 (1).jpg','DSC05494.jpg','DSC05528 (1).jpg','DSC05545 (1).jpg',
    'DSC05547.jpg','DSC05548 (1).jpg','DSC05549.jpg','DSC05551.jpg',
    'DSC05569.jpg','DSC02302.jpg','DSC02367.jpg','DSC02538.jpg',
    'DSC02548.jpg','DSC02556.jpg','DSC02572.jpg','DSC02576.jpg',
];
?>
<style>
#gallery { padding: 60px 0 120px; background: var(--dark); position: relative; }
#gallery::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(228,30,43,.25), transparent); }

.gallery-sub { font-family: 'Outfit', sans-serif; font-size: 15px; color: var(--muted); text-align: center; }
.gallery-grid { columns: 4; column-gap: 4px; }
.gallery-item { break-inside: avoid; margin-bottom: 4px; overflow: hidden; position: relative; cursor: pointer; display: block; }
.gallery-item img { width: 100%; display: block; filter: brightness(0.82) saturate(1.1); transition: transform .6s ease, filter .6s ease; }
.gallery-item:hover img { transform: scale(1.06); filter: brightness(0.95) saturate(1.25); }
.gallery-item-overlay { position: absolute; inset: 0; pointer-events: none; background: rgba(228,30,43,0); transition: background .35s; }
.gallery-item:hover .gallery-item-overlay { background: rgba(228,30,43,0.1); }
.gallery-item-icon { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%) scale(0.6); opacity: 0; transition: opacity .3s, transform .3s; color: rgba(247,238,233,0.85); font-size: 28px; pointer-events: none; text-shadow: 0 0 20px rgba(228,30,43,0.8); }
.gallery-item:hover .gallery-item-icon { opacity: 1; transform: translate(-50%,-50%) scale(1); }

.gallery-lb { position: fixed; inset: 0; z-index: 9100; background: rgba(6,2,1,0.97); display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity .3s; }
.gallery-lb.open { opacity: 1; pointer-events: all; }
.lb-img { max-width: 88vw; max-height: 86vh; object-fit: contain; display: block; box-shadow: 0 0 80px rgba(228,30,43,0.15); }
.lb-close { position: absolute; top: 22px; right: 28px; background: none; border: none; color: rgba(247,238,233,.45); font-size: 40px; cursor: pointer; line-height: 1; transition: color .2s; padding: 4px 8px; }
.lb-close:hover { color: var(--red); }
.lb-prev, .lb-next { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(228,30,43,0.12); border: 1px solid rgba(228,30,43,0.28); color: var(--off-white); font-size: 30px; padding: 14px 20px; cursor: pointer; transition: background .2s; line-height: 1; }
.lb-prev { left: 20px; }
.lb-next { right: 20px; }
.lb-prev:hover, .lb-next:hover { background: rgba(228,30,43,0.32); }
.lb-counter { position: absolute; bottom: 22px; left: 50%; transform: translateX(-50%); font-family: 'Outfit', sans-serif; font-size: 11px; letter-spacing: .28em; color: rgba(247,238,233,.3); text-transform: uppercase; }

@media (max-width: 900px) { .gallery-grid { columns: 2; } .lb-prev { left: 6px; } .lb-next { right: 6px; } }
@media (max-width: 480px) { .gallery-grid { columns: 2; } }
</style>

<section class="page-hdr">
    <div class="container">
        <p class="label" data-i18n="gallery-hdr-label">Moments Captured</p>
        <h1 class="page-hdr-title" data-i18n="gallery-hdr-title">OUR <em>GALLERY</em></h1>
        <p class="page-hdr-zh zh-only" data-i18n="gallery-page-zh">相冊 · 城市之巔的精彩時刻</p>
    </div>
</section>

<section id="gallery">
    <div class="container">
        <p class="gallery-sub reveal" style="margin-bottom:40px;" data-i18n="gallery-sub">A glimpse into the world above the city.</p>
        <div class="gallery-grid">
            <?php foreach ($static_images as $filename): ?>
            <div class="gallery-item" data-hover>
                <img src="<?php echo esc_url("$uri/assets/gallery/" . rawurlencode($filename)); ?>" loading="lazy" alt="Dian Huo Hotpot">
                <div class="gallery-item-overlay"></div>
                <span class="gallery-item-icon">&#8853;</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="gallery-lb" id="galleryLb" role="dialog" aria-modal="true">
    <button class="lb-close" id="lbClose" aria-label="Close">&#215;</button>
    <button class="lb-prev" id="lbPrev" aria-label="Previous">&#8249;</button>
    <img class="lb-img" id="lbImg" src="" alt="">
    <button class="lb-next" id="lbNext" aria-label="Next">&#8250;</button>
    <div class="lb-counter" id="lbCounter"></div>
</div>

<script>
(function() {
    var lb      = document.getElementById('galleryLb');
    var lbImg   = document.getElementById('lbImg');
    var lbCount = document.getElementById('lbCounter');
    var items   = Array.from(document.querySelectorAll('.gallery-item'));
    var cur     = 0;

    function openLb(i) {
        cur = i;
        lbImg.src = items[cur].querySelector('img').src;
        lbCount.textContent = (cur + 1) + ' / ' + items.length;
        lb.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeLb() {
        lb.classList.remove('open');
        document.body.style.overflow = '';
        setTimeout(function() { lbImg.src = ''; }, 300);
    }
    function prev() {
        cur = (cur - 1 + items.length) % items.length;
        lbImg.src = items[cur].querySelector('img').src;
        lbCount.textContent = (cur + 1) + ' / ' + items.length;
    }
    function next() {
        cur = (cur + 1) % items.length;
        lbImg.src = items[cur].querySelector('img').src;
        lbCount.textContent = (cur + 1) + ' / ' + items.length;
    }

    items.forEach(function(item, i) {
        item.addEventListener('click', function() { openLb(i); });
    });
    document.getElementById('lbClose').addEventListener('click', closeLb);
    document.getElementById('lbPrev').addEventListener('click', prev);
    document.getElementById('lbNext').addEventListener('click', next);
    lb.addEventListener('click', function(e) { if (e.target === lb) closeLb(); });
    document.addEventListener('keydown', function(e) {
        if (!lb.classList.contains('open')) return;
        if (e.key === 'Escape') closeLb();
        if (e.key === 'ArrowLeft') prev();
        if (e.key === 'ArrowRight') next();
    });
})();
</script>

<?php get_footer(); ?>
