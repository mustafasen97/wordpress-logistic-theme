<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main class="container" style="padding:3rem 0;">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </article>
<?php endwhile; endif; ?>
</main>
<?php get_footer();
