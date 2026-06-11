<?php
/*
 * Template Name: Menu Page
 */
get_header();

$uri      = get_template_directory_uri();
$broths   = get_posts(['post_type' => 'dh_broth',   'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']);
$proteins = get_posts(['post_type' => 'dh_protein', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']);
$specials = get_posts(['post_type' => 'dh_special', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']);
?>
<style>
#menu { padding: 90px 0 130px; background: var(--bg); }
.menu-cat { margin-bottom: 72px; }
.menu-cat-hd { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 32px; gap: 24px; flex-wrap: wrap; }
.menu-cat-title { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: clamp(40px, 6vw, 72px); text-transform: uppercase; color: var(--white); line-height: 0.9; letter-spacing: -0.01em; }
.menu-cat-title em { font-style: normal; color: var(--red); }
.menu-cat-sub { font-family: 'Outfit', sans-serif; font-size: 14px; color: var(--muted); max-width: 380px; }

.menu-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 2px; }
.menu-card { background: var(--surface); padding: 38px 32px; border: 1px solid rgba(228,30,43,.06); position: relative; overflow: hidden; transition: transform .35s; }
.menu-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 2px; background: var(--red); transform: scaleY(0); transition: transform .35s; transform-origin: bottom; }
.menu-card::after { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 0% 100%, rgba(228,30,43,.07), transparent 60%); opacity: 0; transition: opacity .35s; }
.menu-card:hover { transform: translateY(-4px); }
.menu-card:hover::before { transform: scaleY(1); }
.menu-card:hover::after { opacity: 1; }

.menu-card.wide { grid-column: 1 / -1; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; padding: 48px; }
.wide-quote { font-family: 'Big Shoulders Display', sans-serif; font-weight: 700; font-size: clamp(22px, 3vw, 36px); text-transform: uppercase; color: rgba(228,30,43,.2); line-height: 1.1; letter-spacing: -0.01em; text-align: right; }

.menu-card-tag { font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .34em; text-transform: uppercase; color: var(--red); margin-bottom: 10px; }
.menu-card h3 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 800; font-size: 26px; text-transform: uppercase; color: var(--white); letter-spacing: 0.01em; line-height: 1.05; margin-bottom: 4px; }
.menu-card-zh { font-family: 'Noto Serif SC', serif; font-size: 12px; color: rgba(228,30,43,.48); margin-bottom: 14px; }
.menu-card p { font-size: 14px; line-height: 1.72; color: var(--muted); }
.menu-card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 22px; }
.menu-card-price { font-family: 'Big Shoulders Display', sans-serif; font-weight: 800; font-size: 28px; color: var(--red); letter-spacing: -0.01em; }
.menu-card-heat { display: flex; gap: 2px; }
.spice-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
.spice-dot.on  { background: var(--red); box-shadow: 0 0 4px rgba(228,30,43,.5); }
.spice-dot.off { background: rgba(228,30,43,.15); }

.menu-cat-banner { width: 100%; overflow: hidden; position: relative; margin-bottom: 36px; background: var(--dark); }
.menu-cat-banner img { width: 100%; height: 500px; display: block; object-fit: cover; filter: brightness(0.75) saturate(1.1); transition: transform .7s ease; }
.menu-cat-banner:hover img { transform: scale(1.03); }
.menu-cat-banner::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to right, rgba(10,3,1,.6) 0%, transparent 25%, transparent 75%, rgba(10,3,1,.6) 100%), linear-gradient(to bottom, rgba(10,3,1,.35) 0%, transparent 20%, transparent 80%, rgba(10,3,1,.5) 100%); }

@media (max-width:900px) {
    .menu-grid { grid-template-columns: 1fr; }
    .menu-card.wide { grid-column: span 1; grid-template-columns: 1fr; gap: 24px; }
    .wide-quote { text-align: left; }
    .menu-cat-banner img { height: auto; }
}
</style>

<div class="page-hdr">
    <div class="page-hdr-glow"></div>
    <div class="page-hdr-bg">FOOD</div>
    <div class="page-hdr-content">
        <p class="label" style="justify-content:center;" data-i18n="menu-hdr-label">Crafted Daily</p>
        <h1 class="page-hdr-title" data-i18n="menu-hdr-title">CHOOSE<br><em>YOUR SOUP BASE</em></h1>
        <p class="page-hdr-zh" data-i18n="menu-page-zh">菜單 · 每日新鮮食材</p>
    </div>
</div>

