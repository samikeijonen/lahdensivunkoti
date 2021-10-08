<?php

namespace MEOM\Blocks;

use Kala;

$text = attr( 'text', $attributes );

// Adds all the default attributes like `className` or `align`.
// We add our block default class `example`.
$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'social-links alignfull x-padding' ] );

?>
<div <?php echo $wrapper_attributes; ?>>
    <div class="social-links__wrapper alignwide mx-auto">
        <h2 class="social-links__text"><?php echo esc_html( $text ); ?></h2>

        <?php
        // Render social links from theme, if available.
        $theme_partial = 'partials/global/social-links-nav';
        if ( function_exists( 'Kala\render_partial' ) && file_exists( get_template_directory() . '/' . $theme_partial . '.php' ) ) :
            Kala\render_partial(
                $theme_partial,
                []
            );
        endif;
        ?>
    </div>
</div>
<?php
