<?php
/**
 * Footer template.
 *
 * @package Lahdensivunkoti
 */

?>
</div>
	</main><!-- .site-content -->

	<footer class="site-footer">
		<div class="site-footer__container container grid has-2-columns">
			<div class="site-footer__text top-margin">
				<?php
					// Echo from reusable blocks `/wp-admin/edit.php?post_type=wp_block`.
					// Needs to have slug `alapalkki`.
					$footer_post = get_page_by_path('alapalkki', '', 'wp_block');
					if ( $footer_post ) :
						echo apply_filters( 'the_content', get_the_content( null, false, absint( $footer_post->ID )) ); // phpcs:ignore
					endif;
				?>
			</div>

			<?php get_template_part( 'partials/global/social-links-nav' ); ?>

			<div class="site-footer__logo-nav top-margin">
				<?php get_template_part( 'partials/global/footer-nav' ); ?>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

</body>
</html>
