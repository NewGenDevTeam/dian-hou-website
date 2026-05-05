<?php
defined('ABSPATH') || exit;

// ─── Theme Setup ──────────────────────────────────────────────────────────────
function dh_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo');
    load_theme_textdomain('dian-huo', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'dh_theme_setup');

// ─── Enqueue Assets ───────────────────────────────────────────────────────────
function dh_enqueue_assets() {
    $uri = get_template_directory_uri();
    $v   = '1.0.4';

    wp_enqueue_style('dh-fonts',
        'https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700;800;900&family=Outfit:wght@300;400;500;600&family=Noto+Serif+SC:wght@300;400;600&display=swap',
        [], null
    );
    wp_enqueue_style('dh-styles', "$uri/assets/css/styles.css", ['dh-fonts'], $v);

    wp_enqueue_script('dh-lang',  "$uri/assets/js/lang.js",  [], $v, true);
    wp_enqueue_script('dh-main',  "$uri/assets/js/main.js",  ['dh-lang'], $v, true);

    wp_localize_script('dh-main', 'dhData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('dh_reserve'),
        'homeUrl' => esc_url(home_url('/')),
    ]);
}
add_action('wp_enqueue_scripts', 'dh_enqueue_assets');

// ─── Custom Post Types ────────────────────────────────────────────────────────
function dh_register_post_types() {
    $shared_args = [
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'supports'           => ['title', 'page-attributes'],
        'menu_icon'          => 'dashicons-food',
        'has_archive'        => false,
        'rewrite'            => false,
    ];

    register_post_type('dh_broth', array_merge($shared_args, [
        'label'  => 'Soup Bases',
        'labels' => dh_cpt_labels('Soup Base', 'Soup Bases'),
    ]));

    register_post_type('dh_protein', array_merge($shared_args, [
        'label'  => 'Premium Cuts',
        'labels' => dh_cpt_labels('Premium Cut', 'Premium Cuts'),
    ]));

    register_post_type('dh_special', array_merge($shared_args, [
        'label'  => 'House Specials',
        'labels' => dh_cpt_labels('House Special', 'House Specials'),
    ]));

    register_post_type('dh_gallery', array_merge($shared_args, [
        'label'    => 'Gallery Photos',
        'labels'   => dh_cpt_labels('Gallery Photo', 'Gallery Photos'),
        'supports' => ['title', 'thumbnail', 'page-attributes'],
        'menu_icon' => 'dashicons-camera',
    ]));
}
add_action('init', 'dh_register_post_types');

function dh_cpt_labels(string $singular, string $plural): array {
    return [
        'name'               => $plural,
        'singular_name'      => $singular,
        'add_new_item'       => "Add New $singular",
        'edit_item'          => "Edit $singular",
        'new_item'           => "New $singular",
        'view_item'          => "View $singular",
        'search_items'       => "Search $plural",
        'not_found'          => "No $plural found",
        'not_found_in_trash' => "No $plural in Trash",
    ];
}

