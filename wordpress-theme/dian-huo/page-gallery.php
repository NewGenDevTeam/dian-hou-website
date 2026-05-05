<?php
/*
 * Template Name: Gallery Page
 */
get_header();

$gallery_posts = get_posts([
    'post_type'      => 'dh_gallery',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
?>
<style>
#gallery { padding: 90px 0 120px; background: var(--bg); }
.gallery-sub { font-family: 'Outfit', sans-serif; font-size: 15px; color: var(--muted); text-align: center; margin-bottom: 56px; }
.gallery-masonry { columns: 3; column-gap: 10px; }
.gallery-item { break-inside: avoid; margin-bottom: 10px; position: relative; overflow: hidden; cursor: pointer; }
.gallery-item img { width: 100%; display: block; filter: brightness(.85) saturate(1.1); transition: transform .6s ease, filter .4s; }
.gallery-item:hover img { transform: scale(1.04); filter: brightness(1) saturate(1.2); }
.gallery-item-overlay { position: absolute; inset: 0; background: rgba(228,30,43,0); transition: background .3s; display: flex; align-items: flex-end; padding: 20px; }
.gallery-item:hover .gallery-item-overlay { background: rgba(0,0,0,.3); }
.gallery-caption { font-family: 'Outfit', sans-serif; font-size: 11px; letter-spacing: .2em; text-transform: uppercase; color: rgba(247,238,233,.6); opacity: 0; transform: translateY(8px); transition: opacity .3s, transform .3s; }
.gallery-item:hover .gallery-caption { opacity: 1; transform: translateY(0); }

/* Lightbox */
#lightbox { position: fixed; inset: 0; background: rgba(0,0,0,.95); z-index: 9000; display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity .3s; }
#lightbox.open { opacity: 1; pointer-events: all; }
#lightbox img { max-width: 90vw; max-height: 90vh; object-fit: contain; border: 1px solid rgba(228,30,43,.2); }
.lb-close { position: absolute; top: 24px; right: 32px; font-size: 32px; color: rgba(247,238,233,.5); cursor: pointer; transition: color .2s; background: none; border: none; }
.lb-close:hover { color: var(--red); }
.lb-prev, .lb-next { position: absolute; top: 50%; transform: translateY(-50%); font-size: 28px; color: rgba(247,238,233,.4); cursor: pointer; background: none; border: none; padding: 16px; transition: color .2s; }
.lb-prev { left: 20px; } .lb-next { right: 20px; }
.lb-prev:hover, .lb-next:hover { color: var(--red); }

.gallery-empty { text-align:center; padding:80px 0; color:var(--muted); font-size:14px; letter-spacing:.1em; }

@media (max-width:900px) { .gallery-masonry { columns: 2; } }
@media (max-width:600px) { .gallery-masonry { columns: 1; } }
</style>

<section class="page-hdr">
    <div class="page-hdr-glow"></div>
    <div class="page-hdr-bg">GALLERY</div>
    <div class="page-hdr-content">
        <p class="label" style="justify-content:center;" data-i18n="gallery-hdr-label">Moments Captured</p>
        <h1 class="page-hdr-title" data-i18n="gallery-hdr-title">OUR <em>GALLERY</em></h1>
        <p class="page-hdr-zh" data-i18n="gallery-page-zh">相冊 · 城市之巔的精彩時刻</p>
    </div>
</section>

<section id="gallery">
    <div class="container">
        <p class="gallery-sub reveal" data-i18n="gallery-sub">A glimpse into the world above the city.</p>

        <?php if (!empty($gallery_posts)): ?>
        <div class="gallery-masonry">
            <?php foreach ($gallery_posts as $i => $post):
                $img_url    = get_the_post_thumbnail_url($post->ID, 'large');
                $caption_en = get_field('caption_en', $post->ID) ?: get_the_title($post);
                $caption_zh = get_field('caption_zh', $post->ID) ?: $caption_en;
                if (!$img_url) continue;
            ?>
            <div class="gallery-item reveal" data-src="<?php echo esc_url($img_url); ?>" data-alt="<?php echo esc_attr($caption_en); ?>" data-index="<?php echo $i; ?>">
                <img src="<?php echo esc_url($img_url); ?>" loading="lazy" alt="<?php echo esc_attr($caption_en); ?>">
                <div class="gallery-item-overlay">
                    <span class="gallery-caption en-only"><?php echo esc_html($caption_en); ?></span>
                    <span class="gallery-caption zh-only"><?php echo esc_html($caption_zh); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="gallery-empty">
            <p>Gallery photos coming soon — upload images via <strong>WordPress Admin → Gallery Photos</strong></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox -->
<div id="lightbox">
    <button class="lb-close" id="lbClose">✕</button>
    <button class="lb-prev" id="lbPrev">&#8249;</button>
    <img id="lbImg" src="" alt="">
    <button class="lb-next" id="lbNext">&#8250;</button>
</div>

<script>
const items = Array.from(document.querySelectorAll('.gallery-item'));
const lb    = document.getElementById('lightbox');
const lbImg = document.getElementById('lbImg');
let cur = 0;

function openLb(i) {
    cur = i;
    lbImg.src = items[i].dataset.src;
    lbImg.alt = items[i].dataset.alt || '';
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLb() { lb.classList.remove('open'); document.body.style.overflow = ''; }

items.forEach((el, i) => el.addEventListener('click', () => openLb(i)));
document.getElementById('lbClose').addEventListener('click', closeLb);
document.getElementById('lbPrev').addEventListener('click', () => openLb((cur - 1 + items.length) % items.length));
document.getElementById('lbNext').addEventListener('click', () => openLb((cur + 1) % items.length));
lb.addEventListener('click', e => { if (e.target === lb) closeLb(); });
document.addEventListener('keydown', e => {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') closeLb();
    if (e.key === 'ArrowLeft')  openLb((cur - 1 + items.length) % items.length);
    if (e.key === 'ArrowRight') openLb((cur + 1) % items.length);
});
</script>

<?php get_footer(); ?>
