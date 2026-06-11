<?php get_header(); ?>
<style>
/* ── Hero ── */
#hero { position: relative; height: 100vh; min-height: 700px; display: flex; flex-direction: column; align-items: flex-start; justify-content: center; overflow: hidden; background: var(--bg); }
#hero-canvas { position: absolute; inset: 0; width: 100%; height: 100%; z-index: 1; }
.hero-glow { position: absolute; bottom: -120px; left: 50%; transform: translateX(-50%); width: 900px; height: 500px; z-index: 2; pointer-events: none; background: radial-gradient(ellipse, rgba(228,30,43,.18) 0%, rgba(160,21,32,.06) 50%, transparent 75%); animation: glowPulse 3s ease-in-out infinite; }
.hero-bg-zh { position: absolute; right: -2vw; top: 50%; transform: translateY(-50%); font-family: 'Noto Serif SC', serif; font-weight: 600; font-size: clamp(220px, 38vw, 520px); line-height: 1; color: transparent; -webkit-text-stroke: 1px rgba(228,30,43,.055); user-select: none; pointer-events: none; z-index: 2; writing-mode: vertical-rl; letter-spacing: -0.05em; }
.hero-bowl { position: absolute; right: 8%; top: 50%; transform: translateY(-50%); width: clamp(280px, 38vw, 520px); height: clamp(280px, 38vw, 520px); border-radius: 50%; z-index: 3; pointer-events: none; background: #0c0402; overflow: hidden; border: 1px solid rgba(228,30,43,.12); box-shadow: 0 0 120px rgba(228,30,43,.12), inset 0 0 60px rgba(0,0,0,.8); }
.hero-bowl-inner { width: 100%; height: 100%; }
.hero-bowl-logo { width: 100%; height: 100%; object-fit: cover; opacity: .82; filter: saturate(1.1); }
.hero-content { position: relative; z-index: 5; padding: 0 80px; margin-top: -40px; }
.hero-eyebrow { font-family: 'Outfit', sans-serif; font-size: 11px; letter-spacing: .46em; text-transform: uppercase; color: rgba(228,30,43,.75); margin-bottom: 24px; }
.hero-line { display: block; font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; line-height: .88; letter-spacing: -.02em; text-transform: uppercase; color: var(--white); }
.hero-line.l1 { font-size: clamp(72px, 11vw, 148px); }
.hero-line.l2 { font-size: clamp(72px, 11vw, 148px); color: var(--red); text-shadow: 0 0 80px rgba(228,30,43,.4); }
.hero-zh { font-family: 'Noto Serif SC', serif; font-size: 13px; letter-spacing: .3em; color: rgba(228,30,43,.6); margin-top: 20px; margin-bottom: 8px; }
.hero-sub { font-family: 'Outfit', sans-serif; font-size: 15px; color: rgba(247,238,233,.42); max-width: 420px; line-height: 1.75; margin-bottom: 40px; }
.hero-cta { display: flex; gap: 16px; flex-wrap: wrap; }
.hero-skyline { position: absolute; bottom: 0; left: 0; right: 0; width: 100%; z-index: 4; pointer-events: none; }
.hero-strip { position: absolute; bottom: 0; left: 0; right: 0; z-index: 6; display: grid; border-top: 1px solid rgba(228,30,43,.1); background: rgba(12,6,4,.7); backdrop-filter: blur(12px); }
.strip-item { display: flex; flex-direction: column; gap: 4px; align-items: center; justify-content: center; padding: 16px 10px; text-decoration: none; border-right: 1px solid rgba(228,30,43,.08); transition: background .25s; }
.strip-item:last-child { border-right: none; }
.strip-item:hover { background: rgba(228,30,43,.12); }
.strip-zh { font-family: 'Noto Serif SC', serif; font-size: 12px; color: rgba(228,30,43,.75); }
.strip-en { font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .24em; text-transform: uppercase; color: rgba(247,238,233,.3); }

/* ── About Teaser ── */
#about-teaser { display: grid; grid-template-columns: 1fr 1fr; gap: 0; background: var(--dark); padding: 140px 80px; align-items: center; }
.about-img-wrap { position: relative; height: 600px; overflow: hidden; }
.about-img-wrap img { width: 100%; height: 100%; object-fit: cover; filter: saturate(1.1) brightness(.8); transition: transform .8s; }
.about-img-wrap:hover img { transform: scale(1.04); }
.about-img-frame { position: absolute; inset: 20px; border: 1px solid rgba(228,30,43,.15); pointer-events: none; }
.about-text { padding: 0 0 0 80px; }
.sec-label { font-family: 'Outfit', sans-serif; font-size: 10px; letter-spacing: .42em; text-transform: uppercase; color: var(--red); margin-bottom: 24px; display: flex; align-items: center; gap: 14px; }
.sec-label::before { content: ''; width: 28px; height: 1px; background: var(--red); opacity: .7; }
.sec-title { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: clamp(44px, 6vw, 80px); text-transform: uppercase; color: var(--white); line-height: .92; letter-spacing: -.01em; margin-bottom: 28px; }
.sec-title em { font-style: normal; color: var(--red); }
.sec-body { font-family: 'Outfit', sans-serif; font-size: 15px; color: rgba(247,238,233,.45); line-height: 1.82; margin-bottom: 32px; }
.about-stat-row { display: flex; gap: 36px; margin-bottom: 36px; padding: 28px 0; border-top: 1px solid rgba(228,30,43,.12); border-bottom: 1px solid rgba(228,30,43,.12); }
.about-stat-num { display: block; font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: 48px; color: var(--red); line-height: 1; letter-spacing: -.02em; }
.about-stat-label { display: block; font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .22em; text-transform: uppercase; color: rgba(247,238,233,.3); margin-top: 3px; }

/* ── Pillars ── */
#pillars { background: var(--bg); padding: 140px 80px; position: relative; }
#pillars::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(228,30,43,.25), transparent); }
.pillars-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 2px; margin-top: 64px; }
.pillar { background: var(--surface); padding: 44px 36px 44px; border: 1px solid rgba(228,30,43,.06); position: relative; overflow: hidden; transition: transform .35s, background .35s; }
.pillar:hover { background: var(--card); border-color: rgba(228,30,43,.28); }
.pillar::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, rgba(228,30,43,.5), transparent); opacity: 0; transition: opacity .3s; }
.pillar:hover::before { opacity: 1; }
.pillar-num { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: 72px; color: rgba(228,30,43,.08); line-height: 1; position: absolute; top: 24px; right: 28px; }
.pillar-icon { font-size: 28px; margin-bottom: 28px; display: block; filter: drop-shadow(0 0 8px rgba(228,30,43,.4)); }
.pillar-title { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: 28px; text-transform: uppercase; color: var(--white); letter-spacing: -.01em; margin-bottom: 16px; line-height: 1; }
.pillar-body { font-family: 'Outfit', sans-serif; font-size: 14px; color: rgba(247,238,233,.42); line-height: 1.75; }

