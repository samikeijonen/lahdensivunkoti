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
        $social_links = wp_nav_menu(
            [
                'theme_location' => 'social_links',
                'menu_class'     => 'wp-block-social-links wp-block-social-links--header',
                'container'      => false,
                'echo'           => false,
                'link_before'    => '<span class="screen-reader-text">',
                'link_after'     => '</span>',
            ]
        );

        wp_nav_menu(
            [
                'theme_location' => 'main',
                'menu_id'        => 'site-nav-items',
                'menu_class'     => 'site-nav__items animated js-site-nav-items',
                'container'      => false,
                'depth'          => 2,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s<li class="menu-item menu-item--social-link">' . $social_links . '</li></ul>',
            ]
        );
        ?>
</nav>
