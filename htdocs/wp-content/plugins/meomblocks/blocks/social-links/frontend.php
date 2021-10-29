<?php

namespace MEOM\Blocks;

use Kala;

$content = $content;
$image   = attr( 'image', $attributes, null );

// Adds all the default attributes like `className` or `align`.
// We add our block default class `example`.
$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'social-links alignfull x-padding' ] );

if ( ! $content ) :
    return;
endif;
?>
<div <?php echo $wrapper_attributes; ?>>
    <div class="social-links__wrapper alignwide mx-auto">
        <?php echo do_blocks( $content ); ?>
    </div>

    <?php if ( $image ) : ?>
        <figure class="social-links__image">
            <?php echo wp_get_attachment_image( $image['id'], 'large' ); // phpcs:ignore ?>
        </figure>
    <?php endif; ?>
</div>
<?php
