<?php
/**
 * Home template.
 *
 * @package Lahdensivunkoti
 */

use function Kala\get_svg;

get_header();
?>
<div class="container alignfull">
	<div class="content-area">
		<?php
		the_archive_title( '<h1 class="entry-title has-text-align-center">', '</h1>' );
		the_archive_description( '<div class="archive-description has-text-align-center">', '</div>' );

		if ( have_posts() ) : ?>
			<div class="grid has-3-columns content-row alignfull">
				<?php while ( have_posts() ) {
					the_post();
					get_template_part( 'partials/post/post-item' );
				} ?>
			</div>
			<?php
			the_posts_pagination(
                [
					'prev_text'          => get_svg( 'arrow' ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'lahdensivunkoti' ) . '</span>',
					'next_text'          => get_svg( 'arrow' ) . '<span class="screen-reader-text">' . esc_html__( 'Next page', 'lahdensivunkoti' ) . '</span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'lahdensivunkoti' ) . ' </span>',
				]
            );
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'Unfortunately no posts were found', 'lahdensivunkoti' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php get_footer();
