<?php
/**
 * Partial for displaying hero.
 * Is called also from meomblocks.
 *
 * @package Lahdensivunkoti
 */

use function Kala\display_svg;

$image_id    = Kala\get_variable( $image_id );
$content     = Kala\get_variable( $content );
$extra_class = Kala\get_variable( $extra_class );
$class       = 'hero content-row alignfull ' . $extra_class;

if ( $content ) : ?>
    <div class="<?php echo esc_html( $class ); ?>">
        <div class="hero__container container x-padding">
            <div class="hero__content top-margin top-margin--md">
                <?php
                if ( is_single() ) :
                    $idea_terms = get_the_terms( get_the_ID(), 'idea-kategoria', [ 'parent' => 0 ] );
                    foreach ( $idea_terms as $idea_term ) :
                        $parent = $idea_term->parent;
                        if ( 0 === $parent ) :
                            ?>
                            <a class="is-style-all-caps" href="<?php echo esc_url( get_term_link( $idea_term ) ); ?>">
                                <?php display_svg( 'arrow-back' ); ?>
                                <?php echo esc_html( $idea_term->name ); ?>
                            </a>
                            <?php
                        endif;
                    endforeach;
                endif;
                ?>
                <?php echo do_blocks( $content ); // phpcs:ignore ?>
            </div>
            <?php if ( $image_id ) : ?>
                <figure class="hero__image">
                    <?php echo wp_get_attachment_image( $image_id, 'large', '', [ 'loading' => 'eager' ] ); ?>
                </figure>
            <?php endif; ?>
        </div>
    </div>
    <?php
endif;
