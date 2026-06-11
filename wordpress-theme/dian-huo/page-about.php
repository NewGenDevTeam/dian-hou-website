<?php
/*
 * Template Name: About Page
 */
get_header(); ?>
<style>
#about { padding: 100px 0 120px; background: var(--dark); position: relative; }
#about::before { content: ''; position: absolute; inset: 0; pointer-events: none; background-image: radial-gradient(circle, rgba(228,30,43,.022) 1px, transparent 1px); background-size: 36px 36px; }
.about-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 90px; align-items: center; }
.story-photo-wrap { position: relative; width: 100%; height: 100%; min-height: 300px; overflow: hidden; }
.story-photo { width: 100%; height: 100%; object-fit: cover; object-position: center 40%; display: block; filter: saturate(1.1) brightness(0.8) contrast(1.06); transition: transform .9s ease, filter .9s ease; }
.story-photo-wrap:hover .story-photo { transform: scale(1.04); filter: saturate(1.2) brightness(.88) contrast(1.08); }
.story-photo-overlay { position: absolute; inset: 0; pointer-events: none; background: linear-gradient(to right, rgba(10,3,1,.9) 0%, transparent 22%, transparent 78%, rgba(10,3,1,.9) 100%), linear-gradient(to bottom, rgba(10,3,1,.6) 0%, transparent 18%, transparent 72%, rgba(10,3,1,.8) 100%); }
.about-text h2 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: clamp(42px, 6vw, 78px); text-transform: uppercase; color: var(--white); line-height: 0.92; letter-spacing: -0.01em; margin-bottom: 28px; }
.about-text h2 em { font-style: normal; color: var(--red); }
.about-text p { font-size: 16px; line-height: 1.82; color: var(--muted); margin-bottom: 22px; }
.about-stats { display: flex; gap: 44px; margin-top: 40px; padding-top: 32px; border-top: 1px solid rgba(228,30,43,.16); }
.stat-num { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: 52px; color: var(--red); line-height: 1; margin-bottom: 4px; letter-spacing: -0.02em; }
.stat-lbl { font-family: 'Outfit', sans-serif; font-size: 10px; letter-spacing: .2em; text-transform: uppercase; color: rgba(247,238,233,.3); }

#values { background: var(--bg); padding: 100px 0; position: relative; }
#values::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(228,30,43,.25), transparent); }
.values-header { margin-bottom: 64px; }
.values-header h2 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: clamp(44px, 7vw, 90px); text-transform: uppercase; color: var(--white); line-height: 0.9; letter-spacing: -0.01em; }
.values-header h2 em { font-style: normal; color: var(--red); }
.values-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 2px; }
.val-card { background: var(--surface); padding: 44px 34px; border: 1px solid rgba(228,30,43,.06); position: relative; overflow: hidden; transition: transform .35s; }
.val-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: var(--red); transform: scaleX(0); transition: transform .35s; transform-origin: left; }
.val-card:hover { transform: translateY(-3px); }
.val-card:hover::before { transform: scaleX(1); }
.val-num { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: 72px; letter-spacing: -0.03em; color: rgba(228,30,43,.12); line-height: 1; margin-bottom: 20px; }
.val-card h3 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 800; font-size: 26px; text-transform: uppercase; color: var(--white); margin-bottom: 6px; letter-spacing: 0.01em; }
.val-zh { font-family: 'Noto Serif SC', serif; font-size: 12px; color: rgba(228,30,43,.5); margin-bottom: 14px; }
.val-card p { font-size: 14px; line-height: 1.75; color: var(--muted); }

@media (max-width: 900px) {
    .about-inner { grid-template-columns: 1fr; gap: 40px; }
    .story-photo-wrap { min-height: 280px; height: 280px; }
    .values-grid { grid-template-columns: 1fr; }
}
</style>

<div class="page-hdr">
    <div class="page-hdr-glow"></div>
    <div class="page-hdr-bg">FIRE</div>
    <div class="page-hdr-content">
        <p class="label" style="justify-content:center;" data-i18n="about-hdr-label">Est. 2024</p>
        <h1 class="page-hdr-title" data-i18n="about-hdr-title">OUR <em>STORY</em></h1>
        <p class="page-hdr-zh" data-i18n="about-page-zh">關於我們 · 點火心窩的故事</p>
    </div>
</div>

<section id="about">
    <div class="container">
        <div class="about-inner">
            <div class="about-deco reveal">
                <div class="story-photo-wrap">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/story-photo.jpg" alt="Dian Huo Hotpot Rooftop" class="story-photo">
                    <div class="story-photo-overlay"></div>
                </div>
            </div>
            <div class="about-text">
                <p class="label reveal" data-i18n="about-section-label">The Beginning</p>
                <h2 class="reveal d1" data-i18n="about-h2">DIAN HUO <em>HOTPOT</em><br>Our Story</h2>
                <p class="reveal d2" data-i18n="about-p1">DIAN HUO HOTPOT was born from one idea: To make every hotpot a warm gathering of people. "Dian Huo" is to ignite a good broth, and "Xin Wo" is to keep the warmth in your heart. We believe a good hotpot is not just about great taste — it's about the lively, comforting, and joyful moments shared around the table with family and friends.</p>
                <p class="reveal d3" data-i18n="about-p2">Every broth simmers for twelve hours. Every ingredient is sourced that morning. Every seat looks out at the city you call home — because some meals deserve more than four walls.</p>
                <div class="about-stats reveal d4">
                    <div><div class="stat-num">3</div><div class="stat-lbl" data-i18n="stat-rooftop">Rooftop Level</div></div>
                    <div><div class="stat-num">6</div><div class="stat-lbl" data-i18n="stat-broths">Signature Broths</div></div>
                    <div><div class="stat-num">40+</div><div class="stat-lbl" data-i18n="stat-ingredients">Fresh Ingredients</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="values">
    <div class="container">
        <div class="values-header">
            <p class="label reveal" data-i18n="values-label">What We Stand For</p>
            <h2 class="reveal d1" data-i18n="values-h2">QUALITY FOOD.<br><em>SERVICE FIRST.</em></h2>
        </div>
        <div class="values-grid">
            <div class="val-card reveal d1">
                <div class="val-num">01</div>
                <h3 data-i18n="val1-h3">The Freshest Ingredient</h3>
                <div class="val-zh">最新鮮的食材</div>
                <p data-i18n="val1-p">We source directly from trusted farms and fisheries every morning. If it isn't perfect, it doesn't reach your table.</p>
            </div>
            <div class="val-card reveal d2">
                <div class="val-num">02</div>
                <h3 data-i18n="val2-h3">The Patience of Fire</h3>
                <div class="val-zh">火的耐心</div>
                <p data-i18n="val2-p">Our broths simmer for twelve hours. Some take twenty-four. Good broth cannot be rushed — it is a commitment to flavour.</p>
            </div>
            <div class="val-card reveal d3">
                <div class="val-num">03</div>
                <h3 data-i18n="val3-h3">The Communal Table</h3>
                <div class="val-zh">共聚的餐桌</div>
                <p data-i18n="val3-p">Hotpot was never meant to be eaten alone. Every seat at our rooftop is an invitation to connect under open sky.</p>
            </div>
        </div>
        <div class="ornament-line reveal"><span>窩</span></div>
        <div style="text-align:center;" class="reveal d1">
            <a href="<?php echo esc_url(home_url('/reserve/')); ?>" class="btn-primary"><span data-i18n="about-btn-book">Book Your Evening</span></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
