<?php
/**
 * Partial for displaying selected posts.
 * Is called also from meomblocks.
 *
 * @package Lahdensivunkoti
 */

global $post;

$default_title = get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Ajankohtaista', 'lahdensivunkoti' );
$lifted_posts  = Kala\get_variable( $lifted_posts );
$lifts_title   = Kala\get_variable( $lifts_title, $default_title );

if ( $lifted_posts ) : ?>
    <div class="content-row container top-margin">
        <?php if ( $lifts_title ) : ?>
            <h2><?php echo esc_html( $lifts_title ); ?></h2>
        <?php endif; ?>
        <div class="posts-list">
            <?php
            foreach ( $lifted_posts as $lifted_post ) {
                setup_postdata( $lifted_post );
                get_template_part( 'partials/post/post-item' );
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
endif;
