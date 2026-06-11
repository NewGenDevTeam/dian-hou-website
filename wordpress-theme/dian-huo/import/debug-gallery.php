<?php
$IMPORT_KEY = 'dh-import-2024';
if (($_GET['key'] ?? '') !== $IMPORT_KEY) { http_response_code(403); die('Forbidden.'); }

$wp_load = dirname(__DIR__, 4) . '/wp-load.php';
if (!file_exists($wp_load)) die('wp-load.php not found');
require_once $wp_load;
if (!current_user_can('manage_options')) die('Must be admin.');

header('Content-Type: text/html; charset=utf-8');
echo '<h2>Gallery Debug</h2><pre>';

// 1. Count dh_gallery posts
$posts = get_posts(['post_type'=>'dh_gallery','posts_per_page'=>-1,'post_status'=>'publish']);
echo "dh_gallery posts: " . count($posts) . "\n\n";

// 2. For each post, check thumbnail
foreach ($posts as $p) {
    $tid     = get_post_thumbnail_id($p->ID);
    $att_url = $tid ? wp_get_attachment_url($tid) : 'NO URL';
    echo "Post ID {$p->ID} | thumb_id={$tid} | url={$att_url}\n";
}

// 3. Count attachments in Media Library
$atts = get_posts(['post_type'=>'attachment','post_status'=>'inherit','posts_per_page'=>-1]);
echo "\nMedia Library attachments: " . count($atts) . "\n";
foreach ($atts as $a) {
    echo "  ID:{$a->ID} | " . wp_get_attachment_url($a->ID) . "\n";
}

echo '</pre>';
