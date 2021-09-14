<?php
/**
 * Archive template.
 *
 * @package Lahdensivunkoti
 */

get_header();
$category_image = get_field( 'category_image', get_queried_object() )?>
<div class="content-area">
	<div class="hero alignfull content-row">
		<div class="hero__container container grid has-2-columns">
			<div class="hero__content top-margin--sm">
				<h1><?php echo esc_html( the_archive_title() ); ?></h1>
				<div class="archive-description"><?php echo esc_html( the_archive_description() ); ?></div>
			</div>
			<?php if ( $category_image ) : ?>
				<figure class="hero__image">
					<?php echo wp_get_attachment_image( $category_image, 'large', '', [ 'loading' => 'eager' ] ); ?>
				</figure>
			<?php endif; ?>
		</div>
	</div>
	<div class="posts alignfull content-row">
	<?php
	$categories = get_terms(
		[
			'taxonomy' => get_queried_object()->taxonomy,
			'parent'   => get_queried_object_id(),
		]
	);
	if ( get_term_children( get_queried_object_id(), get_queried_object()->taxonomy ) ) :
		foreach ( $categories as $sub_cat ) :
			$subcat_args = array(
				'post_type'              => 'idea',
				'tax_query'              => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $sub_cat->slug,
					),
				),
				'order'                  => 'ASC',
				'orderby'                => 'title',
				'post_status'            => 'publish',
				'update_post_meta_cache' => false,
				'no_found_rows'          => true, // Skip SQL_CALC_FOUND_ROWS for performance (no pagination).
			);

			// Start WP Query.
			$subcat_query = new WP_Query( $subcat_args );
			if ( $subcat_query->have_posts() ) :
				?>
				<div class="posts-list__sub">
					<h2 class="posts-list__category"><?php echo esc_html( $sub_cat->name ); ?></h2>
					<div class="posts-list grid has-3-columns">
						<?php
						while ( $subcat_query->have_posts() ) :
							$subcat_query->the_post();
							get_template_part( 'partials/post/post-item' );
							endwhile;
						?>
					</div>
				</div>
				<?php
			endif;
		endforeach;
		wp_reset_postdata();
	else :
		if ( have_posts() ) :
			?>
			<div class="posts-list container grid has-3-columns">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'partials/post/post-item' );
				}
				?>
			</div>
			<div class="pagination">
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Unfortunately no posts were found', 'lahdensivunkoti' ); ?></p>
			<?php
		endif;
	endif;
	?>
	</div>

</div>

<?php
get_footer();
