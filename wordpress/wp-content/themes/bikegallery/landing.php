<?php
/**
 *
 * Template Name: Landing Page for before launch
 *
 *
 * @package WordPress
 * @subpackage epictrishop
 * @since epictrishop 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>

<style type="text/css">

.landing_page {
	margin-top: 50px;
	text-align: center;
}

.landing_page img {
	max-width: 600px;
}

</style>

</head>

<body <?php body_class(); ?>>

	<section class="container">
		<section class="row">

			<section class="landing_page twelvecol last">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>


				<?php endwhile; ?>

			</section><!-- .twelvecol .content -->
		</section><!-- .row .last -->
		
<?php wp_footer(); ?>

</body>
</html>
