<?php
/**
 * Header template.
 *
 * @package Lahdensivunkoti
 */

get_template_part( 'partials/header/head' );
?>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lahdensivunkoti' ); ?></a>

	<header class="site-header x-padding">
		<div class="site-header__container container alignfull">

			<div class="site-header__title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div>

			<?php get_template_part( 'partials/global/site-nav' ); ?>

		</div>
	</header>

	<main id="content" class="site-main x-padding">
		<div class="site-main__container container">
