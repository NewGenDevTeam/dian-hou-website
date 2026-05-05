<?php
/*
 * Template Name: Reserve Page
 */
get_header();

$phone    = dh_opt('phone',     '+60 17 878 7652');
$wa       = dh_opt_url('whatsapp', 'https://wa.link/3f0hjs');
$email    = dh_opt('contact_email', 'urgo.adm@gmail.com');
$hours_en = dh_opt('hours_en',  "Monday – Sunday\n12:00 PM – 12:00 AM\nLast order 11:30 PM");
$hours_zh = dh_opt('hours_zh',  "週一至週日\n中午12時 – 凌晨12時");
$loc_en   = dh_opt('location_en','Level 3\nJalan SS 24/9\n47301 Petaling Jaya');
$loc_zh   = dh_opt('location_zh','白蒲 SS 24/9路\n47301 八打靈再也\n3樓');
$priv_en  = dh_opt('private_en','Groups of 10+, corporate bookings, and celebrations — call us directly for bespoke arrangements.');
$priv_zh  = dh_opt('private_zh','10人或以上、企業訂位及慶典——請直接致電洽詢專屬安排。');
$wkin_en  = dh_opt('walkin_en','Walk-ins welcome subject to availability. Recommend reserving at least 24 hours in advance for weekends.');
$wkin_zh  = dh_opt('walkin_zh','設有即場座位，視乎當日情況而定。週末建議提前至少24小時預約。');
?>
<style>
#reserve { padding: 90px 0 130px; background: var(--bg); }
.reserve-layout { display: grid; grid-template-columns: 1fr 380px; gap: 80px; align-items: start; }
.form-side h2 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 900; font-size: clamp(42px, 6vw, 74px); text-transform: uppercase; color: var(--white); line-height: 0.9; letter-spacing: -0.02em; margin-bottom: 14px; }
.form-side h2 em { font-style: normal; color: var(--red); }
.form-side > p { font-size: 15px; color: var(--muted); line-height: 1.75; margin-bottom: 40px; }
.rform { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.rform .full { grid-column: 1 / -1; }
.fg { display: flex; flex-direction: column; gap: 6px; }
.fg label { font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .3em; text-transform: uppercase; color: rgba(228,30,43,.55); }
.fg input, .fg select, .fg textarea { background: rgba(228,30,43,.04); border: 1px solid rgba(228,30,43,.14); color: var(--off-white); padding: 12px 16px; font-family: 'Outfit', sans-serif; font-size: 15px; outline: none; appearance: none; border-radius: 0; transition: border-color .25s, background .25s; width: 100%; }
.fg input:focus, .fg select:focus, .fg textarea:focus { border-color: var(--red); background: rgba(228,30,43,.07); }
.fg input::placeholder { color: rgba(247,238,233,.2); }
.fg select option { background: #160906; }
.fg textarea { resize: none; height: 96px; }
.rform-submit { margin-top: 8px; }
.rform-submit button { width: 100%; background: var(--red); color: var(--white); border: none; padding: 16px; font-family: 'Outfit', sans-serif; font-size: 13px; font-weight: 600; letter-spacing: .16em; text-transform: uppercase; cursor: pointer; transition: background .25s, transform .15s; }
.rform-submit button:hover { background: var(--red-dark); transform: translateY(-2px); }
.rform-submit button:disabled { opacity: .5; cursor: not-allowed; transform: none; }

.success-msg { display: none; padding: 40px; border: 1px solid rgba(93,191,69,.25); background: rgba(93,191,69,.04); text-align: center; }
.success-msg.show { display: block; }
.success-msg h3 { font-family: 'Big Shoulders Display', sans-serif; font-weight: 800; font-size: 32px; text-transform: uppercase; color: #5DBF45; margin-bottom: 10px; }
.success-msg p { font-family: 'Outfit', sans-serif; font-size: 14px; color: var(--muted); }

.info-panel { background: var(--surface); border: 1px solid rgba(228,30,43,.1); padding: 44px 36px; position: sticky; top: 100px; }
.info-logo-img { width: 44px; height: 44px; object-fit: contain; filter: drop-shadow(0 0 8px rgba(228,30,43,.4)); margin-bottom: 8px; display: block; }
.info-logo-txt { font-family: 'Noto Serif SC', serif; font-size: 14px; color: var(--off-white); line-height: 1.3; margin-bottom: 32px; }
.info-logo-txt span { display: block; font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .22em; color: var(--red); text-transform: uppercase; margin-top: 2px; }
.info-block { margin-bottom: 24px; }
.info-lbl { font-family: 'Outfit', sans-serif; font-size: 9px; letter-spacing: .3em; text-transform: uppercase; color: rgba(228,30,43,.5); margin-bottom: 7px; }
.info-val { font-family: 'Outfit', sans-serif; font-size: 14px; color: rgba(247,238,233,.6); line-height: 1.75; white-space: pre-line; }
.info-val a { color: var(--red); text-decoration: none; transition: color .2s; }
.info-val a:hover { color: #ff4a55; }
.info-note { margin-top: 28px; padding-top: 24px; border-top: 1px solid rgba(228,30,43,.1); font-family: 'Outfit', sans-serif; font-size: 12px; color: rgba(247,238,233,.28); line-height: 1.75; font-style: italic; }

@media (max-width:900px) { .reserve-layout { grid-template-columns: 1fr; gap: 40px; } .info-panel { position: static; } .rform { grid-template-columns: 1fr; } }
</style>

<div class="page-hdr">
    <div class="page-hdr-glow"></div>
    <div class="page-hdr-bg">RESERVE</div>
    <div class="page-hdr-content">
        <p class="label" style="justify-content:center;" data-i18n="res-hdr-label">Secure Your Evening</p>
        <h1 class="page-hdr-title" data-i18n="res-hdr-title">BOOK YOUR<br><em>TABLE</em></h1>
        <p class="page-hdr-zh" data-i18n="res-page-zh">訂座 · 點火心窩</p>
    </div>
</div>

<section id="reserve">
    <div class="container">
        <div class="reserve-layout">
            <!-- Form -->
            <div class="form-side">
                <p class="label reveal" data-i18n="res-form-label">Make a Reservation</p>
                <h2 class="reveal d1" data-i18n="res-form-h2">BOOK YOUR<br><em>EVENING ABOVE</em></h2>
                <p class="reveal d2" data-i18n="res-form-p">Rooftop dining is intimate and our tables are few. Reserve ahead to secure your evening with the city at your feet.</p>

                <form class="rform reveal d3" id="rForm" novalidate>
                    <?php wp_nonce_field('dh_reserve', 'nonce'); ?>
                    <div class="fg">
                        <label data-i18n="res-lbl-name">Full Name *</label>
                        <input type="text" name="name" placeholder="Your name" required>
                    </div>
                    <div class="fg">
                        <label data-i18n="res-lbl-phone">Phone Number *</label>
                        <input type="tel" name="phone" placeholder="+60 12 345 6789" required>
                    </div>
                    <div class="fg">
                        <label data-i18n="res-lbl-email">Email Address</label>
                        <input type="email" name="email" placeholder="For confirmation">
                    </div>
                    <div class="fg">
                        <label data-i18n="res-lbl-date">Preferred Date *</label>
                        <input type="date" name="date" required>
                    </div>
                    <div class="fg">
                        <label data-i18n="res-lbl-time">Preferred Time *</label>
                        <select name="time" required>
                            <option value="" data-i18n-opt="res-time-default">Select a time</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="12:30">12:30 PM</option>
                            <option value="13:00">1:00 PM</option>
                            <option value="13:30">1:30 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="17:00">5:00 PM</option>
                            <option value="17:30">5:30 PM</option>
                            <option value="18:00">6:00 PM</option>
                            <option value="18:30">6:30 PM</option>
                            <option value="19:00">7:00 PM</option>
                            <option value="19:30">7:30 PM</option>
                            <option value="20:00">8:00 PM</option>
                            <option value="20:30">8:30 PM</option>
                            <option value="21:00">9:00 PM</option>
                            <option value="21:30">9:30 PM</option>
                            <option value="22:00">10:00 PM</option>
                            <option value="22:30">10:30 PM</option>
                            <option value="23:00">11:00 PM</option>
                        </select>
                    </div>
                    <div class="fg">
                        <label data-i18n="res-lbl-guests">Number of Guests *</label>
                        <select name="guests" required>
                            <option value="">Select guests</option>
                            <?php for ($g = 1; $g <= 20; $g++): ?>
                            <option value="<?php echo $g; ?>"><?php echo $g; ?> <?php echo $g === 1 ? 'Guest' : 'Guests'; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="fg full">
                        <label data-i18n="res-lbl-notes">Special Requests</label>
                        <textarea name="notes" placeholder="Allergies, celebrations, seating preferences…"></textarea>
                    </div>
                    <div class="rform-submit full">
                        <button type="submit" id="rSubmit" data-i18n="res-btn-submit">Confirm Reservation</button>
                    </div>
                </form>

                <div class="success-msg" id="successMsg">
                    <h3 data-i18n="res-success-h3">RESERVATION RECEIVED ✓</h3>
                    <p data-i18n="res-success-p">We'll confirm your rooftop table within 2 hours. Check your phone for a message from our team.</p>
                </div>
            </div>

            <!-- Info Panel -->
            <aside class="info-panel reveal d2">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.jpg" alt="Dian Huo Hotpot" class="info-logo-img">
                <div class="info-logo-txt">點火心窩<span>Dian Huo Hotpot</span></div>

                <div class="info-block">
                    <div class="info-lbl" data-i18n="res-info-hours">Opening Hours</div>
                    <div class="info-val en-only"><?php echo esc_html($hours_en); ?></div>
                    <div class="info-val zh-only"><?php echo esc_html($hours_zh); ?></div>
                </div>
                <div class="info-block">
                    <div class="info-lbl" data-i18n="res-info-location">Location</div>
                    <div class="info-val en-only"><?php echo esc_html($loc_en); ?></div>
                    <div class="info-val zh-only"><?php echo esc_html($loc_zh); ?></div>
                </div>
                <div class="info-block">
                    <div class="info-lbl" data-i18n="res-info-contact">Contact</div>
                    <div class="info-val">
                        <a href="<?php echo esc_url($wa); ?>"><?php echo esc_html($phone); ?></a><br>
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    </div>
                </div>
                <div class="info-block">
                    <div class="info-lbl" data-i18n="res-info-private">Private Events</div>
                    <div class="info-val en-only"><?php echo esc_html($priv_en); ?></div>
                    <div class="info-val zh-only"><?php echo esc_html($priv_zh); ?></div>
                </div>
                <div class="info-note en-only"><?php echo esc_html($wkin_en); ?></div>
                <div class="info-note zh-only"><?php echo esc_html($wkin_zh); ?></div>
            </aside>
        </div>
    </div>
</section>

<script>
document.getElementById('rForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn  = document.getElementById('rSubmit');
    const form = this;
    btn.disabled = true;
    btn.textContent = '…';

    const data = new FormData(form);
    data.append('action', 'dh_reserve');
    data.append('nonce', '<?php echo wp_create_nonce("dh_reserve"); ?>');

    try {
        const res  = await fetch('<?php echo esc_url(admin_url("admin-ajax.php")); ?>', { method: 'POST', body: data });
        const json = await res.json();
        if (json.success) {
            form.style.display = 'none';
            document.getElementById('successMsg').classList.add('show');
        } else {
            alert(json.data?.message || 'Something went wrong. Please try again.');
            btn.disabled = false;
            btn.textContent = 'Confirm Reservation';
        }
    } catch {
        alert('Network error. Please try again or contact us directly.');
        btn.disabled = false;
        btn.textContent = 'Confirm Reservation';
    }
});
</script>

<?php get_footer(); ?>
