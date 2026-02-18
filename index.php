<?php
/**
 * Main fallback template.
 *
 * @package wordpress-logistic-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="site-main container" role="main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h1>
				</header>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No content found.', 'wordpress-logistic-theme' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();
