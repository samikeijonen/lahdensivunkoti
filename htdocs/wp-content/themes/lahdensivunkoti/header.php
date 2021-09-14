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

	<header class="site-header" role="banner">
		<div class="site-header__container container">

			<div class="site-header__title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
					<img class="site-title__logo" alt="" width="128" height="52" src="<?php echo esc_url( get_theme_file_uri( 'images/icons/logo-valteri.svg' ) ); ?>">
				</a>
			</div>

			<?php get_template_part( 'partials/global/site-nav' ); ?>

		</div>
	</header>

	<main id="content" class="site-main">
		<div class="site-main__container container">
