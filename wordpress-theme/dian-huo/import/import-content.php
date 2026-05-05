<?php
/**
 * Dian Huo Content Importer
 *
 * Run once after theme activation to import existing JSON content into WordPress.
 * Usage: Place this file at the root of your WordPress install, then visit:
 *   https://yoursite.com/import-content.php?key=dh-import-2024
 *
 * DELETE THIS FILE after running the import.
 */

define('ABSPATH_CHECK', true);

// Security key — change this before running
$IMPORT_KEY = 'dh-import-2024';
if (($_GET['key'] ?? '') !== $IMPORT_KEY) {
    http_response_code(403);
    die('Forbidden. Provide ?key= to run import.');
}

// Bootstrap WordPress
$wp_load = dirname(__DIR__, 4) . '/wp-load.php'; // adjust depth if needed
if (!file_exists($wp_load)) {
    die('Could not find wp-load.php. Adjust the path in this script.');
}
require_once $wp_load;

if (!current_user_can('manage_options')) {
    die('You must be logged in as an administrator to run this import.');
}

header('Content-Type: text/html; charset=utf-8');
echo '<h2>Dian Huo Content Import</h2><pre>';

$theme_dir = get_template_directory();

// ── Helper ────────────────────────────────────────────────────────────────────
function dh_import_post(string $type, array $fields, string $title, int $order): int {
    $existing = get_posts([
        'post_type'   => $type,
        'title'       => $title,
        'post_status' => 'any',
        'numberposts' => 1,
    ]);
    if ($existing) {
        echo "  SKIP (exists): $title\n";
        return $existing[0]->ID;
    }

    $id = wp_insert_post([
        'post_type'   => $type,
        'post_title'  => $title,
        'post_status' => 'publish',
        'menu_order'  => $order,
    ]);
    if (is_wp_error($id)) {
        echo "  ERROR: {$id->get_error_message()}\n";
        return 0;
    }
    foreach ($fields as $k => $v) {
        if (function_exists('update_field')) {
            update_field($k, $v, $id);
        } else {
            update_post_meta($id, $k, $v);
        }
    }
    echo "  Created: $title (ID: $id)\n";
    return $id;
}

// ── Broths ────────────────────────────────────────────────────────────────────
$broths_file = __DIR__ . '/../../content/broths.json';
if (file_exists($broths_file)) {
    $broths = json_decode(file_get_contents($broths_file), true)['items'] ?? [];
    echo "\n=== Importing Broths ===\n";
    foreach ($broths as $i => $item) {
        dh_import_post('dh_broth', [
            'tag_en'  => $item['tag_en']  ?? '',
            'tag_zh'  => $item['tag_zh']  ?? '',
            'name_en' => $item['name_en'] ?? '',
            'name_zh' => $item['name_zh'] ?? '',
            'desc_en' => $item['desc_en'] ?? '',
            'desc_zh' => $item['desc_zh'] ?? '',
            'price'   => $item['price']   ?? '',
            'spice'   => $item['spice']   ?? 0,
        ], $item['name_en'] ?? "Broth $i", $i);
    }
} else {
    echo "\nbroths.json not found — skipping\n";
}

// ── Proteins ──────────────────────────────────────────────────────────────────
$proteins_file = __DIR__ . '/../../content/proteins.json';
if (file_exists($proteins_file)) {
    $proteins = json_decode(file_get_contents($proteins_file), true)['items'] ?? [];
    echo "\n=== Importing Proteins ===\n";
    foreach ($proteins as $i => $item) {
        dh_import_post('dh_protein', [
            'tag_en'   => $item['tag_en']   ?? '',
            'tag_zh'   => $item['tag_zh']   ?? '',
            'name_en'  => $item['name_en']  ?? '',
            'name_zh'  => $item['name_zh']  ?? '',
            'desc_en'  => $item['desc_en']  ?? '',
            'desc_zh'  => $item['desc_zh']  ?? '',
            'price'    => $item['price']    ?? '',
            'wide'     => !empty($item['wide']),
            'quote_en' => $item['quote_en'] ?? '',
            'quote_zh' => $item['quote_zh'] ?? '',
        ], $item['name_en'] ?? "Protein $i", $i);
    }
} else {
    echo "\nproteins.json not found — skipping\n";
}

// ── Specials ──────────────────────────────────────────────────────────────────
$specials_file = __DIR__ . '/../../content/specials.json';
if (file_exists($specials_file)) {
    $specials = json_decode(file_get_contents($specials_file), true)['items'] ?? [];
    echo "\n=== Importing Specials ===\n";
    foreach ($specials as $i => $item) {
        dh_import_post('dh_special', [
            'tag_en'  => $item['tag_en']  ?? '',
            'tag_zh'  => $item['tag_zh']  ?? '',
            'name_en' => $item['name_en'] ?? '',
            'name_zh' => $item['name_zh'] ?? '',
            'desc_en' => $item['desc_en'] ?? '',
            'desc_zh' => $item['desc_zh'] ?? '',
            'price'   => $item['price']   ?? '',
        ], $item['name_en'] ?? "Special $i", $i);
    }
} else {
    echo "\nspecials.json not found — skipping\n";
}

// ── Contact Options ───────────────────────────────────────────────────────────
$contact_file = __DIR__ . '/../../content/contact.json';
if (file_exists($contact_file) && function_exists('update_field')) {
    $c = json_decode(file_get_contents($contact_file), true);
    echo "\n=== Importing Contact Info ===\n";
    $map = [
        'address_en'   => $c['address_en']   ?? '',
        'address_zh'   => $c['address_zh']   ?? '',
        'phone'        => $c['phone']        ?? '',
        'whatsapp'     => $c['whatsapp']     ?? '',
        'contact_email'=> $c['email']        ?? '',
        'hours_en'     => $c['hours_en']     ?? '',
        'hours_zh'     => $c['hours_zh']     ?? '',
        'location_en'  => $c['location_en']  ?? '',
        'location_zh'  => $c['location_zh']  ?? '',
        'private_en'   => $c['private_en']   ?? '',
        'private_zh'   => $c['private_zh']   ?? '',
        'walkin_en'    => $c['walkin_en']    ?? '',
        'walkin_zh'    => $c['walkin_zh']    ?? '',
        'reserve_email'=> $c['email']        ?? '',
    ];
    foreach ($map as $k => $v) {
        update_field($k, $v, 'option');
        echo "  Set option: $k\n";
    }
} else {
    echo "\ncontact.json not found or ACF not active — skipping options\n";
}

echo "\n\n✓ Import complete. DELETE this file now!\n</pre>";
