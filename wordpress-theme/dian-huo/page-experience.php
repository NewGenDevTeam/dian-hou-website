<?php
/*
 * Template Name: Experience Page
 */
get_header();
$uri = get_template_directory_uri();
?>
<style>
#experience { padding: 90px 0 130px; background: var(--dark); }

.exp-intro { margin-bottom: 72px; }
.exp-intro h2 {
    font-family: 'Big Shoulders Display', sans-serif; font-weight: 900;
    font-size: clamp(52px, 9vw, 110px); text-transform: uppercase;
    color: var(--white); line-height: 0.88; letter-spacing: -0.02em;
}
.exp-intro h2 em { font-style: normal; color: var(--red); }

/* Mosaic grid */
.exp-mosaic {
    display: grid; grid-template-columns: 2fr 1fr 1fr;
    grid-template-rows: 300px 300px; gap: 3px; margin-bottom: 100px;
}
.exp-tile {
    position: relative; overflow: hidden;
    display: flex; align-items: flex-end; padding: 28px;
}
.exp-tile:first-child { grid-row: 1 / 3; }
.exp-bg { position: absolute; inset: 0; transition: transform .6s ease; }
.exp-tile:hover .exp-bg { transform: scale(1.05); }

.exp-tile:nth-child(1) .exp-bg {
    background: radial-gradient(ellipse at 35% 65%, rgba(48,8,8,.72) 0%, rgba(24,4,4,.68) 50%, rgba(12,3,2,.80) 100%),
    url('<?php echo $uri; ?>/assets/images/relax.jpg') center/cover no-repeat;
}
.exp-tile:nth-child(2) .exp-bg {
    background: radial-gradient(ellipse at 50% 50%, rgba(36,20,4,.70) 0%, rgba(20,10,2,.66) 50%, rgba(10,6,2,.80) 100%),
    url('<?php echo $uri; ?>/assets/images/night.view.jpg') center/cover no-repeat;
}
.exp-tile:nth-child(3) .exp-bg {
    background: radial-gradient(ellipse at 50% 50%, rgba(24,24,4,.70) 0%, rgba(14,14,2,.66) 50%, rgba(6,6,2,.80) 100%),
    url('<?php echo $uri; ?>/assets/images/vip.room.jpg') center/cover no-repeat;
}
.exp-tile:nth-child(4) .exp-bg {
    background: radial-gradient(ellipse at 50% 50%, rgba(4,24,16,.70) 0%, rgba(2,14,8,.66) 50%, rgba(1,6,4,.80) 100%),
    url('<?php echo $uri; ?>/assets/images/rooftop.view.jpg') center/cover no-repeat;
}
.exp-tile:nth-child(5) .exp-bg {
    background: radial-gradient(ellipse at 50% 50%, rgba(22,4,24,.70) 0%, rgba(10,2,12,.66) 50%, rgba(6,1,6,.80) 100%),
    url('<?php echo $uri; ?>/assets/images/cooking.jpg') center/cover no-repeat;
}

.exp-tile::before {
    content: ''; position: absolute; inset: 0; z-index: 2;
    border: 1.5px solid transparent; transition: border-color .35s;
}
.exp-tile:hover::before { border-color: rgba(228,30,43,.35); }

.exp-num {
    font-family: 'Big Shoulders Display', sans-serif; font-weight: 900;
    font-size: 80px; letter-spacing: -0.04em;
    color: rgba(228,30,43,.1); position: absolute; top: 16px; right: 20px;
    line-height: 1; z-index: 1;
}
.exp-content { position: relative; z-index: 3; }
.exp-content h3 {
    font-family: 'Big Shoulders Display', sans-serif; font-weight: 800;
    font-size: 22px; text-transform: uppercase; color: var(--white);
    margin-bottom: 6px; letter-spacing: 0.01em;
}
.exp-content p { font-family: 'Outfit', sans-serif; font-size: 13px; color: var(--muted); line-height: 1.6; }