// ─── ACF Field Groups (requires ACF plugin) ───────────────────────────────────
add_action('acf/init', 'dh_register_acf_fields');
function dh_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    // ── Menu Item Fields (shared by broth, protein, special) ──────────────────
    acf_add_local_field_group([
        'key'      => 'group_dh_menu_item',
        'title'    => 'Menu Item Details',
        'fields'   => [
            ['key' => 'field_tag_en',   'label' => 'Tag (English)',         'name' => 'tag_en',   'type' => 'text'],
            ['key' => 'field_tag_zh',   'label' => 'Tag (Chinese)',          'name' => 'tag_zh',   'type' => 'text'],
            ['key' => 'field_name_en',  'label' => 'Name (English)',         'name' => 'name_en',  'type' => 'text'],
            ['key' => 'field_name_zh',  'label' => 'Name (Chinese)',         'name' => 'name_zh',  'type' => 'text'],
            ['key' => 'field_desc_en',  'label' => 'Description (English)',  'name' => 'desc_en',  'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_desc_zh',  'label' => 'Description (Chinese)',  'name' => 'desc_zh',  'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_price',    'label' => 'Price (e.g. RM 38)',     'name' => 'price',    'type' => 'text'],
        ],
        'location' => [
            [['param' => 'post_type', 'operator' => '==', 'value' => 'dh_broth']],
            [['param' => 'post_type', 'operator' => '==', 'value' => 'dh_protein']],
            [['param' => 'post_type', 'operator' => '==', 'value' => 'dh_special']],
        ],
    ]);

    // ── Broth Extra Fields ─────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_dh_broth_extra',
        'title'  => 'Broth Options',
        'fields' => [
            ['key' => 'field_spice', 'label' => 'Spice Level (0–3)', 'name' => 'spice', 'type' => 'number', 'min' => 0, 'max' => 3, 'default_value' => 0],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'dh_broth']]],
    ]);

    // ── Protein Extra Fields ───────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_dh_protein_extra',
        'title'  => 'Protein Options',
        'fields' => [
            ['key' => 'field_wide',     'label' => 'Featured / Wide Card', 'name' => 'wide',     'type' => 'true_false', 'default_value' => 0, 'ui' => 1],
            ['key' => 'field_quote_en', 'label' => 'Quote (English)',       'name' => 'quote_en', 'type' => 'text'],
            ['key' => 'field_quote_zh', 'label' => 'Quote (Chinese)',       'name' => 'quote_zh', 'type' => 'text'],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'dh_protein']]],
    ]);

    // ── Gallery Fields ─────────────────────────────────────────────────────────
    acf_add_local_field_group([
        'key'    => 'group_dh_gallery',
        'title'  => 'Gallery Photo',
        'fields' => [
            ['key' => 'field_gallery_caption_en', 'label' => 'Caption (English)', 'name' => 'caption_en', 'type' => 'text', 'required' => 0],
            ['key' => 'field_gallery_caption_zh', 'label' => 'Caption (Chinese)', 'name' => 'caption_zh', 'type' => 'text', 'required' => 0],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'dh_gallery']]],
    ]);

    // ── Site Options (contact, hours, address) ─────────────────────────────────
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title'  => 'Restaurant Info',
            'menu_title'  => 'Restaurant Info',
            'menu_slug'   => 'dh-restaurant-info',
            'capability'  => 'manage_options',
            'icon_url'    => 'dashicons-location',
            'redirect'    => false,
        ]);

        acf_add_local_field_group([
            'key'    => 'group_dh_options',
            'title'  => 'Contact & Hours',
            'fields' => [
                ['key' => 'field_opt_address_en',  'label' => 'Address (English)',           'name' => 'address_en',  'type' => 'text'],
                ['key' => 'field_opt_address_zh',  'label' => 'Address (Chinese)',           'name' => 'address_zh',  'type' => 'text'],
                ['key' => 'field_opt_phone',       'label' => 'Phone Number',                'name' => 'phone',       'type' => 'text'],
                ['key' => 'field_opt_whatsapp',    'label' => 'WhatsApp Link',               'name' => 'whatsapp',    'type' => 'url'],
                ['key' => 'field_opt_email',       'label' => 'Email',                       'name' => 'contact_email', 'type' => 'email'],
                ['key' => 'field_opt_hours_en',    'label' => 'Opening Hours (English)',     'name' => 'hours_en',    'type' => 'textarea', 'rows' => 4],
                ['key' => 'field_opt_hours_zh',    'label' => 'Opening Hours (Chinese)',     'name' => 'hours_zh',    'type' => 'textarea', 'rows' => 4],
                ['key' => 'field_opt_location_en', 'label' => 'Location Detail (English)',   'name' => 'location_en', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_opt_location_zh', 'label' => 'Location Detail (Chinese)',   'name' => 'location_zh', 'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_opt_private_en',  'label' => 'Private Events Note (EN)',    'name' => 'private_en',  'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_opt_private_zh',  'label' => 'Private Events Note (ZH)',    'name' => 'private_zh',  'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_opt_walkin_en',   'label' => 'Walk-in Note (English)',      'name' => 'walkin_en',   'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_opt_walkin_zh',   'label' => 'Walk-in Note (Chinese)',      'name' => 'walkin_zh',   'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_opt_reserve_email','label' => 'Reservation Notification Email','name' => 'reserve_email','type' => 'email'],
            ],
            'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'dh-restaurant-info']]],
        ]);
    }
}

// ─── Helper: Get ACF Option with Fallback ─────────────────────────────────────
function dh_opt(string $key, string $fallback = ''): string {
    if (function_exists('get_field')) {
        $val = get_field($key, 'option');
        if ($val) return esc_html($val);
    }
    return esc_html($fallback);
}

