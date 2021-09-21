<?php

namespace MEOM\Blocks;

$image_position = attr( 'imagePosition', $attributes, 'left' );
$image          = attr( 'image', $attributes, null );
$class_name     = attr( 'className', $attributes, '' );
$content        = remove_empty_tags_recursive( $content );

$class_names = [
    'image-and-text',
    'image-and-text--position-' . $image_position,
    'alignfull',
    'content-row',
];
if ( $class_name ) {
    $class_names[] = $class_name;
}

if ( $content ) : ?>
    <div class="<?php echo esc_attr( implode( ' ', $class_names ) ); ?>">
        <div class="image-and-text__container grid has-2-columns">
            <?php if ( $image ) : ?>
                <figure class="image-and-text__image">
                    <?php echo wp_get_attachment_image( $image['id'], 'large' ); // phpcs:ignore ?>
                </figure>
            <?php endif; ?>
            <div class="image-and-text__content top-margin">
                <?php echo do_blocks( $content ); // phpcs:ignore ?>
            </div>
        </div>
    </div>
<?php endif;
