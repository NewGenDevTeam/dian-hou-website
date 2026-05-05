<?php
// Fallback — WordPress requires this file. Front page is handled by front-page.php.
get_header(); ?>

<div style="padding:140px 0 80px;text-align:center;">
    <div class="container">
        <h1 style="font-family:'Big Shoulders Display',sans-serif;font-size:clamp(40px,6vw,72px);color:var(--white);">
            點火心窩
        </h1>
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <div><?php the_content(); ?></div>
        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer();
