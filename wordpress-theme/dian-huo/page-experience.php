<?php
/*
 * Template Name: Experience Page
 */
get_header(); ?>
<style>
#experience { padding: 100px 0 120px; background: var(--bg); }
.exp-intro { display: grid; grid-template-columns: 1fr 2fr; gap: 80px; margin-bottom: 80px; align-items: start; }
.exp-tiles { display: grid; grid-template-columns: repeat(3,1fr); gap: 2px; }
.exp-tile { background: var(--surface); padding: 38px 30px; border: 1px solid rgba(228,30,43,.06); position: relative; transition: transform .3s; }
.exp-tile:hover { transform: translateY(-4px); }
.exp-tile::before { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, rgba(228,30,43,.4), transparent); transform: scaleX(0); transition: transform .3s; }
.exp-tile:hover::before { transform: scaleX(1); }
.exp-tile-num { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: 64px; color: rgba(228,30,43,.08); line-height: 1; margin-bottom: 20px; }
.exp-tile h3 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 800; font-size: 22px; text-transform: uppercase; color: var(--white); margin-bottom: 12px; }
.exp-tile p { font-size: 13px; color: var(--muted); line-height: 1.75; }

#features { background: var(--dark); padding: 100px 0; border-top: 1px solid rgba(228,30,43,.08); }
.feature-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0; align-items: stretch; margin-bottom: 2px; }
.feature-row.reverse { direction: rtl; }
.feature-row.reverse > * { direction: ltr; }
.feature-img { position: relative; min-height: 460px; overflow: hidden; background: var(--surface); }
.feature-img img { width: 100%; height: 100%; object-fit: cover; display: block; filter: brightness(.75) saturate(1.1); transition: transform .8s, filter .5s; }
.feature-img:hover img { transform: scale(1.04); filter: brightness(.85) saturate(1.2); }
.feature-img-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(228,30,43,.06) 0%, transparent 60%); }
.feature-text { padding: 72px 64px; display: flex; flex-direction: column; justify-content: center; }
.feature-text h3 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: clamp(32px, 4vw, 54px); text-transform: uppercase; color: var(--white); line-height: .92; letter-spacing: -.01em; margin-bottom: 24px; }
.feature-text h3 em { font-style: normal; color: var(--red); }
.feature-text p { font-size: 15px; color: var(--muted); line-height: 1.82; margin-bottom: 16px; }

@media (max-width:900px) {
    .exp-intro { grid-template-columns: 1fr; gap: 40px; }
    .exp-tiles { grid-template-columns: 1fr; }
    .feature-row, .feature-row.reverse { grid-template-columns: 1fr; direction: ltr; }
    .feature-img { min-height: 260px; }
    .feature-text { padding: 40px 24px; }
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
            <div>
                <p class="label reveal" data-i18n="exp-intro-label">Five Reasons to Come Up</p>
                <h2 class="reveal d1" style="font-family:'Big Shoulders Display',sans-serif;font-weight:900;font-size:clamp(44px,6vw,80px);text-transform:uppercase;color:var(--white);line-height:.92;" data-i18n="exp-intro-h2">ABOVE<br>THE <em>CITY</em></h2>
            </div>
            <div class="exp-tiles">
                <?php
                $tiles = [
                    ['exp-tile1-h3','Rooftop Panorama','exp-tile1-p','Eighteen floors above the city. Watch twilight descend as your pot boils across the glittering skyline.'],
                    ['exp-tile2-h3','Night Ambience','exp-tile2-p','City lights below. Red lanterns above. The hiss of a boiling pot between.'],
                    ['exp-tile3-h3','Private Dining','exp-tile3-p','Intimate tables for celebrations. Bespoke menus curated for your occasion.'],
                    ['exp-tile4-h3','Sunset Sessions','exp-tile4-p','Arrive at golden hour. Sip chrysanthemum tea as the sun sets behind the skyline.'],
                    ['exp-tile5-h3','Live Fire Cooking','exp-tile5-p','Your pot, your pace, your soup base — precision fire for the perfect broth every time.'],
                ];
                foreach ($tiles as $i => [$hk,$h,$pk,$p]):
                ?>
                <div class="exp-tile reveal d<?php echo min($i+1,4); ?>">
                    <div class="exp-tile-num">0<?php echo $i+1; ?></div>
                    <h3 data-i18n="<?php echo esc_attr($hk); ?>"><?php echo esc_html($h); ?></h3>
                    <p data-i18n="<?php echo esc_attr($pk); ?>"><?php echo esc_html($p); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section id="features">
    <div class="feature-row reveal">
        <div class="feature-img">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/feature-city.jpg" alt="City view from Dian Huo">
            <div class="feature-img-overlay"></div>
        </div>
        <div class="feature-text">
            <p class="label" data-i18n="feat1-label">Evening Atmosphere</p>
            <h3 data-i18n="feat1-h3">A CITY<br>AT YOUR <em>FEET</em></h3>
            <p data-i18n="feat1-p1">At dusk the city transforms. From 3 floors up, the skyline becomes your dining room — a living canvas of light that no interior restaurant can replicate.</p>
            <p data-i18n="feat1-p2">Every table faces outward. No seat has a bad view.</p>
        </div>
    </div>
    <div class="feature-row reverse reveal">
        <div class="feature-img">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/feature-private.jpg" alt="Private dining at Dian Huo">
            <div class="feature-img-overlay"></div>
        </div>
        <div class="feature-text">
            <p class="label" data-i18n="feat2-label">Private Dining</p>
            <h3 data-i18n="feat2-h3">YOUR <em>PRIVATE</em><br>TABLE</h3>
            <p data-i18n="feat2-p1">Birthdays, anniversaries, corporate evenings, proposals — our private section seats up to 12 guests with a dedicated team and a custom set menu.</p>
            <p data-i18n="feat2-p2">Enquire about our bespoke private dining packages.</p>
        </div>
    </div>
    <div class="feature-row reveal">
        <div class="feature-img">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/feature-ritual.jpg" alt="The hotpot ritual">
            <div class="feature-img-overlay"></div>
        </div>
        <div class="feature-text">
            <p class="label" data-i18n="feat3-label">The Ritual</p>
            <h3 data-i18n="feat3-h3">THE <em>HOTPOT</em><br>RITUAL</h3>
            <p data-i18n="feat3-p1">Hotpot is not simply a meal — it is the slowest, most communal way to eat. You wait for the broth, you pass across the table, and the conversation fills the time between.</p>
            <p data-i18n="feat3-p2">We didn't reinvent hotpot. We just gave it a better view.</p>
        </div>
    </div>
</section>

<div style="background:var(--bg);padding:80px 0;text-align:center;">
    <div class="container">
        <div class="ornament-line reveal"><span>火</span></div>
        <a href="<?php echo esc_url(home_url('/reserve/')); ?>" class="btn-primary reveal d1"><span data-i18n="exp-btn-book">Reserve the Rooftop</span></a>
    </div>
</div>

<?php get_footer(); ?>