/* Features */
#features { background: var(--bg); padding: 100px 0; position: relative; }
#features::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(228,30,43,.22), transparent);
}
.feature-row {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 80px; align-items: center; padding: 72px 0;
    border-bottom: 1px solid rgba(228,30,43,.1);
}
.feature-row:last-child { border-bottom: none; }
.feature-row.flip { direction: rtl; }
.feature-row.flip > * { direction: ltr; }

.feature-vis { aspect-ratio: 4/3; position: relative; overflow: hidden; }
.fv-inner { position: absolute; inset: 0; transition: transform .6s ease; }
.feature-vis:hover .fv-inner { transform: scale(1.04); }
.fv-1 {
    background: radial-gradient(ellipse at 30% 70%, rgba(56,10,4,.35) 0%, rgba(28,5,2,.30) 50%, rgba(12,3,1,.45) 100%),
    url('<?php echo $uri; ?>/assets/images/nice.view.jpg') center/cover no-repeat;
}
.fv-2 {
    background: radial-gradient(ellipse at 70% 30%, rgba(26,36,10,.35) 0%, rgba(12,20,4,.30) 50%, rgba(6,8,2,.45) 100%),
    url('<?php echo $uri; ?>/assets/images/vip1.jpg') center/cover no-repeat;
}
.fv-3 {
    background: radial-gradient(ellipse at 50% 50%, rgba(30,4,40,.35) 0%, rgba(12,2,24,.30) 50%, rgba(6,1,16,.45) 100%),
    url('<?php echo $uri; ?>/assets/images/cooking.jpg') center/cover no-repeat;
}
.fv-glow {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
    width: 180px; height: 180px; border-radius: 50%;
    background: radial-gradient(circle, rgba(228,30,43,.15), transparent 70%);
}
.feature-text h3 {
    font-family: 'Big Shoulders Display', sans-serif; font-weight: 900;
    font-size: clamp(34px, 4.5vw, 58px); text-transform: uppercase;
    color: var(--white); line-height: 0.92; letter-spacing: -0.02em; margin-bottom: 10px;
}
.feature-text h3 em { font-style: normal; color: var(--red); }
.feature-text-zh { font-family: 'Noto Serif SC', serif; font-size: 12px; letter-spacing: .18em; color: rgba(228,30,43,.4); margin-bottom: 20px; }
.feature-text p { font-size: 15px; line-height: 1.84; color: var(--muted); margin-bottom: 14px; }

@media (max-width: 900px) {
    .exp-mosaic { grid-template-columns: 1fr 1fr; grid-template-rows: auto; }
    .exp-tile:first-child { grid-row: auto; grid-column: 1 / -1; min-height: 220px; }
    .feature-row, .feature-row.flip { grid-template-columns: 1fr; gap: 32px; direction: ltr; }
}
</style>

<div class="page-hdr">
    <div class="page-hdr-glow"></div>
    <div class="page-hdr-bg">SKY</div>
    <div class="page-hdr-content">
        <p class="label" style="justify-content:center;" data-i18n="exp-hdr-label">Level 3 Rooftop</p>
        <h1 class="page-hdr-title" data-i18n="exp-hdr-title">THE <em>ROOFTOP</em><br>EXPERIENCE</h1>
        <p class="page-hdr-zh" data-i18n="exp-page-zh">空間體驗 · 城市之巔</p>
    </div>
</div>

