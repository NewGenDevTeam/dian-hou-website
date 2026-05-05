<!DOCTYPE html>
<html <?php language_attributes(); ?> class="lang-en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="cursor"></div>
<div id="cursor-ring"></div>

<nav id="navbar">
    <div class="nav-left">
        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-pill outline" data-i18n="nav-story">Story</a>
        <a href="<?php echo esc_url(home_url('/menu/')); ?>"  class="nav-pill outline" data-i18n="nav-menu">Menu</a>
    </div>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-center">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.jpg" alt="Dian Huo Hotpot">
        <div class="nav-brand">點火心窩 <span>Dian Huo Hotpot</span></div>
    </a>
    <div class="nav-right">
        <a href="<?php echo esc_url(home_url('/gallery/')); ?>"    class="nav-pill outline" data-i18n="nav-gallery">Gallery</a>
        <a href="<?php echo esc_url(home_url('/experience/')); ?>" class="nav-pill outline" data-i18n="nav-experience">Experience</a>
        <a href="<?php echo esc_url(home_url('/reserve/')); ?>"    class="nav-pill" data-i18n="nav-reserve">Reserve</a>
        <button class="lang-toggle" id="langToggle">中文</button>
    </div>
</nav>
