<?php
/**
 * Header template.
 *
 * @package Lahdensivunkoti
 */

get_template_part( 'partials/header/head' );
?>

<body <?php body_class( 'site' ); ?>>
    <?php wp_body_open(); ?>
    <div class="site__wrapper">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lahdensivunkoti' ); ?></a>

        <header class="site-header x-padding">
            <div class="site-header__container container alignwide">

                <div class="site-header__title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
                        <img class="site-header__logo" alt="" width="723" height="265" src="<?php echo esc_url( get_theme_file_uri( 'images/icons/logo.svg' ) ); ?>">
                    </a>
                </div>

                <?php get_template_part( 'partials/global/site-nav' ); ?>

            </div>
        </header>

        <main id="content" class="site-main x-padding">
            <div class="site-main__container container">
