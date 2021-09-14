<?php

namespace MEOM\Blocks;

use Kala;

global $post;

$image_id    = get_post_thumbnail_id( $post );
$style       = attr( 'style', $attributes, 'setting_1' );
$extra_class = attr( 'className', $attributes, '' );
$content     = $content;

// Build extra classes from attributes.
$extra_class .= 'hero--style-' . $style;

// Render hero from theme, if available.
$theme_partial = 'partials/global/hero';
if ( $content && function_exists( 'Kala\render_partial' ) && file_exists( get_template_directory() . '/' . $theme_partial . '.php'  ) ) :
    Kala\render_partial(
        $theme_partial,
        array(
            'image_id'    => $image_id,
            'style'       => $style,
            'content'     => $content,
            'extra_class' => $extra_class,
        )
    );
    // Backup rendering, markup might be outdated.
elseif ( $content ) :
    $class = 'hero ' . $extra_class . ' alignfull content-row'; ?>
    <div class="<?php echo esc_html( $class ); ?>">
		<div class="hero__container container">
            <div class="hero__content">
                <?php echo do_blocks( $content ); ?>
            </div>
            <?php if ( $image_id ) : ?>
                <figure class="hero__image">
                    <?php echo wp_get_attachment_image( $image_id, 'large' ); ?>
                </figure>
            <?php endif; ?>
        </div>
    </div>
<?php endif;
