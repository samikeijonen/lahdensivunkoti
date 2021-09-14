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
				<h2 class="h3">Testiotsikko</h2>
				<p>Mahdollisesti jotakin tekstiä.</p>
			</div>

			<div class="site-footer__logo-nav top-margin">
				<?php get_template_part( 'partials/global/footer-nav' ); ?>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

</body>
</html>