/* ── Dishes ── */
#dishes { background: var(--bg); padding: 140px 80px; }
.dishes-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 64px; }
.dishes-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
.dish-card { background: var(--surface); border: 1px solid rgba(228,30,43,.1); border-radius: 2px; overflow: hidden; transition: transform .3s, box-shadow .3s, border-color .3s; }
.dish-card:hover { transform: translateY(-6px); box-shadow: 0 24px 60px rgba(0,0,0,.5), 0 0 30px rgba(228,30,43,.1); border-color: rgba(228,30,43,.28); }
.dish-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; filter: brightness(.88) saturate(1.15); transition: transform .6s ease; }
.dish-card:hover .dish-img { transform: scale(1.05); }
.dish-info { padding: 28px 28px 32px; }
.dish-tag { font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .32em; text-transform: uppercase; color: var(--red); margin-bottom: 10px; }
.dish-name { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: 26px; text-transform: uppercase; color: var(--white); letter-spacing: -.01em; margin-bottom: 10px; }
.dish-desc { font-family: 'Outfit', sans-serif; font-size: 13px; color: rgba(247,238,233,.38); line-height: 1.7; }

/* ── Videos ── */
#video-section { background: var(--dark); padding: 140px 80px; border-top: 1px solid rgba(228,30,43,.1); }
.video-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 28px; margin-top: 64px; }
.video-wrap { position: relative; border: 1px solid rgba(228,30,43,.18); border-radius: 2px; overflow: hidden; background: #000; box-shadow: 0 0 60px rgba(228,30,43,.08); transition: box-shadow .3s, border-color .3s; }
.video-wrap:hover { box-shadow: 0 0 80px rgba(228,30,43,.18); border-color: rgba(228,30,43,.32); }
.video-wrap video { width: 100%; display: block; }
.video-label { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px 24px 18px; background: linear-gradient(to top, rgba(12,6,4,.9) 0%, transparent 100%); font-family: 'Outfit', sans-serif; font-size: 11px; letter-spacing: .24em; text-transform: uppercase; color: rgba(247,238,233,.4); pointer-events: none; }

/* ── Gallery Teaser ── */
#gallery-teaser { background: var(--bg); padding: 140px 80px; }
.gallery-grid { display: grid; margin-top: 64px; grid-template-columns: repeat(12, 1fr); grid-template-rows: repeat(2, 280px); gap: 10px; }
.g-cell { overflow: hidden; border-radius: 2px; position: relative; }
.g-cell img { width: 100%; height: 100%; object-fit: cover; display: block; filter: brightness(.8) saturate(1.1); transition: transform .6s ease, filter .4s; }
.g-cell:hover img { transform: scale(1.06); filter: brightness(.95) saturate(1.2); }
.g1 { grid-column: span 5; grid-row: span 2; } .g2 { grid-column: span 4; } .g3 { grid-column: span 3; } .g4 { grid-column: span 3; } .g5 { grid-column: span 4; }

/* ── Reserve CTA ── */
#reserve-cta { background: var(--dark); padding: 140px 80px; border-top: 1px solid rgba(228,30,43,.12); position: relative; overflow: hidden; display: flex; flex-direction: column; align-items: center; text-align: center; }
#reserve-cta::before { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 700px; height: 700px; border-radius: 50%; background: radial-gradient(circle, rgba(228,30,43,.08) 0%, transparent 70%); pointer-events: none; }
.reserve-zh { font-family: 'Noto Serif SC', serif; font-size: 13px; letter-spacing: .32em; color: rgba(228,30,43,.5); margin-bottom: 28px; }
.reserve-title { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: clamp(56px, 10vw, 130px); text-transform: uppercase; color: var(--white); line-height: .88; letter-spacing: -.02em; margin-bottom: 32px; }
.reserve-title em { font-style: normal; color: var(--red); }
.reserve-body { font-family: 'Outfit', sans-serif; font-size: 15px; color: rgba(247,238,233,.42); max-width: 460px; line-height: 1.75; margin-bottom: 52px; }
.reserve-info-row { display: flex; gap: 60px; margin-bottom: 52px; justify-content: center; }
.reserve-info-item { display: flex; flex-direction: column; gap: 6px; align-items: center; }
.reserve-info-label { font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .36em; text-transform: uppercase; color: rgba(228,30,43,.6); }
.reserve-info-val { font-family: 'Outfit', sans-serif; font-size: 14px; color: rgba(247,238,233,.7); }

/* ── Responsive ── */
@media (max-width: 900px) {
    .hero-content { padding: 0 24px; }
    .hero-bowl { display: none; }
    .hero-bg-zh { display: none; }
    .hero-strip { grid-template-columns: repeat(3,1fr) !important; }
    #about-teaser { grid-template-columns: 1fr; padding: 80px 24px; gap: 40px; }
    .about-img-wrap { height: 300px; }
    .about-text { padding: 0; }
    #pillars, #dishes, #video-section, #gallery-teaser, #reserve-cta { padding: 80px 24px; }
    .pillars-grid, .dishes-grid, .video-grid { grid-template-columns: 1fr; }
    .gallery-grid { grid-template-columns: repeat(2,1fr); grid-template-rows: auto; }
    .g1,.g2,.g3,.g4,.g5 { grid-column: span 1; grid-row: span 1; height: 220px; }
    .dishes-header { flex-direction: column; align-items: flex-start; gap: 20px; }
    .reserve-info-row { flex-direction: column; gap: 24px; }
}
/* ── Scroll-reveal aliases ── */
.sr { opacity: 0; transform: translateY(32px); transition: opacity .8s, transform .8s; }
.sr.vis { opacity: 1; transform: translateY(0); }
.sr-d1 { transition-delay:.1s; } .sr-d2 { transition-delay:.22s; }
.sr-d3 { transition-delay:.36s; } .sr-d4 { transition-delay:.5s; }
</style>

<?php
$uri       = get_template_directory_uri();
$home      = home_url('/');
$wa_link   = dh_opt_url('whatsapp', 'https://wa.link/3f0hjs');
$phone_raw = dh_opt('phone', '+60 17 878 7652');

// Gallery teaser: try CPT, fallback to theme images
$gallery_posts = get_posts(['post_type' => 'dh_gallery', 'posts_per_page' => 5, 'orderby' => 'menu_order', 'order' => 'ASC']);
$gallery_imgs  = [];
foreach ($gallery_posts as $gp) {
    $thumb = get_the_post_thumbnail_url($gp->ID, 'large');
    if ($thumb) $gallery_imgs[] = ['url' => $thumb, 'alt' => esc_attr($gp->post_title)];
}
// Fallback static images if CPT is empty
if (empty($gallery_imgs)) {
    $fallback = ['DSC04894.jpg','DSC05099.jpg','DSC02302.jpg','DSC05468 (1).jpg','DSC04903.jpg'];
    foreach ($fallback as $f) $gallery_imgs[] = ['url' => "$uri/assets/gallery/" . urlencode($f), 'alt' => 'Dian Huo Hotpot'];
}

?>

<!-- HERO -->
<section id="hero">
    <canvas id="hero-canvas"></canvas>
    <div class="hero-glow"></div>
    <div class="hero-bg-zh">火</div>

    <div class="hero-bowl">
        <div class="hero-bowl-inner">
            <img src="<?php echo esc_url("$uri/assets/images/hero-bowl.jpg"); ?>" alt="" class="hero-bowl-logo">
        </div>
    </div>

    <div class="hero-content">
        <p class="hero-eyebrow" data-i18n="hero-eyebrow">Rooftop · Hotpot · Level 3</p>
        <span class="hero-line l1" data-i18n="hero-l1">露天</span>
        <span class="hero-line l2" data-i18n="hero-l2">打边炉</span>
        <p class="hero-zh" data-i18n="hero-zh-tag">點火心窩 · 城市之巔</p>
        <p class="hero-sub" data-i18n="hero-sub">A rooftop hotpot experience above the city skyline. Fire, flavour, and the open night sky.</p>
        <div class="hero-cta">
            <a href="<?php echo esc_url(home_url('/reserve/')); ?>" class="btn-primary"><span data-i18n="hero-btn-reserve">Reserve a Table</span></a>
            <a href="<?php echo esc_url(home_url('/menu/')); ?>" class="btn-outline" data-i18n="hero-btn-menu">View Menu</a>
        </div>
    </div>

    <svg class="hero-skyline" viewBox="0 0 1440 160" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <defs><linearGradient id="sg" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#0C0604" stop-opacity="0"/><stop offset="60%" stop-color="#0C0604" stop-opacity="0.5"/><stop offset="100%" stop-color="#0C0604" stop-opacity="1"/></linearGradient></defs>
        <path fill="#0C0604" d="M0,160 L0,138 L28,138 L28,122 L46,122 L46,108 L60,108 L60,92 L74,92 L74,76 L84,76 L84,64 L94,64 L94,76 L108,76 L108,60 L118,50 L128,50 L138,60 L148,60 L148,76 L162,76 L162,92 L180,92 L180,72 L194,72 L194,56 L206,46 L218,36 L230,46 L242,56 L242,72 L256,72 L256,88 L274,88 L274,68 L288,68 L288,52 L300,40 L314,52 L314,68 L330,68 L330,88 L348,88 L348,68 L362,68 L362,50 L374,38 L386,28 L398,38 L410,50 L410,68 L426,68 L426,88 L444,88 L444,66 L458,66 L458,48 L470,36 L484,48 L484,66 L500,66 L500,88 L518,88 L518,66 L532,66 L532,48 L545,36 L558,26 L572,36 L585,48 L585,66 L602,66 L602,88 L620,88 L620,68 L634,68 L634,52 L647,40 L660,52 L660,68 L676,68 L676,88 L694,88 L694,68 L708,68 L708,50 L720,38 L734,50 L734,68 L750,68 L750,88 L768,88 L768,66 L782,66 L782,48 L795,36 L808,48 L808,66 L824,66 L824,88 L842,88 L842,68 L856,68 L856,50 L870,38 L883,28 L897,38 L910,50 L910,68 L926,68 L926,88 L944,88 L944,68 L958,68 L958,50 L971,38 L985,50 L985,68 L1001,68 L1001,88 L1019,88 L1019,64 L1033,64 L1033,48 L1046,36 L1060,48 L1060,64 L1076,64 L1076,82 L1094,82 L1094,66 L1108,66 L1108,50 L1121,38 L1135,50 L1135,66 L1151,66 L1151,82 L1169,82 L1169,88 L1187,88 L1187,70 L1201,70 L1201,54 L1215,42 L1229,54 L1229,70 L1245,70 L1245,88 L1263,88 L1263,76 L1277,76 L1277,62 L1290,52 L1304,62 L1304,76 L1320,76 L1320,90 L1338,90 L1338,106 L1356,106 L1356,120 L1380,120 L1380,134 L1410,134 L1440,134 L1440,160 Z"/>
        <rect x="0" y="0" width="1440" height="160" fill="url(#sg)"/>
    </svg>

    <div class="hero-strip" style="grid-template-columns: repeat(5,1fr);">
        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="strip-item">
            <span class="strip-zh zh-only">關於我們</span>
            <span class="strip-en" data-i18n="strip-story">Our Story</span>
        </a>
        <a href="<?php echo esc_url(home_url('/menu/')); ?>" class="strip-item">
            <span class="strip-zh zh-only">菜　　單</span>
            <span class="strip-en" data-i18n="strip-menu">Menu</span>
        </a>
        <a href="<?php echo esc_url(home_url('/gallery/')); ?>" class="strip-item">
            <span class="strip-zh zh-only">相　　冊</span>
            <span class="strip-en" data-i18n="strip-gallery">Gallery</span>
        </a>
        <a href="<?php echo esc_url(home_url('/experience/')); ?>" class="strip-item">
            <span class="strip-zh zh-only">空間體驗</span>
            <span class="strip-en" data-i18n="strip-exp">Experience</span>
        </a>
        <a href="<?php echo esc_url(home_url('/reserve/')); ?>" class="strip-item">
            <span class="strip-zh zh-only">訂　　座</span>
            <span class="strip-en" data-i18n="strip-res">Reservations</span>
        </a>
    </div>
</section>

<!-- ABOUT TEASER -->
<section id="about-teaser">
    <div class="about-img-wrap sr">
        <img src="<?php echo esc_url("$uri/assets/images/cooking.jpg"); ?>" alt="Cooking at Dian Huo">
        <div class="about-img-frame"></div>
    </div>
    <div class="about-text">
        <p class="sec-label sr sr-d1" data-i18n="idx-about-label">Our Story · 我們的故事</p>
        <h2 class="sec-title sr sr-d1" data-i18n="idx-about-title">Born from<br><em>fire,</em><br>built for<br>the night.</h2>
        <p class="sec-body sr sr-d2" data-i18n="idx-about-body">Dian Huo was born from a simple belief — that the best meals happen in the open air, under a darkening sky, with the heat of a hotpot between you and the people you love. Perched on Level 3, we built Petaling Jaya's most memorable rooftop table.</p>
        <div class="about-stat-row sr sr-d3">
            <div class="about-stat">
                <span class="about-stat-num">3</span>
                <span class="about-stat-label" data-i18n="idx-stat-floors">Floors Up</span>
            </div>
            <div class="about-stat">
                <span class="about-stat-num">8+</span>
                <span class="about-stat-label" data-i18n="idx-stat-broths">Signature Broths</span>
            </div>
            <div class="about-stat">
                <span class="about-stat-num">∞</span>
                <span class="about-stat-label" data-i18n="idx-stat-nights">Good Nights</span>
            </div>
        </div>
        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn-outline sr sr-d4" data-i18n="idx-about-btn">Read Our Story</a>
    </div>
</section>

<!-- PILLARS -->
<section id="pillars">
    <div style="max-width:1100px;margin:0 auto;">
        <p class="sec-label sr" data-i18n="idx-pillars-label">Why Dian Huo · 為何選擇我們</p>
        <h2 class="sec-title sr sr-d1" data-i18n="idx-pillars-title">The <em>experience</em><br>in three acts.</h2>
        <div class="pillars-grid" style="margin-top:64px;">
            <div class="pillar sr sr-d1">
                <span class="pillar-num">01</span>
                <span class="pillar-icon">🏙️</span>
                <h3 class="pillar-title" data-i18n="idx-pillar1-title">Open-Air Rooftop</h3>
                <p class="pillar-body" data-i18n="idx-pillar1-body">Dine beneath the Petaling Jaya skyline on our open-air Level 3 terrace. Every table faces the city lights.</p>
            </div>
            <div class="pillar sr sr-d2">
                <span class="pillar-num">02</span>
                <span class="pillar-icon">🍲</span>
                <h3 class="pillar-title" data-i18n="idx-pillar2-title">Signature Broths</h3>
                <p class="pillar-body" data-i18n="idx-pillar2-body">House-crafted broths, from our slow-simmered Coconut Herbal to the signature Spicy Mala.</p>
            </div>
            <div class="pillar sr sr-d3">
                <span class="pillar-num">03</span>
                <span class="pillar-icon">🥩</span>
                <h3 class="pillar-title" data-i18n="idx-pillar3-title">Premium Cuts</h3>
                <p class="pillar-body" data-i18n="idx-pillar3-body">Handmade balls, wagyu slices, and fresh seafood — sourced daily. Every ingredient earns its place.</p>
            </div>
        </div>
    </div>
</section>

<!-- SIGNATURE DISHES -->
<section id="dishes">
    <div style="max-width:1100px;margin:0 auto;">
        <div class="dishes-header">
            <div class="sr">
                <p class="sec-label" data-i18n="idx-dishes-label">Signature Dishes · 招牌菜</p>
                <h2 class="sec-title" data-i18n="idx-dishes-title">Made to<br><em>savour.</em></h2>
            </div>
            <a href="<?php echo esc_url(home_url('/menu/')); ?>" class="btn-outline sr sr-d2" data-i18n="idx-dishes-btn">Full Menu</a>
        </div>
        <div class="dishes-grid">
            <div class="dish-card sr sr-d1">
                <div style="overflow:hidden;">
                    <img class="dish-img" src="<?php echo esc_url("$uri/assets/images/coconut-herbal-soup.png"); ?>" alt="Coconut Herbal Soup">
                </div>
                <div class="dish-info">
                    <p class="dish-tag" data-i18n="idx-dish1-tag">Signature Broth</p>
                    <h3 class="dish-name" data-i18n="idx-dish1-name">Coconut Herbal Soup</h3>
                    <p class="dish-desc" data-i18n="idx-dish1-desc">A light, nourishing broth built on fresh coconut and Chinese herbs.</p>
                </div>
            </div>
            <div class="dish-card sr sr-d2">
                <div style="overflow:hidden;">
                    <img class="dish-img" src="<?php echo esc_url("$uri/assets/images/handmade-ball.png"); ?>" alt="Handmade Balls">
                </div>
                <div class="dish-info">
                    <p class="dish-tag" data-i18n="idx-dish2-tag">House Specialty</p>
                    <h3 class="dish-name" data-i18n="idx-dish2-name">Handmade Balls</h3>
                    <p class="dish-desc" data-i18n="idx-dish2-desc">Crafted in-house daily — springy and flavour-packed.</p>
                </div>
            </div>
            <div class="dish-card sr sr-d3">
                <div style="overflow:hidden;">
                    <img class="dish-img" src="<?php echo esc_url("$uri/assets/images/dish.png"); ?>" alt="Chef's Selection">
                </div>
                <div class="dish-info">
                    <p class="dish-tag" data-i18n="idx-dish3-tag">Premium Platter</p>
                    <h3 class="dish-name" data-i18n="idx-dish3-name">Chef's Selection</h3>
                    <p class="dish-desc" data-i18n="idx-dish3-desc">The chef's daily premium platter — fresh market cuts for the table.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VIDEOS -->
<section id="video-section">
    <div style="max-width:1100px;margin:0 auto;">
        <p class="sec-label sr" data-i18n="idx-video-label">In the Moment · 感受現場</p>
        <h2 class="sec-title sr sr-d1" data-i18n="idx-video-title">Feel the<br><em>fire.</em></h2>
        <div class="video-grid">
            <div class="video-wrap sr sr-d2">
                <video controls preload="metadata">
                    <source src="<?php echo esc_url("$uri/assets/video/video-1.mp4"); ?>" type="video/mp4">
                </video>
                <div class="video-label" data-i18n="idx-video1-label">Rooftop Experience · Vol. 1</div>
            </div>
            <div class="video-wrap sr sr-d3">
                <video controls preload="metadata">
                    <source src="<?php echo esc_url("$uri/assets/video/video-2.mp4"); ?>" type="video/mp4">
                </video>
                <div class="video-label" data-i18n="idx-video2-label">Rooftop Experience · Vol. 2</div>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY TEASER -->
<section id="gallery-teaser">
    <div style="max-width:1100px;margin:0 auto;">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:20px;" class="sr">
            <div>
                <p class="sec-label" data-i18n="idx-gallery-label">Gallery · 相冊</p>
                <h2 class="sec-title" data-i18n="idx-gallery-title">Every night<br>tells a <em>story.</em></h2>
            </div>
            <a href="<?php echo esc_url(home_url('/gallery/')); ?>" class="btn-outline sr sr-d2" data-i18n="idx-gallery-btn">View All Photos</a>
        </div>
        <?php if (!empty($gallery_imgs)): $gc = ['g1','g2','g3','g4','g5']; ?>
        <div class="gallery-grid">
            <?php foreach (array_slice($gallery_imgs,0,5) as $i => $g): ?>
            <div class="g-cell <?php echo esc_attr($gc[$i] ?? ''); ?> sr sr-d<?php echo ($i+1); ?>">
                <img src="<?php echo esc_url($g['url']); ?>" loading="lazy" alt="<?php echo esc_attr($g['alt']); ?>">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- RESERVE CTA -->
<section id="reserve-cta">
    <p class="reserve-zh sr" data-i18n="idx-reserve-zh">點火心窩 · 訂座</p>
    <h2 class="reserve-title sr sr-d1" data-i18n="idx-reserve-title">Claim your<br>seat <em>above</em><br>the city.</h2>
    <p class="reserve-body sr sr-d2" data-i18n="idx-reserve-body">Tables fill fast on weekends. Reserve yours and arrive to an open sky, a glowing pot, and a night you won't forget.</p>
    <div class="reserve-info-row sr sr-d2">
        <div class="reserve-info-item">
            <span class="reserve-info-label" data-i18n="idx-reserve-loc-label">Location</span>
            <span class="reserve-info-val en-only"><?php echo dh_opt('address_en','Level 3, Jalan SS 24/9, PJ'); ?></span>
            <span class="reserve-info-val zh-only"><?php echo dh_opt('address_zh','白蒲 SS 24/9路 3樓'); ?></span>
        </div>
        <div class="reserve-info-item">
            <span class="reserve-info-label" data-i18n="idx-reserve-hrs-label">Hours</span>
            <span class="reserve-info-val">Mon – Sun · 12 pm – 12 am</span>
        </div>
        <div class="reserve-info-item">
            <span class="reserve-info-label" data-i18n="idx-reserve-enq-label">Enquiries</span>
            <span class="reserve-info-val"><?php echo esc_html($phone_raw); ?></span>
        </div>
    </div>
    <div class="sr sr-d3" style="display:flex;gap:16px;flex-wrap:wrap;justify-content:center;">
        <a href="<?php echo esc_url(home_url('/reserve/')); ?>" class="btn-primary"><span data-i18n="idx-reserve-btn">Reserve a Table</span></a>
        <a href="<?php echo esc_url($wa_link); ?>" class="btn-outline" data-i18n="idx-reserve-wa">WhatsApp Us</a>
    </div>
</section>

<script>
// Ember canvas
const canvas = document.getElementById('hero-canvas');
const ctx = canvas.getContext('2d');
function resize(){ canvas.width = window.innerWidth; canvas.height = window.innerHeight; }
resize();
window.addEventListener('resize', resize);
class Ember {
    constructor(init){ this.reset(init); }
    reset(init){
        this.x = Math.random() * canvas.width;
        this.y = init ? Math.random() * canvas.height : canvas.height + 10;
        this.size = Math.random() * 2.5 + 0.5;
        this.speedY = Math.random() * 0.8 + 0.3;
        this.speedX = (Math.random() - 0.5) * 0.4;
        this.opacity = Math.random() * 0.6 + 0.1;
        this.life = 0; this.maxLife = Math.random() * 200 + 100;
    }
    tick(){
        this.y -= this.speedY; this.x += this.speedX;
        this.life++;
        if(this.y < -10 || this.life > this.maxLife) this.reset(false);
    }
    draw(){
        const a = this.opacity * Math.sin(Math.PI * this.life / this.maxLife);
        ctx.save();
        ctx.globalAlpha = a;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI*2);
        const g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.size*3);
        g.addColorStop(0, '#ff9a4a'); g.addColorStop(0.5, '#e41e2b'); g.addColorStop(1, 'transparent');
        ctx.fillStyle = g; ctx.fill();
        ctx.restore();
    }
}
const embers = Array.from({length:80}, (_,i) => new Ember(true));
(function loop(){ ctx.clearRect(0,0,canvas.width,canvas.height); embers.forEach(e=>{e.tick();e.draw();}); requestAnimationFrame(loop); })();

// Scroll reveals (.sr)
const srObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('vis'); srObs.unobserve(e.target); } });
}, { threshold:0.08, rootMargin:'0px 0px -44px 0px' });
document.querySelectorAll('.sr').forEach(el => srObs.observe(el));
</script>

<?php get_footer(); ?>