<section id="experience">
    <div class="container">
        <div class="exp-intro">
            <p class="label reveal" data-i18n="exp-intro-label">Five Reasons to Come Up</p>
            <h2 class="reveal d1" data-i18n="exp-intro-h2">ABOVE<br>THE <em>CITY</em></h2>
        </div>

        <div class="exp-mosaic reveal d2">
            <div class="exp-tile" data-hover>
                <div class="exp-bg"></div>
                <span class="exp-num">01</span>
                <div class="exp-content">
                    <h3 data-i18n="exp-tile1-h3">Rooftop Panorama</h3>
                    <p data-i18n="exp-tile1-p">Eighteen floors above the city. Watch twilight descend as your pot boils across the glittering skyline.</p>
                </div>
            </div>
            <div class="exp-tile" data-hover>
                <div class="exp-bg"></div>
                <span class="exp-num">02</span>
                <div class="exp-content">
                    <h3 data-i18n="exp-tile2-h3">Night Ambience</h3>
                    <p data-i18n="exp-tile2-p">City lights below. Red lanterns above. The hiss of a boiling pot between.</p>
                </div>
            </div>
            <div class="exp-tile" data-hover>
                <div class="exp-bg"></div>
                <span class="exp-num">03</span>
                <div class="exp-content">
                    <h3 data-i18n="exp-tile3-h3">Private Dining</h3>
                    <p data-i18n="exp-tile3-p">Intimate tables for celebrations. Bespoke menus curated for your occasion.</p>
                </div>
            </div>
            <div class="exp-tile" data-hover>
                <div class="exp-bg"></div>
                <span class="exp-num">04</span>
                <div class="exp-content">
                    <h3 data-i18n="exp-tile4-h3">Sunset Sessions</h3>
                    <p data-i18n="exp-tile4-p">Arrive at golden hour. Sip chrysanthemum tea as the sun sets behind the skyline.</p>
                </div>
            </div>
            <div class="exp-tile" data-hover>
                <div class="exp-bg"></div>
                <span class="exp-num">05</span>
                <div class="exp-content">
                    <h3 data-i18n="exp-tile5-h3">Live Fire Cooking</h3>
                    <p data-i18n="exp-tile5-p">Your pot, your pace, your soup base — precision fire for the perfect broth every time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features">
    <div class="container">
        <div class="feature-row reveal">
            <div class="feature-vis">
                <div class="fv-inner fv-1"></div>
                <div class="fv-glow"></div>
            </div>
            <div class="feature-text">
                <p class="label" data-i18n="feat1-label">Evening Atmosphere</p>
                <h3 data-i18n="feat1-h3">A CITY<br>AT YOUR <em>FEET</em></h3>
                <p class="feature-text-zh zh-only">夜景與火鍋 · 城市之美</p>
                <p data-i18n="feat1-p1">At dusk the city transforms. From 18 floors up, the skyline becomes your dining room — a living canvas of light that no interior restaurant can replicate.</p>
                <p data-i18n="feat1-p2">Every table faces outward. No seat has a bad view.</p>
            </div>
        </div>

        <div class="feature-row flip reveal d1">
            <div class="feature-vis">
                <div class="fv-inner fv-2"></div>
                <div class="fv-glow"></div>
            </div>
            <div class="feature-text">
                <p class="label" data-i18n="feat2-label">Private Dining</p>
                <h3 data-i18n="feat2-h3">YOUR <em>PRIVATE</em><br>TABLE</h3>
                <p class="feature-text-zh zh-only">私人包廂 · 專屬服務</p>
                <p data-i18n="feat2-p1">Birthdays, anniversaries, corporate evenings, proposals — our private section seats up to 12 guests with a dedicated team and a custom set menu.</p>
                <p data-i18n="feat2-p2">Enquire about our bespoke private dining packages.</p>
            </div>
        </div>

        <div class="feature-row reveal d2">
            <div class="feature-vis">
                <div class="fv-inner fv-3"></div>
                <div class="fv-glow"></div>
            </div>
            <div class="feature-text">
                <p class="label" data-i18n="feat3-label">The Ritual</p>
                <h3 data-i18n="feat3-h3">THE <em>HOTPOT</em><br>RITUAL</h3>
                <p class="feature-text-zh zh-only">打邊爐的儀式 · 共聚一桌</p>
                <p data-i18n="feat3-p1">Hotpot is not simply a meal — it is the slowest, most communal way to eat. You wait for the broth, you pass across the table, and the conversation fills the time between.</p>
                <p data-i18n="feat3-p2">We built the rooftop to make that ritual worth even more.</p>
            </div>
        </div>

        <div class="ornament-line reveal"><span>天</span></div>
        <div style="text-align:center;" class="reveal d1">
            <a href="<?php echo esc_url(home_url('/reserve/')); ?>" class="btn-primary"><span data-i18n="exp-btn">Secure Your Evening</span></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
