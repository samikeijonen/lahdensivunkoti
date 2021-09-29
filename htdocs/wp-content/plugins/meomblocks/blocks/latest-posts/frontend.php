<?php

namespace MEOM\Blocks;

$count      = attr( 'count', $attributes, '2' );
$class_name = attr( 'className', $attributes, '' );

$class_names = [
    'latest-posts',
    'alignwide',
];

if ( $class_name ) {
    $class_names[] = $class_name;
}

$args = [
    'post_type'              => 'post',
    'posts_per_page'         => absint( $count ),
    'no_found_rows'          => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
];

$latest_posts = new \WP_Query( $args );

if ( $latest_posts->have_posts() ) :
	?>
	<div class="<?php echo esc_attr( implode( ' ', $class_names ) ); ?>">
		<div class="grid has-3-columns">
			<?php
			while ( $latest_posts->have_posts() ) :
				$latest_posts->the_post();

				get_template_part( 'partials/post/post-item' );
			endwhile;
			?>
		</div>
	</div>
	<?php
	endif;
wp_reset_postdata();
