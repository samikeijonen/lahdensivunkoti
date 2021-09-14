<?php
/**
 * Partial for displaying nav.
 *
 * @package Lahdensivunkoti
 */

if ( ! has_nav_menu( 'main' ) ) :
	return;
endif;
?>

<nav class="site-nav js-site-nav" aria-label="<?php esc_attr_e( 'Main', 'lahdensivunkoti' ); ?>">
	<button class="site-nav__toggle js-site-nav-toggle" aria-controls="site-nav-items">
		<?php esc_html_e( 'Menu', 'lahdensivunkoti' ); ?>
	</button>
	<?php
		wp_nav_menu(
			[
				'theme_location' => 'main',
				'menu_id'        => 'site-nav-items',
				'menu_class'     => 'site-nav__items animated js-site-nav-items',
				'container'      => false,
				'depth'          => 1,
			]
		);
		?>
</nav>