<section id="menu">
    <div class="container">

        <?php if (!empty($broths)): ?>
        <!-- BROTHS -->
        <div class="menu-cat">
            <div class="menu-cat-hd">
                <div>
                    <p class="label reveal" data-i18n="broth-label">The Foundation</p>
                    <h2 class="menu-cat-title reveal d1" data-i18n="broth-h2">SIGNATURE<br><em>BROTHS</em></h2>
                </div>
                <p class="menu-cat-sub reveal d2" data-i18n="broth-sub">Every great hotpot begins with the broth. Choose your soup base — the soul of your evening.</p>
            </div>
            <div class="menu-cat-banner reveal">
                <img src="<?php echo esc_url("$uri/assets/images/coconut-herbal-soup.png"); ?>" alt="Signature Broths">
            </div>
            <div class="menu-grid">
                <?php foreach ($broths as $i => $post):
                    $tag_en  = get_field('tag_en',  $post->ID);
                    $tag_zh  = get_field('tag_zh',  $post->ID);
                    $name_en = get_field('name_en', $post->ID) ?: get_the_title($post);
                    $name_zh = get_field('name_zh', $post->ID);
                    $desc_en = get_field('desc_en', $post->ID);
                    $desc_zh = get_field('desc_zh', $post->ID);
                    $price   = get_field('price',   $post->ID);
                    $spice   = intval(get_field('spice', $post->ID));
                    $delay   = 'd' . min($i + 1, 4);
                ?>
                <div class="menu-card reveal <?php echo esc_attr($delay); ?>" data-hover>
                    <?php if ($tag_en): ?><div class="menu-card-tag"><span class="en-only"><?php echo esc_html($tag_en); ?></span><span class="zh-only"><?php echo esc_html($tag_zh); ?></span></div><?php endif; ?>
                    <h3 class="en-only"><?php echo esc_html($name_en); ?></h3>
                    <h3 class="zh-only"><?php echo esc_html($name_zh ?: $name_en); ?></h3>
                    <?php if ($name_zh): ?><div class="menu-card-zh en-only"><?php echo esc_html($name_zh); ?></div><?php endif; ?>
                    <p class="en-only"><?php echo esc_html($desc_en); ?></p>
                    <p class="zh-only"><?php echo esc_html($desc_zh ?: $desc_en); ?></p>
                    <div class="menu-card-footer">
                        <span class="menu-card-price"><?php echo esc_html($price ?: '—'); ?></span>
                        <div class="menu-card-heat">
                            <?php for ($s = 1; $s <= 3; $s++): ?><span class="spice-dot <?php echo $s <= $spice ? 'on' : 'off'; ?>"></span><?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="ornament-line reveal"><span>火</span></div>

        <?php if (!empty($proteins)): ?>
        <!-- PROTEINS -->
        <div class="menu-cat">
            <div class="menu-cat-hd">
                <div>
                    <p class="label reveal" data-i18n="proteins-label">Premium Cuts</p>
                    <h2 class="menu-cat-title reveal d1" data-i18n="proteins-h2">TASTE<br><em>THE BEST</em></h2>
                </div>
                <p class="menu-cat-sub reveal d2" data-i18n="proteins-sub">Sourced with care. Each cut deserves a moment before it meets the broth.</p>
            </div>
            <div class="menu-cat-banner reveal">
                <img src="<?php echo esc_url("$uri/assets/images/dish.png"); ?>" alt="Premium Cuts">
            </div>
            <div class="menu-grid">
                <?php foreach ($proteins as $i => $post):
                    $tag_en   = get_field('tag_en',   $post->ID);
                    $tag_zh   = get_field('tag_zh',   $post->ID);
                    $name_en  = get_field('name_en',  $post->ID) ?: get_the_title($post);
                    $name_zh  = get_field('name_zh',  $post->ID);
                    $desc_en  = get_field('desc_en',  $post->ID);
                    $desc_zh  = get_field('desc_zh',  $post->ID);
                    $price    = get_field('price',    $post->ID);
                    $wide     = get_field('wide',     $post->ID);
                    $quote_en = get_field('quote_en', $post->ID);
                    $quote_zh = get_field('quote_zh', $post->ID);
                    $delay    = 'd' . min($i + 1, 4);
                ?>
                <?php if ($wide): ?>
                <div class="menu-card wide reveal <?php echo esc_attr($delay); ?>" data-hover>
                    <div>
                        <?php if ($tag_en): ?><div class="menu-card-tag"><span class="en-only"><?php echo esc_html($tag_en); ?></span><span class="zh-only"><?php echo esc_html($tag_zh); ?></span></div><?php endif; ?>
                        <h3 class="en-only"><?php echo esc_html($name_en); ?></h3>
                        <h3 class="zh-only"><?php echo esc_html($name_zh ?: $name_en); ?></h3>
                        <?php if ($name_zh): ?><div class="menu-card-zh en-only"><?php echo esc_html($name_zh); ?></div><?php endif; ?>
                        <p class="en-only"><?php echo esc_html($desc_en); ?></p>
                        <p class="zh-only"><?php echo esc_html($desc_zh ?: $desc_en); ?></p>
                        <div class="menu-card-footer">
                            <span class="menu-card-price"><?php echo esc_html($price ?: '—'); ?></span>
                        </div>
                    </div>
                    <?php if ($quote_en): ?><div class="wide-quote en-only"><?php echo esc_html($quote_en); ?></div><?php endif; ?>
                    <?php if ($quote_zh): ?><div class="wide-quote zh-only"><?php echo esc_html($quote_zh); ?></div><?php endif; ?>
                </div>
                <?php else: ?>
                <div class="menu-card reveal <?php echo esc_attr($delay); ?>" data-hover>
                    <?php if ($tag_en): ?><div class="menu-card-tag"><span class="en-only"><?php echo esc_html($tag_en); ?></span><span class="zh-only"><?php echo esc_html($tag_zh); ?></span></div><?php endif; ?>
                    <h3 class="en-only"><?php echo esc_html($name_en); ?></h3>
                    <h3 class="zh-only"><?php echo esc_html($name_zh ?: $name_en); ?></h3>
                    <?php if ($name_zh): ?><div class="menu-card-zh en-only"><?php echo esc_html($name_zh); ?></div><?php endif; ?>
                    <p class="en-only"><?php echo esc_html($desc_en); ?></p>
                    <p class="zh-only"><?php echo esc_html($desc_zh ?: $desc_en); ?></p>
                    <div class="menu-card-footer">
                        <span class="menu-card-price"><?php echo esc_html($price ?: '—'); ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="ornament-line reveal"><span>心</span></div>

        <?php if (!empty($specials)): ?>
        <!-- SPECIALS -->
        <div class="menu-cat">
            <div class="menu-cat-hd">
                <div>
                    <p class="label reveal" data-i18n="specials-label">Handcrafted Daily</p>
                    <h2 class="menu-cat-title reveal d1" data-i18n="specials-h2">HOUSE<br><em>SPECIALS</em></h2>
                </div>
                <p class="menu-cat-sub reveal d2" data-i18n="specials-sub">Made fresh every morning. The small things that make the difference.</p>
            </div>
            <div class="menu-cat-banner reveal">
                <img src="<?php echo esc_url("$uri/assets/images/handmade-ball.png"); ?>" alt="House Specials">
            </div>
            <div class="menu-grid">
                <?php foreach ($specials as $i => $post):
                    $tag_en  = get_field('tag_en',  $post->ID);
                    $tag_zh  = get_field('tag_zh',  $post->ID);
                    $name_en = get_field('name_en', $post->ID) ?: get_the_title($post);
                    $name_zh = get_field('name_zh', $post->ID);
                    $desc_en = get_field('desc_en', $post->ID);
                    $desc_zh = get_field('desc_zh', $post->ID);
                    $price   = get_field('price',   $post->ID);
                    $spice   = intval(get_field('spice', $post->ID));
                    $delay   = 'd' . min($i + 1, 4);
                ?>
                <div class="menu-card reveal <?php echo esc_attr($delay); ?>" data-hover>
                    <?php if ($tag_en): ?><div class="menu-card-tag"><span class="en-only"><?php echo esc_html($tag_en); ?></span><span class="zh-only"><?php echo esc_html($tag_zh); ?></span></div><?php endif; ?>
                    <h3 class="en-only"><?php echo esc_html($name_en); ?></h3>
                    <h3 class="zh-only"><?php echo esc_html($name_zh ?: $name_en); ?></h3>
                    <?php if ($name_zh): ?><div class="menu-card-zh en-only"><?php echo esc_html($name_zh); ?></div><?php endif; ?>
                    <p class="en-only"><?php echo esc_html($desc_en); ?></p>
                    <p class="zh-only"><?php echo esc_html($desc_zh ?: $desc_en); ?></p>
                    <div class="menu-card-footer">
                        <span class="menu-card-price"><?php echo esc_html($price ?: '—'); ?></span>
                        <div class="menu-card-heat">
                            <?php for ($s = 1; $s <= 3; $s++): ?><span class="spice-dot <?php echo $s <= $spice ? 'on' : 'off'; ?>"></span><?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (empty($broths) && empty($proteins) && empty($specials)): ?>
        <div style="text-align:center;padding:80px 0;color:var(--muted);">
            <p style="font-size:14px;letter-spacing:.1em;">Menu items coming soon — add them via <strong>WordPress Admin → Soup Bases / Premium Cuts / House Specials</strong></p>
        </div>
        <?php endif; ?>

        <div class="ornament-line reveal"><span>窩</span></div>
        <div style="text-align:center;" class="reveal d1">
            <a href="<?php echo esc_url(home_url('/reserve/')); ?>" class="btn-primary"><span data-i18n="menu-btn-reserve">Reserve Your Table</span></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
