<?php
/**
 * Partial for displaying the post item.
 *
 * @package Lahdensivunkoti
 */

use function Kala\display_svg;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>
	<h3 class="post-item__title">
		<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-item__link">
			<?php the_title(); ?>
		</a>
	</h3>
	<?php echo esc_html( display_svg( 'arrow-light' ) ); ?>
</article>
