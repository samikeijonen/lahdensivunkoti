<?php
/**
 * 404 template.
 *
 * @package Lahdensivunkoti
 */

get_header();
?>
<div class="content-area">
    <h1 class="page-title"><?php esc_html_e( '404 - Not Found', 'lahdensivunkoti' ); ?></h1>
    <p><?php esc_html_e( 'Unfortunately, we didn’t find anything.', 'lahdensivunkoti' ); ?></p>
</div>
<?php get_footer(); ?>