function dh_opt_url(string $key, string $fallback = ''): string {
    if (function_exists('get_field')) {
        $val = get_field($key, 'option');
        if ($val) return esc_url($val);
    }
    return esc_url($fallback);
}

// ─── AJAX: Reservation Form ───────────────────────────────────────────────────
add_action('wp_ajax_nopriv_dh_reserve', 'dh_handle_reservation');
add_action('wp_ajax_dh_reserve',        'dh_handle_reservation');
function dh_handle_reservation() {
    check_ajax_referer('dh_reserve', 'nonce');

    $name   = sanitize_text_field($_POST['name']   ?? '');
    $phone  = sanitize_text_field($_POST['phone']  ?? '');
    $email  = sanitize_email($_POST['email']       ?? '');
    $date   = sanitize_text_field($_POST['date']   ?? '');
    $time   = sanitize_text_field($_POST['time']   ?? '');
    $guests = sanitize_text_field($_POST['guests'] ?? '');
    $notes  = sanitize_textarea_field($_POST['notes'] ?? '');

    if (!$name || !$phone || !$date || !$time || !$guests) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    $notify_email = function_exists('get_field')
        ? (get_field('reserve_email', 'option') ?: get_option('admin_email'))
        : get_option('admin_email');

    $headers = ['Content-Type: text/html; charset=UTF-8'];

    // Notification to restaurant
    $subject = "New Reservation — {$name} on {$date} at {$time}";
    $body = "
        <h2 style='color:#E41E2B;'>New Reservation Request</h2>
        <table style='border-collapse:collapse;font-family:sans-serif;font-size:14px;'>
            <tr><td style='padding:6px 12px;color:#666;'>Name</td><td style='padding:6px 12px;'><strong>{$name}</strong></td></tr>
            <tr><td style='padding:6px 12px;color:#666;'>Phone</td><td style='padding:6px 12px;'>{$phone}</td></tr>
            <tr><td style='padding:6px 12px;color:#666;'>Email</td><td style='padding:6px 12px;'>{$email}</td></tr>
            <tr><td style='padding:6px 12px;color:#666;'>Date</td><td style='padding:6px 12px;'>{$date}</td></tr>
            <tr><td style='padding:6px 12px;color:#666;'>Time</td><td style='padding:6px 12px;'>{$time}</td></tr>
            <tr><td style='padding:6px 12px;color:#666;'>Guests</td><td style='padding:6px 12px;'>{$guests}</td></tr>
            <tr><td style='padding:6px 12px;color:#666;'>Notes</td><td style='padding:6px 12px;'>" . nl2br($notes) . "</td></tr>
        </table>
    ";
    wp_mail($notify_email, $subject, $body, $headers);

    // Confirmation to guest
    if ($email) {
        $guest_body = "
            <h2 style='color:#E41E2B;'>Reservation Received ✓</h2>
            <p style='font-family:sans-serif;font-size:14px;color:#333;'>
                Dear {$name},<br><br>
                Thank you for your reservation at <strong>點火心窩 Dian Huo Hotpot</strong>.
                We have received your request for <strong>{$guests} guest(s)</strong> on
                <strong>{$date} at {$time}</strong>.<br><br>
                Our team will confirm your rooftop table within 2 hours.
                If you need to make changes, please contact us at
                <a href='https://wa.link/3f0hjs' style='color:#E41E2B;'>WhatsApp</a>
                or call <strong>+60 17 878 7652</strong>.<br><br>
                See you soon!<br>
                <em>The Dian Huo Hotpot Team</em>
            </p>
        ";
        wp_mail($email, 'Reservation Confirmed — Dian Huo Hotpot', $guest_body, $headers);
    }

    wp_send_json_success(['message' => 'Reservation received.']);
}

// ─── Admin: ACF dependency notice ─────────────────────────────────────────────
add_action('admin_notices', function () {
    if (!function_exists('acf_add_local_field_group')) {
        echo '<div class="notice notice-warning"><p><strong>Dian Huo Theme:</strong> Please install and activate <a href="' . esc_url(admin_url('plugin-install.php?s=advanced+custom+fields&tab=search')) . '">Advanced Custom Fields (free)</a> to manage menu items and restaurant info.</p></div>';
    }
});
