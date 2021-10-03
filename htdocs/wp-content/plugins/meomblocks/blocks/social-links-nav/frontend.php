<?php

namespace MEOM\Blocks;

use Kala;

// Render social links from theme, if available.
$theme_partial = 'partials/global/social-links-nav';
if ( function_exists( 'Kala\render_partial' ) && file_exists( get_template_directory() . '/' . $theme_partial . '.php' ) ) :
    Kala\render_partial(
        $theme_partial,
        []
    );
endif;
?>
