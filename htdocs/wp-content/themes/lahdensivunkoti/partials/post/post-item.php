<?php
/**
 * Partial for displaying the post item.
 *
 * @package Lahdensivunkoti
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="post-item__fig">
            <?php the_post_thumbnail( 'medium_large' ); ?>
		</figure>
	<?php endif; ?>
	<div class="post-item__content">
		<h2 class="post-item__title h3">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-item__link">
				<?php the_title(); ?>
			</a>
		</h2>
	</div>
</article>
