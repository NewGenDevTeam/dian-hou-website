<?php
/**
 * Dian Huo Gallery Post Creator
 *
 * Creates dh_gallery CPT posts from images already in the Media Library.
 * Run ONCE after uploading gallery photos to Media Library.
 * Visit: https://yoursite.com/wp-content/themes/dian-huo/import/import-gallery.php?key=dh-import-2024
 *
 * DELETE THIS FILE after running.
 */

$IMPORT_KEY = 'dh-import-2024';
if (($_GET['key'] ?? '') !== $IMPORT_KEY) {
    http_response_code(403);
    die('Forbidden. Provide ?key= to run.');
}

// Bootstrap WordPress
$wp_load = dirname(__DIR__, 4) . '/wp-load.php';
if (!file_exists($wp_load)) {
    die('Could not find wp-load.php. Adjust the path in this script.');
}
require_once $wp_load;

if (!current_user_can('manage_options')) {
    die('You must be logged in as an administrator.');
}

header('Content-Type: text/html; charset=utf-8');
echo '<h2>Dian Huo — Gallery Post Creator</h2><pre>';

// Get all image attachments in Media Library
$attachments = get_posts([
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_status'    => 'inherit',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
]);

if (empty($attachments)) {
    echo "No images found in Media Library.\n";
    echo '</pre>';
    exit;
}

echo "Found " . count($attachments) . " image(s) in Media Library.\n\n";

// Get attachment IDs already used as featured images for dh_gallery posts
$existing_gallery = get_posts([
    'post_type'      => 'dh_gallery',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);
$used_thumb_ids = [];
foreach ($existing_gallery as $gp) {
    $tid = get_post_thumbnail_id($gp->ID);
    if ($tid) $used_thumb_ids[] = (int) $tid;
}

$created = 0;
$skipped = 0;
$order   = count($existing_gallery); // continue from existing order

foreach ($attachments as $att) {
    // Skip images already used as gallery featured images
    if (in_array((int) $att->ID, $used_thumb_ids, true)) {
        echo "  SKIP (already a gallery post): {$att->post_title}\n";
        $skipped++;
        continue;
    }

    // Use filename (without extension) as the post title
    $title = $att->post_title ?: pathinfo($att->guid, PATHINFO_FILENAME);

    // Create the dh_gallery post
    $post_id = wp_insert_post([
        'post_type'   => 'dh_gallery',
        'post_title'  => $title,
        'post_status' => 'publish',
        'menu_order'  => $order,
    ]);

    if (is_wp_error($post_id)) {
        echo "  ERROR creating post for {$title}: " . $post_id->get_error_message() . "\n";
        continue;
    }

    // Set featured image
    set_post_thumbnail($post_id, $att->ID);

    echo "  Created gallery post: {$title} (Post ID: {$post_id}, Image ID: {$att->ID})\n";
    $created++;
    $order++;
}

echo "\n\n✓ Done! Created: $created  |  Skipped: $skipped\n";
echo "Now visit your Gallery page to see the photos.\n";
echo "DELETE this file when finished!\n</pre>";
