<?php
/**
 * Single template.
 *
 * @package Lahdensivunkoti
 */

get_header();

while ( have_posts() ) :
    the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'content-area' ); ?>>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php
        get_template_part( 'partials/post/entry-meta' );
        if ( has_post_thumbnail() ) :
            ?>
            <figure class="entry-image"><?php the_post_thumbnail( 'large' ); ?></figure>
            <?php
        endif;
        the_content();
        ?>
    </article>

    <?php
endwhile;
get_footer();
