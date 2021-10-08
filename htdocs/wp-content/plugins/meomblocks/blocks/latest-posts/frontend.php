<?php

namespace MEOM\Blocks;

$term_id_1  = attr( 'termId1', $attributes, '1' );
$term_id_2  = attr( 'termId2', $attributes, '1' );
$term_id_3  = attr( 'termId3', $attributes, '1' );
$class_name = attr( 'className', $attributes, '' );

$class_names = [
    'latest-posts',
    'alignwide',
];

if ( $class_name ) {
    $class_names[] = $class_name;
}

// Show latest article from selected category.
$args1 = [
    'cat' => absint( $term_id_1 ),
];

$args2 = [
    'cat' => absint( $term_id_2 ),
];

$args3 = [
    'cat' => absint( $term_id_3 ),
];

// Same base arguments for all.
$args = [
    'post_type'              => 'post',
    'posts_per_page'         => 1,
    'no_found_rows'          => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
];

$args1 = array_merge( $args, $args1 );
$args2 = array_merge( $args, $args2 );
$args3 = array_merge( $args, $args3 );

$latest_posts1 = new \WP_Query( $args1 );
$latest_posts2 = new \WP_Query( $args2 );
$latest_posts3 = new \WP_Query( $args3 );

$articles = [ $latest_posts1, $latest_posts2, $latest_posts3 ];

?>
<div class="<?php echo esc_attr( implode( ' ', $class_names ) ); ?>">
    <div class="grid has-3-columns">
        <?php
        foreach ( $articles as $article ) :
            if ( $article->have_posts() ) :
                while ( $article->have_posts() ) :
                    $article->the_post();

                    get_template_part( 'partials/post/post-item' );
                endwhile;
            endif;
        endforeach;
        ?>
    </div>
</div>
<?php
wp_reset_postdata();
